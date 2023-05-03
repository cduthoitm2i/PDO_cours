<!DOCTYPE html>
<!--
PaysCSV2BD.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $message = "";
        // Lecture du fichier
        /*
          id_pays;nom_pays
          BG;Bulgaries
          034;Espagne
         */
        // Lecture du fichier dans une String
        $fileSource = "villes.csv";
        echo "$fileSource<br/>"; 
        $tableName = explode(".", $fileSource)[0] . "_bis";
        echo "$tableName<br/>";
        $contents = file_get_contents($fileSource);
        // La String dans un tableau
        $linesArray = explode("\n", $contents);
        // Comme son nom l'indique
        $firstLine = $linesArray[0];
        // De la première à la la liste des colonnes de la table
        $columnNames = str_replace(";", ",", $firstLine);
        $columnNumber = count(explode(",", $columnNames));
        $parameters = "";
        for ($i=1; $i <= $columnNumber; $i++)   {
            $parameters .= "?,";
        }
        $parameters = substr($parameters, 0, -1);
        /*
         * INSERT
         * INSERT INTO nomTable(col1, col2, ...) VALUES(v1,v2,...)
         * INSERT INTO pays_bis(id_pays,nom_pays) VALUES(?,?)
         */
        $sqlInsert = "INSERT INTO $tableName($columnNames) VALUES($parameters)";
        echo "$sqlInsert<br/>";

        try {
            // Connexion à la BD
            require_once './ConnectionDB.php';
            $pdo = getConnection("localhost", "cours", "root", "");
            // On compile
            $statement = $pdo->prepare($sqlInsert);

            // On boucle
            for ($i = 1; $i < count($linesArray); $i++) {
                // Récupération de la ligne de données
                $line = $linesArray[$i];
                if (!empty($line)) {
                    // Création d'un tableau
                    $values = explode(";", $line);
                    // Avec BIND
                    $statement->bindValue(1, $values[0]);
                    $statement->bindValue(2, $values[1]);
                    // Exécution de la requête avec BIND
                    $statement->execute();
                    // Exécution de la requête SANS BIND
                    //$statement->execute($values);
                }
            }

            $message = "Transfert réussi !!!";
        } catch (PDOException $exc) {
            $message = $exc->getTraceAsString();
        }
        echo $message;
        ?>
    </body>
</html>
