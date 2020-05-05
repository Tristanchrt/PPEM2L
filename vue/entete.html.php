<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>PPE-M2L</title>
        <style type="text/css">
            @import url("css/base.css");
            @import url("css/form.css");
            @import url("css/cgu.css");
            @import url("css/corps.css");
        </style>
    </head>

    <?php
    if(isLoggedOn()){ ?>
      <body>
    <?php }
    else { ?>
     <body class="body2"> <?php
    } ?>

    
    <!-- MENU -->
    <nav>
        <?php if(isLoggedOn()){ ?>
          <ul id="menuGeneral">
              <li class="col-lg-2"><a href="./?action=accueil">Accueil</a></li>
              <li class="col-lg-2"><a href="./?action=profil">Mon Profil</a></li>
          <?php
            if(isset($_SESSION["name"])){
                $user  = getUtilisateurByName($_SESSION["name"]);
                $level = $user['level'];
                if($level > 1){ ?>
                  <li class="col-lg-2"><a href="./?action=creerPoste">Crée poste</a></li>
                  <li class="col-lg-2"><a href="./?action=modifierPoste">Modifier poste</a></li>
                  <li class="col-lg-2"><a href="./?action=gestionLogiciel">Gestion des logicels</a></li>
                  <li class="col-lg-2"><a href="./?action=infoPoste">Information postes</a></li>
                <?php } if($level == 1){ ?>
                  <li class="col-lg-2"><a href="./?action=modifierPoste">Modifier Salle</a></li>
                  <li class="col-lg-2"><a href="./?action=infoPoste">Information postes</a></li>
              <?php }
            }?>
          </ul>
        <?php } ?>
    </nav>

    <div id="blocTitre">
      <h1><?= $titre?></h1>

    </div>

    <div id="corps">
