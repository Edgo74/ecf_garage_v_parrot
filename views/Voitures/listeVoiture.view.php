<ul class="breadcrumb">
    <li><a href="<?= URL ?>administrateur/administration">Panel Admin</a></li>
    <li><a href="<?= URL ?>Voitures/listeVoitures">Liste Voitures</a></li>
</ul>


<div class="text-center mt-3">
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Ajouter une voiture</button>
</div>
<?php include "views/Commons/add.php" ?>

<div class="filter_data">
    <?php foreach ($voitures as $voiture) : ?>
        <section class="my-card">
            <img src="<?= URL ?>public/Assets/images/<?= $voiture->getImage() ?>" class="img" alt="voiture">
            <div class="card-right">
                <h2><?= $voiture->getTitre() ?></h2>
                <h4><?= $voiture->getYear() ?></h4>
                <p><?= $voiture->getCarburant() ?> <span><?= $voiture->getKilometre() ?>km</span></p>
                <h4><span class="badge bg-success card-price"><?= $voiture->getPrice() ?>€</span></h4>
                <span><a class="link-1" href="<?= URL ?>Voitures/afficherVoiture/<?= $voiture->getId() ?>">Details</a>
            </div>
            <?php if ($voiture->getGarantie() === 1) : ?>
                <span class="garantie">
                    Garantie 1 an
                </span>
            <?php endif ?>

            <div class="delete-icon">
                <a href="<?= URL ?>Voitures/supprimerVoiture/<?= $voiture->getId() ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette voiture ?')"><i class="fa-regular fa-square-minus"></i></a>
            </div>
            <div class="modify-icon">
                <a href="<?= URL ?>Voitures/modifierVoiture/<?= $voiture->getId() ?>"><i class="fa-solid fa-pen"></i></a>
            </div>
        </section>
    <?php endforeach; ?>
</div>