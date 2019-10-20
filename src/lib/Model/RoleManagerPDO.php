<?php


namespace Model;

use Entity\Role;
use MongoDB\Driver\Manager;

class RoleManagerPDO extends RoleManager
{


    public function getList($offset = -1, $limit = -1)
    {
        $sql = 'SELECT * FROM Role ';
        if ($offset != -1 || $limit != -1) {
            $sql .= ' LIMIT ' . (int)$limit . ' OFFSET ' . (int)$offset;
        }

        $query = $this->dao->query($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Role');

        $rolesList = $query->fetchAll();

        $query->closeCursor();
        $permissionsManager = new PermissionManagerPDO($this->dao);
        foreach ($rolesList as $role) {
            $role->setPermissions($permissionsManager->getListOf($role));
        }


        return $rolesList;
    }

    public function getByAttribute($attribute, $value)
    {
        $value = $value ?? 1;// TODO:

        $sql = 'SELECT * FROM role ';
        $sql .= 'WHERE ' . $attribute . ' = \'' . $value. '\' ';

        $query = $this->dao->query($sql);

        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Role');

        $permissionsManager = new PermissionManagerPDO($this->dao);
        if ($role = $query->fetch()) {
            $role->setPermissions($permissionsManager->getListOf($role));
            $query->closeCursor();

            return $role;
        }

        return null;
    }

    public function count()
    {
        $sql = 'SELECT count(*) FROM Role';
        $query = $this->dao->query($sql);

        return $query->fetchColumn();
    }

    public function add(Role $role)
    {
        $sql = 'INSERT INTO Role (module, action, description ) VALUES ';
        $sql .= '(:module, :action, :description ) ';

        $query = $this->dao->prepare($sql);

        $query->bindValue(':module', $role->getModule());
        $query->bindValue(':action', $role->getAction());
        $query->bindValue(':description', $role->getDescription());


        $query->execute();

        $role->setId($this->dao->lastInsertId());
    }
}
