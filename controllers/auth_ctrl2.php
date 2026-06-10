<?php

/**
 * Aiguille vers le bon contrôleur selon la méthode HTTP
 */
function login_ctrl()
{
    $ask_route = isset($_GET['ask']) ? htmlentities($_GET['ask']) : null;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        verify_login_ctrl($ask_route);
    } else {
        login_form_ctrl($ask_route);
    }
}

/**
 * Affichage du formulaire de connexion
 */
function login_form_ctrl(?string $route)
{
    require('views/login_views.php');
    login_form_view($route);
}

/**
 * Vérification du login/mot de passe
 */
function verify_login_ctrl(?string $route)
{
    require('models/connection.php');
    require('models/user_crud.php');

    // On récupère les données du formulaire
    $login = isset($_POST['login']) ? htmlentities($_POST['login']) : '';
    $passwd = isset($_POST['password']) ? $_POST['password'] : '';

    $c = connection();
    $user = recuperation_auth($c, $login);

    if ($user && password_verify($passwd, $user['passwd'])) {
        session_regenerate_id(true);
        $_SESSION['id'] = $user['ID'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['role'] = $user['type'];

        // Si une route était demandée avant connexion, on y retourne
        if ($route) {
            header('Location: index.php?route=' . $route);
            exit;
        }

        // Sinon on redirige selon le rôle
        switch ($user['type']) {
            case 'administration':
                header('Location: index.php?route=modif_utilisateurs_form');
                break;
            case 'gestionnaire':
                header('Location: index.php?route=operations');
                break;
            default:
                header('Location: index.php?route=planning');
                break;
        }
        exit;
    }

    // Échec de l'authentification
    $_SESSION['notification'] = 'Erreur d\'authentification : login ou mot de passe incorrect.';
    $ask = $route ? '&ask=' . $route : '';
    header('Location: index.php?route=auth' . $ask);
    exit;
}

/**
 * Déconnexion
 */
function logout_ctrl()
{
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    header('Location: index.php');
    exit;
}
