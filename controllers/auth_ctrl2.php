<?php
function login_ctrl() {
    $ask_route = null;
    if (isset($_GET['ask'])) {
        $ask_route = htmlentities($_GET['ask']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        verify_login_ctrl($ask_route);
    } else {
        login_form_ctrl($ask_route);
    }
}
function verify_login_ctrl(?string $route) {
    require('models/connection.php');
    require('models/user_crud.php');
    $login  = isset($_POST['login']) ? htmlentities($_POST['login']) : '';
    $passwd = isset($_POST['password']) ? $_POST['password'] : '';
    $c = connection();
    $user = recuperation_auth($c, $login);
    if ($user && password_verify($passwd, $user['passwd'])) {
        session_regenerate_id(true);
        $_SESSION['login'] = $user['login'];
        $_SESSION['role']  = $user['type'];
        if ($route) {
            header('Location: index.php?route=' . $route);
        } else {
            switch ($user['type']) {
                case 'admin':
                    header('Location: index.php?route=admin');
                    break;
                case 'administration':
                    header('Location: index.php?route=operations');
                    break;
                default:
                    header('Location: index.php');
                    break;
            }
        }
        exit;
    } else {
        echo 'Erreur d\'authentification.';
        exit;
    }
}
function login_form_ctrl(?string $route) {
    require('views/login_views.php');
    login_form_view($route);
}
function logout_ctrl() {
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    require('views/welcome_view.php');
}