<?php

use Registration\ReCaptcha;
use Registration\Informations\RegistrationInformations;
use Registration\DatabaseHandling\DatabaseManager;

require "./vendor/autoload.php";

if(!empty($_POST["g-recaptcha-response"])) {

    $code = htmlspecialchars($_POST["g-recaptcha-response"]);

    $reCaptcha = new ReCaptcha("6LdZCvUZAAAAAJgzrTYiRojyn4cMdQZA342yBM_u");
    
    if($reCaptcha->checkCode($code)) {
        // Les potentiels scripts envoyés sont rendus inoffensifs :
        $lastName = htmlspecialchars($_POST['lastName']);
        $firstName = htmlspecialchars($_POST['firstName']);
        $userEmail = htmlspecialchars($_POST['userEmail']);
        $password = htmlspecialchars($_POST['password']);
        $passwordVerify = htmlspecialchars($_POST['passwordVerify']);

        if ($password == $passwordVerify) {

            $dataList = [
                'lastName' => $lastName,
                'firstName' => $firstName,
                'userEmail' => $userEmail,
                'password' => $password
            ];

            // Informations de connexion à la base de données :
            $db = new PDO("mysql:host=localhost;dbname=E4_ESPACES_PERSONNELS","root","root");
            $dbConnection = new DatabaseManager($db);

            $registrationInformations = new RegistrationInformations($dataList);

            if (!$dbConnection->checksBeforeRegistration($registrationInformations->getUserEmail())) {

                $dbConnection->addUser($registrationInformations);

                echo "<p>Vous avez bien été ajouté à notre base de données !</p>";
                echo "<a href=\"../registration.html\"> > Retourner au formulaire d'inscription </a>";

            } else {

                echo "<p>Vous avez déjà un espace personnel !</p>";
                echo "<a href=\"../registration.html\"> > Retourner au formulaire d'inscription </a>";

            }

        } else {

            echo "<p>Les deux mots de passe renseignés ne sont pas identiques !!!</p>";
            echo "<a href=\"../registration.html\"> > Retourner au formulaire d'inscription </a>";

        }
    } else {
        echo "<p>Erreur de validation du reCAPTCHA !</p>";
        echo "<a href=\"../registration.html\"> > Retourner au formulaire d'inscription </a>";
    }

}
