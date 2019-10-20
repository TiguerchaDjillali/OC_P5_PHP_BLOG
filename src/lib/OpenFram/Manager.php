<?php


namespace OpenFram;


abstract class Manager
{
    protected $dao;
    //static protected $table='';

    public function __construct($dao)
    {
        $this->dao = $dao;
    }

}
