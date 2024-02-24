<div class="container">
  <div class="row align-items-center">
    <div class=" col-md-6 offset-md-3">
      <h3 class="text-center  mb-3">Login</h3>
      <form action="<?= URL ?>validation_login" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? "" ?>">
        <div class="form-group">
          <label for="email">Email</label>
          <input class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group mt-3">
          <label for="password">Mot de passe</label>
          <input class="form-control" type="password" id="password" name="password" required>
        </div>
        <input id="submit" type="submit" class="btn btn-block btn-primary mt-3" value="Connexion">
      </form>
      <div class="forgot-password">
        <a href="<?= URL ?>reset_password">Mot de Passe Oublié? </a>
      </div>
    </div>
  </div>
</div>