<?php
namespace App\Backend\Modules\Connexion;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\ServerRequest;
use OpenFram\BackController;
use function Http\Response\send;

class ConnexionController extends BackController
{

    public function executeLogin(Request $request)
    {
        $this->page->addVar('title', 'Connexion');
        if($request->getMethod() ==='POST'){

            $login = $request->getParsedBody()['login'];
            $password = $request->getParsedBody()['password'];
            $user = $this->managers->getManagerOf('User')->getByAttribute('userName', $login);
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