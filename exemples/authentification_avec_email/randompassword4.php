<?php
$chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789[~!@#$%^&*()-_=+[]{};:,./?]";
$shfl = str_shuffle($chaine);
$pwd = substr($shfl,0,30);
echo $pwd;
echo "<br/>";
echo "<br/>";
echo 'Default hash: ' . password_hash($pwd . "salt" , PASSWORD_DEFAULT);
echo "<br/><br/>";
echo 'Bcrypt hash: ' . password_hash($pwd . "salt" , PASSWORD_BCRYPT, ['cost' => 12]);
echo "<br/><br/>";
echo 'Blowfish hash: ' . password_hash($pwd . "salt" , CRYPT_BLOWFISH);
echo "<br/><br/>";
echo 'Argon2i hash: ' . password_hash($pwd . "salt" , PASSWORD_ARGON2I);
?>