<?php

namespace Registration\DatabaseHandling;

use PDO;
use Registration\Informations\RegistrationInformations;

/**
 * La classe DataBaseManager permettra de manipuler les données présentes dans la BDD
 */

class DataBaseManager {

    private $_dbConnection;

    // Constructeur de la classe

    public function __construct(PDO $connectionInformations) {

        $tmpDbConnection = $connectionInformations;
        $tmpDbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $this->_dbConnection = $tmpDbConnection;

    }

    // Méthode permettant de vérifier qu'un utilisateur n'a pas déjà crée un compte.

    public function checksBeforeRegistration($userEmail) : bool {
        
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

    // Méthode permettant d'ajouter un compte utilisateur à la base de données.

    public function addUser(RegistrationInformations $data) : void {
        
        $db = $this->_dbConnection;

        // Étape avant ajout d'un utilisateur à la base de données -> "chiffrement" du mdp.
        $password = password_hash($data->getPassword(),PASSWORD_DEFAULT);

        $tmpRes = $db->prepare("INSERT INTO Users(lastName,firstName,userEmail,password) VALUES(:lastName,:firstName,:userEmail,:password)");
        $tmpRes->bindValue(":lastName",$data->getLastName());
        $tmpRes->bindValue(":firstName",$data->getFirstName());
        $tmpRes->bindValue(":userEmail",$data->getUserEmail());
        $tmpRes->bindValue(":password",$password);

        $tmpRes->execute();

        $tmpRes->closeCursor();

    }

}