
  <h1><?= $titre ?></h1>

  <div class="listeSalle">
      <?php for ($i = 0; $i < count($salle); $i++) { ?>
          <div class="salle">
          	<span class="salleName"> <a href="./?action=detail&nSalle=<?= $salle[$i]->nSalle; ?>" > <?= $salle[$i]->nomSalle; ?> </a> </span><br /><br />
      	  </div>
      <?php } ?>
  </div>
