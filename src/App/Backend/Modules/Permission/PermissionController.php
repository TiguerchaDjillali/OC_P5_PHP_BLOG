<?php

namespace App\Backend\Modules\Permission;


use GuzzleHttp\Psr7\Request;
use OpenFram\BackController;

class PermissionController extends BackController
{


    public function executeIndex(Request $request)
    {
        $this->page->addVar('title', 'Permissions');

        $manager = $this->managers->getManagerOf('Permission');

        $this->page->addVar('permissionsList', $manager->getList());
        $this->page->addVar('permissionsNumber', $manager->count());
    }

}