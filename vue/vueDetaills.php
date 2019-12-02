<p id="posteTitle">Information sur la <?= $nomSalle; ?></p>
    <ul id="postes">
        <?php for($ii = 0; $ii < count($postSalle); $ii++) { ?>
           <div class="row">
            <div class="infoPostes col-lg-6">
                <span>
                    <p> Nom : <?= $postSalle[$ii]->nomPoste ?> </p>
                </span>
                <span>
                    <p> Administarateur : <?= $postSalle[$ii]->ad ?> </p>
                </span>
                <br>
                <br>
            </div>
              <form action="./?action=modifierSalle" method="POST">
                <div class="col-lg-6">
                  <input  value="<?= $postSalle[$ii]->nPoste ?>" type="text" name="postsValForChangeData" style="display: none;"/>
                  <button type="submit" class="BtnModifierPoste"> Modifier Poste </button>
                </div>
              </form>
          </div>
            <br>
            <br>
        <?php  } ?>                
    </ul>
			</form>
