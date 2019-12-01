

<p id="posteTitle">Salle numero <?= $numSalle; ?></p>
    <ul id="postes">
        <?php for($ii = 0; $ii < count($postSalle); $ii++) { ?>
                <span>
                    <p> Nom : <?= $postSalle[$ii]->nomPoste ?> </p>
                </span>
                <span>
                    <p> Adresse IP : <?= $postSalle[$ii]->indIP ?> </p>
                </span>
                <span>
                    <p> Administarateur : <?= $postSalle[$ii]->ad ?> </p>
                </span>
                <br>
                <br>

                    <?php  } ?>
    </ul>
