<h1 class = "text-center">Page de Creation de compte</h1>

<div class="mb-5 ">
    <form action="<?= URL ?>administrateur/validation_creation_compte" method = "POST" class = "pt-5">
    <input type = "hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
        <div class="row form-group g-0 align-items-center mb-3 ms-3">
            <label for="employe_mail" class = "col-6 col-md-3 col-lg-2 text-lg-end me-3" >Mail de l'employé:</label>
            <input type="email" class = "col-6 col-md-9 col-lg-10 form-control w-75" id = "employe_mail" name = "employe_mail" required>
        </div>
        <div class="row form-group g-0 align-items-center mb-3 ms-3">
            <label for="employe_password" class = "col-6 col-md-3 col-lg-2 text-lg-end  me-3" >Password de l'employé:</label>
            <input type="password" class = "col-6 col-md-9 col-lg-10 form-control  w-75" id = "employe_password" name = "employe_password" required>
        </div>
        <div class = "text-center">
            <input type="submit" value = "Generer un compte" class = "btn btn-primary ">
        </div>
    </form>    
</div>

