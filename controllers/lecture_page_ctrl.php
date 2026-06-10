<?php

/**
 * Affichage du planning
 */
function planning_afficher_ctrl()
{
    // Tout utilisateur connecté peut voir le planning
    require_once('controllers/auth_utilities.php');
    verify_grants('planning');

    require('models/connection.php');
    require('models/lecture_page_model.php');

    $pdo = connection();

    $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    // On récupère les sauveteurs et leurs missions du jour
    $sauveteurs = get_sauveteurs($pdo);
    $missions   = get_missions_planning($pdo, $date);

    // Créneaux de 30 minutes sur 24h
    $creneaux = [];
    for ($minutes = 0; $minutes < 1440; $minutes += 30) {
        $heures = intdiv($minutes, 60);
        $mins   = $minutes % 60;
        $creneaux[] = sprintf('%02d:%02d', $heures, $mins);
    }

    // On regroupe les missions par sauveteur
    $missions_par_sauveteur = [];
    foreach ($missions as $mission) {
        $missions_par_sauveteur[$mission['ID_Sauveteur']][] = $mission;
    }

    require('views/lecture_page.php');
    planning_view($sauveteurs, $creneaux, $missions_par_sauveteur, $date);
}
