<div class="blcPlanning">
    <h2>Planning réservation salles</h2>
    <select id="ffsalle" name="changeSfdalleVal">
        <?php
        foreach($salles as $uneSalle => $salle) { ?>
            <option value="<?= $salle->nSalle?>"> <?=$salle->nomSalle?> </option>;
        <?php } ?>
	</select>
    <div class="planningWeek">
        <div class="planningDay">
                <p class="titleDay">Horraire</p>
            <?php foreach($horraires as $keyHorraire => $horraire) { ?>
                <p class="hourInDay" value="<?= $horraire->id?>"> <?=$horraire->oneHorraire?> </p>
            <?php } ?>
        </div>
        <div class="planningDay">
                 <p class="titleDay">Lundi</p>
            <?php foreach($horraires as $keyHorraire => $horraire) { ?>
                <p class="hourInDay"> </p>
            <?php } ?>
        </div>
        <div class="planningDay">
                <p class="titleDay">Mardi</p>
            <?php foreach($horraires as $keyHorraire => $horraire) { ?>
                <p class="hourInDay"> </p>
            <?php } ?>
            </div>
        <div class="planningDay">
                <p class="titleDay">Mercredi</p>
            <?php foreach($horraires as $keyHorraire => $horraire) { ?>
                <p class="hourInDay"> </p>
            <?php } ?>
        </div>
        <div class="planningDay">
                <p class="titleDay">Jeudi</p>
            <?php foreach($horraires as $keyHorraire => $horraire) { ?>
                <p class="hourInDay"> </p>
            <?php } ?>
        </div>
        <div class="planningDay">
                <p class="titleDay">Vendredi</p>
            <?php foreach($horraires as $keyHorraire => $horraire) { ?>
                <p class="hourInDay"> </p>
            <?php } ?>
        </div>
        <div class="planningDay">
                <p class="titleDay">Samedi</p>
            <?php foreach($horraires as $keyHorraire => $horraire) { ?>
                <p class="hourInDay"> </p>
            <?php } ?>
        </div>
    </div>
</div>

<style>
.planningWeek
{
    width: 100%;
    height: 550px;
    display: flex;
    justify-content: space-around;
}
.planningDay {
    width: 193px;
    height: 550px;
    background-color: rgba(172, 194, 238, 0.4);
    border-right: 2px solid;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.titleDay {
    text-align: center;
    font-size: 20px;
    margin: 5px 0px 0px 0px;
    border-bottom: 2px solid;
}
.hourInDay {
    text-align: center;
    font-weight: bold;
    border-bottom: 2px solid;
    margin-bottom: 0px;
    padding: 15px;
    cursor: pointer;
    height: 100%;
}
</style>