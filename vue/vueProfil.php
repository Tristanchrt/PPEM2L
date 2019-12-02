

  <div class="blocProfilVue">
    <h2>Information sur le profil </h2>
      <div class="infoBlcProfil" >
        <label class="lblModifiePoste">Pseudo de l'utilisateur :</label>
        <span class="lblModifiePoste"> <?= $infoUser['name']; ?> </span>

        <br><br>

        <label class="lblModifiePoste">Email de l'utilisateur :</label>
        <span class="lblModifiePoste">  <?= $infoUser['email']; ?></span>

        <br><br>

        <form action="./?action=deconnexion" method="POST">
            <button type="submit" class="BtnModifierPoste">Deconnexion</button>
        </form>
      </div>

  </div>
