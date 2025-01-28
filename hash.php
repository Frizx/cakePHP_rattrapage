<?php
require 'vendor/autoload.php'; // Charge l'autoload de Composer

use Authentication\PasswordHasher\DefaultPasswordHasher;

$password = '1234'; // Remplace par ton mot de passe
$hashedPassword = (new DefaultPasswordHasher())->hash($password);

echo "Mot de passe haché : " . $hashedPassword . PHP_EOL;
