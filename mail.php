<?php
require __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Charger les variables d'environnement
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configurer PHPMailer
$mail = new PHPMailer(true);
try {
    // Paramètres SMTP de Mailtrap
    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->Port = $_ENV['SMTP_PORT'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USERNAME'];
    $mail->Password = $_ENV['SMTP_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Utilisez STARTTLS pour le chiffrement TLS

    // Destinataire et expéditeur
    $mail->setFrom('quai-antique@noreply.mail', 'Arnaud Michant');
    $mail->addAddress('cinartpierre@gmail.com', 'Pierre Cinart');

    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'test de mailtrap';
    $mail->Body    = 'test de mail trap pour developpement de confiramtion de message';

    // Envoyer l'e-mail
    $mail->send();
    echo 'L\'e-mail a été envoyé avec succès';
} catch (Exception $e) {
    echo 'Échec de l\'envoi de l\'e-mail. Erreur : ', $e->getMessage();
}
?>
