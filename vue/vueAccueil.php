
<h1><?= $titre ?></h1>

<div class="listeSalle">
    <?php for ($i = 0; $i < count($salle); $i++) { ?>

        <div class="salle">

        	<span class="salleName"> <?= $salle[$i]->nomSalle; ?></span><br /><br />
          <span> Poste dans la salle :</span>
            <?php for ($ii = 0; $ii < count($postSalle[$i]); $ii++) { ?>
                    <?= $postSalle[$i][$ii]->nomPoste  ?>
            <?php   } ?>

    	  </div>
    <?php } ?>
</div>
