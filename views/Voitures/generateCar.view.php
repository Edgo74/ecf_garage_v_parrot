<section class="my-card">
    <img src="public/Assets/images/<?= $car->image ?>" class="img" alt="voiture">
    <div class="card-right">
        <h2><?= $car->titre ?></h2>
        <h3><?= $car->year ?></h3>
        <p><?= $car->carburant ?> <span><?= $car->kilometre ?>km</span></p>
        <h3><span class="badge bg-success card-price"><?= $car->price ?>€</span></h3>
        <span><a class="link-1" href="<?= URL ?>Voitures/afficherVoiture/<?= $car->id ?>">Details</a> <span><a class="link-2" href="<?= URL ?>contact/<?= urlencode($car->titre) ?>">Contact</a></span></span>
    </div>
</section>