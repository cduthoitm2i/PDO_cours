<!DOCTYPE html>
<!--
TableauExo4
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TableauExo4</title>
    </head>
    <body>
        <h1>TableauExo4</h1>
<!--        <ul>
            <li>Janvier</li>
            <li>Février</li>
            <li>Mars</li>
        </ul>

        <hr>
        <table border="1">
            <thead>
                <tr>
                    <th>Mois</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Janvier</td>
                </tr>
                <tr>
                    <td>Février</td>
                </tr>
                <tr>
                    <td>Mars</td>
                </tr>
            </tbody>
        </table>-->

        <hr>

        <?php
        /**
         * 
         * @param array $t
         * @return string
         */
        function createSelectOptions(array $t): string {
            $html = "<select>";
            for ($i = 0; $i < count($t); $i++) {
                $html .= "<option>" . $t[$i] . "</option>";
            }
            $html .= "</select>";
            return $html;
        }
        /**
         * 
         * @param array $t
         * @return string
         */
        function createULLI(array $t): string {
            $html = "<ul>";
            for ($i = 0; $i < count($t); $i++) {
                $html .= "<li>" . $t[$i] . "</li>";
            }
            $html .= "</ul>";
            return $html;
        }
        
        /**
         * 
         * @param array $t
         * @return string
         */
        function createTBodyOfTable(array $t): string{
            $html = "<tbody>";
            for ($i = 0; $i < count($t); $i++) {
                $html .= "<tr><td>" . $t[$i] . "</td></tr>";
            }
            $html .= "</tbody>";
            return $html;
        }
        ?>

        <?php
        $t = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

        echo "<pre>";
        var_dump($t);
        echo "</pre>";
        
        echo "<hr>";
        echo createULLI($t);
        ?>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Mois</th>
                </tr>
            </thead>
            <?php
            echo createTBodyOfTable($t);
            ?>
        </table>

        <br><br>
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
    </body>
</html>
