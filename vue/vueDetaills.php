

<p id="posteTitle">Information sur la <?= $nomSalle; ?></p>
    <ul id="postes">
        <?php for($ii = 0; $ii < count($postSalle); $ii++) { ?>
           <div class="row">
            <div class="infoPostes col-lg-6">
                <span>
                    <span class="titleDataPoste" > Nom du poste :  </span> <span> <?= $postSalle[$ii]->nomPoste ?> </span> <br /> 
                </span>
                <span>
                    <span class="titleDataPoste" > Adresse IP :  </span> <span> <?= $postSalle[$ii]->indIP ?> </span>  <br />
                </span>
                <span>
                    <span class="titleDataPoste" > Administarateur :  </span> <span> <?= $postSalle[$ii]->ad ?> </span>  <br />
                </span>
                <span>
                  <?php foreach ($typePc as $typePcKey => $typePcVal) {
                      if($typePcVal->typeLP == $postSalle[$ii]->typePoste){
                        ?>
                          <span class="titleDataPoste" > Type de poste :  </span> <span> <?= $typePcVal->nomType ?> </span>  <br />  <?php
                      }
                  }?>
                </span>


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
