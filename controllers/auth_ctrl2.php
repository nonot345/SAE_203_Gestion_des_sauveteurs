<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', 1);


function login_ctrl() {
    $ask_route = null;
    if (isset($_GET['ask'])) {
        $ask_route = htmlentities($_GET['ask']);
    }
    
    // Si le formulaire est soumis (POST), on vérifie, sinon on l'affiche
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        verify_login_ctrl($ask_route);
    } else {
        login_form_ctrl($ask_route);
    }
}
function verify_login_ctrl(?string $route) {
   
    require('models/user_crud.php'); 
    require('config/config.php');

    $login = isset($_POST['login']) ? htmlentities($_POST['login']) : '';
    $passwd = isset($_POST['password']) ? htmlentities($_POST['password']) : '';
    $user_data = recuperation_auth($connex, $login);

    if ($user_data && $user_data['passwd'] === $passwd) {
        
        $_SESSION['login'] = $user_data['login'];
        $_SESSION['role']  = $user_data['type']; 
        
        // Redirection
        header('Location: index.php?route=' . $route);
        exit;
    } else {
       
        echo 'Authentication error !!!';
        exit;
    }
} 

/**
 * Contrôleur de déconnexion
 */


function login_form_ctrl(?string $route) {
    require('views/login_view.php');
    login_form_view($route);
}


/**
* Authentication processing
*/

function logout_ctrl() {
    unset($_SESSION);
    session_destroy();
    require('views/welcome_view.php');
}

