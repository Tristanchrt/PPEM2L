  <?php

    if ($_SERVER["SCRIPT_FILENAME"] == __FILE__)
        $racine = "..";


    include "$racine/modele/bd.sallesInfo.inc.php";

    $titre = "Gestion logiciel";

    if (isLoggedOnAsRole(2)) {

        $salles = getSalle();
        $posts  = getPoste();
        $typePc = getTypePc();
        $postSelected = array();
        $logPost = [];
        $logNotPost = [];

        if(isset($_POST['posteinfoLog'])) {
            $logByPosts = getLogicielByPost($_POST['posteinfoLog']);
            $logicels = getLogiciel();
            // $postSelected = $_POST['posteinfoLog'];
            $postSelected = getPostWithId(htmlentities($_POST['posteinfoLog']));

            if($logByPosts != 1){
                foreach($logicels as $key => $logicel)
                    foreach($logByPosts as $keyy => $logByPost)
                        if($logicel['nLog'] == $logByPost['nLog'])
                            $logPost[$logicel['nLog']] = $logicel;
                
                foreach($logicels as $key => $logicel)
                    if (!array_key_exists($logicel['nLog'], $logPost)) 
                        $logNotPost[$logicel['nLog']] = $logicel;
            }else{
                $logNotPost = $logicels;
                $logPost = 1;
            }
        }
        if(isset($_POST['arrayLogInstall']) && isset($_POST['poste'])){
            updateLogInPost($_POST['arrayLogInstall'], $_POST['poste']);
        }
      
        include "$racine/vue/entete.html.php";
        include "$racine/vue/vueGestionLogiciel.php";
        include "$racine/vue/pied.html.php";
    } else {
        include "$racine/vue/entete.html.php";
        include "$racine/vue/vueErrorPage.php";
        include "$racine/vue/pied.html.php";
    }
