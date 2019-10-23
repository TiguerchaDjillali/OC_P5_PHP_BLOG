<?php


namespace Model;

use Entity\User;
use http\Exception\RuntimeException;
use OpenFram\Manager;

abstract class UserManager extends Manager
{
    abstract public function getById($value);

    abstract public function getByUserName($value);

    public function save(User $user)
    {
        if ($user->isValid()) {
           return $user->isNew() ? $this->add($user) : $this->update($user);
        } else {
            throw new RuntimeException('L\'article doit être valid pour être enregistré');
        }
    }

    abstract public function add(User $post);
}
