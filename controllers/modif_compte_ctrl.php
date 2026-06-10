<?php

function modif_utilisateurs_form_ctrl() {
    require_once('controllers/auth_utilities.php');
    verify_grants('modif_utilisateurs_form', 'administration');
    require('models/connection.php');
    $c = connection();
    require('models/modif_compte_model.php');

    $comptes = get_all_comptes($c);

    $compte_select = null;
    if (isset($_GET['id'])) {
        $compte_select = get_compte_by_id($c, (int) $_GET['id']);
    }

    require('views/modif_compte_view.php');
    modif_compte_view($comptes, $compte_select);
}

function modif_utilisateurs_write_ctrl() {
    require_once('controllers/auth_utilities.php');
    verify_grants('modif_utilisateurs', 'administration');
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?route=modif_utilisateurs_form');
        exit;
    }

    $id     = (int) $_POST['id'];
    $nom    = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $role   = htmlentities($_POST['role']);
    $nomdep = htmlentities($_POST['nomdep']);
    $num_tel = htmlentities($_POST['num_tel']);
    $login  = htmlentities($_POST['login']);
    $passwd = $_POST['passwd'] ?? '';

    require('models/connection.php');
    $c = connection();
    require('models/modif_compte_model.php');

    update_compte($c, $id, $nom, $prenom, $role, $nomdep, $num_tel, $login, $passwd);

    $_SESSION['notification'] = 'Compte modifié avec succès.';
    header('Location: index.php?route=modif_utilisateurs_form&id=' . $id);
    exit;
}
