<?php

namespace App\Frontend\Modules\Connection;

use Entity\Connection;
use FormBuilder\ContactFormBuilder;
use FormBuilder\LoginFormBuilder;
use GuzzleHttp\Psr7\Request;

class ConnectionController extends \OpenFram\BackController
{

    public function executeLogin(Request $request)
    {
        if($request->getMethod() ==='POST'){

            $userName = $request->getParsedBody()['userName'];
            $password = $request->getParsedBody()['password'];

            $user = $this->managers->getManagerOf('User')->getByAttribute('userName', $userName);
            if($user !== null  &&  $user->verifyPassword($password)){

                $this->app->getCurrentUser()->setAuthenticated(true);
                $this->app->getCurrentUser()->setAttribute('user',$user);
                if($this->app->getCurrentUser()->hasAttribute('lastUrl')){
                    $this->app->redirect($this->app->getCurrentUser()->getAttribute('lastUrl'));

                }else{
                    $this->app->redirect('/admin/');
                }

            }else{
                $this->app->getCurrentUser()->setFlash('Le userName ou le mot de passe est incorrect');
            }
        }

        $connection = new Connection();
        $formBuilder = new LoginFormBuilder($connection);
        $formBuilder->build();
        $form = $formBuilder->getFrom();

        $this->page->addVar('form', $form->createView());
        $this->page->addVar('title', 'Connexion');
        $this->page->addVar('pageType', 'login-page');

    }


    public function executeLogout(Request $request)
    {
        session_destroy();

        $this->page->addVar('title', 'Déconnexion');
        $this->page->addVar('user', $this->app->getCurrentUser()->getAttribute('user'));

        $this->getApp()->getCurrentUser()->setFlash('Déconnexion réussie');
        $this->app->redirect('/');
    }



    /*
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Connexion');

        if($request->postExists('login')){
            $login = $request->postData('login');
            $password = $request->postData('password');

            if($login === $this->app->getConfig()->get('login') && $password === $this->app->getConfig()->get('password')){
                $this->app->getCurrentUser()->setAuthenticated(true);
                $this->app->getHttpResponse()->redirect('.');
            }else{
                $this->app->getCurrentUser()->setFlash('Le userName ou le mot de passe est incorrect');
            }
        }

    }
    */
}