<?php

function add_utilisateurs_form_ctrl() {
    require('controllers/auth_utilities.php');
    verify_grants('add_utilisateurs_form', 'administration');
    require('views/creation_compte_view.php');
}

function add_utilisateurs_write_ctrl() {
    require('controllers/auth_utilities.php');
    verify_grants('add_utilisateurs', 'administration');
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?route=add_utilisateurs_form');
        exit;
    }

    $nom    = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $role   = $_POST['role'];
    $nomdep = $_POST['nomdep'];
    $num_tel = $_POST['num_tel'];
    $login  = $_POST['login'];
    $mdp    = $_POST['mdp'];

    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $login)) {
        $_SESSION['notification'] = 'Erreur : le login contient des caractères non autorisés.';
        require('views/creation_compte_view.php');
        return;
    }

    $mdp_hache = password_hash($mdp, PASSWORD_DEFAULT);

    require('models/connection.php');
    $c = connection();
    require('models/utilisateur_crud.php');
    create_utilisateur_crud($c, $nom, $prenom, $role, $nomdep, $num_tel, $login, $mdp_hache);

    $_SESSION['notification'] = 'Utilisateur créé avec succès.';
    header('Location: index.php');
    exit;
}
