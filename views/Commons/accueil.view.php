<div class="main-wrapper">
    <section class="intro">
        <h1>Garage <strong>V. Perrot </strong> 15 Ans <strong>d'expérience</strong></h1>

    </section>

    <main class="main-content">
        <h2 class="text-center fw-bold">Nos Services</h2>

        <p class="desc">Voici la liste non exhaustives des services que l'on propose. Un probleme de voiture ? Appelez-nous maintenat !</p>

        <div class="container mt-4">

            <?php if (Securite::estConnecte() && Securite::isAdmin()) : ?>
                <a href="<?= URL ?>Services/ajouterService" class="btn">Ajouter un Service</a>
            <?php endif ?>
            <div class="row mt-4">
                <?php if (!empty($services)) : ?>
                    <?php for ($i = 0; $i < count($services); $i++) : ?>
                        <div class="col-md-4 mb-4 <?php if ($i > 2) echo 'd-none'; ?>">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $services[$i]->getTitre(); ?> </h4>
                                    <p class="card-text"><?= $services[$i]->getDescription(); ?> </p>
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
            <button class="btn  text-center fadeIn" id="Voirplus">Voir plus</button>
        </div>

        <p class="text-center m-5">Vos avis</p>

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
            <a href="Avis/ajouterAvis" class="btn  text-center">Je donne mon avis</a>
        </div>
    </main>

</div>