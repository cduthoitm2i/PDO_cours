<?php

session_start();
/*
  C:\xampp\htdocs\PDOCours\AuthentificationAvecEmail\
  http://pascalbuguet.alwaysdata.net/PDOCours/AuthentificationAvecEmail/AuthentificationAvecEmailCTRL.php
  AuthentificationAvecEmailCTRL.php
 */

$message = "";
$pseudo = filter_input(INPUT_POST, "pseudo");
$mdp = filter_input(INPUT_POST, "mdp");

if ($pseudo != null && $mdp != null) {
    try {
        // Connexion
        require_once './ConnectionDB.php';
        $pdo = getConnection("../conf/cours.ini");

        // Préparation et exécution du SELECT SQL
        $select = "SELECT * FROM utilisateurs WHERE pseudo = ? AND mdp = ?";
        $curseur = $pdo->prepare($select);
        $curseur->bindValue(1, $pseudo);
        $curseur->bindValue(2, $mdp);
        $curseur->execute();

        $record = $curseur->fetch();

        if ($record == false) {
            $_SESSION["connecte"] = 0;
            $message = "ID ou mot de passe incorrects";
        } else {
            $_SESSION["connecte"] = 1;
            /*
             * Générateur de code secret sur 6 chiffres
             */
            $codeSecret = "";
            for ($i = 1; $i <= 6; $i++) {
                $codeSecret .= rand(0, 9);
            }

            // Le code secret dans une variable de session pour comparaison ultérieure
            echo "<hr>$codeSecret<hr>";
            $_SESSION["code_secret"] = $codeSecret;
            /*
             * Envoi d'un email avec le code secret
             */
            ini_set("SMTP", "smtp-cduthoit59.alwaysdata.net");
            ini_set("sendmail_from", "cduthoit@gmail.com"); // --- Remplace le FROM dans les entêtes
            // --- utf8_decode() : UTF8 vers ISO 8859-1
            $objet = utf8_decode("Votre code secret valable 30 minutes");

            $messageMail = "Votre code secret valable 30 minutes pour finaliser l'authentification : $codeSecret";

            $entetes = "Content-Type: text/plain; charset=UTF-8\r\n";
            //$entetes .= "Content-Transfer-Encoding: 8bit\n";
            //$entetes .= "From: courspascalbuguet@gmail.com\r\n";
            $destinataire = "cduthoit@gmail.com";
            $bOk = mail($destinataire, $objet, $messageMail, $entetes);
            if ($bOk) {
                $message = "Mail 1 envoy&eacute; avec succ&egrave;s; Consultez votre boîte de réception de votre messagerie !";
            } else {
                $message = "Erreur d'envoi du Mail 1";
            }
        }
        $curseur->closeCursor();
        include './AuthentificationAvecEmailCodeView.php';
    }
    // Gestion des erreurs
    catch (PDOException $e) {
        $message = $e->getMessage();
    }
    $cnx = null;
} else {
    $message = "Toutes les saisies sont obligatoires !";
    include './AuthentificationAvecEmailView.php';
}
?>
