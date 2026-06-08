<?php

function operations_form_ctrl() {
    require('views/operations_view.php');
}

function add_operation_write_ctrl() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?route=operations');
        exit;
    }

    $date_debut = $_POST['date_debut'];
    $date_fin   = $_POST['date_fin'];
    $lieu       = $_POST['lieu'];

    // Valeurs par défaut pour les clés étrangères (à adapter quand l'auth sera active)
    $en_prepa      = 0;
    $id_sauveteur  = 1;
    $id_statut     = 1;
    $id_utilisateur = 1;

    require('models/connection.php');
    $c = connection();
    require('models/operation_crud.php');

    $resultat = create_operation_crud($c, $date_debut, $date_fin, $lieu, $en_prepa, $id_sauveteur, $id_statut, $id_utilisateur);

    if ($resultat) {
        $_SESSION['notification'] = 'Opération enregistrée avec succès.';
    } else {
        $_SESSION['notification'] = 'Erreur lors de l\'enregistrement.';
    }

    header('Location: index.php?route=operations');
    exit;
}
