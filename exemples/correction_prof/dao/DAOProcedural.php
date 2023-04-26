<?php


require_once './lib/Connexion.php';
//require_once '../lib/Transaxion.php';
require_once 'UtilisateursDAOProcedural.php';

$pdo = seConnecter("./conf/cours.ini");


/*
  UtilisateursDAOProcedural.php
 */

/**
 *
 * @param PDO $pdo
 * @param string $id
 * @return array
 */
function selectOneByPseudoAndMdp(PDO $pdo, string $pseudo, string $mdp): int {
    $count = 0;
    /*
     * Renvoie un tableau associatif
     */
    try {
        $sql = "SELECT count(*) FROM membre where pseudo = ? and mdp = ?";
        $cursor = $pdo->prepare($sql);
        $cursor->bindValue(1, $pseudo);
        $cursor->bindValue(2, $mdp);
        $cursor->execute();
        // Renvoie un tableau associatif
        $line = $cursor->fetch(PDO::FETCH_ASSOC);
        if ($line === FALSE) {
            $line["message"] = "Enregistrement inexistant !";
        }
        $cursor->closeCursor();

    } catch (PDOException $e) {
        //$line["Error"] = $e->getMessage();
        $line["Error"] = "Une erreur s'est produite";
    }
    return $count;
}

?>
