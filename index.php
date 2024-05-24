<?php
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use Model\UserRepository;
use Model\NoteRepository;

$template = new League\Plates\Engine('templates', 'tpl');



// Controlla se sono stati inviati dati dal modulo di accesso
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Ottieni il risultato della verifica delle credenziali, che include lo stato di successo e l'id_permesso
    $result = UserRepository::verificaCredenziali($username, $password);
    $nusers = NoteRepository::nusers();
    $nform = NoteRepository::nform();
    $nansw = NoteRepository::nrisposte();

    // Se le credenziali sono corrette
    if ($result['success']) {
        // Avvia la sessione per memorizzare lo stato di accesso e il permesso
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['id_permesso'] = $result['id_permesso'];

        // Controlla il permesso dell'utente
        if ($_SESSION['id_permesso'] == 1) {
            // Renderizza la pagina per l'admin
            echo $template->render('admin', [
                'username' => $username,
                'id_permesso' => $result['id_permesso'],
                'nusers' => $nusers,
                'nform' => $nform,
                'nansw' => $nansw
            ]);
            exit(0);
        } else {
            // Renderizza la pagina standard per gli utenti
            $username = $_SESSION['username'];
            $id = UserRepository::getID($username);
            $spesePrec = \Model\NoteRepository::listAll($id);
            echo $template->render('lista', [
                'username' => $username,
                'spesePrec' => $spesePrec,
            ]);
            exit(0);
        }

    } else {
        // Se le credenziali non sono corrette, mostra un messaggio di errore
        echo $template->render('login', [
            'error' => 'Credenziali non valide. Riprova.'
        ]);
        exit();
    }
} else {
    // Se non sono stati inviati dati dal modulo di accesso, mostra il modulo di accesso
    echo $template->render('login');
}