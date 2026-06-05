<?php require('views/header.php'); ?>

<h2>Ajout de personnes</h2>

<form action="index.php?route=add_personne" method="post">
    <p>Nom : <input type="text" name="nom" required></p>
    <p>Prénom : <input type="text" name="prenom" required></p>
    <p>Département : <input type="text" name="dep" required></p>

    <p>
        <label for="spe">Spécialité :</label>
        <select name="spe" id="spe">
            <option value="1" selected>Évacuation</option>
            <option value="2">ASV (assistance victime)</option>
            <option value="3">Transmission</option>
            <option value="4">Conseiller technique (chef)</option>
            <option value="5">Gestion</option>
            <option value="6">Désobstruction</option>
            <option value="7">Médical</option>
            <option value="8">Ventilation</option>
            <option value="9">Pas de spécialité</option>
        </select>
    </p>

    <p>
        <label for="date">Date d'engagement :</label>
        <input type="date" id="date" name="date">
    </p>

    <p>
        <label for="heure">Heure d'engagement :</label>
        <input type="time" id="heure" name="heure" value="14:00">
    </p>

    <p>
        <label for="role_pers">Rôle :</label>
        <select name="role_pers" id="role_pers">
            <option value="1" selected>Gestionnaire</option>
            <option value="2">Lecteur</option>
            <option value="3">Admin</option>
        </select>
    </p>

    <p>
        <input type="submit" value="Valider">
        <input type="reset" value="Annuler">
    </p>
</form>

<?php require('views/footer.php'); ?>
