<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET");

// Inclure le fichier de configuration de la base de données
require_once 'bdd.php';

// Requête SQL pour récupérer les données de la table home_pictures avec une jointure sur la table dishes
$sql = "SELECT home_pictures.id, dishes.description AS alt, dishes.picture AS src FROM home_pictures 
        INNER JOIN dishes ON home_pictures.dish_id = dishes.dish_id";

// Exécutez la requête
$stmt = $pdo->query($sql);

// Vérifiez s'il y a des résultats
if ($stmt) {
    // Récupérez les résultats sous forme de tableau associatif
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Encodez les résultats en format JSON
    $json = json_encode($data);

    // Envoyez la réponse JSON
    echo $json;
} else {
    // En cas d'erreur, renvoyez un message d'erreur JSON
    http_response_code(500);
    echo json_encode(array("message" => "Impossible de récupérer les données de home_pictures."));
}
?>
