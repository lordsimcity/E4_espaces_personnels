<?php

/* Fichier permettant de supprimer la session en cours */

session_start();

session_destroy();
unset($_SESSION['lastName']);
unset($_SESSION['firstName']);
unset($_SESSION['userEmail']);

/* Redirection vers la page de connexion */

header("location:./connectionValidation.php");