<?php

namespace App\Backend;

use App\Backend\Modules\Connexion\ConnexionController;
use App\Frontend\Modules\Connection\ConnectionController;
use GuzzleHttp\Psr7\Response;
use OpenFram\RedirectException;
use function GuzzleHttp\Psr7\stream_for;
use function Http\Response\send;

class BackendApplication extends \OpenFram\Application
{

    public function __construct($request)
    {
        parent::__construct($request);
        $this->name = 'Backend';
    }

    /**
     * @return mixed
     */
    public function run()
    {
        try {
            $controller = $this->getController();

            if (!$this->currentUser->isAuthenticated()) {

                $url = '/connection';
                $redirectionResponse = (new Response())
                    ->withStatus(301, 'Fedirection')
                    ->withHeader('Location', $url);
                throw new RedirectException($redirectionResponse,'Redirection');
            }

            if (!$this->currentUser->hasAccess()) {
                $this->currentUser->setFlash('Vous avez pas les permissions nécessaires');
                $url = '/admin/';
                $redirectionResponse = (new Response())
                    ->withStatus(301, 'redirection')
                    ->withHeader('Location', $url);
                throw new RedirectException($redirectionResponse,'Redirection');
            }

            $controller->execute();
            $controller->getpage()->addVar('module', $controller->getModule());
            $page = $controller->getPage()->getGeneratedPage();
            send($this->response->withBody(stream_for($page)));
        }catch (RedirectException $e){
            $e->run();
        }
    }
}
