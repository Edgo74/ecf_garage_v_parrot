<div class="main-wrapper">
    <section class="intro">
        <h1>Garage <strong>V. Perrot </strong> 15 Ans <strong>d'expérience</strong></h1>
    </section>

    <main class="main-content">
        <h2> Nos Services </h2>
        <div class="container ">
            <div class="row  my-container">
                <?php if (!empty($services)) : ?>
                    <?php for ($i = 0; $i < count($services); $i++) : ?>
                        <div class="service-wrapper">
                            <p class="titre-service"><?= $services[$i]->getTitre(); ?> </p>
                            <p class="description-service"><?= $services[$i]->getDescription(); ?> </p>
                        </div>
                    <?php endfor; ?>
                <?php else : ?>
                    <p class="text-center fw-bold">Aucun services disponible</p>
                <?php endif; ?>
            </div>
        </div>
        <?php if (!empty($avis)) : ?>
            <h3 class="text-center my-2 ">Vos avis</h3>
        <?php endif; ?>

        <div class="container mb-1">
            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
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
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="text-center mb-3 ">
            <a href="Avis/ajouterAvis" class="btn  text-center">Je donne mon avis</a>
        </div>


        <p id="footer-show" class="text-center"><i class="fas fa-arrow-down"></i>Voir les horaires</p>
    </main>

</div>