<?php


namespace Model;

use Entity\Permission;
use Entity\Role;
use http\Exception\RuntimeException;
use OpenFram\Manager;

abstract class PermissionManager extends Manager
{

    abstract public function getList($options = []);

    abstract public function getById($value);

    abstract public function count();

    public function save(Permission $permission)
    {
        if ($permission->isValid()) {
            $permission->isNew() ? $this->add($permission) : $this->update($permission);
        } else {
            throw new RuntimeException('La pemission doit être valie  pour être enregistrée');
        }
    }

    abstract public function add(Permission $permission);

    abstract public function getListOf(Role $role);
}
