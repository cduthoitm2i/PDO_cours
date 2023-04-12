<!DOCTYPE html>
<!--
ForExo1Plus.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ForExo1Plus.php</title>
    </head>
    <body>
        <?php

        /**
         * 
         * @param string $name
         * @param int $begin
         * @param int $end
         * @return string
         */
        function createList(string $name, int $begin, int $end): string {
            $list = "<select name='$name'>";
            for ($i = $begin; $i <= $end; $i++) {
                $list .= "<option>$i</option>\n";
            }
            // $list = $list . "</select>";
            $list .= "</select>";
            return $list;
        }
        ?>
        <h1>ForExo1Plus.php</h1>
        <form action="" method="GET">

            <?php
            $jours = createList("jours", 1, 31);
            echo $jours;
            
            echo createList("mois", 1, 12);
            echo createList("annees", 1900, 2023);
            ?>

<!--<select name="jours">-->
            <?php
//                for ($i = 1; $i <= 31; $i++) {
//                    echo "<option>$i</option>\n";
//                }
            ?>



            <!--</select>-->

            <?php
//            $liste = "";
//            $liste .= "<select name='mois'>\n";
//            for ($i = 1; $i <= 12; $i++) {
//                $liste .= "<option>$i</option>";
//            }
//            $liste .= "\n<select>";
//            echo $liste;
            ?>

            <!--<select name="annees" id="annees">-->
            <?php
//                $i = 1900;
//                while ($i <= 2023) {
//                    echo "<option>$i</option>";
//                    $i++;
//                }
//                echo createList("annees", 1900, 2023);
            ?>
            <!--</select>-->
            &nbsp;&nbsp;&nbsp;
            <input type="submit" />
        </form>
        <br><br>
        <a href="../index.php">Retour</a>
        <footer>
            <p>&copy; PB & co 2023</p>
        </footer>
    </body>
</html>
