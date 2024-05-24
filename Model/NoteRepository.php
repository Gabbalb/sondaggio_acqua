<?php

namespace Model;
use Util\Connection;

class NoteRepository
{

    public static function listAll($id): array
    {
        try {
            $pdo = Connection::getInstance();
            $sql = 'SELECT * FROM risposte WHERE id_utente = :id_user'; // Assicurati che il nome della colonna sia corretto
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_user' => $id]);
            return $stmt->fetchAll(); // Utilizza PDO::FETCH_ASSOC per ottenere solo un array associativo
        } catch (PDOException $e) {
            // Gestione degli errori, ad esempio loggare l'errore e restituire un array vuoto
            error_log("Errore durante il recupero delle spese dell'utente: " . $e->getMessage());
            return []; // Restituisce un array vuoto in caso di errore
        }
    }

    //prende le domande da un form identificato dall'id
    public static function listQuestionByForm($id)
    {
        try {
            $pdo = Connection::getInstance();
            $sql = 'SELECT domanda, titolo, descrizione FROM domande, form WHERE id_form = form.id
AND id_form = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Errore durante il recupero delle spese dell'utente: " . $e->getMessage());
            return [];
        }
    }





    //ricava i form identificati dall'id non completati dall'utente

    public static function listFormNotCompleted($id_utente)
    {
        try {
            $pdo = Connection::getInstance();
            $sql = 'SELECT DISTINCT form.id, form.titolo, form.descrizione 
                FROM form 
                LEFT JOIN domande ON form.id = domande.id_form 
                WHERE form.id NOT IN (
                    SELECT id_form FROM risposte WHERE id_utente = :id_utente
                )';

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_utente' => $id_utente]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Errore durante il recupero delle spese dell'utente: " . $e->getMessage());
            return [];
        }
    }




    //ricava i form completati dall'utente identificato dall'id

    public static function listFormCompleted($id_utente)
    {
        try {
            $pdo = Connection::getInstance();
            $sql = 'SELECT f.id, f.titolo, f.descrizione
                FROM form f
                JOIN risposte r ON f.id = r.id_form
                WHERE r.id_utente = :id_utente
                GROUP BY f.id, f.titolo, f.descrizione;';

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_utente' => $id_utente]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Errore durante il recupero delle spese dell'utente: " . $e->getMessage());
            return [];
        }
    }


    public static function query1()
    {
        $pdo = Connection::getInstance();
        $sql = 'SELECT id, username, mail, id_permesso FROM users;';
        $result = $pdo->query($sql);
        return $result->fetchAll();
    }

    public static function query2(){
        $pdo = Connection::getInstance();
        $sql = 'SELECT * FROM form';
        $result = $pdo->query($sql);
        return $result->fetchAll();
    }

    public static function query3(){
        $pdo = Connection::getInstance();
        $sql = 'SELECT * FROM risposte';
        $result = $pdo->query($sql);
        return $result->fetchAll();
    }

    public static function nusers() {
        $pdo = Connection::getInstance();
        $sql = 'SELECT COUNT(*) AS count FROM users';
        $result = $pdo->query($sql);
        return $result->fetchColumn();
    }

    public static function nform() {
        $pdo = Connection::getInstance();
        $sql = 'SELECT COUNT(*) AS countform FROM form';
        $result = $pdo->query($sql);
        return $result->fetchColumn();
    }

    public static function nrisposte() {
        $pdo = Connection::getInstance();
        $sql = 'SELECT COUNT(*) AS countansw FROM risposte';
        $result = $pdo->query($sql);
        return $result->fetchColumn();
    }





}