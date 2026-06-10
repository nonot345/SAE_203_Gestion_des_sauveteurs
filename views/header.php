<?php
require_once('controllers/auth_utilities.php');

// --- NAVIGATION selon le rôle ---
$nav = '';

if (is_logged()) {
    $nav .= '<li><a href="index.php?route=planning">Accueil</a></li>';

    if (has_any_role(['gestionnaire', 'administration'])) {
        $nav .= '<li><a href="index.php?route=operations">Opérations</a></li>';
    }

    if (has_role('administration')) {
        $nav .= '<li><a href="index.php?route=modif_utilisateurs_form">Gestion des comptes</a></li>';
    }

    $nav .= '<li><a href="index.php?route=logout" class="nav-right">Déconnexion</a></li>';
}

// --- BARRE DE SESSION ---
if (is_logged()) {
    $session = 'Connecté : ' . htmlentities($_SESSION['login']) . ' (' . htmlentities($_SESSION['role']) . ')';
} else {
    $session = 'Non connecté';
}

// --- NOTIFICATION ---
$notif = '';
if (!empty($_SESSION['notification'])) {
    $notif = '<div id="notification">' . htmlentities($_SESSION['notification']) . '</div>';
    unset($_SESSION['notification']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSF - Gestion des sauveteurs</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
</head>

<body>
<header>
    <div class="header-top">
        <a href="index.php">
            <img src="images/logo_ssf.png" alt="Logo SSF">
            <span>Spéléo-Secours Français - Gestion des sauveteurs</span>
        </a>
    </div>

    <nav><ul><?= $nav ?></ul></nav>
    <div class="session-bar"><?= $session ?></div>
    <?= $notif ?>
</header>

<article>
