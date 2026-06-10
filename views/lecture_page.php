<?php

/**
 * Affichage du planning avec le tableau des créneaux
 */
function planning_view(array $sauveteurs, array $creneaux, array $missions_par_sauveteur, string $date)
{
    $date_formatee = date('d/m/Y', strtotime($date));
    require('views/header.php');

    // Couleurs associées à chaque statut
    $couleurs = [
        'Sauveteur disponible'                => '#2ecc71',
        'Sauveteur en approche de la cavite'  => '#9b59b6',
        'Sauveteur sous terre'                => '#8B4513',
        'Sauveteur equipe de gestion'         => '#f1c40f',
        'Sauveteur en mission a l\'exterieur' => '#f39c12',
        'Sauveteur en repos'                  => '#3498db',
        'Sauveteur en brancardage civiere'    => '#e74c3c',
    ];
?>

<h2>Planning du <?= $date_formatee ?></h2>

<div class="planning-tableau">
<table>
    <thead>
        <tr>
            <th>Sauveteur</th>
            <?php foreach ($creneaux as $creneau): ?>
                <th><?= $creneau ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($sauveteurs as $sauveteur): ?>
        <tr>
            <td class="sauveteur-nom">
                <?= htmlentities($sauveteur['nom'] . ' ' . $sauveteur['prenom']) ?>
                <br><small><?= htmlentities($sauveteur['specialite']) ?></small>
            </td>

            <?php foreach ($creneaux as $creneau): ?>
                <?php
                $statut = null;
                $en_prepa = false;

                $debut_creneau = new DateTime($date . ' ' . $creneau . ':00');
                $fin_creneau = clone $debut_creneau;
                $fin_creneau->modify('+30 minutes');

                // On cherche si une mission couvre ce créneau
                $liste_missions = $missions_par_sauveteur[$sauveteur['ID']] ?? [];
                foreach ($liste_missions as $mission) {
                    $debut_mission = new DateTime($mission['DateHeureDebut']);
                    $fin_mission = new DateTime($mission['DateHeureFin']);

                    if ($debut_mission < $fin_creneau && $fin_mission > $debut_creneau) {
                        $statut = $mission['TypeStatut'];
                        $en_prepa = (bool) $mission['EnPrepa'];
                        break;
                    }
                }

                if ($statut === null) {
                    $style = '';
                    $titre = '';
                    $texte = '';
                } else {
                    $couleur = $couleurs[$statut] ?? '#ccc';
                    $titre = htmlspecialchars($statut);
                    if ($en_prepa) {
                        $style = 'background:' . $couleur . '; opacity:0.4;';
                        $titre .= ' (préparation)';
                        $texte = 'P';
                    } else {
                        $style = 'background:' . $couleur . '; opacity:0.85;';
                        $texte = '';
                    }
                }
                ?>
                <td style="<?= $style ?>" title="<?= $titre ?>"><?= $texte ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<div class="planning-legende">
    <h3>Légende</h3>
    <span class="legende-item">
        <span class="legende-couleur" style="background:#2ecc71;"></span> Disponible
    </span>
    <span class="legende-item">
        <span class="legende-couleur" style="background:#9b59b6;"></span> En approche de la cavité
    </span>
    <span class="legende-item">
        <span class="legende-couleur" style="background:#8B4513;"></span> Sous terre
    </span>
    <span class="legende-item">
        <span class="legende-couleur" style="background:#f1c40f;"></span> Équipe de gestion
    </span>
    <span class="legende-item">
        <span class="legende-couleur" style="background:#f39c12;"></span> En mission à l'extérieur
    </span>
    <span class="legende-item">
        <span class="legende-couleur" style="background:#3498db;"></span> En repos
    </span>
    <span class="legende-item">
        <span class="legende-couleur" style="background:#e74c3c;"></span> Brancardage civière
    </span>
    <span class="legende-item">
        <span class="legende-couleur" style="background:#ccc; opacity:0.4;"></span>
        En préparation (P)
    </span>
</div>

<?php
    require('views/footer.php');
}
