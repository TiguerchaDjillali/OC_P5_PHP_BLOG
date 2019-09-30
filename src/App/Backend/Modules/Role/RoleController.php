<?php

namespace App\Backend\modules\Role;

use OpenFram\BackController;
use OpenFram\HTTPRequest;

class RoleController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des Roles');

        $manager = $this->managers->getManagerOf('Role');

        $this->page->addVar('rolesList', $manager->getList());
        $this->page->addVar('rolesNumber', $manager->count());
    }

    public function executeShow(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('Role');

        $role = $manager->getByAttribute('id', $request->getData('id'));

        if (empty($role)) {
            $this->app->getHttpResponse()->redirect404();
        }


        $this->page->addVar('title', $role->getName());
        $this->page->addVar('role', $role);
        $this->page->addVar('permissions', $role->getPermissions());

    }

}