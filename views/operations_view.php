<?php require('views/header.php'); ?>

<nav class="sub-nav">
    <a href="index.php?route=operations">Nouvelle mission</a>
    <a href="index.php?route=ajout_personnes">Ajout sauveteur</a>
</nav>

<h2>Assigner une mission</h2>

<form action="index.php?route=add_operation" method="POST">

    <p>
        <label for="id_sauveteur">Sauveteur :</label>
        <select name="id_sauveteur" id="id_sauveteur" required>
            <option value="">-- Choisir un sauveteur --</option>
            <?php foreach ($sauveteurs as $s): ?>
            <option value="<?= $s['ID'] ?>">
                <?= htmlentities($s['nom'] . ' ' . $s['prenom']) ?> (<?= htmlentities($s['specialite']) ?>)
            </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <label for="id_statut">Statut :</label>
        <select name="id_statut" id="id_statut" required>
            <option value="">-- Choisir un statut --</option>
            <?php foreach ($statuts as $st): ?>
            <option value="<?= $st['ID'] ?>"><?= htmlentities($st['TypeStatut']) ?></option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <label for="lieu">Lieu :</label>
        <input type="text" id="lieu" name="lieu" placeholder="Ex : Grotte de Lestélas" required>
    </p>

    <p>
        <label for="date_debut">Date / heure début :</label>
        <input type="datetime-local" id="date_debut" name="date_debut" required>
    </p>

    <p>
        <label for="date_fin">Date / heure fin :</label>
        <input type="datetime-local" id="date_fin" name="date_fin">
    </p>

    <p>
        <label>
            <input type="checkbox" name="duree_indeterminee" value="1" onclick="
                var fin = document.getElementById('date_fin');
                if (this.checked) { fin.disabled = true; fin.value = ''; }
                else { fin.disabled = false; }
            ">
            Durée indéterminée
        </label>
    </p>

    <p>
        <label>
            <input type="checkbox" name="en_prepa" value="1">
            En préparation
        </label>
    </p>

    <p>
        <input type="submit" value="Enregistrer la mission">
    </p>

</form>

<?php require('views/footer.php'); ?>
