Jonathan RX - Projet 3
==
*Réalisé dans le cadre de la formation OpenClassroom*

--------------
Utilisation
-
Ce code peut être déployé sur un serveur apache, il nécessite la création d'un fichier Php nommé "DbManager.php" dans le dossier src/Model contenant :

```php
<?php

namespace App\Model;
use \PDO;

class DbManager
{
    protected function dbConnect()
    {
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=NomDeLaBase;charset=utf8', 'Utilisateur', 'MotDePasse', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $db;
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
    }
}
```