<?php
    
$idProduit = filter_input(INPUT_GET,"id");
$designation = filter_input(INPUT_GET,"designation");
$prix = filter_input(INPUT_GET,"prix");

setcookie("id", $idProduit, time() + (3600 *24 *7));
setcookie("designation", $designation, time() + (3600 *24 *7));
setcookie("prix", $prix, time() + (3600 *24 *7));

include 'catalogueView.php';
