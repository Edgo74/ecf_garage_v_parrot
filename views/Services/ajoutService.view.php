<ul class="breadcrumb">
    <li><a href="<?= URL ?>administrateur/administration">Panel Admin</a></li>
    <li><a href="<?= URL ?>Services/ajouterService">Ajout Service</a></li>
</ul>
<h1 class="text-center my-2">Nouveau Service</h1>
<form method="POST" action="<?= URL ?>Services/ValidationAjoutService">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
    <div class="container">
        <div class=" row my-3">
            <div class="form-group col-md-6 offset-md-3">
                <input type="text" class="form-control " id="Titre" name="Titre" placeholder="Titre">
            </div>
        </div>
        <div class="form-group mb-3">
            <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Description"></textarea>
        </div>
        <div class="d-flex">
            <button id="validateButton" type="submit" class="btn btn-primary mb-3 mx-auto" disabled>Ajouter</button>
        </div>
    </div>
</form>