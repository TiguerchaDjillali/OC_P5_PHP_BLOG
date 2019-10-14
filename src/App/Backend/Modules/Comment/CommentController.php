<?php

namespace App\Backend\Modules\Comment;


use GuzzleHttp\Psr7\Request;

class CommentController extends \OpenFram\BackController
{

    public function executeIndex(Request $request)
    {

        $this->page->addVar('title', 'Gestion des commentaires');
        $manager = $this->managers->getManagerOf('Comment');

        $dataTable = [];
        foreach ($manager->getList() as $comment) {
            $dataTable[] = [
                'id' => $comment->getId(),
                'postTitle' => $comment->getPost()->getTitle(),
                'content' => $comment->getContent(),
                'author' => $comment->getUser()->getUserName(),
                'valid' => $comment->getValid(),
                'publicationDate' => $comment->getPublicationDate()->format('Y-m-d H:i:s'),
                'editLink' => '/admin/comment-moderate-' . $comment->getId() . '.html#comment-' . $comment->getId()
            ];
        }

        $this->page->addVar('dataTable', json_encode($dataTable) );
        $this->page->addVar('commentsList', $manager->getList());
        $this->page->addVar('commentsNumber', $manager->count());
        $this->page->addVar('nonValidCommentsNumber', $manager->count(['valid' => 0]));


    }

    public function executeModerate(Request $request)
    {

        $commentManager = $this->managers->getManagerOf('comment');
        $postManager = $this->managers->getManagerOf('post');

        $targetComment = $commentManager->getByAttribute('id', $request->getQueryParams()['id']);
        $post = $postManager->getByAttribute('id', $targetComment->getPost()->getId());
        $commentsList = $commentManager->getListOf($post);


        $this->page->addVar('title', 'Validation des commentaires');
        $this->page->addVAr('commentId', 'comment-' . $targetComment->getId());
        $this->page->addVAr('targetComment', $targetComment);
        $this->page->addVAr('post', $post);
        $this->page->addVAr('commentsList', $commentsList);


        $this->processForm($request);
    }

    private function processForm(Request $request)
    {

        if ($request->getMethod() === 'POST') {
            $manager = $this->managers->getManagerOf('comment');

            if (isset($request->getParsedBody()['valid'])) {
                $manager->validate($request->getParsedBody()['valid']);
                $this->app->getCurrentUser()->setFlash('Le commentaire à été validé ');
                $this->app->redirect('/admin/comments');

            }

            if (isset($request->getParsedBody()['invalid'])) {

                $manager->invalidate($request->getParsedBody()['invalid']);
                $this->app->getCurrentUser()->setFlash('Le commentaire à été caché ');
                $this->app->redirect('/admin/comments');
            }

            if (isset($request->getParsedBody()['delete'])) {

                $manager->delete($request->getParsedBody()['delete']);
                $this->app->getCurrentUser()->setFlash('Le commentaire à été supprimé ');
                $this->app->redirect('/admin/comments');
            }

        } else {
            return;
        }

    }


}