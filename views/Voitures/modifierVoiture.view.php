<h1 class="text-center">Modifier une Voiture</h1>
<form method="POST" action="<?= URL ?>Voitures/ValidationModifVoiture" enctype="multipart/form-data">
    <div class="container">
        <div class="form-group mb-3">
            <label for="Titre" class="form-label">Titre :</label>
            <input type="text" class="form-control" id="Titre" name="Titre" value="<?= $voiture->getTitre() ?>">
        </div>
        <div class="form-group mb-3">
            <label for="year" class="form-label">Année de mise en circulation : </label>
            <input type="number" class="form-control" id="year" name="year" value="<?= $voiture->getYear() ?>">
        </div>
        <div class="form-group mb-3">
            <label for="carburant" class="form-label">type carburant : </label>
            <input type="texte" class="form-control" id="carburant" name="carburant" value="<?= $voiture->getCarburant() ?>">
        </div>
        <div class="form-group mb-3">
            <label for="kilometre" class="form-label">kilometre : </label>
            <input type="number" class="form-control" id="kilometre" name="kilometre" value="<?= $voiture->getKilometre() ?>">
        </div>
        <div class="form-group mb-3">
            <label for="immatriculation" class="form-label">Immatriculation : </label>
            <input type="texte" class="form-control" id="immatriculation" name="immatriculation" value="<?= $voiture->getImmatriculation() ?>">
        </div>
        <div class="form-group mb-3">
            <label for="type" class="form-label">Type : </label>
            <input type="texte" class="form-control" id="type" name="type" value="<?= $voiture->getType() ?>">
        </div>
        <div class="form-group mb-3">
            <label for="date" class="form-label">Date d'arrivée : </label>
            <input type="date" class="form-control" id="date" name="date" value="<?= $voiture->getDate() ?>">
        </div>
        <div class="form-group mb-3">
            <label for="price" class="form-label">Prix : </label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $voiture->getPrice() ?>">
        </div>
        <h3>Images :</h3>
        <img src="<?= URL ?>public/Assets/images/<?= $voiture->getImage(); ?>" alt="l'image de la voiture">
        <div class="form-group mb-3">
            <label for="image" class="form-label mt-3">Changer Image: </label>
            <input type="file" class="form-control " id="image" name="image">
        </div>
        <input type="hidden" name="identifiant" value="<?= $voiture->getId() ?>">
        <button type="submit" class="btn btn-primary mb-3">Valider</button>
    </div>
</form>