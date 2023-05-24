<!DOCTYPE html>
<!--
C:\xampp\htdocs\PDOCours\AuthentificationAvecEmail\
AuthentificationAvecEmailCodeView.php
http://pascalbuguet.alwaysdata.net/PDOCours/AuthentificationAvecEmail/AuthentificationEmailCodeView.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>AuthentificationAvecEmailCodeView</title>
    </head>
    <body>
        <h1>AuthentificationAvecEmailCodeView</h1>
        <form action="AuthentificationAvecEmailCTRL2.php" method="POST">
            <input type="text" name="code" value="" size="50" placeholder="Le code reçu par E-mail ?"/>
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
