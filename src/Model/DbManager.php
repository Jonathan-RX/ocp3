<?php

namespace App\Model;
use App\config\Config;
use \PDO;

class DbManager
{
    /**
     * Initializes the connection to the database
     *
     * @return object PDO databse connection object
     */
    protected function dbConnect()
    {
        $config = new Config();
        try
        {
            $db = new PDO('mysql:host=' . $config->getDBHost() . ';dbname=' . $config->getDBName() . ';charset=utf8', $config->getDBUser(), $config->getDBPassword(), array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $db;
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
    }
}