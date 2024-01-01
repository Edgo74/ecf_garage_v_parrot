<div class="container my-5">
    <div class="row ">
        <div class="col-md-4 mb-5">
            <div class="card ">

                <img src="<?= URL ?>public/Assets/images/<?= $voiture->getImage() ?>" class="card-img-top" alt="voiture">
                <div class="card-body shadow">
                    <h5 class="card-title"><?= $voiture->getTitre() ?></h5>
                    <p class="card-text">Année : <?= $voiture->getYear() ?></p>
                    <p class="card-text"><?= $voiture->getCarburant() ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text"><?= $voiture->getKilometre() ?> km</p>
                        </div>
                        <div class="col-md-6">
                            <p class="card-text"><span class="badge bg-success">Prix : <?= $voiture->getPrice() ?>€</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info">
                <div class="details">
                    Immatriculation
                </div>
                <div class="details2">
                    <?= $voiture->getImmatriculation() ?>
                </div>
            </div>

            <div class="info">
                <div class="details">
                    Marque
                </div>
                <div class="details2">
                    <?= $voiture->getTitre() ?>
                </div>
            </div>

            <div class="info">
                <div class="details">
                    Type
                </div>
                <div class="details2">
                    <?= $voiture->getType() ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info">
                <div class="details">
                    Année
                </div>
                <div class="details2">
                    <?= $voiture->getYear() ?>
                </div>
            </div>

            <div class="info">
                <div class="details">
                    Kilométrage
                </div>
                <div class="details2">
                    <?= $voiture->getKilometre() ?>
                </div>
            </div>

            <div class="info">
                <div class="details">
                    Date d'arrivée
                </div>
                <div class="details2">
                    <?= $voiture->getDate() ?>
                </div>
            </div>
        </div>
    </div>
</div>