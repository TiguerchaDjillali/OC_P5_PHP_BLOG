<?php

namespace App\Backend\modules\Role;

use GuzzleHttp\Psr7\Request;
use OpenFram\BackController;

class RoleController extends BackController
{
    public function executeIndex(Request $request)
    {
        $this->page->addVar('title', 'Roles');


        $manager = $this->managers->getManagerOf('Role');
        $rolesList = $manager->getList();
        $dataTable = [];
        foreach ($rolesList as $role) {
            $dataTable[] = [
                'id' => $role->getId(),
                'name' => $role->getName(),
                'slug' => $role->getSlug(),
                'viewLink' => '/admin/role-' . $role->getId() . '.html',
                'editLink' => '/admin/role-edit-' . $role->getId() . '.html',
                'deleteLink' => '/admin/role-delete-' . $role->getId() . '.html',
            ];
        }


        $this->page->addVar('rolesList', $rolesList);
        $this->page->addVar('dataTable', $dataTable);
        $this->page->addVar('rolesNumber', $manager->count());
    }



    public function executeShow(Request $request)
    {
        $manager = $this->managers->getManagerOf('Role');

        $role = $manager->getById( $request->getQueryPArams()['id']);

        if (empty($role)) {
            $this->app->redirect404();
        }

        $modules = [];
        foreach ($role->getPermissions() as $permission) {
            if (!array_key_exists($permission->getModule(), $modules)) {
                $modules [$permission->getModule()] = [];
            }
            if (array_key_exists($permission->getModule(), $modules)) {
                $modules[$permission->getModule()][] = [$permission->getAction(), $permission->getDescription()];
            }
        }


        $this->page->addVar('modules', $modules);
        $this->page->addVar('title', $role->getName());
        $this->page->addVar('role', $role);
    }
}
