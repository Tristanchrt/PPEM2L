
<!-- 
  <div class="blocLogin">
    <h2>Formulaire d'inscription</h2>
      <form action="./?action=inscription" method="POST">
          <input type="text" name="mailU" placeholder="Email de connexion" /><br />
          <input type="password" name="mdpU" placeholder="Mot de passe"  /><br />
          <input type="text" name="pseudoU" placeholder="Pseudo" /><br />
          <div class="blcButtonConnect">
            <button class="BtnModifierPoste" type="submit">Inscription</button>
      </form>
      <form action="./?action=connexion" method="POST">
            <button style="margin-left:92px;" type="submit" class="BtnModifierPoste">Connexion</button>
          </div>
      </form>
  </div> -->

  <div class="formInscription">
    <form  action="./?action=inscription" method="POST">
      <h2>Formulaire d'inscription</h2>
        <div class="form-group">
          <label for="exampleInputEmail1">Adresse mail</label>
          <input type="text" class="form-control" name="mailU" placeholder="Email de connexion...">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Pseudo</label>
          <input type="text" class="form-control" name="pseudoU" placeholder="Pseudo...">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Mot de passe</label>
          <input type="password" class="form-control" name="mdpU" placeholder="Mot de passe...">
        </div>
        <button type="submit" class="btn btn-primary">Inscription</button>
    </form><br>
    <form action="./?action=connexion" method="POST">
      <button type="submit" class="btn btn-primary">Connexion</button>
    </form>
  </div>
