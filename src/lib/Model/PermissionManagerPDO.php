<?php


namespace Model;

use Entity\Permission;
use Entity\Role;

class PermissionManagerPDO extends PermissionManager
{


    public function getList($offset = -1, $limit = -1)
    {
        $sql = 'SELECT * FROM Permission ';
        if ($offset != -1 || $limit != -1) {
            $sql .= ' LIMIT ' . (int)$limit . ' OFFSET ' . (int)$offset;
        }

        $query = $this->dao->query($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Permission');

        $permissionsList = $query->fetchAll();

        $query->closeCursor();


        return $permissionsList;
    }

    public function getByAttribute($attribute, $value)
    {
        $value = $value ?? 1;// TODO:

        $sql = 'SELECT * FROM permission ';
        $sql .= 'WHERE ' . $attribute . ' = \'' . $value . '\' ';

        $query = $this->dao->query($sql);

        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Permission');

        if ($permission = $query->fetch()) {
            $query->closeCursor();

            return $permission;
        }

        return null;
    }

    public function count()
    {
        $sql = 'SELECT count(*) FROM Permission';
        $query = $this->dao->query($sql);

        return $query->fetchColumn();
    }

    public function add(Permission $permission)
    {
        $sql = 'INSERT INTO Permission (module, action, description ) VALUES ';
        $sql .= '(:module, :action, :description ) ';

        $query = $this->dao->prepare($sql);

        $query->bindValue(':module', $permission->getModule());
        $query->bindValue(':action', $permission->getAction());
        $query->bindValue(':description', $permission->getDescription());


        $query->execute();

        $permission->setId($this->dao->lastInsertId());
    }


    public function getListOf(Role $role)
    {
        $sql = 'SELECT * FROM Permission as p ';
        $sql .= 'INNER JOIN RolePermission AS pr ON pr.permissionId = p.id ';
        $sql .= 'WHERE pr.roleId = :roleId';

        $query = $this->dao->prepare($sql);
        $query->bindValue(':roleId', $role->getId(), \PDO::PARAM_INT);
        $query->execute();

        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Permission');

        $permissions = $query->fetchALL();


        $query->closeCursor();

        return $permissions;
    }
}
