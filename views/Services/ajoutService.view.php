<h1 class = "text-center">Ajouter un nouveau Service</h1>
<form method="POST" action ="<?= URL ?>Services/ValidationAjoutService">
<input type = "hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
<div class="container">
    <div class="form-group mb-3">
        <label for="Titre" class="form-label">Titre :</label>
        <input type="text" class="form-control" id="Titre" name = "Titre">
    </div>
    <div class="form-group mb-3">
        <label for="description" class="form-label">Description : </label>
        <textarea name="description" class ="form-control" id="description" cols="30" rows="5"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
</div>
</form>

