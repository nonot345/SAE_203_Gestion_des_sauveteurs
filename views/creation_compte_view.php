<?php require('views/header.php'); ?>

<nav class="sub-nav">
    <a href="index.php?route=add_utilisateurs_form">Créer un compte</a>
    <a href="index.php?route=modif_utilisateurs_form">Modifier un compte</a>
</nav>

<h2>Créer un compte</h2>

<form action="index.php?route=add_utilisateurs" method="post">
    <p><label>Nom :</label> <input type="text" name="nom" required></p>
    <p><label>Prénom :</label> <input type="text" name="prenom" required></p>
    <p>
        <label for="role">Rôle :</label>
        <select name="role" id="role" required>
            <option value="">-- Sélectionnez un profil --</option>
            <option value="gestionnaire">Gestionnaire</option>
            <option value="lecture">Lecture</option>
            <option value="administration">Administration</option>
        </select>
    </p>
    <p><label>Département :</label> <input type="text" name="nomdep" required></p>
    <p><label>Téléphone :</label> <input type="text" name="num_tel" required></p>
    <p><label for="login">Login :</label> <input type="text" id="login" name="login" required></p>
    <p><label for="mdp">Mot de passe :</label> <input type="password" id="mdp" name="mdp" required></p>
    <p><input type="submit" value="Enregistrer"></p>
</form>

<?php require('views/footer.php'); ?>
