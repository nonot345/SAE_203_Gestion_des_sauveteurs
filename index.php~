<?php

require('controllers/auth_utilities.php');
session_start();

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', 1);

$route = null;
if (isset($_GET['route'])) {
    $route = 'invalid';
    if (preg_match('#^[a-zA-Z0-9 _]*$#', $_GET['route'])) {
        $route = $_GET['route'];
    }
}

switch ($route) {

    case null:
    case '':
        require('controllers/auth_ctrl2.php');
        login_ctrl();
        break;

    case 'auth':
        require('controllers/auth_ctrl2.php');
        login_ctrl();
        break;

    case 'logout':
        require('controllers/auth_ctrl2.php');
        logout_ctrl();
        break;

    case 'planning':
        require('controllers/lecture_page_ctrl.php');
        planning_afficher_ctrl();
        break;

    case 'add_utilisateurs_form':
        require('controllers/utilisateur_ctrl.php');
        add_utilisateurs_form_ctrl();
        break;

    case 'add_utilisateurs':
        require('controllers/utilisateur_ctrl.php');
        add_utilisateurs_write_ctrl();
        break;

    case 'modif_utilisateurs_form':
        require('controllers/modif_compte_ctrl.php');
        modif_utilisateurs_form_ctrl();
        break;

    case 'modif_utilisateurs':
        require('controllers/modif_compte_ctrl.php');
        modif_utilisateurs_write_ctrl();
        break;

    case 'ajout_personnes':
        require('controllers/contact_crtl.php');
        contact_ctrl();
        break;

    case 'operations':
        require('controllers/operation_ctrl.php');
        operations_form_ctrl();
        break;

    case 'add_operation':
        require('controllers/operation_ctrl.php');
        add_operation_write_ctrl();
        break;

    default:
        require('views/404_view.php');
        break;
}
