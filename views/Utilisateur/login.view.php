<div class="container">
   <div class="row">
       <div class="col-md-6 offset-md-3">
           <h2 class = "text-center">Page de Connexion</h2>
           <form action="<?= URL ?>validation_login" method = "POST">
           <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? "" ?>">
              <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Entrer votre email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password"><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer votre mot de passe" name="password" required>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
           </form>
       </div>
   </div>
</div>
