<?php

session_start();

use Connection\ConnectionChecks\LoginInformations;
use Connection\DatabaseHandling\DatabaseManager;

require "./vendor/autoload.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $dataList = [
        'userEmail' => $email,
        'userPassword' => $password
    ];
    
    // Informations de connexion à la base de données :
    $db = new PDO("mysql:host=localhost;dbname=E4_ESPACES_PERSONNELS","root","root");
    $dbConnection = new DatabaseManager($db);
    
    $connectionInformations = new LoginInformations($dataList);
    
    if ($dbConnection->checksBeforeConnection($connectionInformations->getUserEmail())) {
    
        $res = $dbConnection->getUserInformations($connectionInformations->getUserEmail());

        if (password_verify($connectionInformations->getUserPassword(),$res['password'])) {

            $_SESSION['idUser'] = $res['idUsers'];
            $_SESSION['lastName'] = $res['lastName'];
            $_SESSION['firstName'] = $res['firstName'];
            $_SESSION['userEmail'] = $res['userEmail'];
        
            header("location:../../Profil/profil.php");

        } else {

            echo "<p>Le mot de passe est incorrect !</p>";
            echo "<p> <a href=\"../connection.html\"> > Retourner au formulaire de connexion </a> </p>";

        }
        
    } else {
    
        echo "<p>L'espace personnel n'éxiste pas !</p>";
        echo "<p> <a href=\"../connection.html\"> > Retourner au formulaire de connexion </a> </p>";
        echo "<p> <a href=\"../../Inscription/registration.html\"> > S'inscrire </a> </p>";
    
    }

} else {
    header("location:../connection.html");
}
