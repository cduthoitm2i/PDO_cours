<?php
// --- ClientsSelectParameterInjectionSQL.php
header("Content-Type: text/html; charset=UTF-8");
$message = "";

$cp = filter_input(INPUT_GET, "cp");
if ($cp != null) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        // ORDRE SQL
        $sql = "SELECT nom, prenom, cp FROM clients WHERE cp = $cp";
        // COMPILATION
        $curseur = $pdo->query($sql);

        while ($enregistrement = $curseur->fetch()) {
            $message .= "$enregistrement[0]-$enregistrement[1]-$enregistrement[2]<br>";
        }
        $pdo = null;
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }
}
?>

<form action="" method="get">
    <label>Code postal : </label>
    <input type="text" name="cp" value="75011" />
    <input type="submit" />
</form>

<label>
    <?php echo $message; ?>
</label>