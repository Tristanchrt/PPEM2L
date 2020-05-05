<div class="gestionProfil">
    <label class="lblModifiePoste"> Selectionner un poste </label>

        <div id="bclSuccess" class="alert alert-success" style="display: none">
            <strong>Modification effectuer !</strong>
        </div>

    
    <form id="changePostLog" action="./?action=gestionLogiciel" method="POST">
        <input id="postesSelect" type="text" name="posteinfoLog" style="display: none;"/>
    </form>


    <select id="allPostsGesLog" name="postsVal">
        <?php if (empty($postSelected)) { ?>
            <option value=''> </option><?php
                }
                foreach ($posts as $unePosts => $post) {
                    if (!empty($postSelected)) {
                        if ($post->nPoste == $postSelected) {
                    ?> <option value="<?= $post->nPoste ?>" selected> <?= $post->nomPoste ?> </option>;
                    <?php
                    } else {
                    ?> <option value="<?= $post->nPoste ?>"> <?= $post->nomPoste ?> </option>;
                    <?php
                    }
                    } else {
                    ?> <option value="<?= $post->nPoste ?>"> <?= $post->nomPoste ?> </option>;
                    <?php
                        }
                } ?>
    </select> <br><br>
    <div class="blcLogInPostDd">
        <div class="logInstall">
            <label>Logiciel installé</label>
            <div class="dragDropIem blcLogInPoste">
            <?php if($logPost != 1){
                 foreach ($logPost as $logPost => $logPostOne) { ?>
                    <span id="<?=$logPostOne['nLog']?>" class="onePostGestionLog"> <?=$logPostOne['nomLog']?> </span>
                <?php }
            }?>
            </div>
        </div>
        <div class="blcAllPoste">
            <label>Tous les logiciels</label>
            <div class="dragDropIem notLogInstall">
            <?php foreach ($logNotPost as $logPost => $logNotPostOne) { ?>
                <span id="<?=$logNotPostOne['nLog']?>" class="onePostGestionLog"> <?=$logNotPostOne['nomLog']?> </span>
            <?php }?>
            </div>
        </div>
    </div>
    <br><br>
    <button id="valideSaveLog" type="submit" class="form-control btn btn-primary">Valider enregistrement</button>
</div>

<script>
    $(document).ready(function() {
        $(".onePostGestionLog").draggable({
            connectToSortable: ".dragDropIem", 
            revert: "invalid", 
        });
        $(".dragDropIem").sortable();
    });


    $('#valideSaveLog').click(function(e) {
        let logInstall = []
        let idPoste = $("#allPostsGesLog").val();
        console.log(idPoste)

        $(".blcLogInPostDd").find(".blcLogInPoste").find("span").each(function(index, val) {
            logInstall.push($(val).attr('id'));
        });
        console.log(logInstall)

        $.post("./?action=gestionLogiciel", {
            arrayLogInstall: logInstall,
            poste: idPoste
        },
        function(msg) {
            if(msg){
                $('#bclSuccess').css('display', 'block')
                setTimeout(function(){ $('#bclSuccess').css('display', 'none') }, 5000);
            }
        });
        
    });

    $('#allPostsGesLog').change(function(e) {
        $('#postesSelect').attr('value', $('#allPostsGesLog').val());
        $('#changePostLog').submit();
    });

</script>

<style>
    .blcLogInPostDd {
    display: flex;
    justify-content: space-around;
}
    .blcAllPoste {
    display: flex;
    justify-content: space-around;
}
.blcLogInPoste {
    padding: 15px;
    display: flex;
    flex-direction: column;
    border: dashed;  
}
.notLogInstall {
    padding: 15px;
    display: flex;
    flex-direction: column;
    border: dashed;   
}
.blcAllPoste{
    display: flex;
    flex-direction: column;
}
.onePostGestionLog {
    background-color: #b0c3e9;
    margin: 10px;
    padding: 7px;
    border-radius: 8px;
    cursor: pointer;
}
</style>