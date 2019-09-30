<?php

namespace App\Backend\Modules\Permission;


use OpenFram\BackController;
use OpenFram\HTTPRequest;

class PermissionController extends BackController
{


    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des Permission');

        $manager = $this->managers->getManagerOf('Permission');

        $this->page->addVar('permissionsList', $manager->getList());
        $this->page->addVar('permissionsNumber', $manager->count());
    }

}