<?php

function planning_afficher_ctrl()
{
    require_once('controllers/auth_utilities.php');
    verify_grants('planning');
    require('models/connection.php');
    require('models/lecture_page_model.php');

    $pdo = connection();

    // Date du planning
    if (isset($_GET['date'])) {
        $date = $_GET['date'];
    } else {
        $date = date('Y-m-d');
    }

    // Données depuis la base
    $sauveteurs = get_sauveteurs($pdo);
    $missions   = get_missions_planning($pdo, $date);

    // Créneaux horaires : 0h à 24h toutes les 30 minutes
    $creneaux = [];
    for ($minutes = 0; $minutes < 1440; $minutes = $minutes + 30) {
        $heures = intdiv($minutes, 60);
        $mins   = $minutes % 60;
        $creneaux[] = sprintf('%02d:%02d', $heures, $mins);
    }

    // Regrouper les missions par sauveteur
    $missions_par_sauveteur = [];
    foreach ($missions as $mission) {
        $id_sauv = $mission['ID_Sauveteur'];
        $missions_par_sauveteur[$id_sauv][] = $mission;
    }

    // Affichage
    require('views/lecture_page.php');
    planning_view($sauveteurs, $creneaux, $missions_par_sauveteur, $date);
}
