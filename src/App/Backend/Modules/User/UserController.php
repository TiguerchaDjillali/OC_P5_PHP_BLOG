<?php


namespace App\Backend\Modules\User;


use OpenFram\BackController;
use OpenFram\HTTPRequest;

class UserController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des Utilisateurs');

        $manager = $this->managers->getManagerOf('User');

        $this->page->addVar('usersList', $manager->getList());
        $this->page->addVar('usersNumber', $manager->count());
    }



}