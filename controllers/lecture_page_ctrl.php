<?php

function planning_afficher_ctrl() {
    require('models/connection.php');
    require('models/lecture_page_model.php');

    $c = connection();

    // Date : aujourd'hui par défaut, modifiable via ?date=YYYY-MM-DD
    $date = $_GET['date'] ?? date('Y-m-d');
    $date_precedente = date('Y-m-d', strtotime($date . ' -1 day'));
    $date_suivante   = date('Y-m-d', strtotime($date . ' +1 day'));

    // Tous les sauveteurs et leurs missions du jour
    $sauveteurs = get_all_sauveteurs($c);
    $missions   = get_missions_by_date($c, $date);

    // Couleurs par spécialité (numéro → couleur)
    $couleurs = [
        1 => '#e74c3c',  // Évacuation
        2 => '#3498db',  // ASV
        3 => '#f39c12',  // Transmission
        4 => '#9b59b6',  // Conseiller technique
        5 => '#2ecc71',  // Gestion
        6 => '#8B4513',  // Désobstruction
        7 => '#e91e63',  // Médical
        8 => '#00bcd4',  // Ventilation
        9 => '#95a5a6',  // Pas de spécialité
    ];

    // Créneaux 8h-20h (toutes les 30 min)
    $creneaux = [];
    for ($min = 8 * 60; $min < 20 * 60; $min += 30) {
        $creneaux[] = sprintf('%02d:%02d', intdiv($min, 60), $min % 60);
    }

    // Index des sauveteurs + couleur par spécialité
    $sauveteurs_index = [];
    foreach ($sauveteurs as $s) {
        $spe_num = (int) ($s['specialite'] ?? 0);
        $s['couleur'] = $couleurs[$spe_num] ?? '#cccccc';
        $sauveteurs_index[$s['ID']] = $s;
    }

    // Grille : sauveteur_id → créneau → [couleur, en_prepa]
    $grille = [];
    foreach ($sauveteurs as $s) {
        $grille[$s['ID']] = [];
        foreach ($creneaux as $c) {
            $grille[$s['ID']][$c] = null;
        }
    }

    // Remplissage de la grille avec les missions
    foreach ($missions as $m) {
        $id_sauv = $m['ID_Sauveteur'];
        if (!isset($grille[$id_sauv])) continue;

        $debut = new DateTime($m['DateHeureDebut']);
        $fin   = new DateTime($m['DateHeureFin']);
        $en_prepa = (bool) $m['EnPrepa'];

        foreach ($creneaux as $c) {
            $debut_creneau = new DateTime($date . ' ' . $c . ':00');
            $fin_creneau   = (clone $debut_creneau)->modify('+30 minutes');

            if ($debut < $fin_creneau && $fin > $debut_creneau) {
                $grille[$id_sauv][$c] = [
                    'couleur'  => $sauveteurs_index[$id_sauv]['couleur'],
                    'en_prepa' => $en_prepa,
                    'mission_id' => $m['ID'],
                ];
            }
        }
    }

    // Légende des spécialités
    $legendes = [
        1 => 'Évacuation',
        2 => 'ASV',
        3 => 'Transmission',
        4 => 'Conseiller technique',
        5 => 'Gestion',
        6 => 'Désobstruction',
        7 => 'Médical',
        8 => 'Ventilation',
        9 => 'Pas de spécialité',
    ];

    require('views/lecture_page.php');
    planning_view($sauveteurs, $sauveteurs_index, $creneaux, $grille, $date, $date_precedente, $date_suivante, $couleurs, $legendes);
}
