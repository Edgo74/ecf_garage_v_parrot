<div class="col-md-4 mb-5 d-flex">
    <div class="card ">

        <img src="public/Assets/images/<?= $car->image ?>" class="card-img-top" alt="voiture">

        <!-- Corps -->
        <div class="card-body shadow d-flex flex-column ">
            <h5 class="card-title"><?= $car->titre ?></h5>
            <p class="card-text card-year">Année : <?= $car->year ?></p>
            <p class="card-text"><?= $car->carburant ?></p>
            <div class="row  mb-auto">
                <div class="col-md-6">
                    <p class="card-text card-km"><?= $car->kilometre ?>km</p>
                </div>
                <div class="col-md-6">
                    <p class="card-text"><span class="badge bg-success card-price">Prix : <?= $car->price ?>€</span></p>
                </div>
            </div>
        </div>
        <!-- Pied -->
        <div class="card-footer text-center ">
            <a href="<?= URL ?>Voitures/afficherVoiture/<?= $car->id ?>" class="btn btn-primary">Details</a>
            <a href="<?= URL ?>contact/<?= urlencode($car->titre) ?>" class="btn btn-primary">Nous Contacter</a>
            <?php if (Securite::estConnecte()) : ?>
                <a href="<?= URL ?>Voitures/modifierVoiture/<?= $car->id ?>" class="btn btn-primary">Modifier</a>
                <a href="<?= URL ?>Voitures/supprimerVoiture/<?= $car->id ?>" class="btn btn-danger btnsup" onclick="return confirm('voulez-vous vraiment supprimer cette voiture? ')">Supprimer</a>
            <?php endif ?>
        </div>
    </div>
</div>