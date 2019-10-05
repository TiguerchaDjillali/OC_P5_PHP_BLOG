<?php

namespace App\Backend\Modules\Post;

use Entity\Post;
use FormBuilder\PostFormBuilder;
use GuzzleHttp\Psr7\Request;
use OpenFram\BackController;
use OpenFram\Form\FormHandler;

class PostController extends BackController
{
    public function executePreview(Request $request)
    {
        $id = $this->app->getRequest()->getQueryParams('GET')['id'];

        $this->app->getResponse()->redirect('/post-' . $id . '.html');
    }

    public function executeShow(Request $request)
    {
        $manager = $this->managers->getManagerOf('Post');

        $post = $manager->getByAttribute('id', $request->getRequest()->getQueryParams('GET')['id']);

        if (empty($post)) {

            $this->page->addVar('title','Erreur 404');
            $this->app->redirect404();

        }

        $comments = $this->managers->getManagerOf('Comment')->getListOF($post);

        $this->page->addVar('title', $post->getTitle());
        $this->page->addVar('post', $post);
        $this->page->addVar('comments', $comments);

    }

    public function executeIndex(Request $request)
    {
        $this->page->addVar('title', 'Gestion des articles');

        $manager = $this->managers->getManagerOf('Post');

        $this->page->addVar('postsList', $manager->getList());
        $this->page->addVar('postsNumber', $manager->count());


    }

    public function executeDelete(Request $request)
    {
        $this->page->addVar('title', 'Supprimer un article');
        if ($request->method() == 'POST') {
            $id = $this->app->getRequest()->getQueryParams('GET')['id'];

            // Suppression des commentaire est prise en charge par la base de données
            $this->managers->getManagerOf('post')->delete($id);

            $this->app->getCurrentUser()->setFlash('L\'article à bien été supprimé');
            $this->app->getResponse()->redirect('/admin/');
        }

    }

    public function executeInsert(Request $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Ajouter un article');
    }

    public function executeUpdate(Request $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Modifier un article');
    }


    public function processForm(Request $request)
    {
        if ($request->getMethod() == 'POST') {

            $post = new Post([
                'title' => $request->getParsedBody()['title'],
                'subtitle' => $request->getParsedBody()['subtitle'],
                'user' => $this->managers->getManagerOf('user')->getByAttribute('id', $request->getParsedBody()['userId']),
                'content' => $request->getParsedBody()['content'],
                'visible' => $request->getParsedBody()['save'],
                'publicationDate' => new \DateTime($request->getParsedBody()['publicationDate']),
                'modificationDate' => new \DateTime($request->getParsedBody()['modificationDate'])
            ]);


            if (isset($request->getQueryParams()['id'])) {
                $post->setId($request->getQueryParams()['id']);
            }

        } else {
            if (isset($request->getQueryParams()['id'])) {
                $post = $this->managers->getManagerOf('post')->getByAttribute('id', $request->getQueryParams()['id']);
            } else {
                $post = new Post;
            }
        }


        $formBuilder = new PostFormBuilder($post);
        $formBuilder->build();
        $form = $formBuilder->getFrom();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('post'), $request);

        if ($formHandler->process()) {
            $this->app->getCurrentUser()->setFlash($post->isNew() ? 'L\'article a bien été ajouté' : 'L\'article a bien été mis à jour');
            $this->app->getResponse()->redirect('/admin/');
        }

        $this->page->addVar('form', $form->createView());

    }


}