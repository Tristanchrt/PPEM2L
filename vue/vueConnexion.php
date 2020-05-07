<div class="formConnexion">
  <form  action="./?action=connexion" method="POST">
    <h2>Formulaire de connexion</h2>
      <div class="form-group">
        <label for="exampleInputEmail1">Adresse mail</label>
        <input type="text" class="form-control" name="mailU" placeholder="Email de connexion">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Mot de passe</label>
        <input type="password" class="form-control" name="mdpU" placeholder="Mot de passe...">
        <!-- <input type="password" class="form-control" name="mdpU" placeholder="Mot de passe..." > -->
      </div>
      <button type="submit" class="btn btn-primary">Connexion</button>
  </form><br>
  <form action="./?action=inscription" method="POST">
    <button type="submit" class="btn btn-primary">Inscription</button>
  </form>
</div>

