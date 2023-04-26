<?php
/**
* 
* @param PDO $pdo
* @param string $pseudo
* @param string $mdp
* @return int
*/
// On déclare une fonction nommée selectOneByPseudoAndMdp qui a des paramètres pour la connexion BD de type PDO et le p et le mdp de typ chaine
// La fonction renvoie un nombre
function selectOneByPseudoAndMdp(PDO $pdo, string $pseudo, string $mdp): int {
    // On déclare une variable locale de type nombre qui va servir pour le retour de la fonction
    $count = 0;
 
    // On déclare une variable locale pour stockée le texte de la requête SQL
    $sql = "SELECT COUNT(*) FROM utilisateurs WHERE pseudo=? AND mdp=?";
    // Variable pour compiler (-> binaire)
    $cursor = $pdo->prepare($sql);
    // Valorise le 1e paramètre (donc le 1e ?)
    $cursor->bindValue(1, $pseudo);
    $cursor->bindValue(2, $mdp);
    // execute
    $cursor->execute();
    // Lit l'enregistement à partir du curseur vers une nouvelle variable
    $record = $cursor->fetch();
    // On attribue à count la 1e case du tableau (colonne)
    $count = $record[0];
    // Renvoie la valeur de count (0 ou 1)
    return $count;
}
?>