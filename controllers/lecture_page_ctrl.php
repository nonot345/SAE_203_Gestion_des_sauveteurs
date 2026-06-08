<?php

function planning_afficher_ctrl() {

    require_once 'models/connection.php';
    require_once 'models/planning_model.php';

    $co = connection();

    $date = $_GET['date'] ?? date('Y-m-d');

    $sauveteurs = get_all_sauveteurs($co);
    $missions   = get_missions_by_date($co, $date);

    // Couleurs
    $couleurs = [
        'Sauveteur disponible'               => '#2ecc71',
        'Sauveteur en approche de la cavité' => '#9b59b6',
        'Sauveteur sous terre'               => '#8B4513',
        'Sauveteur équipe de gestion'        => '#f1c40f',
        "Sauveteur en mission à l'extérieur" => '#e67e22',
        'Sauveteur en repos'                 => '#3498db',
        'Sauveteur en brancardage civière'   => '#e74c3c',
    ];

    // Créneaux 8h - 20h (30 min)
    $creneaux = [];
    for ($min = 8 * 60; $min < 20 * 60; $min += 30) {
        $creneaux[] = sprintf('%02d:%02d', intdiv($min, 60), $min % 60);
    }

    // Index sauveteurs + grille vide
    $sauveteursById = [];
    $grille = [];

    foreach ($sauveteurs as $s) {
        $sauveteursById[$s['ID_Sauveteur']] = $s;
        $grille[$s['ID_Sauveteur']] = array_fill_keys($creneaux, '');
    }

    // Remplissage des missions
    foreach ($missions as $m) {

        $id = $m['ID_Sauveteur'];

        if (!isset($grille[$id])) continue;

        $specialite = $sauveteursById[$id]['Specialite'] ?? '';
        $couleur = $couleurs[$specialite] ?? '#cccccc';

        $debut = new DateTime($m['DtaHeureDebut']);
        $fin   = new DateTime($m['DtaHeureFin']);

        foreach ($creneaux as $c) {

            $start = new DateTime($date . ' ' . $c . ':00');
            $end   = (clone $start)->modify('+30 minutes');

            if ($debut < $end && $fin > $start) {
                $grille[$id][$c] = $couleur;
            }
        }
    }

    require 'views/planning_view.php';
}
