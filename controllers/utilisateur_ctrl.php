<?php

/**
 * Affichage du formulaire de création de compte
 */
function add_utilisateurs_form_ctrl()
{
    // Réservé administration
    require_once('controllers/auth_utilities.php');
    verify_grants('add_utilisateurs_form', 'administration');
    require('views/creation_compte_view.php');
}

/**
 * Enregistrement d'un nouveau compte utilisateur
 */
function add_utilisateurs_write_ctrl()
{
    require_once('controllers/auth_utilities.php');
    verify_grants('add_utilisateurs', 'administration');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?route=add_utilisateurs_form');
        exit;
    }

    // Contrôle des caractères du login
    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $_POST['login'])) {
        $_SESSION['notification'] = 'Erreur : le login contient des caractères non autorisés.';
        require('views/creation_compte_view.php');
        return;
    }

    // Hashage du mot de passe
    $mdp_hache = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    // On écrit dans la base
    require('models/connection.php');
    $c = connection();
    require('models/utilisateur_crud.php');

    create_utilisateur_crud($c, $_POST['nom'], $_POST['prenom'], $_POST['role'], $_POST['nomdep'], $_POST['num_tel'], $_POST['login'], $mdp_hache);

    $_SESSION['notification'] = 'Utilisateur créé avec succès.';
    header('Location: index.php');
    exit;
}
