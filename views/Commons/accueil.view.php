<div class="container mt-4">

    <div class="mt-3">
        <p class="text-center display-5 fw-bold " id="title">Les Services Proposés</p>
    </div>
    <?php if (Securite::estConnecte() && Securite::isAdmin()) : ?>
        <a href="<?= URL ?>Services/ajouterService" class="btn btn-primary">Ajouter un Service</a>
    <?php endif ?>
    <div class="row mt-4">
        <?php if (!empty($services)) : ?>
            <?php for ($i = 0; $i < count($services); $i++) : ?>
                <div class="col-md-4 mb-4 <?php if ($i > 2) echo 'd-none'; ?>">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title"><?= $services[$i]->getTitre(); ?> </h4>
                            <p class="card-text"><?= $services[$i]->getDescription(); ?> </p>

                            <div class="text-center ">
                                <?php if (Securite::estConnecte() && Securite::isAdmin()) : ?>
                                    <a href="<?= URL ?>Services/modifierService/<?= $services[$i]->getId() ?>" class="btn btn-primary">Modifier</a>
                                    <a href="<?= URL ?>Services/supprimerService/<?= $services[$i]->getId() ?>" class="btn btn-danger btnsup" onclick="return confirm('voulez-vous vraiment supprimer ce service ? ')">Supprimer</a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php else : ?>
            <p class="text-center fw-bold">Aucun services disponible</p>
        <?php endif; ?>
    </div>
</div>
<div class="text-center mb-3 ">
    <button class="btn btn-primary text-center fadeIn" id="Voirplus">Voir plus</button>
</div>

<h1 class="text-center m-5">Vos avis</h1>

<div class="container mb-5">
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
            <?php if (!empty($avis)) : ?>
                <?php for ($i = 0; $i < count($avis); $i++) : ?>
                    <?php if (Securite::estConnecte() || (int)$avis[$i]->getAvisValide() === 1) : ?>
                        <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>" data-bs-interval="4000">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $avis[$i]->getNom() ?></h5>
                                    <p class="card-text"><?= $avis[$i]->getCommentaire() ?></p>
                                    <p class="card-text">Note : <?= $avis[$i]->getNote() ?> / 5</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php else : ?>
                <p class="text-center fw-bold">Aucun avis disponible</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="text-center mb-3 ">
    <a href="Avis/ajouterAvis" class="btn btn-primary text-center">Je donne mon avis</a>
</div>