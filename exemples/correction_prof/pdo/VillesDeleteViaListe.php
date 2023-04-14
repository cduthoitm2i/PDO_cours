<?php
// VillesDeleteViaListe.php
// MONO PAGE
header("Content-Type: text/html; charset=UTF-8");

$message = "";

try {
    // Connexion ... dans tous les cas
//    $pdo = new PDO('mysql:host=localhost;dbname=cours', 'root', '');
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $pdo->exec("SET NAMES 'UTF8'");
    
    require_once './ConnectionDB.php';
    
    $pdo = getConnection("localhost", "cours", "root", "");

    // Suppression
    $cp = filter_input(INPUT_POST, "listeVilles");
    if ($cp != null) {
        $sql = "DELETE FROM villes WHERE cp = ?";

        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $cp);
        $statement->execute();

        $message = $statement->rowcount() . " enregistrement(s) supprimé(s)";
    } // fin if

    // Creation de la liste des villes
    $sql = "SELECT cp, nom_ville FROM villes ORDER BY nom_ville";
    $cursor = $pdo->query($sql);

    $options = "";
    while ($record = $cursor->fetch()) {
        $options .= "<option value='$record[0]'>$record[1]</option>\n";
    }

    // --- Deconnexion
    $pdo = null;
} // fin try
catch (PDOException $e) {
    $message = $e->getMessage();
}
?>

<h3>DELETE</h3>
<form action="" method="POST">
    <label>Quelle ville ? </label>
    <select name="listeVilles">
        <?php echo $options; ?>
    </select>
    <input type="submit" name="btValider"/>
</form>

<label><?php echo $message; ?></label>
