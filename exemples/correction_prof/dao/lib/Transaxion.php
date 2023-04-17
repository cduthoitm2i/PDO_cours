<?php
/**
 * Transaxion.php : une bibliothèque
 * initialiser()
 * valider()
 * annuler()
 */

/**
 *
 * @param PDO $pdo
 */
function initialiser(PDO &$pdo) {
    $lbOK = true;
    try {
        $pdo->beginTransaction();
    } catch (PDOException $ex) {
        $lbOK = false;
    }
    return $lbOK;
}

/**
 *
 * @param PDO $pdo
 */
function valider(PDO &$pdo) {
    $lbOK = true;
    try {
        $pdo->commit();
    } catch (PDOException $ex) {
        $lbOK = false;
    }
    return $lbOK;
}

/**
 *
 * @param PDO $pdo
 */
function annuler(PDO &$pdo) {
    $lbOK = true;
    try {
        $pdo->rollBack();
    } catch (PDOException $ex) {
        $lbOK = false;
    }
    return $lbOK;
}
?>