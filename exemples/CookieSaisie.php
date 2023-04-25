<?php
// CookieSaisie.php
header("Content-Type: text/html;charset=UTF-8");
?>

<form action="" method="get">
    <label>Nom d'utilisateur : </label>
    <input type="text" name="ut" value="Tintin" />
    <input type="submit" /><br/>
</form>

<?php
$ut = filter_input(INPUT_GET, "ut");
if (isSet($ut) && $ut == "") {
    echo "Saisie manquante";
} else {
    if ($ut != null) {
        setCookie("ut", $ut);
        echo "Le cookie UT a été créé : " . $ut;
    } else {
        
    }
}
?>
<br>
<a href='CookiesMenu.php'>Retour au menu</a>