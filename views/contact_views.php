<?php require('views/header.php'); ?>

<nav class="sub-nav">
    <a href="index.php?route=operations">Nouvelle mission</a>
    <a href="index.php?route=ajout_personnes">Ajout sauveteur</a>
</nav>

<h2>Ajout d'un sauveteur</h2>

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
            <option value="Évacuation">Évacuation</option>
            <option value="ASV (assistance victime)">ASV (assistance victime)</option>
            <option value="Transmission">Transmission</option>
            <option value="Conseiller technique">Conseiller technique</option>
            <option value="Gestion">Gestion</option>
            <option value="Désobstruction">Désobstruction</option>
            <option value="Médical">Médical</option>
            <option value="Ventilation">Ventilation</option>
            <option value="Pas de spécialité">Pas de spécialité</option>
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
