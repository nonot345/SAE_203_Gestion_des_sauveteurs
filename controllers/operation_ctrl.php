<?php

function operations_form_ctrl()
{
    require_once('controllers/auth_utilities.php');
    if (!has_any_role(['gestionnaire', 'administration'])) {
        header('Location: index.php?route=auth&ask=operations');
        exit;
    }

    require('models/connection.php');
    require('models/lecture_page_model.php');
    $pdo = connection();
    $sauveteurs = get_sauveteurs($pdo);
    $statuts    = get_statuts($pdo);

    require('views/operations_view.php');
}

function add_operation_write_ctrl()
{
    require_once('controllers/auth_utilities.php');
    if (!has_any_role(['gestionnaire', 'administration'])) {
        header('Location: index.php?route=auth&ask=operations');
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?route=operations');
        exit;
    }

    $id_sauveteur  = (int) $_POST['id_sauveteur'];
    $id_statut     = (int) $_POST['id_statut'];
    $lieu          = $_POST['lieu'];
    $date_debut    = str_replace('T', ' ', $_POST['date_debut']) . ':00';
    $en_prepa      = isset($_POST['en_prepa']) ? 1 : 0;
    $indeterminee  = isset($_POST['duree_indeterminee']);

    // Durée indéterminée → date très lointaine
    if ($indeterminee || empty($_POST['date_fin'])) {
        $date_fin = '2099-12-31 23:59:00';
    } else {
        $date_fin = str_replace('T', ' ', $_POST['date_fin']) . ':00';
    }

    // Utilisateur connecté
    $id_utilisateur = isset($_SESSION['id']) ? (int) $_SESSION['id'] : 1;

    require('models/connection.php');
    $c = connection();
    require('models/operation_crud.php');

    $resultat = create_operation_crud(
        $c,
        $date_debut,
        $date_fin,
        $lieu,
        $en_prepa,
        $id_sauveteur,
        $id_statut,
        $id_utilisateur
    );

    if ($resultat) {
        $_SESSION['notification'] = 'Mission enregistrée avec succès.';
    } else {
        $_SESSION['notification'] = 'Erreur lors de l\'enregistrement de la mission.';
    }

    header('Location: index.php?route=operations');
    exit;
}
