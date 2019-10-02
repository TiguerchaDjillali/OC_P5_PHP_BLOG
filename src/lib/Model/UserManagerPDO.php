<?php


namespace Model;


use Entity\User;

class UserManagerPDO extends UserManager
{

    public function getList($offset = -1, $limit = -1)
    {
        $sql = 'SELECT * FROM User ';
        if($offset != -1 || $limit != -1) {

            $sql .= ' LIMIT ' . (int)$limit . ' OFFSET ' . (int)$offset;
        }

        $query = $this->dao->query($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');

        $usersList = $query->fetchAll();

        $query->closeCursor();

        $roleManager = new RoleManagerPDO($this->dao);

        foreach ($usersList as $user) {

           $user->setRole($roleManager->getByAttribute('id', $user->roleId));

        }

        return $usersList;


    }

    public function count()
    {
        $sql = 'SELECT count(*) FROM User';
        $query = $this->dao->query($sql);

        return $query->fetchColumn();
    }



    public function getByAttribute($attribute, $value)
    {
        $value = $value ?? 1;// TODO:

        $sql = 'SELECT * FROM User ';
        $sql .= 'WHERE ' . $attribute . ' = \'' . $value. '\' ';

        $query = $this->dao->query($sql);

        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');

        $roleManager = new RoleManagerPDO($this->dao);

        if ($user = $query->fetch()) {

            $query->closeCursor();

            $user->setRole($roleManager->getByAttribute('id', $user->roleId));

            return $user;
        }

        return null;

    }

    public function add (User $user)
    {
        $sql = 'INSERT INTO User (firstName, lastName, userName, , hashedPassword ) VALUES ';
        $sql .= '(:firstName, :lastName, :userName, :, :hashedPassword ) ';

        $query = $this->dao->prepare($sql);
        $query->bindValue(':firstName', $user->getFirstName());
        $query->bindValue(':lastName', $user->getLastName());
        $query->bindValue(':userName', $user->getUserName());
        $query->bindValue(':', $user->getEmail());
        $query->bindValue(':hashedPassword', $user->getHashedPassword());

        $query->execute();

        $user->setId($this->dao->lastInsertId());
    }


}