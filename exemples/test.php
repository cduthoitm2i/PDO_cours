<?php /* Code à insérer dans le haut de la page */

if (isset($_POST['remember'])) {
    setcookie("cookiemail", $_POST['login'], time() + 60 * 60 * 24 * 100, "/");
    setcookie("cookiepass", $_POST['password'], time() + 60 * 60 * 24 * 100, "/");
} else {
    setcookie("cookiemail", "", NULL, "/");
    setcookie("cookiepass", "", NULL, "/");
}
?>

<!-- Votre formulaire dans la partie HTML -->
<form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
    <fieldset>
        <label>Adresse mail :</label>
        <input name="login" type="text" maxlength="100" value="<?php if (isset($_COOKIE['cookiemail'])) {echo $_COOKIE['cookiemail'];} ?>" />
        <br /><br />
        <label>Mot de passe :</label>
        <input name="password" type="password" maxlength="12" value="<?php if (isset($_COOKIE['cookiepass'])) {echo $_COOKIE['cookiepass'];} ?>" />
        <br />
        <br />
        <label>Se souvenir de moi</label>
        <input name="remember" type="checkbox" <?php if (isset($_COOKIE['cookiemail']) && ($_COOKIE['cookiemail'] != '')) {echo 'checked';}  ?>" />
        <br />
        <br />
        <br />
        <p align="center">
            <input type="Reset" value="Annuler" class="button" name="effacer" style="top: 640px; ">
            <input type="Submit" value="Envoyer" class="button" name="envoie" style="top: 640px;">
        </p>
    </fieldset>
</form>