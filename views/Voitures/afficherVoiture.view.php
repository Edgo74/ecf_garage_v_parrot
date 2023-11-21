
<div class="container my-5">
    <div class="row ">
        <div class="col-md-4">
            <div class="card ">
                <!-- Image d'illustration -->
                <img src="<?=URL ?>public/Assets/images/<?= $voiture->getImage() ?>"
                    class="card-img-top" alt="voiture">
            
                <!-- Corps -->
                <div class="card-body shadow">
                    <h5 class="card-title"><?= $voiture->getTitre() ?></h5>
                    <p class="card-text">Année : <?=  $voiture->getYear() ?></p>
                    <p class="card-text"><?=  $voiture->getCarburant() ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text"><?=  $voiture->getKilometre() ?> km</p>
                        </div>
                        <div class="col-md-6">
                            <p class="card-text"><span class="badge bg-success">Prix : <?=  $voiture->getPrice() ?>€</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

