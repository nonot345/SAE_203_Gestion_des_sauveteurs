<?php

function contact_ctrl() {
    require('controllers/auth_utilities.php');
    if (!has_any_role(['gestionnaire', 'administration'])) {
        header('Location: index.php?route=auth&ask=ajout_personnes');
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        contact_write_ctrl();
    } else {
        contact_form_ctrl();
    }
}

function contact_form_ctrl() {
    require('views/contact_views.php');
}

function contact_write_ctrl() {
    $nom    = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dep    = $_POST['dep'];
    $spe    = $_POST['spe'];
    $tel    = $_POST['tel'];
    $date   = $_POST['ladate'];
    $heure  = $_POST['lheure'];

    // Combine date + heure en DateTime
    $date_heure = $date . ' ' . $heure . ':00';

    if (empty($nom) || empty($prenom) || empty($tel)) {
        $_SESSION['notification'] = 'Veuillez remplir tous les champs obligatoires.';
        require('views/contact_views.php');
        return;
    }

    require('models/connection.php');
    $c = connection();
    require('models/contact_crud.php');

    create_sauveteur($c, $nom, $prenom, $dep, $spe, $date_heure, $tel);

    $_SESSION['notification'] = 'Sauveteur ajouté avec succès.';
    header('Location: index.php?route=ajout_personnes');
    exit;
}
