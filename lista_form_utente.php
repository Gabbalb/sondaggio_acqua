<?php


require 'vendor/autoload.php';

use Model\UserRepository;

$template = new League\Plates\Engine('templates', 'tpl');


$id_utente = 1;
$lista_form_fatti = \Model\NoteRepository::listFormCompleted($id_utente);
$lista_form_non_fatti = \Model\NoteRepository::listFormNotCompleted($id_utente);


echo $template->render('lista_form_utente', [
    'completati' => $lista_form_fatti,
    'non_completati' => $lista_form_non_fatti,
]);