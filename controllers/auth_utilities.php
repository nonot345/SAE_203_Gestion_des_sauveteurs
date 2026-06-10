<?php

// Vérifie si l'utilisateur est connecté
function is_logged()
{
    return isset($_SESSION['login']);
}

// Vérifie si l'utilisateur a un rôle précis
function has_role(string $role)
{
    return isset($_SESSION['role']) && $_SESSION['role'] == $role;
}

// Vérifie si l'utilisateur a au moins un des rôles donnés
function has_any_role(array $roles): bool
{
    return isset($_SESSION['role']) && in_array($_SESSION['role'], $roles, true);
}

// Contrôle d'accès : redirige vers auth si les droits sont insuffisants
function verify_grants(string $route, string $role = '')
{
    if (!has_role($role) && !($role == '' && is_logged())) {
        header('Location: index.php?route=auth&ask=' . $route);
        exit;
    }
}
