<?php

// --- SQL paramétré : VillesInsert.php
header("Content-Type: text/plain; charset=UTF-8");
// Pour accepter l'accès à des fichiers se trouvant dans un autre domaine (localhost) (par exemple dans htdocs et un autre dossier)
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Origin: *");

$message = "";

$cp = filter_input(INPUT_POST, "cp");
$nomVille = filter_input(INPUT_POST, "nomVille");
$idPays = filter_input(INPUT_POST, "idPays");

if ($cp != null && $nomVille != null && $idPays != null) {

    try {
        /*
         * Connexion
         */
        $cnx = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cnx->exec("SET NAMES 'UTF8'");

        /*
         * INSERTION
         */
        $sql = "INSERT INTO villes(cp, nom_ville, id_pays) VALUES(?,?,?)";

        $statement = $cnx->prepare($sql);

        $statement->bindParam(1, $cp, PDO::PARAM_STR);
        $statement->bindParam(2, $nomVille, PDO::PARAM_STR);
        $statement->bindParam(3, $idPays, PDO::PARAM_STR);

        $statement->execute();

        $message = $statement->rowcount() . " enregistrement(s) ajouté(s)";

        $cnx = null;
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }
} else {
    $message = "Toutes les saisies sont obligatoires";
}

echo $message;