<?php

// True if user is logged (auth is right)
function is_logged() {
    $status = false;
    if (isset($_SESSION['login'])) {
        $status = true;
    }
    return $status;
}

// True if user has the role $role
function has_role(string $role) {
    $status = false;
    
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == $role) {
            $status = true;
        }
    }
    return $status;
}


// True if user has at least one of the given roles
function has_any_role(array $roles): bool
{
    if (!isset($_SESSION['role'])) {
        return false;
    }
    return in_array($_SESSION['role'], $roles, true);
}

function verify_grants(string $route, string $role='') {
    if (! has_role($role) && ! ($role == '' && is_logged())) {
        header('Location: index.php?route=auth&ask=' . $route);
        exit;
    }
    // Nothing is done so process goes on
}