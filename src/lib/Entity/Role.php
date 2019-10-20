<?php


namespace Entity;


use http\Exception\InvalidArgumentException;
use OpenFram\Entity;

class Role extends Entity
{
    protected $name;
    protected $slug;

    protected $permissions = [];


    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @param array (Permission $permissions)
     */
    public function setPermissions(array  $permissions)
    {
        $this->permissions = $permissions;
    }





    public function isValid()
    {
        //TODO:
        return true;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        if(is_string($name)) {
            $this->name = $name;

        }
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        if(is_string($slug)) {
            $this->slug = $slug;
        }
    }



}
