<?php


namespace OpenFram;

class PDOFactory
{
    public static function getMysqlConnection()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog_user', '0000');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}