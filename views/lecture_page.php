<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Planning</title></head>
<body>

<h2>Planning du <?= $date ?></h2>

<table border="1">
    <tr>
        <th>Nom / Prénom</th>
        <?php foreach ($creneaux as $c): ?>
            <th><?= $c ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($sauveteurs as $s): ?>
    <tr>
        <td><?= $s['Nom'] ?> <?= $s['Prenom'] ?></td>
        <?php foreach ($creneaux as $c):
            $couleur = $grille[$s['ID_Sauveteur']][$c];
        ?>
            <td <?= $couleur ? 'bgcolor="' . $couleur . '"' : '' ?>></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>