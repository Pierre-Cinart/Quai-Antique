<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';


// Charger les variables d'environnement depuis le fichier .env à la racine
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Utiliser les variables d'environnement
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$database = $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host={$host};port={$port};dbname={$database}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e) {
    // Gérer l'erreur de connexion
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

