<div class="container mt-5">
    <?php


    $cardIds = array_map(function ($item) {
        return $item['voiture_id'];
    }, $voitureIds);

    $maxId = max($cardIds);
    $minId = min($cardIds);
    $url = explode("/", filter_var($_GET["page"], FILTER_SANITIZE_URL));
    $currentId = $url[2];
    $next  = $cardIds[array_search($currentId, $cardIds) + 1] ?? $maxId;
    $prev  = $cardIds[array_search($currentId, $cardIds) - 1] ?? $minId;

    ?>
    <div class="position-relative">
        <a href="<?= URL ?>Voitures/afficherVoiture/<?= $prev != $minId ? $prev : "" ?>" class="<?php echo $prev == $minId ? 'd-none' : "" ?> position-absolute start-0 translate-middle-y" style="z-index: 1;">
            <i class="fa-regular fa-circle-left"></i>
        </a>
        <a href="<?= URL ?>Voitures/afficherVoiture/<?= $next != $maxId ? $next : "" ?> " class="<?php echo $next  == $maxId ? 'd-none' : "" ?> position-absolute end-0 translate-middle-y" style="z-index: 1;">
            <i class="fa-regular fa-circle-right"></i>
        </a>
    </div>
    <div class="row ">
        <div class="col-md-4 mb-5">
            <div class="card mt-5">
                <img src="<?= URL ?>public/Assets/images/<?= $voiture->getImage() ?>" class="card-img-top" alt="voiture">
            </div>
        </div>

        <div class="col-md-4 mt-5">
            <div class="info ">
                <div class="details green-price">
                    Prix
                </div>
                <div class="details2">
                    <?= $voiture->getPrice() ?>€
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
            <div class="info ">
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
            <div class="info">
                <div class="details">
                    Garantie
                </div>
                <div class="details2">
                    <?= $voiture->getGarantie() == 1 ? "Oui" : "Non" ?>
                </div>
            </div>

        </div>
        <div class="equipements col-md-4 text-center mt-5">
            <div class="info ">
                <div class="details">
                    Immatriculation
                </div>
                <div class="details2">
                    <?= $voiture->getImmatriculation() ?>
                </div>
            </div>

            <div class="info">
                <div class="details">
                    Carburant
                </div>
                <div class="details2">
                    <?= $voiture->getCarburant() ?>
                </div>
            </div>
            <?= $equipements  ? '<h3 class="equipement mt-3">Equipements</h3>' : "" ?>
            <ol class="liste-equipement">
                <?php foreach ($equipements as $equipement) : ?>
                    <li>
                        <div><?php echo $equipement["titre"] ?></div>
                    </li>
                <?php endforeach; ?>

            </ol>
            <a href="<?= URL ?>contact/<?= urlencode($voiture->getTitre()) ?>" class="bouton ">Nous contacter a propos de cette voiture</a>
        </div>
    </div>
</div>