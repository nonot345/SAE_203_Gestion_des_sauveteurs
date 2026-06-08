<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', 1);

require_once('models/connection.php');
require_once('models/operation_crud.php');

function operations_form_ctrl() {
    // Appelle TA vue exacte
    require('views/operations_view.php');
}

function add_operation_write_ctrl() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // 1. On récupère les 3 champs de ton formulaire
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
        $lieu = $_POST['lieu'];

        // 2. On force les champs obligatoires de la BDD en arrière-plan
        $en_prepa = 0; 
        $id_sauveteur = 1;   // Par défaut
        $id_statut = 1;      // Par défaut
        $id_utilisateur = 1; // Par défaut

        $connex = connection();
        
        // On envoie tout au modèle
        $resultat = create_operation_crud($connex, $date_debut, $date_fin, $lieu, $en_prepa, $id_sauveteur, $id_statut, $id_utilisateur);
        
        require('models/close_connection.php');
        
        if ($resultat) {
            $_SESSION['notification'] = "Opération enregistrée avec succès.";
        } else {
            $_SESSION['notification'] = "<span style='color:red;'>Erreur lors de l'enregistrement.</span>";
        }
        
        header('Location: index.php?route=operations');
        exit();
    }
}
?>