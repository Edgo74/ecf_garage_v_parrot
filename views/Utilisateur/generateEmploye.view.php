<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center mb-3">Création d'un compte employé</h1>
            <form action="<?= URL ?>administrateur/validation_creation_compte" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                <div class="form-group">
                    <label for="employe_mail">Mail de l'employé:</label>
                    <input class="form-control" type="email" name="employe_mail" id="employe_mail" required>
                </div>
                <div class="form-groupq mt-2">
                    <label for="employe_password">mot de passe de l'employé:</label>
                    <input class="form-control" type="password" name="employe_password" id="employe_password" required>
                </div>
                <input id="submit" type="submit" class="btn btn-block btn-success mt-3" value="Generer un compte">
            </form>
        </div>
    </div>
</div>