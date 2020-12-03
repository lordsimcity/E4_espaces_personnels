<?php

  session_start();

  if (!isset($_SESSION['userEmail'])) {
    header("location:../Connexion/connection.html");
  }

?>

<!DOCTYPE html">
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Profil</title>
    <link rel="stylesheet" href="style_profil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  </head>
  
  <body>
  <div id="big_box">
    <div class="container">
        <div class="row">
          <div class="col-5">
            <img src="profilimage.png">
          </div>
          <div class="col-7">
            <p>Nom : <?php echo $_SESSION['lastName'] ?> </p> 
            <p>Prénom : <?php echo $_SESSION['firstName'] ?> </p> 
            <p>Email : <?php echo $_SESSION['userEmail'] ?> </p> 
                <button class="btn" onclick="toggleFormMail()">Changer votre addresse mail</button>
                <div id="formsMail" class="forms">
                    <form>
                        <label for="pwd">Mot de passe :</label><br>
                        <input type="text" id="pwd" name="pwd"><br>
                        <label for="new_mail">Nouvelle addresse :</label><br>
                        <input type="text" id="new_mail" name="new_mail">
                    </form>
                    <button type="submit">Valider</button>
                    <button onclick="closeFormMail()">Fermer</button>
                </div>
            <p>Mot de passe : ************</p> 
            <button class="btn" onclick="toggleFormPwd()">Changer votre mot de passe</button>
            <div id="formsMdp" class="forms">
                <form>
                    <label for="pwd">Mot de passe actuelle :</label><br>
                    <input type="text" id="pwd" name="pwd"><br>
                    <label for="new_pwd">Nouveau mot de passe :</label><br>
                    <input type="text" id="new_pwd" name="new_pwd"><br>
                    <label for="tewt_new_pwd">Réécrire le nouveau mot de passe :</label><br>
                    <input type="text" id="new_mail" name="new_mail">
                </form>
                <button type="submit">Valider</button>
                <button onclick="closeFormPwd()">Fermer</button>
            </div>
            </div>
          </div>
        </div>
      </div>
    
  </div>

  <hr class="hr">
  <a href="../Connexion/php/logout.php">> Se déconnecter </a>
  <a href="../../PanierV2/basket.php">> Voir mon panier </a>
  <a href="../../PanierV2/products.php">> Voir les produits </a>
  </body>
  <script src="script.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>