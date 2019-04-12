<?php

namespace App\Model;
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
        try
        {
            $db = new PDO('mysql:host=127.0.0.1;dbname=ocp3;charset=utf8', 'ocp3', 'Tinfoil-jobs-crucial-neff-pagan-privacy2', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $db;
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
    }
}