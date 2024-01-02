<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center fw-bold mb-3">Création d'un compte employé</h1>
            <form action="<?= URL ?>administrateur/validation_creation_compte" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                <div class="form-group">
                    <label for="employe_mail"><b>Mail de l'employé:</b></label>
                    <input type="email" placeholder="Entrer un  email" name="employe_mail" id="employe_mail" required>
                </div>
                <div class="form-group">
                    <label for="employe_password"><b>Password de l'employé:</b></label>
                    <input type="password" placeholder="Entrer un  mot de passe" name="employe_password" id="employe_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Generer un compte</button>
            </form>
        </div>
    </div>
</div>