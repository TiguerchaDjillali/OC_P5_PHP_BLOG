<?php

namespace App\Backend;

use App\Backend\Modules\Connexion\ConnexionController;
use App\Frontend\Modules\Connection\ConnectionController;
use function GuzzleHttp\Psr7\stream_for;
use function Http\Response\send;


class BackendApplication extends \OpenFram\Application
{

    public function __construct()
    {
        parent::__construct();
        $this->name = 'Backend';
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $controller = $this->getController();

        if (!$this->currentUser->isAuthenticated()) {
            $this->redirect('/connection');

        } else {
            if(!$this->currentUser->hasAccess()){
                $this->currentUser->setFlash('Vous avez pas les permissions nécessaires');

                $this->redirect('/admin/');
            }
        }

        $controller->execute();
        $controller->getpage()->addVar('module', $controller->getModule());

        $page = $controller->getPage()->getGeneratedPage();
        send($this->response->withBody(stream_for($page)));
    }

}