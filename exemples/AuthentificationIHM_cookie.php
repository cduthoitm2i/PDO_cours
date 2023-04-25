<!DOCTYPE html>
<!-- AuthentificationIHM.php -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Authentification</title>
    </head>

    <body>
        <h3>Authentification</h3>
        <form action="AuthentificationCTRL_cookie.php" method="POST">
            <table>
                <tr>
                    <td>Pseudo : </td>
                    <td><input type="text" name="pseudo" id="pseudo" value="" /></td>
                </tr>
                <tr>
                    <td>Mot de passe : </td>
                    <td><input type="password" name="mdp" id="mdp" value="" /></td>
                </tr>
                <tr>
                    <td>Mot de passe visible</td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td>Se souvenir de moi</td>
                    <td><input type="checkbox" name="sesouvenir" id="sesouvenir"></td>
                </tr>
                <tr>
                    <td><input type="reset" value="Reinitialiser" name="btReinitialiser" id="btReinitialiser"/></td>
                    <td><input type="submit" value="Valider" name="btValider" id="btValider"/></td>
                </tr>
            </table>
        </form>

        <label>
            <?php
                if(isSet($message)) {
                    echo $message;
                }
            ?>
        </label>
    </body>
</html>