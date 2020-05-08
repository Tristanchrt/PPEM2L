<div class="blcPlanning">
    <h2>Planning réservation salles</h2>

    <div id="blcSuccess" class="alert alert-success" style="display: none">
            <strong>Horraire reserver !</strong>
    </div>
    <div id="blcDanger" class="alert alert-danger" style="display: none">
            <strong>Impossible de reserver à cette horraire</strong>
    </div>

    <div class="headerPlanning">
        <form id="formDateSearch" method="POST" action="?action=planning">
            <select id="ffsalle" name="changeSfdalleVal">
                    <?php 
                        foreach($salles as $uneSalle => $salle) {
                            if(!empty($salleSecleted)){
                                if($salle->nSalle == $salleSecleted){
                                    ?> <option value="<?= $salle->nSalle?>" selected> <?=$salle->nomSalle?> </option>;
                                    <?php
                                }else{ ?>
                                    <option value="<?= $salle->nSalle?>"> <?=$salle->nomSalle?> </option>;
                                <?php }
                            }else {
                                ?> <option value="<?= $salle->nSalle?>"> <?=$salle->nomSalle?> </option>;
                                <?php
                            }
                        }?>
            </select>
            <input id="setPlanningDate" name="setPlanningDate" hidden/>
            <input id="setPlanningTitle" name="setPlanningTitle" hidden/>
            <input id="setPlanningHour" name="setPlanningHour" hidden/>
            <input id="setPlanningSalle" name="setPlanningSalle" hidden value="<?php if(!empty($salleSecleted)){ echo $salleSecleted; }?>"/>

            <label class="titlePlanning">Choisir une date et une salle pour voir le planning de la semaine</label>
            <input id="pickDateSearch" name="dateSearchPlan" type="date" value="<?= $dateSecleted ?>"/>
        </form>
    </div>

    <div class="planningWeek">
        <div class="planningDay">
                <p class="titleDay">Horraire</p>
            <?php foreach($horraires as $keyHorraire => $horraire) { ?>
                <p class="hourInDay" value="<?= $horraire->id?>"> <?=$horraire->oneHorraire?> </p>
            <?php } ?>
        </div>
        <!-- SEMAINE -->
        <div class="planningDay">
                 <p class="titleDay" dateDay="<?= $arrayDateWeek[0] ?>">Lundi</p>
            <?php foreach($horraires as $keyHorraireMonday => $horraireeMonday) { ?>
                <?php if(!empty($dayHorraire['Monday'][$keyHorraireMonday])){ ?>
                    <p class="hourInDay colorBlcHorraire reservedSalle" hour="<?= $keyHorraireMonday ?>"> <?= $dayHorraire['Monday'][$keyHorraireMonday] ?> </p>
               <?php  }else{ ?>
                    <p class="hourInDay reservedSalle" hour="<?= $keyHorraireMonday ?>"></p>
               <?php } ?>
            <?php } ?>
        </div>
        <div class="planningDay">
                <p class="titleDay" dateDay="<?= $arrayDateWeek[1] ?>">Mardi</p>
            <?php foreach($horraires as $keyHorraireTuesday => $horraireeTuesday) { ?>
                <?php if(!empty($dayHorraire['Tuesday'][$keyHorraireTuesday])){ ?>
                    <p class="hourInDay colorBlcHorraire reservedSalle" hour="<?= $keyHorraireTuesday ?>"> <?= $dayHorraire['Tuesday'][$keyHorraireTuesday] ?> </p>
               <?php  }else{ ?>
                    <p class="hourInDay reservedSalle" hour="<?= $keyHorraireTuesday ?>"></p>
               <?php } ?>
            <?php } ?>
            </div>
        <div class="planningDay">
                <p class="titleDay" dateDay="<?= $arrayDateWeek[2] ?>">Mercredi</p>
            <?php foreach($horraires as $keyHorraireWednesday => $horraireeWednesday) { ?>
                <?php if(!empty($dayHorraire['Wednesday'][$keyHorraireWednesday])){ ?>
                    <p class="hourInDay colorBlcHorraire reservedSalle" hour="<?= $keyHorraireWednesday ?>"> <?= $dayHorraire['Wednesday'][$keyHorraireWednesday] ?> </p>
               <?php  }else{ ?>
                    <p class="hourInDay reservedSalle" hour="<?= $keyHorraireWednesday ?>"></p>
               <?php } ?>
            <?php } ?>
        </div>
        <div class="planningDay">
                <p class="titleDay" dateDay="<?= $arrayDateWeek[3] ?>">Jeudi</p>
            <?php foreach($horraires as $keyHorraireThursday => $horraireeThursday) { ?>
                <?php if(!empty($dayHorraire['Thursday'][$keyHorraireThursday])){ ?>
                    <p class="hourInDay colorBlcHorraire reservedSalle" hour="<?= $keyHorraireThursday ?>"> <?= $dayHorraire['Thursday'][$keyHorraireThursday] ?> </p>
               <?php  }else{ ?>
                    <p class="hourInDay reservedSalle" hour="<?= $keyHorraireThursday ?>"></p>
               <?php } ?>
            <?php } ?>
        </div>
        <div class="planningDay">
                <p class="titleDay" dateDay="<?= $arrayDateWeek[4] ?>">Vendredi</p>
            <?php foreach($horraires as $keyHorraireFriday => $horraireeFriday) { ?>
                <?php if(!empty($dayHorraire['Friday'][$keyHorraireFriday])){ ?>
                    <p class="hourInDay colorBlcHorraire reservedSalle" hour="<?= $keyHorraireFriday ?>"> <?= $dayHorraire['Friday'][$keyHorraireFriday] ?> </p>
               <?php  }else{ ?>
                    <p class="hourInDay reservedSalle" hour="<?= $keyHorraireFriday ?>"></p>
               <?php } ?>
            <?php } ?>
        </div>
        <!-- SEMAINE -->
    </div>
</div>
<script>
    
    $('#pickDateSearch').change(function(e){
      let dateVal = $(this).val();
      if(dateVal.length > 1){
        $('#formDateSearch').submit();
      }
    });
    
    $('#ffsalle').change(function(e){
        $('#formDateSearch').submit();
    });

    $('.reservedSalle').click(function(e){
        if($(this).text().length < 1){
            let hour = getHour($(this).attr('hour'));

            let day  = $(this).parent('div').children('.titleDay').text();
            let date  = $(this).parent('div').children('.titleDay').attr('dateDay');
            let titlePlanning = prompt("Ecrire le titre de la reunion pour \nLe "+day+" de "+hour+"\n(le titre doit faire moins de 40 caractères)", "");

            if(titlePlanning.length > 40){
                $('#blcDanger').css('display', 'block')
                setTimeout(function(){ $('#blcDanger').css('display', 'none') }, 5000);
            }else{
                $('#setPlanningDate').val(date)
                $('#setPlanningHour').val($(this).attr('hour'))
                $('#setPlanningTitle').val(titlePlanning)

                $('#formDateSearch').submit();
                $('#blcSuccess').css('display', 'block')
            }
        }
    });

    function getHour(idHour){
        let myArray = {
            0 : '8h à 9h',
            1 : '9h à 10h',
            2 : '10h à 11h',
            3 : '11h à 12h',
            4 : '12h à 13h',
            5 : '13h à 14h',
            6 : '14h à 15h',
            7 : '15h à 16h',
            8 : '16h à 17h',
            9 : '17h à 18h',
        }
        return myArray[idHour]
    }

</script>
<style>
.planningWeek
{
    width: 100%;
    height: 600px;
    display: flex;
    justify-content: space-around;
}
.planningDay {
    width: 193px;
    height: 600px;
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
    padding: 0px;
    cursor: pointer;
    height: 100%;
}
.titlePlanning{
    font-weight: bold;
}
.headerPlanning{
    margin-bottom: 15px;
    display: flex;
}
.colorBlcHorraire{
    background-color: #52f5b7;
}
</style>