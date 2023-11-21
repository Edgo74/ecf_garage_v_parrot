
</form>
<h1 class = "text-center">Modifier/Supprimer une Voiture</h1>

<div class="container">
    <form method="POST" action ="<?= URL ?>Voitures/ValidationModifVoiture" enctype = "multipart/form-data">
    <input type = "hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
        <select name="voitureId" class ="form-select mt-2">
            <option value=""></option>
            <?php foreach ($voitures as $voiture): ?>
                <option value="<?= $voiture->getId() ?>"><?= $voiture->getTitre() ?></option>
            <?php endforeach; ?>
        </select>
        <div class="form-group mb-3">
        <label for="Titre" class="form-label">Titre :</label>
        <input type="text" class="form-control" id="Titre" name = "Titre" value = "">
        </div>
        <div class="form-group mb-3">
            <label for="year" class="form-label">Année de mise en circulation : </label>
            <input type="number" class="form-control" id="year" name = "year"  value = "">
        </div>
        <div class="form-group mb-3">
            <label for="carburant" class="form-label">type carburant : </label>
            <input type="texte" class="form-control" id="carburant" name = "carburant"  value = "">
        </div>
        <div class="form-group mb-3">
            <label for="kilometre" class="form-label">kilometre : </label>
            <input type="number" class="form-control" id="kilometre" name = "kilometre"  value = "">
        </div>
        <div class="form-group mb-3">
            <label for="price" class="form-label">Prix : </label>
            <input type="number" class="form-control" id="price" name = "price"  value = "">
        </div>
        <h3>Images :</h3>
        <img id = "image"src="<?= URL ?>public/Assets/images/" alt="l'image de la voiture">
        <div class="form-group mb-3">
            <label for="image" class="form-label mt-3">Changer Image: </label>
            <input type="file" class="form-control " id="image" name = "image">
        </div>
        <input type="hidden" name = "identifiant" value = "">
        <button type="submit" class="btn btn-primary mb-3">Valider</button>
    </form>
    <div class = "text-start my-3" >
        <a id="deleteButton" href="<?= URL ?>Voitures/supprimerVoiture/" class = "btn btn-danger btnsup" onclick="return confirm('voulez-vous vraiment supprimer ce livre ? ')">Supprimer</a>
    </div>
</div>

