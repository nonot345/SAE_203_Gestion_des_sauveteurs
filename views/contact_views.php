<?php require('header.php')?>

<h2>Ajouts de personnes </h2>

	<form action="traite_formulaire.php" method="post">
	<p>Nom : <input type="text" name="login" /></p>
	<p>Prénom : <input type="text" name="login" /></p>
	</form>
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
	</form></p>
    <p>
	<label for="date">Date d'engagement sur l'opération de secours :</label>
	<input type="date" title="titre" name="ladate" value="unedate" /></p>
	<p>
	<label for="heure">Heure d'engagement sur l'opération de secours :</label>
	<input type="time" title="titre" name="lheure" value="14:00" />
	</p>
	<form>
		<label for="roles">Rôle :</label>
		<select type="number" min="1" placeholder="Rôle" name="role">
		<option value="1" selected="true">Gestionnaire </option>
		<option value="2">Lecteur </option>
		<option value="3">Admin</option>
	</select>
	</form>
</p>
	<input type="submit" value="Valider" />
	<input type="reset" value="Annuler" />
	


<?php
require('footer.php');