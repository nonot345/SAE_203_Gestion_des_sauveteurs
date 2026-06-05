<?php
// Ce fichier est la vue : il affiche uniquement le HTML
// Les données ($resultComptes, $compteSelectionne, $message) viennent du contrôleur
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Modification d'un compte</title>
</head>
<body>

<?php include('../views/header.php'); ?>

<h2>Modifier un compte existant</h2>

<!-- Navigation entre les deux pages de gestion des comptes -->
<nav>
    <a href="../views/creation_compte_view.php">Créer un compte</a>
    |
    <a href="../controllers/modif_compte_ctrl.php">Modifier un compte</a>
</nav>

<table border="1">
    <tr>

        <!-- COLONNE GAUCHE : liste de tous les comptes -->
        <td>
            <h3>Liste des comptes</h3>
            <ul>
                <?php
                // On parcourt tous les comptes récupérés dans la base
                while ($compte = mysqli_fetch_assoc($resultComptes)) {
                ?>
                    <li>
                        <!-- Un clic sur le nom envoie l'ID dans l'URL -->
                        <a href="modif_compte_ctrl.php?id=<?php echo $compte['ID']; ?>">
                            <?php echo $compte['nom'] . ' ' . $compte['prenom']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </td>

        <!-- COLONNE DROITE : formulaire de modification -->
        <td>
            <h3>Modifier les informations</h3>

            <!-- Affichage du message de confirmation si une modification a été faite -->
            <?php if ($message != "") { ?>
                <p><?php echo $message; ?></p>
            <?php } ?>

            <?php
            // On affiche le formulaire seulement si un compte a été sélectionné
            if ($compteSelectionne != null) {
            ?>
                <!-- Le formulaire envoie les données en POST vers le contrôleur -->
                <form method="POST" action="../controllers/modif_compte_ctrl.php">

                    <!-- Champ caché pour transmettre l'ID du compte à modifier -->
                    <input type="hidden" name="id" value="<?php echo $compteSelectionne['ID']; ?>" />

                    <p>
                        Nom :
                        <input type="text" name="nom" size="40" maxlength="100"
                               value="<?php echo $compteSelectionne['nom']; ?>" />
                    </p>
                    <p>
                        Prénom :
                        <input type="text" name="prenom" size="40" maxlength="100"
                               value="<?php echo $compteSelectionne['prenom']; ?>" />
                    </p>
                    <p>
                        Rôle :
                        <select name="role">
                            <!-- On pré-sélectionne le rôle actuel du compte -->
                            <option value="gestionnaire" <?php if ($compteSelectionne['type'] == 'gestionnaire') echo 'selected'; ?>>Gestionnaire</option>
                            <option value="lecture"      <?php if ($compteSelectionne['type'] == 'lecture')      echo 'selected'; ?>>Lecture</option>
                            <option value="administration" <?php if ($compteSelectionne['type'] == 'administration') echo 'selected'; ?>>Administration</option>
                        </select>
                    </p>
                    <p>
                        Département :
                        <input type="text" name="departement" size="10" maxlength="10"
                               value="<?php echo $compteSelectionne['departement']; ?>" />
                    </p>
                    <p>
                        Numéro de téléphone :
                        <input type="text" name="numtel" size="20" maxlength="20"
                               value="<?php echo $compteSelectionne['NumTel']; ?>" />
                    </p>
                    <p>
                        Login :
                        <input type="text" name="login" size="40" maxlength="50"
                               value="<?php echo $compteSelectionne['login']; ?>" />
                    </p>
                    <p>
                        Nouveau mot de passe :
                        <!-- Champ vide : si on ne remplit pas, le mot de passe reste inchangé -->
                        <input type="password" name="passwd" size="40" maxlength="255"
                               placeholder="Laisser vide pour ne pas modifier" />
                    </p>

                    <p>
                        <input type="submit" name="enregistrer" value="Enregistrer" />
                    </p>

                </form>

            <?php } else { ?>
                <p>Cliquez sur un compte dans la liste pour le modifier.</p>
            <?php } ?>

        </td>
    </tr>
</table>

<?php include('../views/footer.php'); ?>

</body>
</html>
