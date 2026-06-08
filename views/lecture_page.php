<?php

function planning_view(array $sauveteurs, array $sauveteurs_index, array $creneaux, array $grille, string $date, string $date_prec, string $date_suiv, array $couleurs, array $legendes) {
    require('views/header.php');
?>

<h2>Planning du <?= date('d/m/Y', strtotime($date)) ?></h2>

<!-- Navigation des dates -->
<nav class="planning-nav">
    <a href="index.php?date=<?= $date_prec ?>">&larr; Jour précédent</a>
    <strong><?= date('d/m/Y', strtotime($date)) ?></strong>
    <a href="index.php?date=<?= $date_suiv ?>">Jour suivant &rarr;</a>
</nav>

<!-- Tableau du planning -->
<div class="planning-tableau">
<table>
    <thead>
        <tr>
            <th>Sauveteur</th>
            <?php foreach ($creneaux as $c): ?>
                <th><?= substr($c, 0, 5) ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sauveteurs as $s): ?>
        <tr>
            <td class="sauveteur-nom">
                <?= htmlentities($s['nom'] . ' ' . $s['prenom']) ?>
                <br><small><?= $legendes[(int) $s['specialite']] ?? 'Inconnu' ?></small>
            </td>
            <?php foreach ($creneaux as $c):
                $cell = $grille[$s['ID']][$c] ?? null;
                $bg = $cell ? $cell['couleur'] : '';
                $class = '';
                if ($cell) {
                    $class = $cell['en_prepa'] ? 'cell-prepa' : 'cell-actif';
                }
            ?>
                <td class="<?= $class ?>" style="<?= $bg ? 'background:' . $bg : '' ?>">
                    <?= $cell && $cell['en_prepa'] ? 'P' : '' ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<!-- Légende -->
<div class="planning-legende">
    <h3>Légende : Spécialités</h3>
    <?php foreach ($legendes as $num => $nom): ?>
        <span class="legende-item">
            <span class="legende-couleur" style="background:<?= $couleurs[$num] ?>"></span>
            <?= $nom ?>
        </span>
    <?php endforeach; ?>
    <span class="legende-item">
        <span class="legende-couleur" style="background:#ccc; opacity:0.5;"></span>
        En préparation (P)
    </span>
</div>

<?php require('views/footer.php');
}
