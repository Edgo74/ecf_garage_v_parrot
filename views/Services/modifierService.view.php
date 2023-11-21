<h1 class = "text-center">Modifier un Service</h1>
<form method="POST" action ="<?= URL ?>Services/ValidationModifService">
<div class="container">
    <div class="form-group mb-3">
        <label for="Titre" class="form-label">Titre :</label>
        <input type="text" class="form-control" id="Titre" name = "Titre" value = "<?= $service->getTitre()?>">
    </div>
    <div class="form-group mb-3">
        <label for="description" class="form-label">Description : </label>
        <textarea name="description" class ="form-control" id="description" cols="30" rows="5"><?= $service->getDescription()?></textarea>
    </div>
    <input type="hidden" name = "identifiant" value = "<?= $service->getId()?>">
    <button type="submit" class="btn btn-primary mb-3">Modifier</button>
</div>
</form>
