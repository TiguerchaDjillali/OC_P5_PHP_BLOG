<?php

namespace App\Frontend\Modules\Post;

use Entity\Comment;
use FormBuilder\CommentFormBuilder;
use GuzzleHttp\Psr7\Request;
use Model\UserManagerPDO;
use Model\PostManagerPDO;
use OpenFram\BackController;
use OpenFram\Form\Form;
use OpenFram\Form\FormHandler;
use GuzzleHttp\Psr7\Response;
use function OpenFram\escape_to_html as h;
use function OpenFram\u;

class PostController extends BackController
{
    public function executeIndex(Request $request)
    {

        $limit = 4;

        $page = $request->getQueryPArams()['page'];
        $offset = (($page - 1) * $limit);


        $this->page->addVar('title', 'Liste des  articles');
        $manager = $this->managers->getManagerOf('Post');

        $postsList = $manager->getList(['offset' => $offset, 'limit' => $limit, 'visible' => 1]);
        $postsNumber = $manager->count(['visible' => 1]);

        $this->page->addVar('limit', $limit);
        $this->page->addVar('activePage', $page);
        $this->page->addVar('postsNumber', $postsNumber);
        $this->page->addVar('postsList', $postsList);
        $this->page->addVar('pageType', 'index-page small-header');
    }


    public function executeShow(Request $request)
    {
        $manager = $this->managers->getManagerOf('Post');
        //__________________________

        if ($this->app->getCurrentUser()->isAuthenticated()) {
            $permissions = $this->app->getCurrentUser()->getAttribute('user')->getRole()->getPermissions();
            $couple = [];
            foreach ($permissions as $permission) {
                $couple [] = [$permission->getModule(), $permission->getAction()];
            }
            $control = ['Post', 'Preview'];


            if (in_array($control, $couple)) {
                $post = $manager->getByAttribute('id', $request->getQueryParams('GET')['id']);
            } else {
                $post = $manager->getByAttribute('id', $request->getQueryParams('GET')['id'], ['visible' => 1]);
            }
        } else {
            $post = $manager->getByAttribute('id', $request->getQueryParams('GET')['id'], ['visible' => 1]);
        }


        if (empty($post)) {
            $this->page->getApp()->redirect404("L'article n'existe pas");
        }

        //___________________________


        $this->page->addVar('title', $post->getTitle());
        $this->page->addVar('post', $post);


        $comments = $this->managers->getManagerOf('Comment')->getListOF($post);

        $this->page->addVar('comments', $comments);
        $this->executeInsertComment($request);
    }

    public function executeInsertComment(Request $request)
    {

        if ($request->getMethod() == 'POST') {
            if (isset($request->getParsedBody()['loginForComment'])) {
                $this->app->getCurrentUser()->setAttribute('lastUrl', $this->app->getRequest()->getUri()->getPath());
                $this->app->getCurrentUser()->setAttribute('commentContent', $request->getParsedBody()['content']);

                $this->app->redirect('/connection');
            }


            $comment = new Comment(
                [
                    'content' => $request->getParsedBody()['content'],
                    'post' => $this->managers->getManagerOf('Post')->getByAttribute(
                        'id',
                        $request->getQueryParams('GET')['id']
                    ),
                    'user' => $this->app->getCurrentUser()->getAttribute('user')
                ]
            );
        } else {
            $comment = new Comment;

            if ($this->app->getCurrentUser()->hasAttribute('commentContent')) {
                $comment->setContent($this->app->getCurrentUser()->getAttribute('commentContent'));
                $this->app->getCurrentUser()->setAttribute('commentContent', null);
            }
        }

        $formBuilder = new CommentFormBuilder($this->app, $comment);
        $formBuilder->build();

        $form = $formBuilder->getFrom();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('comment'), $request);

        if ($formHandler->process()) {
            $this->app->getCurrentUser()->setFlash('Votre commentaitre a bien été ajouté, merci!');
            $this->app->redirect('post-' . htmlspecialchars(urlencode($request->getQueryParams('GET')['id'])) . '.html#commentForm');
        }


        $this->page->addVar('comment', $comment);
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('pageType', 'small-header');
    }
}
