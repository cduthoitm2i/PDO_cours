<?php
// --- TransactionExemple1.php
header("Content-Type: text/html; charset=UTF-8");
$message = "";

$btValider = filter_input(INPUT_POST, "btValider");

if ($btValider != null) {
    $cp = filter_input(INPUT_POST, "cp");
    $nomVille = filter_input(INPUT_POST, "nomVille");
    $idPays = filter_input(INPUT_POST, "idPays");

    if ($cp != null && $nomVille != null && $idPays != null) {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $pdo->exec("SET NAMES 'UTF8'");

            $pdo->beginTransaction();

            $sql = "INSERT INTO villes(cp, nom_ville, id_pays) VALUES(?,?,?)";
            $statement = $pdo->prepare($sql);
            $statement->execute(array($cp, $nomVille, $idPays)); // Alternative
            $message = $statement->rowcount() . " enregistrement(s) ajouté(s)";
//        $pdo->rollback();
            $pdo->commit();

            $pdo = null;
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }
    } else {
        $message = "Toutes les saisies sont obligatoires !!!";
    }
}
?>

<form action="" method="POST">
    <label>CP </label>
    <input type="text" name="cp" value="75021" size="5" />
    <label>Ville </label>
    <input type="text" name="nomVille" value="Paris 21" />
    <label>ID pays </label>
    <input type="text" name="idPays" value="033" size="4" />

    <input type="submit" name="btValider"/>
</form>

<label>
    <?php echo $message; ?>
</label>