<?php require('views/header.php'); ?>

<nav style="margin-bottom: 20px;">
    <a href="index.php?route=operations" style="text-decoration: underline; font-weight: bold; margin-right: 15px;">Opérations</a>
    <a href="index.php?route=ajout_personnes" style="margin-right: 15px;">Ajout personnes</a>
    <a href="index.php?route=planning">Planning</a>
</nav>

<h2>Création d'une opération</h2>

<form action="index.php?route=add_operation" method="POST">
    
    <p>
        <label for="date_debut">Date / heure début :</label>
        <input type="datetime-local" id="date_debut" name="date_debut" required>
    </p>

    <p>
        <label for="date_fin">Date / heure fin :</label>
        <input type="datetime-local" id="date_fin" name="date_fin" required>
    </p>

    <p>
        <label for="lieu">Lieu :</label>
        <input type="text" id="lieu" name="lieu" placeholder="Saisir le lieu" required>
    </p>

    <p>
        <input type="submit" value="Enregistrer l'opération">
    </p>

</form>

<?php require('views/footer.php'); ?>