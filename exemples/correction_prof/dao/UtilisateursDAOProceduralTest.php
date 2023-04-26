<?php

/*
* UtilisateursDAOProceduralTests.php
*/
 
// On charge en mémoire du code PHP qui contient pour le coup des fonctions
// once : une fois donc et si c'est déjà chargé ne recharge pas pour éviter une erreur fatale
require_once './lib/Connexion.php';
require_once './UtilisateursDAOProcedural.php';
 
// Sollicite la fonction qui permet une connexion BD avec comme paramètre un fichier ini
// qui contient lui-même des paramètres de connexion à la BD (protocole, hôte, port, nom de la BD, ...)
$pdo = seConnecter("../conf/cours.ini");
// Sollicite la fonction qui permet d'authentifier un user
// elle a comme paramètre une connexion BD et le pseudo et le mot de passe
// On ajoute un test selon les informations remontées dans la fonction, si c'est 1, on affiche OK, sinon KO
if (selectOneByPseudoAndMdp($pdo, "p", "b") == 1) {
    echo "ok";
} else {
    echo "KO";
}
// Affichage résultat de la fonction précédente (0 ou 1)
//echo $count;
?>