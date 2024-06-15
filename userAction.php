<?php
// Carica e inizializza la classe del database
require_once 'DB.class.php'; 
$db = new DB();

if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];

    // Ottieni i dati del record dal database
    $member = $db->getRow($id);

    if (!empty($member)) {
        // Aggiorna i dati del record con i nuovi dati inviati dalla richiesta Ajax
        $data = array(
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'status' => $_POST['status']
        );
        $result = $db->update($data, $id);

        if ($result) {
            // Invia una risposta JSON di successo alla richiesta Ajax
            echo json_encode(array('status'=>1, 'data'=>$data));
        } else {
            // Invia una risposta JSON di errore alla richiesta Ajax
            echo json_encode(array('status'=>0, 'msg'=>'Errore durante l\'aggiornamento dei dati del membro'));
        }
    } else {
        // Invia una risposta JSON di errore alla richiesta Ajax
        echo json_encode(array('status'=>0, 'msg'=>'Membro non trovato nel database'));
    }
} else {
    // Invia una risposta JSON di errore alla richiesta Ajax
    echo json_encode(array('status'=>0, 'msg'=>'Azione non valida'));
}
