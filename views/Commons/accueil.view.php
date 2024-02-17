<div class="main-wrapper">
    <section class="intro">
        <h1>Garage <strong>V. Perrot </strong> 15 Ans <strong>d'expérience</strong></h1>
    </section>

    <main class="main-content">
        <h2>&lt; Nos Services &gt;</h2>
        <div class="container ">

            <?php if (Securite::estConnecte() && Securite::isAdmin()) : ?>
                <a href="<?= URL ?>Services/ajouterService" class="btn text-center">Ajouter un Service</a>
            <?php endif ?>
            <div class="row  my-container">
                <?php if (!empty($services)) : ?>
                    <?php for ($i = 0; $i < count($services); $i++) : ?>
                        <div class="joke">
                            <p class="question"><?= $services[$i]->getTitre(); ?> </p>
                            <p class="punchline"><?= $services[$i]->getDescription(); ?> </p>
                        </div>
                    <?php endfor; ?>
                <?php else : ?>
                    <p class="text-center fw-bold">Aucun services disponible</p>
                <?php endif; ?>
            </div>
        </div>

        <h3 class="text-center ">Vos avis</h3>

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
                    <?php else : ?>
                        <p class="text-center fw-bold">Aucun avis disponible</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="text-center mb-3 ">
            <a href="Avis/ajouterAvis" class="btn  text-center">Je donne mon avis</a>
        </div>


        <p id="footer-show" class="text-center"><i class="fas fa-arrow-down"></i>Voir les horaires</p>
    </main>

</div>


<?php if (!isset($_SESSION["modal_displayed"])) : ?>
    <div class="modal" id="modal">
        <div class="close-modal-btn-container">
            <button class="modal-close-btn" id="modal-close-btn" disabled>X</button>
        </div>
        <div class="modal-inner" id="modal-inner">
            <h2 class="h2modal">We ❤️ Your Data!</h2>
            <p class="modal-text" id="modal-text">We have a strict policy on tracking and spamming: we'll definitely track you, and we'll definitely spam you. To use this
                site, enter your name and email address and accept our ridiculous terms and conditions.</p>
            <form id="consent-form">
                <input type="text" name="fullName" placeholder="Enter your full name" required />
                <input type="email" name="email" placeholder="Enter your email" required />

                <div class="modal-choice-btns" id="modal-choice-btns">
                    <button type="submit" class="modal-btn">Accept</button>
                    <button class="modal-btn" id="decline-btn">Decline</button>
                </div>

            </form>
        </div>
    </div>
    <?php $_SESSION["modal_displayed"] = true ?>
<?php endif; ?>