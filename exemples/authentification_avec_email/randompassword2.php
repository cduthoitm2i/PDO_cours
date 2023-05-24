<?php
 $comb = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ[~!@#$%^&*()-_=+[]{};:,.<>/?]';
 $pass = array(); 
 $combLen = strlen($comb) - 1; 
 for ($i = 0; $i < 20; $i++) {
     $n = rand(0, $combLen);
     $pass[] = $comb[$n];
 }
 print(implode($pass)); 
?>