<h1 class = "text-center">Ajouter une nouvelle Voiture</h1>
<form method="POST" action ="<?= URL ?>Voitures/ValidationAjoutVoiture" enctype = "multipart/form-data">
<input type = "hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
<div class="container">
    <div class="form-group mb-3">
        <label for="Titre" class="form-label">Titre :</label>
        <input type="text" class="form-control" id="Titre" name = "Titre">
    </div>
    <div class="form-group mb-3">
        <label for="year" class="form-label">Année de mise en circulation : </label>
        <input type="number" class="form-control" id="year" name = "year">
    </div>
    <div class="form-group mb-3">
        <label for="carburant" class="form-label">type carburant : </label>
        <input type="texte" class="form-control" id="carburant" name = "carburant">
    </div>
    <div class="form-group mb-3">
        <label for="kilometre" class="form-label">kilometre : </label>
        <input type="number" class="form-control" id="kilometre" name = "kilometre">
    </div>
    <div class="form-group mb-3">
        <label for="price" class="form-label">Prix : </label>
        <input type="number" class="form-control" id="price" name = "price">
    </div>
    <div class="form-group mb-3">
        <label for="image" class="form-label">Image: </label>
        <input type="file" class="form-control " id="image" name = "image">
    </div>

    <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
</div>
</form>
