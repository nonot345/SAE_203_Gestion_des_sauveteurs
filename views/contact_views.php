<?php require('header.php')?>

<h2>Ajouts de personnes </h2>

	<form action="traite_formulaire.php" method="post">
	<p>Nom : <input type="text" name="nom" /></p>
	<p>Prénom : <input type="text" name="prenom" /></p>

	<p>Département : <input type="text" name="dep" /></p>
	<label for="spe">Spécialité :</label>
	<select type="number" min="1" placeholder="spécialité" name="spe" >
		<option value="1" selected="true">Evacuation </option>
		<option value="2">ASV (assistance victime)</option>
		<option value="3">Transmission</option>
		<option value="4">Conseiller technique(chef)</option>
		<option value="5">Gestion</option>
		<option value="6">Désobstruction</option>
		<option value="7">Médical</option>
		<option value="8">Ventilation</option>
		<option value="9">Pas de spécialitées</option>
	</select>
    </p>
	<p>
	<label for="date">Date d'engagement sur l'opération de secours :</label>
	<input type="date" name="ladate" /></p>
	</p>
	<p>
	<label for="heure">Heure d'engagement sur l'opération de secours :</label>
	<input type="time" name="lheure"/>
	</p>
	<p>
	<label for="roles">Rôle :</label>
	<select type="number" min="1" placeholder="Rôle" name="role">
	<option value="1" selected="true">Gestionnaire </option>
	<option value="2">Lecteur </option>
	<option value="3">Admin</option>
	</select>
	</p>
	<p>
    <label for="tel">Numéro de téléphone :</label>
    <input type="tel" id="tel" name="tel" placeholder="Numéro de téléphone" required>
	</p> 

	<input type="submit" value="Valider" />
	<input type="reset" value="Annuler" />
	</form>


<?php
require('footer.php');
