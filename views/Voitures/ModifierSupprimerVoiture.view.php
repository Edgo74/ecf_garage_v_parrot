<ul class="breadcrumb">
    <li><a href="<?= URL ?>administrateur/administration">Panel Admin</a></li>
    <li><a href="<?= URL ?>Voitures/page_modifier_supprimer_voiture">Gestion Voitures</a></li>
</ul>
<h1 class="text-center my-2">Gestion Voiture 📝</h1>
<div class="container">
    <form method="POST" action="<?= URL ?>Voitures/ValidationModifVoiture" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
        <select id="select" name="voitureId" class="form-select my-3">
            <?php foreach ($voitures as $voiture) : ?>
                <option value="<?= $voiture->getId() ?>"><?= $voiture->getTitre() ?></option>
            <?php endforeach; ?>
        </select>
        <div class="row">
            <div class="form-group mb-3 col-md-6">
                <label for="Titre" class="form-label">Titre :</label>
                <input type="text" class="form-control" id="Titre" name="Titre" value="" required>
            </div>
            <div class="form-group mb-3 col-md-6">
                <label for="year" class="form-label">Année de mise en circulation : </label>
                <input type="number" class="form-control" id="year" name="year" value="" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group mb-3 col-md-6">
                <label for="carburant" class="form-label">type carburant : </label>
                <input type="text" class="form-control" id="carburant" name="carburant" value="" required>
            </div>
            <div class="form-group mb-3 col-md-6">
                <label for="kilometre" class="form-label">kilometre : </label>
                <input type="number" class="form-control" id="kilometre" name="kilometre" value="" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group mb-3 col-md-6">
                <label for="immatriculation" class="form-label">Immatriculation : </label>
                <input type="texte" class="form-control" id="immatriculation" name="immatriculation" value="" required>
            </div>
            <div class="form-group mb-3 col-md-6">
                <label for="type" class="form-label">Type : </label>
                <input type="texte" class="form-control" id="type" name="type" value="" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group mb-3 col-md-6">
                <label for="date" class="form-label">Date d'arrivée : </label>
                <input type="date" class="form-control" id="date" name="date" value="" required>
            </div>
            <div class="form-group mb-3 col-md-6">
                <label for="price" class="form-label">Prix : </label>
                <input type="number" class="form-control" id="price" name="price" value="" required>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="garantie" class="form-check-label">Garantie : </label>
            <input type="checkbox" class="form-check-input" id="garantie" name="garantie" value="1">
        </div>

        <h3>Images :</h3>
        <img class="car-image" id="image" src="<?= URL ?>public/Assets/images/" alt="l'image de la voiture">
        <div class="form-group mb-3">
            <label for="image" class="form-label mt-3">Changer Image: </label>
            <input type="file" class="form-control " id="image" name="image">
        </div>
        <input type="hidden" name="identifiant" value="">

        <div>
            <button type="submit" class="btn btn-primary " id="validateButton" disabled>Valider</button>
            <a id="deleteButton" href="<?= URL ?>Voitures/supprimerVoiture/" class=" btn btn-danger btnsup">Supprimer</a>
        </div>

    </form>

</div>