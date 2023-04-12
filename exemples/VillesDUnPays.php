<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VillesDUnPays.php</title>
</head>
<?php
$contenu ="";
$sql = "SELECT nom_ville, site, id_pays FROM villes WHERE id_pays = ?";
$id_pays = filter_input(INPUT_GET, "id_pays");
if ($id_pays != NULL) {
    // Connexion à la bdd
    try {
        $pdo = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        // Compilation
        $curseur = $pdo->prepare($sql);
        $curseur->bindvalue(1, $id_pays);
        $curseur->execute();
        //
        foreach ($curseur as $enregistrement) {
            // Récupération des valeurs par concaténation et interpolation
            $contenu .= "$enregistrement[0]-$enregistrement[1]-$enregistrement[2]<br>";
           }
        // $select = "SELECT nom_ville, site, id_pays FROM villes WHERE id_pays =?";
    }
    // Gestion des erreurs
    catch (PDOException $e) {
        $contenuSelect = "Echec de l'exécution : " . $e->getMessage();
    }
}

?>
<body>
    <h1>Villes d'un pays</h1>
    <form action="" method="get">
        <label for="">Id pays</label>
        <input type="text" name="id_pays" value="033">
        <input type="submit">
    </form>

    <p>
        <?php
            echo $contenu;
        ?>
    </p>
</body>

</html>