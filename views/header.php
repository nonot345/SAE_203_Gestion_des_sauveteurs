<?php
//session_start();

// --- NAVIGATION STATIQUE (auth commentée en attendant le système de connexion) ---
$nav = '<li><a href="index.php">Accueil</a></li>';

// À DÉCOMMENTER quand auth_utilities.php sera chargé :
// $nav .= '<li><a href="index.php?route=planning">Planning</a></li>';
// $nav .= '<li><a href="index.php?route=sauveteurs">Sauveteurs</a></li>';
// $nav .= '<li><a href="index.php?route=gestion">Gestion</a></li>';
// $nav .= '<li><a href="index.php?route=admin">Admin</a></li>';

$nav .= '<li><a href="index.php?route=planning">Planning</a></li>';
$nav .= '<li><a href="index.php?route=sauveteurs">Sauveteurs</a></li>';
$nav .= '<li><a href="index.php?route=gestion">Gestion</a></li>';
$nav .= '<li><a href="index.php?route=admin">Admin</a></li>';

$nav .= '<li><a href="index.php?route=auth" class="nav-right">Connexion</a></li>';

// $session = 'Connecté : ' . htmlentities($_SESSION['login']) . ' (' . ($_SESSION['role'] ?: 'lecture') . ')';
$session = 'Non connecté';

$notif = '';
// if (!empty($_SESSION['notification'])) {
//     $notif = '<div id="notification">' . htmlentities($_SESSION['notification']) . '</div>';
//     unset($_SESSION['notification']);
// }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSF — Gestion des sauveteurs</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
</head>

<body>
<header>
    <div class="header-top">
        <a href="index.php">
            <img src="images/logo_ssf.png" alt="Logo SSF">
            <span>Spéléo-Secours Français — Gestion des sauveteurs</span>
        </a>
    </div>

    <nav><ul><?= $nav ?></ul></nav>
    <div class="session-bar"><?= $session ?></div>
    <?= $notif ?>
</header>

<article>
