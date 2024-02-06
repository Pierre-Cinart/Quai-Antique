<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET");
require_once 'bdd.php';
$query = $pdo->query("SELECT src, alt FROM home_pictures");
$images = $query->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($images);
exit;

// Indiquer le type de contenu de la réponse
header('Content-Type: application/json');
// Récupérer la liste des adresses d'images
if ($_SERVER['REQUEST_METHOD'] === 'GET' ) {
    require_once 'bdd.php';
    $query = $pdo->query("SELECT src, alt FROM home_pictures");
    $images = $query->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($images);
    exit;
}


?>
