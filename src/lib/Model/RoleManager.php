<?php


namespace Model;

use Entity\Role;
use http\Exception\RuntimeException;
use OpenFram\Manager;

abstract class RoleManager extends Manager
{
    abstract public function getList($offset = -1, $limit = -1);

    abstract public function getById($value);

    abstract public function count();

    public function save(Role $role)
    {
        if ($role->isValid()) {
            $role->isNew() ? $this->add($role) : $this->update($role);
        } else {
            throw new RuntimeException('Le role doit être valide  pour être enregistré');
        }
    }
    abstract public function add(Role $role);
}
