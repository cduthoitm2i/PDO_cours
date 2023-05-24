<?php

// ConnectionDB.php

/**
 * 
 * @param string $iniFile
 * @return PDO
 */
function getConnection(string $iniFile): PDO {
    try {
        $tProprietes = parse_ini_file($iniFile);

        // Récupération une à une des valeurs des clés du tableau associatif
        $host = $tProprietes["serveur"];
        $db = $tProprietes["bd"];
        $user = $tProprietes["ut"];
        $pwd = $tProprietes["mdp"];

        // Connexion ... dans tous les cas
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");
    } catch (PDOException $e) {
        echo $e;
        $pdo = null;
    }
    return $pdo;
}
?>
