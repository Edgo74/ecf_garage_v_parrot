<section class="my-card">
    <img src="<?= URL ?>public/Assets/images/<?= $car->image ?>" class="img" alt="voiture">
    <div class="card-right">
        <h2><?= $car->titre ?></h2>
        <h4><?= $car->year ?></h4>
        <p><?= $car->carburant ?> <span><?= $car->kilometre ?>km</span></p>
        <h4><span class="badge bg-success card-price"><?= $car->price ?>€</span></h4>
        <span><a class="link-1" href="<?= URL ?>Voitures/afficherVoiture/<?= $car->voiture_id ?>">Details</a> <span><a class="link-2" href="<?= URL ?>contact/<?= urlencode($car->titre) ?>">Contact</a></span></span>
    </div>
    <?php if ($car->garantie === 1) : ?>
        <span class="garantie">
            Garantie 1 an
        </span>
    <?php endif ?>
</section>