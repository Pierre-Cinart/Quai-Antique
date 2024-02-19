<?php
// Autoriser l'accès depuis n'importe quelle origine
header("Access-Control-Allow-Origin: *");

// Autoriser les en-têtes et méthodes spécifiques
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Vérifier la méthode de la requête
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Répondre immédiatement aux requêtes OPTIONS préalables
    http_response_code(200);
    exit();
}

// Vérifier si le formulaire d'inscription est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    // Validation des données
    if (!$email || !$password || !$confirmPassword || !$firstName || !$lastName) {
        http_response_code(400);
        echo json_encode(['message' => 'Tous les champs sont obligatoires.']);
        exit();
    }

    if ($password !== $confirmPassword) {
        http_response_code(400);
        echo json_encode(['message' => 'Les mots de passe ne correspondent pas.']);
        exit();
    }

    // Appliquer les règles de validation pour le mot de passe (majuscule, chiffre, symbole, longueur)
    $passwordRegex = '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!+-=?#]).{8,}$/';
    if (!preg_match($passwordRegex, $password)) {
        http_response_code(400);
        echo json_encode(['message' => 'Le mot de passe ne respecte pas les critères.']);
        exit();
    }

    // Autres validations (par exemple, longueur du prénom et du nom)
    $nameRegex = '/^[A-Za-z]{3,}$/';
    if (!preg_match($nameRegex, $firstName) || !preg_match($nameRegex, $lastName)) {
        http_response_code(400);
        echo json_encode(['message' => 'Le nom et le prénom doivent contenir au moins 3 lettres.']);
        exit();
    }

    // Hash du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insérer l'utilisateur dans la base de données
    try {
        $stmt = $pdo->prepare("INSERT INTO users (email, password, first_name, last_name) VALUES (?, ?, ?, ?)");
        $stmt->execute([$email, $hashedPassword, $firstName, $lastName]);

        http_response_code(201);
        echo json_encode(['message' => 'Inscription réussie.']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['message' => 'Erreur de base de données.']);
    }
} else {
    http_response_code(405); // Méthode non autorisée
    echo json_encode(['message' => 'Méthode non autorisée.']);
}
?>
