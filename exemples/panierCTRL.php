<?php
//PanierCTRL.php
// Je veux ca comme cookie nommé panier
// 1 Evian 0.8 et 2 Badoit 1.1 ...
 
// on récupere les attributs d'URL
$idProduit = filter_input(INPUT_GET, "id_produit");
$designation = filter_input(INPUT_GET, "designation");
$prix = filter_input(INPUT_GET, "prix");
$photo = filter_input(INPUT_GET, "photo");
 
// Vérifie si cookie existe avant de explode
$panier = filter_input(INPUT_COOKIE, "panier");
if ($panier != null) {
    // le panier n'est pas vide, cookie existant (1 article ou plus), s'ajoute 
    // Attention, on utilise le caractère # comme séprateur entre les cookies et on change également dans le panierView.php
    $panier .= " et $idProduit#$designation#$prix#$photo";
 
} else {
    // le panier est vide car cookie inexistant (avant le premier article ajouté dans le panier)
    $panier = "$idProduit#$designation#$prix#$photo";
}
 
setcookie("panier", $panier, time() + (3600 * 24 * 14));
//echo $panier;
 
include 'CatalogueView.php';
 
?>