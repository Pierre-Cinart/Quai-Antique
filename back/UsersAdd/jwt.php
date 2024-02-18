<?php

$jwt = bin2hex(random_bytes(32)); // Utilisez 16 octets pour obtenir 64 caractères hexadécimaux


echo "Chaîne hashée :" . $jwt;

?>