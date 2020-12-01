<?php

namespace Connection\DatabaseHandling;

use PDO;
use Connection\ConnectionChecks\LoginInformations;

class DatabaseManager {

    private $_dbConnection;

    // Constructeur de la classe

    public function __construct(PDO $connectionInformations) {

        $tmpDbConnection = $connectionInformations;
        $tmpDbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $this->_dbConnection = $tmpDbConnection;

    }

    // Méthode permettant de vérifier qu'un utilisateur existe.

    public function checksBeforeConnection($userEmail) : bool {
        
        $db = $this->_dbConnection;
        $tmpRes = $db->prepare("SELECT * FROM Users WHERE userEmail = :userEmail");
        $tmpRes->bindValue(":userEmail",$userEmail);
        $tmpRes->execute();

        if ($tmpRes->fetch() != null) {

            $tmpRes->closeCursor();
            return true;

        } else {

            $tmpRes->closeCursor();
            return false;

        }

    }

    // Méthode permettant de récupérer les inforamtions d'un utilisateur dans la base de données.

    public function getUserInformations($userEmail) : array {

        $db = $this->_dbConnection;
        $tmpRes = $db->prepare("SELECT * FROM Users WHERE userEmail = :userEmail");
        $tmpRes->bindValue(":userEmail",$userEmail);
        $tmpRes->execute();

        $output = $tmpRes->fetch(PDO::FETCH_ASSOC);

        $listToUse = [];

        foreach($output as $key => $value) {
            $listToUse[$key] = $value;
        }

        return $listToUse;

    }

}