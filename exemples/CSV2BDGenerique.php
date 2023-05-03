<!DOCTYPE html>
<!--
CSV2BDGenerique.php

1 - On considère que les tables existent déjà
2 - Noms des fichiers = pays.csv, villes.csv, ...
3 - Noms des tables = même nom + _bis

CREATE TABLE pays_bis AS SELECT * FROM pays WHERE id_pays = '';
CREATE TABLE villes_bis AS SELECT * FROM villes WHERE cp = '';

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CSV2BDGenerique.php</title>
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
        // On test si le fichier existe
        if (file_exists($fileSource)) {
            echo "$fileSource<br/>";
            // On forme le nom de la table destination
            // Explosion de la première ligne du fichier (les en-têtes) concaténée à "_bis"
            $tableName = explode(".", $fileSource)[0] . "_bis";
            echo "$tableName<br/>";
            // Lecture du fichier dans une String
            $contents = file_get_contents($fileSource);
            // La String dans un tableau
            $linesArray = explode("\n", $contents);
            // Comme son nom l'indique
            $firstLine = $linesArray[0];
            // De la première à la liste des colonnes de la table
            $columnNames = str_replace(";", ",", $firstLine);
            $columnNumber = count(explode(",", $columnNames));
            // Composition de la liste des paramètres donc des ?
            $parameters = "";
            for ($i = 1; $i <= $columnNumber; $i++) {
                $parameters .= "?,";
            }
            // Suppression de la dernière virgule sinon erreur (mettre -1)
            $parameters = substr($parameters, 0, -1);

            // On passe en commentaire l'ancienne syntaxe pas générique
            //$parameters = implode(",", $columnNumber);
            /*
             * INSERT
             * INSERT INTO nomTable(col1, col2, ...) VALUES(v1,v2,...)
             * INSERT INTO pays_bis(id_pays,nom_pays) VALUES(?,?)
             * INSERT INTO villes_bis(cp,nom_ville,site,photo,id_pays) VALUES(?,?,?,?,?)
             */
            $sqlInsert = "INSERT INTO $tableName($columnNames) VALUES($parameters)";

            echo "$sqlInsert<br/>";
            // on a ce résultat : INSERT INTO villes_bis(cp,nom_ville,site,photo,id_pays) VALUES(?,?,?,?,?)
//            die();

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
                        // Avec BIND : possible avec une boucle mais très lourd
//                        $statement->bindValue(1, $values[0]);
//                        $statement->bindValue(2, $values[1]);
                        // Exécution de la requête avec BIND
//                        $statement->execute();
                        // Exécution de la requête SANS BIND
                        $statement->execute($values);
                    }
                }

                $message = "Transfert réussi !!!";
            } catch (PDOException $exc) {
                $message = $exc->getTraceAsString();
            }
        } else {
            $message = "Le fichier $fileSource n'existe pas !!!";
        }
        echo $message;
        ?>
    </body>
</html>
