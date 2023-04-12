<!DOCTYPE html>
<!--
IfExo1.php
Tintin mineur Tintin majeur / Pas Tintin / Trop jeune / Trop vieux  ... Pas né / Mort

dans l'ordre : pas né | trop jeune | tintin mineur | tintin majeur | trop vieux | mort
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // A tester : -1, 0, 6, 7, 17, 76, 78, 180
        // INPUT
        $age = 180;
        
        // OUTPUT
        $message = "";

        // TRAITEMENT
        // SI TINTIN
        if ($age >= 7 && $age <= 77) {
            $message = "Tintin ";
            if ($age >= 18) {
                $message .= "majeur";  // $message = $message . "majeur";
            } else {
                $message .= "mineur";
            }
            // SI PAS TINTIN
        } else {
            // Inférieur à 7
            if ($age < 7) {
                if ($age < 0) {
                    $message = "Pas né";
                } else {
                    $message = "Trop jeune";
                }
                // Supérieur à 77
            } else {
                if ($age > 130) {
                    $message = "Mort";
                } else {
                    $message = "Trop vieux";
                }
            }
        }

        // GESTION de l'OUTPUT : Affichage du message
        echo $message;
        ?>
        <br><br>
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
    </body>
</html>
