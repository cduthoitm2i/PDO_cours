<!DOCTYPE html>
<!--
SELECT nom_ville, site, id_pays FROM `villes` WHERE id_pays = '033';
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $contenu = "";
        $sql = "SELECT nom_ville, site, id_pays FROM villes WHERE id_pays = ?";

        // Récupération de la saisie
        $idPays = filter_input(INPUT_GET, "id_pays");
        if ($idPays != null) {
            try {
                // Connexion BD
                $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
                //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec("SET NAMES 'UTF8'");

                // Compilation de l'ordre SQL
                $curseur = $pdo->prepare($sql);
                $curseur->bindValue(1, $idPays);
                $curseur->execute();

                foreach ($curseur as $enregistrement) {
                    // Récupération des valeurs par interpolation
                    $contenu .= "$enregistrement[0]-$enregistrement[1]-$enregistrement[2]<br>\n";
                }
            } catch (PDOException $exc) {
                $contenu = $exc->getMessage();
            }
        }
        ?>

        <h1>Villes d'un pays</h1>
        <form method="GET" action="">
            <label>Id pays</label>
            <input type="text" name="id_pays" value="033" />
            <input type="submit"  />
        </form>

        <p>
<?php
echo $contenu;
?> 
        </p>


    </body>
</html>
