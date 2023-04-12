<!DOCTYPE html>
<!--
TableauExo2
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TableauExo2</title>
    </head>
    <body>
        <h1>TableauExo2</h1>
        <form>
            <?php
            function createOptions($t) {
                $options = "";
                for ($i = 0; $i < count($t); $i++) {
                    $options .= "<option value='$i'>$t[$i]</option>";
                }
                return $options;
            }
            ?>

            <!--
            MAIN
            -->
            <select name="mois">
                <?php
                $tMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

//                for ($i = 0; $i < count($tMois); $i++) {
//                    echo "<option value='$i'>$tMois[$i]</option>";
//                }
                echo createOptions($tMois);
                ?>
            </select>

            <hr>
            <select name="jours">
                <?php
                $tJours = array("L", "M", "M", "J", "V", "S", "D");

//                for ($i = 0; $i < count($tMois); $i++) {
//                    echo "<option value='$i'>$tMois[$i]</option>";
//                }
                echo createOptions($tJours);
                ?>
            </select>
            <input type="submit" />
        </form>
        <br><br>
        <a href="../index.php">Retour</a>
    </body>
</html>
