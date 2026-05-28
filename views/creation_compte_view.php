<?php
 require('views/header.php');
   
?>
<meta charset="UTF-8">

<nav> 
<a id="CRERR COMPTES" href="../creation_compte_view.php">CRER COMPTES</a>
<a id="MODIFIER COMPTES" href="../modif_comptes_view.php">MODIFIER COMPTES</a>
</nav>
<h2>Ajout d'un nouveau compte</h2>
<form action="index.php?route=add_utilisateurs" method="post"> 
    <p>
        Nom : <input type="text" name="nom" required>
    </p>

    <p>
        Prénom : <input type="text" name="prenom" required>
    </p>


    <p>
        <label for="role">Choix du rôle :</label>
        <select name="role" id="role" required>
            <option value="">-- Sélectionnez un profil --</option>
            <option value="GESTIONNAIRE">Gestionnaire</option>
            <option value="LECTURE">Lecture (Responsable)</option>
            <option value="ADMINISTRATION">Administration</option>
        </select>
    </p>

<p>
        NOM DEP : <input type="text" name=nomdep" required>
        </p>


        <p>
        n°tel : <input type="text" name=n°tel" required>
    </p>
    
    
   <p>
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required>
    </p>

    <p>
        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required>
    </p>

    <p>
        <input type="submit" value="Enregistrer">
    </p>

</form>
 

     <?php