

	<h1>
		<?= $titre ?>
	</h1>

	<div id="vueModifierSalle" class="modifierSalle">

		<?php if($requestUpdate){ ?>
			<div class="alert alert-success">
	  		<strong>Modification effectuer !</strong>
			</div>
		<?php } ?>

			<form id="changeDataForm" ref="formChangeData" action="./?action=modifierSalle" method="POST">

				<input id="postesSelect" type="text" name="postsValForChangeData" style="display: none;"/>

			</form>

		<form action="./?action=modifierSalle" method="POST">

		    <label>Selectionner un poste:</label>

			<select id="allPosts" name="postsVal">
				<?php if(empty($postSelected)){?>
					 				<option value=''> </option><?php
			      	}
		        	foreach($posts as $unePosts => $post) {
		        		 ?> <option value="<?= $post->nPoste?>"> <?=$post->nomPoste?> </option>;
		        		 <?php
		        	} ?>
			</select> <br><br>
			<label>Modifier le nom du poste :</label>
		    <input type="text" name="namePostChange" size="25" value="<?= $namePoste = (!empty($postSelected)) ? $namePoste = "$postSelected->nomPoste" : $namePoste = "";?>"><br><br>

			<label>Selectionner la salle a changer</label>
			<select id="salle" name="changeSalleVal">
			      		<?php
			        	foreach($salles as $uneSalle => $salle) {
									if(!empty($postSelected)){
										if($salle->nSalle == $postSelected->nSalle){
											?> <option value="<?= $salle->nSalle?>" selected> <?=$salle->nomSalle?> </option>;
	 			        		 <?php
									 }else {
										 ?> <option value="<?= $salle->nSalle?>"> <?=$salle->nomSalle?> </option>;
				        		 <?php
									 }
									}
			        	} ?>
			</select><br><br>


			<label>Modifier le type du poste :</label>
			<select id="typePc" name="typePost">
					<?php
					foreach($typePc as $untypePc => $typePcVal) {
						if(!empty($postSelected)){
							if($typePcVal->typeLP == $postSelected->typePoste){
								?> <option value="<?= $typePcVal->typeLP?>" selected> <?=$typePcVal->nomType?> </option>;
								<?php
							}else {
								?> <option value="<?= $typePcVal->typeLP?>"> <?=$typePcVal->nomType?> </option>;
	 						 <?php
							}
						}
					} ?>
			</select>

			<br />

			  <input type="submit" name="buttonChangePoste">

		</form>

	</div>

		<script>
				$('#allPosts').change(function(e) {
		      $('#postesSelect').attr('value', $('#allPosts').val());
		      $('#changeDataForm').submit();
		    });
		</script>
