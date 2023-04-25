<?php

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
        $sql = "SELECT count(*) FROM membre where pseudo = '$pseudo' and mdp = '$mdp'";
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
