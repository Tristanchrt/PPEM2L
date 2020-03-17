<div class="creeSalle">
	<form action="./?action=creerPoste" method="POST">

		<?php if ($checkCreatePoste) { ?>
			<div class="alert alert-success">
				<strong>Creation effectuer !</strong>
			</div>
		<?php } ?>
		<label class="lblModifiePoste">Nom post :</label>
		<input type="text" name="namePost" size="25"><br><br>

		<label class="lblModifiePoste">Salle d'installation du poste :</label>
		<select id="salle" name="salleVal">
			<?php
			foreach ($salles as $uneSalle => $salle) {
			?> <option value="<?= $salle->nSalle ?>"> <?= $salle->nomSalle ?> </option>;
			<?php
			} ?>
		</select>
		<br><br>
		<label class="lblModifiePoste">Type de poste :</label>
		<select id="typePc" name="typePost">
			<?php
			foreach ($typePc as $untypePc => $typePcVal) {
			?> <option value="<?= $typePcVal->typeLP ?>"> <?= $typePcVal->nomType ?> </option>;
			<?php
			} ?>
		</select>
		<br /><br />
		<input class="BtnModifierPoste" type="submit" name="buttonCrearePost">
	</form>

</div>
