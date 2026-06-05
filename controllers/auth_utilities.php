<?php

// Vérifie si l'utilisateur est connecté
function is_logged() {
    return isset($_SESSION['login']);
}

// Vérifie si l'utilisateur a un rôle spécifique
function has_role(string $role) {
    return isset($_SESSION['role']) && $_SESSION['role'] == $role;
}

// Redirige vers l'authentification si l'utilisateur n'a pas les droits
function verify_grants(string $route, string $role = '') {
    if (!has_role($role) && !($role == '' && is_logged())) {
        header('Location: index.php?route=auth&ask=' . $route);
        exit;
    }
}
