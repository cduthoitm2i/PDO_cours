<!DOCTYPE html>
<!--
TableauExo3Stats
Statistiques : somme, moyenne, min, max, variance
[10, 30, 20, 40, 50]
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TableauExo3Stats</title>
    </head>
    <body>
        <h1>TableauExo3Stats</h1>

        <?php

        function somme($t) {
            $s = 0;
            for ($i = 0; $i < count($t); $i++) {
                $s += $t[$i];
            }
            return $s;
        }

        function moyenne($t) {
            return somme($t) / count($t);
        }

        function mini($t) {
            $m = $t[0];
            for ($i = 1; $i < count($t); $i++) {
                if ($t[$i] < $m) {
                    $m = $t[$i];
                }
            }
            return $m;
        }

        function maxi($t) {
            $m = $t[0];
            for ($i = 1; $i < count($t); $i++) {
                if ($t[$i] > $m) {
                    $m = $t[$i];
                }
            }
            return $m;
        }

        /*
          Étant donnée une série statistique d’une variable réelle (x1, x2, ..., xn), dont on a calculé la moyenne
          la variance est la moyenne des carrés des écarts à cette moyenne :

         * Vérifiez ici : https://calculis.net/variance#resultat
         * 
         *          */

        function variance($t) {
            // La moyenne
            $avg = moyenne($t);
            // Somme des carrés des écarts
            $sce = 0;
            for ($i = 0; $i < count($t); $i++) {
                $ecart = $t[$i] - $avg;
                $sce += $ecart * $ecart;
            }

            return $sce / count($t);
        }

        function ecartType($t) {
            return sqrt(variance($t));
        }

        /*
         * MAIN
         */
        $tNums = array(20, 30, 10, 40, 50);

        for ($i = 0; $i < count($tNums); $i++) {
            echo $tNums[$i] . " ";
        }

        echo "<hr>";

        echo "<br>Somme : " . somme($tNums);
        echo "<br>Moyenne : " . moyenne($tNums);
        echo "<br>Mini : " . mini($tNums);
        echo "<br>Maxi : " . maxi($tNums);
        echo "<br>Variance : " . variance($tNums);
        echo "<br>Ecart Type : " . ecartType($tNums);

        //echo"<br> Variance ave la fonction PHP : " . stats_variance($tNums);
        ?>

        <br><br>
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
    </body>
</html>
