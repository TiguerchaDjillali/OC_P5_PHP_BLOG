<?php


namespace Model;


use Entity\User;
use function OpenFram\h;

class UserManagerPDO extends UserManager
{

    public function getList($offset = -1, $limit = -1)
    {
        $sql = 'SELECT * FROM User ';
        if ($offset != -1 || $limit != -1) {

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
        $sql .= 'WHERE ' . $attribute . ' = \'' . $value . '\' ';

        $query = $this->dao->query($sql);

        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');

        $roleManager = new RoleManagerPDO($this->dao);

        if ($user = $query->fetch()) {

            $query->closeCursor();

            $user->setRole($roleManager->getByAttribute('id', $user->roleId));

            $imagePath = $_SERVER["DOCUMENT_ROOT"] . '/images/user/user-' . h($user->getId()) . '.jpg';

            if (file_exists($imagePath)) {
                $user->setProfileImage('/images/user/user-' . h($user->getId()) . '.jpg');
            } else {
                $user->setProfileImage('/images/user/user-default.jpg');
            }


            return $user;
        }

        return null;

    }

    public function add(User $user)
    {
        $sql = 'INSERT INTO User (firstName, lastName, userName, email, hashedPassword, description, roleId ) VALUES ';
        $sql .= '(:firstName, :lastName, :userName, :email, :hashedPassword, :description, :roleId ) ';

        $query = $this->dao->prepare($sql);
        $query->bindValue(':firstName', $user->getFirstName());
        $query->bindValue(':lastName', $user->getLastName());
        $query->bindValue(':userName', $user->getUserName());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':hashedPassword', $user->getHashedPassword());
        $query->bindValue(':description', $user->getDescription());
        $query->bindValue(':roleId', $user->getRole()->getId());

        $query->execute();

        $user->setId($this->dao->lastInsertId());


        if ($user->getProfileImage() !== null) {
            $imageTarget = $_SERVER["DOCUMENT_ROOT"] . '/images/user/user-' . $this->dao->lastInsertId() . '.jpg';
            $user->getProfileImage()->moveTo($imageTarget);
        }
    }


    public function update(User $user)
    {
        $sql = "UPDATE User SET ";
        $sql .= "firstName = :firstName, ";
        $sql .= "lastName = :lastName, ";
        $sql .= "userName = :userName, ";
        $sql .= "email = :email, ";
        $sql .= "description = :description, ";
        if ($user->isPasswordRequired()) {
            $sql .= "hashedPassword = :hashedPassword, ";
        }
        $sql .= "roleId = :roleId ";
        $sql .= "WHERE id = :id ";


        $query = $this->dao->prepare($sql);

        $query->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        $query->bindValue(':firstName', $user->getFirstName());
        $query->bindValue(':lastName', $user->getLastName());
        $query->bindValue(':userName', $user->getUserName());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':description', $user->getDescription());
        $query->bindValue(':roleId', $user->getRole()->getId());

        if ($user->isPasswordRequired()) {
            $query->bindValue(':hashedPassword', $user->getHashedPassword());
        }

        $query->execute();

        if ($user->getProfileImage() !== null) {
            $imageTarget = $_SERVER["DOCUMENT_ROOT"] . '/images/user/user-' . $user->getId() . '.jpg';
            $user->getProfileImage()->moveTo($imageTarget);
        }

    }

    public function delete($id)
    {

        $sql = 'DELETE FROM user ';
        $sql .= 'WHERE id=:id ';

        $query = $this->dao->prepare($sql);
        $query->bindValue(':id', $id, \PDO::PARAM_INT);

        $query->execute();

        $imagePath = $_SERVER["DOCUMENT_ROOT"] . '/images/user/user-' . h($id) . '.jpg';

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

    }

}