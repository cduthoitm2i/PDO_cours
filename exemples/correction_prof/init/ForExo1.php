<!DOCTYPE html>
<!--
ForExo1.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ForExo1.php</title>
    </head>
    <body>
        <h1>ForExo1.php</h1>
        <select>
            <?php
            for ($i = 1; $i <= 31; $i++) {
                echo "<option>$i</option>\n";
                //echo "<option>", $i, "</option>\n";
                //echo "<option>" . $i . "</option>\n";
            }
            ?>
        </select>

        <select>
            <?php
            $liste = "";
            for ($i = 1; $i <= 12; $i++) {
                $liste .= "<option>$i</option>";
            }
            $liste .= "\n";
            echo $liste;
            ?>
        </select>

        <select>
            <?php
//            $i = 1900;
//            while ($i <= 2023) {
//                echo "<option>$i</option>";
//                $i++;
//            }
//            echo "\n";
            for ($i = 1900; $i <= 2023; $i++) {
                $liste .= "<option>$i</option>";
            }
            $liste .= "\n";
            ?>
        </select>
        <br><br>
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
    </body>
</html>
