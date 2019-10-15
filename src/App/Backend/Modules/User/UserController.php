<?php


namespace App\Backend\Modules\User;


use Entity\User;
use FormBuilder\PostFormBuilder;
use FormBuilder\UserFormBuilder;
use GuzzleHttp\Psr7\Request;
use OpenFram\BackController;
use OpenFram\Form\FormHandler;

class UserController extends BackController
{
    public function executeIndex(Request $request)
    {
        $this->page->addVar('title', 'Gestion des Utilisateurs');

        $manager = $this->managers->getManagerOf('User');


        $dataTable = [];
        foreach ($manager->getList() as $user) {
            $dataTable[] = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'userName' => $user->getUserName(),
                'email' => $user->getEmail(),
                'role' => $user->getRole()->getName(),


                'viewLink' => '/admin/user-' . $user->getId() . '.html',
                'editLink' => '/admin/user-' . $user->getId() . '.html',
                'deleteLink' => '/admin/user-delete-' . $user->getId() . '.html',
            ];
        }


        $this->page->addVar('dataTable', json_encode($dataTable));

        $this->page->addVar('usersList', $manager->getList());
        $this->page->addVar('usersNumber', $manager->count());
    }

    public function executeShow(Request $request)
    {
        $manager = $this->managers->getManagerOf('User');

        $user = $manager->getByAttribute('id', $request->getQueryParams('GET')['id']);

        if (empty($user)) {

            $this->page->getApp()->redirect404("L'article n'existe pas");

        }

        $this->page->addVar('title', $user->getUserName());
        $this->page->addVar('user', $user);

        $this->processForm($request);

    }


    public function executeInsert(Request $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Ajouter un utilisateur');
    }


    private function processForm(Request $request)
    {

        if ($request->getMethod() == 'POST') {

            $file = $request->getUploadedFiles()["profileImage"];
            if ($file->getError() === 4) {
                $file = null;
            }
            $roleManager = $this->managers->getManagerOf('role');

            $user = new User([
                'firstName' => $request->getParsedBody()["firstName"],
                'lastName' => $request->getParsedBody()["lastName"],
                'userName' => $request->getParsedBody()["userName"],
                'email' => $request->getParsedBody()["email"],
                'confirmEmail' => $request->getParsedBody()["confirmEmail"],
                'password' => $request->getParsedBody()["password"],
                'confirmPassword' => $request->getParsedBody()["confirmPassword"],
                'role' => $roleManager->getByAttribute('id', $request->getParsedBody()["role"]),
                'description' => $request->getParsedBody()["description"],
                'profileImage' => $file,
            ]);
            $user->setHashedPassword();


            if (isset($request->getQueryParams()['id'])) {
                $user->setId($request->getQueryParams()['id']);
                if($request->getParsedBody()["password"] ==''){
                    $user->setPasswordRequired(false);
                }
            }


        } else {
            if (isset($request->getQueryParams()['id'])) {

                $user = $this->managers->getManagerOf('user')->getByAttribute('id', $request->getQueryParams()['id']);
            } else {
                $user = new User;
            }
        }

        $formBuilder = new UserFormBuilder($user);
        $formBuilder->build();
        $form = $formBuilder->getFrom();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('user'), $request);

        if ($formHandler->process()) {
            $this->app->getCurrentUser()->setFlash($user->isNew() ? 'L\'utlisateur a bien été ajouté' : 'L\'utlisateur a bien été mis à jour');
            $this->app->redirect('/admin/users');
        }

        $this->page->addVar('form', $form->createView());


    }

    public function executeDelete(Request $request)
    {
        $this->page->addVar('title', 'Supprimer un utlisateur');
        $post = $this->managers->getManagerOf('user')->getByAttribute('id', $request->getQueryParams()['id']);
        $this->page->addVar('user', $post);


        if ($request->getMethod() == 'POST') {
            $id = $this->app->getRequest()->getQueryParams('GET')['id'];

            $this->managers->getManagerOf('user')->delete($id);

            $this->app->getCurrentUser()->setFlash('L\'utlisateur a bien été supprimé');
            $this->app->redirect('/admin/users');
        }

    }

}