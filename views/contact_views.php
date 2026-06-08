<?php require('views/header.php'); ?>

<h2>Ajout de personnes</h2>

<form action="index.php?route=ajout_personnes" method="post">
    <p>
        <label>Nom :</label>
        <input type="text" name="nom" required>
    </p>
    <p>
        <label>Prénom :</label>
        <input type="text" name="prenom" required>
    </p>
    <p>
        <label>Département :</label>
        <input type="text" name="dep" required>
    </p>
    <p>
        <label for="spe">Spécialité :</label>
        <select name="spe" id="spe">
            <option value="1">Évacuation</option>
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
        <input type="date" id="date" name="ladate" required>
    </p>
    <p>
        <label for="heure">Heure d'engagement :</label>
        <input type="time" id="heure" name="lheure" required>
    </p>
    <p>
        <label for="tel">Numéro de téléphone :</label>
        <input type="tel" id="tel" name="tel" required>
    </p>
    <p>
        <input type="submit" value="Valider">
        <input type="reset" value="Annuler">
    </p>
</form>

<?php require('views/footer.php'); ?>
