
<div class="creeSalle">
    <form action="./?action=creeSalle" method="POST">

      <?php if($checkCreatePoste){ ?>
        <div class="alert alert-success">
          <strong>Creation effectuer !</strong>
        </div>
      <?php } ?>
    	<label>Nom post :</label>
    	<input type="text" name="namePost" size="25"><br><br>

    	<select id="salle" name="salleVal">
      		<?php
        	foreach($salles as $uneSalle => $salle) {
        		 ?> <option value="<?= $salle->nSalle?>"> <?=$salle->nomSalle?> </option>;
        		 <?php
        	} ?>
    	</select>

    	<select id="typePc" name="typePost">
      		<?php
        	foreach($typePc as $untypePc => $typePcVal) {
        		 ?> <option value="<?= $typePcVal->typeLP?>"> <?=$typePcVal->nomType?> </option>;
        		 <?php
        	} ?>
    	</select>
            <br>
        <input type="submit" name="buttonCrearePost">
    </form>

</div>
