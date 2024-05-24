<?php
require 'vendor/autoload.php';

use Model\UserRepository;

$template = new League\Plates\Engine('templates', 'tpl');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Esegui la registrazione
    UserRepository::registrazione($email, $username, $password, $type);

    // Reindirizza alla pagina di successo
    echo $template->render('login', [

    ]);
    exit(0); // Assicura che lo script termini dopo il reindirizzamento
}

echo $template->render('registrazione', []);

