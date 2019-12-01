
  <div class="listeSalle">
      <?php for ($i = 0; $i < count($salle); $i++) { ?>
        <a href="./?action=detail&nSalle=<?= $salle[$i]->nSalle; ?>" >
          <div class="salle">
          	<span class="salleName">  <?= $salle[$i]->nomSalle; ?>  </span><br /><br />
      	  </div>
          </a>
      <?php } ?>
  </div>



  <script>

    $('.salle').mouseover(function(e) {
      $(this).addClass('blocSalle');
    });

    $('.salle').mouseleave(function(event) {
      $('.salle').removeClass('blocSalle');
    });

  </script>
