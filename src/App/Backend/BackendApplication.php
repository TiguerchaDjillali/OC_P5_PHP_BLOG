<?php

namespace App\Backend;

use App\Backend\Modules\Connexion\ConnexionController;
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
        if ($this->currentUser->isAuthenticated()) {
            $controller = $this->getController();

            $controller->getPage()->addVAr('user', $this->currentUser);


            $permissions = $this->currentUser->getAttribute('user')->getRole()->getPermissions();
            $couple = [];
            foreach ($permissions as $permission) {
                $couple [] = [$permission->getModule(), $permission->getAction()];
            }
            $control = [$controller->getModule(), $controller->getAction()];

            if(!in_array($control, $couple)) {
                $this->redirect('/admin/');
            }


        } else {
            $controller = new ConnexionController($this, 'Connexion', 'login');
        }

        $controller->execute();
        $page = $controller->getPage()->getGeneratedPage();
        send($this->response->withBody(stream_for($page)));
    }
}