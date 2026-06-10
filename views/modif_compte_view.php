<?php

/**
 * Page de modification d'un compte existant
 */
function modif_compte_view(array $comptes, ?array $compte_select)
{
    require('views/header.php');
?>

<nav class="sub-nav">
    <a href="index.php?route=add_utilisateurs_form">Créer un compte</a>
    <a href="index.php?route=modif_utilisateurs_form">Modifier un compte</a>
</nav>

<h2>Modifier un compte</h2>

<table>
    <tr>
        <td style="width: 40%; vertical-align: top;">
            <h3>Liste des comptes</h3>
            <ul>
                <?php foreach ($comptes as $cpte): ?>
                <li>
                    <a href="index.php?route=modif_utilisateurs_form&id=<?= $cpte['ID'] ?>">
                        <?= htmlentities($cpte['nom'] . ' ' . $cpte['prenom']) ?> (<?= htmlentities($cpte['login']) ?>)
                    </a>
                </li>
                <?php endforeach; ?>
                <?php if (empty($comptes)): ?>
                <li>Aucun compte trouvé.</li>
                <?php endif; ?>
            </ul>
        </td>

        <td style="vertical-align: top;">
            <h3>Informations</h3>

            <?php if ($compte_select !== null): ?>
            <form action="index.php?route=modif_utilisateurs" method="post">
                <input type="hidden" name="id" value="<?= $compte_select['ID'] ?>">

                <p><label>Nom :</label>
                    <input type="text" name="nom" size="40" value="<?= htmlentities($compte_select['nom']) ?>"></p>
                <p><label>Prénom :</label>
                    <input type="text" name="prenom" size="40" value="<?= htmlentities($compte_select['prenom']) ?>"></p>
                <p><label>Rôle :</label>
                    <select name="role">
                        <option value="gestionnaire" <?= $compte_select['type'] === 'gestionnaire' ? 'selected' : '' ?>>Gestionnaire</option>
                        <option value="lecture" <?= $compte_select['type'] === 'lecture' ? 'selected' : '' ?>>Lecture</option>
                        <option value="administration" <?= $compte_select['type'] === 'administration' ? 'selected' : '' ?>>Administration</option>
                    </select></p>
                <p><label>Département :</label>
                    <input type="text" name="nomdep" size="10" value="<?= htmlentities($compte_select['nomdep']) ?>"></p>
                <p><label>N° téléphone :</label>
                    <input type="text" name="num_tel" size="20" value="<?= htmlentities($compte_select['num_tel']) ?>"></p>
                <p><label>Login :</label>
                    <input type="text" name="login" size="40" value="<?= htmlentities($compte_select['login']) ?>"></p>
                <p><label>Nouveau mot de passe :</label>
                    <input type="password" name="passwd" size="40" placeholder="Laisser vide pour ne pas modifier"></p>
                <p><input type="submit" value="Enregistrer les modifications"></p>
            </form>
            <?php else: ?>
            <p>Cliquez sur un compte dans la liste pour le modifier.</p>
            <?php endif; ?>
        </td>
    </tr>
</table>

<?php
    require('views/footer.php');
}
