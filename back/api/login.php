<?php
session_start();
require_once __DIR__ . '/../../vendor/autoload.php';
require_once '../config/bdd.php';

// Autoriser toutes les origines (à adapter en fonction de votre environnement)
header('Access-Control-Allow-Origin: *'); 
// Autoriser les méthodes de requête spécifiées
header('Access-Control-Allow-Methods: POST, OPTIONS');
// Autoriser les en-têtes spécifiés
header('Access-Control-Allow-Headers: Content-Type');
// Permettre l'envoi des cookies (si nécessaire)
header('Access-Control-Allow-Credentials: true');


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Répondre aux requêtes OPTIONS avec les en-têtes CORS appropriés
    header('Access-Control-Allow-Origin: *'); 
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Allow-Credentials: true');
    exit();
}


// Vérifier la méthode de requête
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    // Validation des données
    if (!$email || !$password) {
        http_response_code(400);
        echo json_encode(['error' => 'Tous les champs sont obligatoires.']);
        exit();
    }

    // Récupérer l'utilisateur depuis la base de données avec une requête préparée
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier le mot de passe
if (!$user || !password_verify($password, $user['password'])) {
    http_response_code(401);
    error_log('Erreur d\'authentification: Identifiants invalides. Email: ' . $email);
    echo json_encode(['error' => 'Identifiants invalides.']);
    exit();
}

    // Stocker l'ID de l'utilisateur en session par exemple
    $_SESSION['user_id'] = $user['user_id'];

    http_response_code(200);
    echo json_encode(['message' => 'Connexion réussie.']);
} else {
    http_response_code(405); // Méthode non autorisée
    echo json_encode(['error' => 'Méthode non autorisée.']);
}
?>
