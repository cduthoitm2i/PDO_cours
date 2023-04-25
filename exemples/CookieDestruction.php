<?php
// CookieSaisie.php
header("Content-Type: text/html;charset=UTF-8");
?>
<?php
        // On affecte une valeur vide à $ut (ce qui supprime le cookie)
        // Voir documentation sur les cookies
        setCookie("ut", "");
        echo "Le cookie sa été supprimé : ";
?>
<br>
<a href='CookiesMenu.php'>Retour au menu</a>
