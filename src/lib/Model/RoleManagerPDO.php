<?php


namespace Model;

use Entity\Role;
use MongoDB\Driver\Manager;
use PDO;

class RoleManagerPDO extends RoleManager
{


    public function getList($offset = -1, $limit = -1)
    {
        $sql = 'SELECT * FROM Role ';

        if ($offset != -1 || $limit != -1) {
            $sql .= ' LIMIT :limit  OFFSET :offset ';
        }

        $query = $this->dao->prepare($sql);

        if ($offset != -1 || $limit != -1) {
            $query->bindValue(':limit', $limit, \PDO::PARAM_INT);
            $query->bindValue(':offset', $offset, \PDO::PARAM_INT);
        }
        $query->execute();

        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Role');

        $rolesList = $query->fetchAll();

        $query->closeCursor();
        $permissionsManager = new PermissionManagerPDO($this->dao);
        foreach ($rolesList as $role) {
            $role->setPermissions($permissionsManager->getListOf($role));
        }


        return $rolesList;
    }

    public function getById($value)
    {

        $sql = 'SELECT * FROM Role ';
        $sql .= 'WHERE id = :id ';

        $query = $this->dao->prepare($sql);

        $query->bindValue(':id', $value, PDO::PARAM_INT);

        $query->execute();


        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\Entity\Role');

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
