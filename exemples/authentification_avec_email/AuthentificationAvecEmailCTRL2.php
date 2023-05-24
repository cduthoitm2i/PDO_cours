<?php

session_start();
/*
  C:\xampp\htdocs\PDOCours\AuthentificationAvecEmail\
  http://pascalbuguet.alwaysdata.net/PDOCours/AuthentificationAvecEmail/AuthentificationAvecEmailCTRL2.php
  AuthentificationAvecEmailCTRL2.php
 */

$message = "";
// Le code saisi
$code = filter_input(INPUT_POST, "code");
// Le code stocké en session
$codeSession = $_SESSION["code_secret"];
// Comparaison
if ($code == $codeSession) {
    $message = "Authentification OK";
} else {
    $message = "Authentification Kaput";
}

include './AuthentificationAvecEmailView.php';
?>
