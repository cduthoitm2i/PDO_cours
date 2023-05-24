<!DOCTYPE html>
<!--
C:\xampp\htdocs\PDOCours\AuthentificationAvecEmail\
AuthentificationAvecEmailView.php
http://pascalbuguet.alwaysdata.net/PDOCours/AuthentificationAvecEmail/AuthentificationAvecEmailView.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>AuthentificationEmailView</title>
    </head>
    <body>
        <h1>AuthentificationEmailView</h1>
        <form action="AuthentificationAvecEmailCTRL.php" method="POST">
            <input type="text" name="pseudo" value="p" placeholder="Pseudo ?" />
            <input type="text" name="mdp" value="b" placeholder="Mot de passe ?" />
            <input type="submit" />
        </form>
        <p>
            <?php
            if (isSet($message)) {
                echo $message;
            }
            ?>
        </p>

        <a href="MonCompte.php">Mon compte</a>
    </body>
</html>
