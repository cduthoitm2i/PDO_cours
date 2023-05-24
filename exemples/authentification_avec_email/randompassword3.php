<?php
$bytes = openssl_random_pseudo_bytes(20);
$pass = bin2hex($bytes);
echo $pass;
?>