<?php
/**
 * ../lib/Connexion.php : une bibliothèque
 *
 * seConnecter() : PDO(à partir d'un fichier ini)
 * seDeconnecter() : void
 */

/**
 *
 * @param string $psCheminParametresConnexion
 * @return PDO
 */
function seConnecter(string $psCheminParametresConnexion) : PDO {

    $tProprietes = parse_ini_file($psCheminParametresConnexion);

    $lsProtocole = $tProprietes["protocole"];
    $lsServeur = $tProprietes["serveur"];
    $lsPort = $tProprietes["port"];
    $lsUT = $tProprietes["ut"];
    $lsMDP = $tProprietes["mdp"];
    $lsBD = $tProprietes["bd"];

    /*
     * Connexion
     */
    $pdo = null;
    try {
        $pdo = new PDO("$lsProtocole:host=$lsServeur;port=$lsPort;dbname=$lsBD;", $lsUT, $lsMDP);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
        $pdo->exec("SET NAMES 'UTF8'");
    } catch (PDOException $ex) {
        //echo "<br>" .   $ex->getMessage();
    }
    return $pdo;
}

/**
 *
 * @param PDO $pdo
 */
function seDeconnecter(PDO &$pdo) {
    $pdo = null;
}
?>