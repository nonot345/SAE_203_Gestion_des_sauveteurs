<?php

require 'model.php';

$couleurs = [
    'Sauveteur disponible'                => '#2ecc71',
    'Sauveteur en approche de la cavité'  => '#9b59b6',
    'Sauveteur sous terre'                => '#8B4513',
    'Sauveteur équipe de gestion'         => '#f1c40f',
    "Sauveteur en mission à l'extérieur"  => '#e67e22',
    'Sauveteur en repos'                  => '#3498db',
    'Sauveteur en brancardage civière'    => '#e74c3c',
];

$creneaux = [];
for ($min = 8 * 60; $min < 20 * 60; $min += 30) {
    $creneaux[] = sprintf('%02d:%02d', intdiv($min, 60), $min % 60);
}

// Indexer les sauveteurs par ID pour accès rapide à la spécialité
$sauveteursById = [];
foreach ($sauveteurs as $s) {
    $sauveteursById[$s['ID_Sauveteur']] = $s;
    $grille[$s['ID_Sauveteur']]= array_fill_keys($creneaux, false);
}

foreach ($missions as $m) {
    $id         = $m['ID_Sauveteur'];
    if (!isset($grille[$id])) continue;

    $specialite = $sauveteursById[$id]['Specialite'] ?? '';
    $couleur    = $couleurs[$specialite] ?? '#cccccc';
    $debut      = new DateTime($m['DtaHeureDebut']);
    $fin        = new DateTime($m['DtaHeureFin']);

    foreach ($creneaux as $c) {
        $debutCreneau = new DateTime($date . ' ' . $c . ':00');
        $finCreneau   = (clone $debutCreneau)->modify('+30 minutes');
        if ($debut < $finCreneau && $fin > $debutCreneau) {
            $grille[$id][$c] = $couleur;
        }
    }
}

require 'view.php';
