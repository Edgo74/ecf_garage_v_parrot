<div class="offcanvas offcanvas-end" style="width: 50%;" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Ajouter une nouvelle Voiture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="POST" action="<?= URL ?>Voitures/ValidationAjoutVoiture" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
            <div class="container">
                <div class="form-group mb-3">
                    <label for="Titre" class="form-label">Marque :</label>
                    <input type="text" class="form-control" id="Titre" name="Titre">
                </div>
                <div class="form-group mb-3">
                    <label for="year" class="form-label">Année de mise en circulation : </label>
                    <input type="number" class="form-control" id="year" name="year">
                </div>
                <div class="form-group mb-3">
                    <label for="carburant" class="form-label">type carburant : </label>
                    <input type="texte" class="form-control" id="carburant" name="carburant">
                </div>
                <div class="form-group mb-3">
                    <label for="kilometre" class="form-label">kilometre : </label>
                    <input type="number" class="form-control" id="kilometre" name="kilometre">
                </div>
                <div class="form-group mb-3">
                    <label for="immatriculation" class="form-label">Immatriculation : </label>
                    <input type="texte" class="form-control" id="immatriculation" name="immatriculation">
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="form-label">Type : </label>
                    <input type="texte" class="form-control" id="type" name="type">
                </div>
                <div class="form-group mb-3">
                    <label for="date" class="form-label">Date d'arrivée : </label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="form-group mb-3">
                    <label for="price" class="form-label">Prix : </label>
                    <input type="number" class="form-control" id="price" name="price">
                </div>
                <div class="form-group mb-3">
                    <label for="garantie" class="form-check-label">Garantie : </label>
                    <input type="checkbox" class="form-check-input" id="garantie" name="garantie" value="1">
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image: </label>
                    <input type="file" class="form-control " id="image" name="image">
                </div>

                <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
            </div>
        </form>
    </div>
</div>