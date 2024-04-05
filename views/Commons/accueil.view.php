<main>
    <div class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 75vh;">
        <!-- Background Image -->
        <div class="absolute top-0 w-full h-full bg-center bg-cover image-div">
            <!-- Overlay -->
            <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                    <div class="pr-12 title-section">
                        <h1 class="text-white font-semibold text-5xl" data-aos="fade-up">
                            Garage V. Parrot
                        </h1>
                        <p class="mt-4 text-lg text-gray-300" data-aos="fade-right" data-aos-delay="1000">
                            Lorem ipsum dolor sit. Eum totam aspernatur aliquam praesentium aperiam magni, dignissimos, atque incidunt fuga nulla distinctio eligendi enim placeat nesciunt, soluta maxime nihil ipsa minus!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  Section Services -->
    <section class="pb-20 bg-gray-300 -mt-24">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap">

                <?php if (!empty($services)) : ?>
                    <?php for ($i = 0; $i < min(3, count($services)); $i++) : ?>
                        <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center" data-aos="fade-right">
                            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                                <div class="px-4 py-5 flex-auto">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400">
                                        <!-- Icon -->
                                        <i class="fa-solid fa-briefcase"></i>
                                    </div>
                                    <h6 class="text-xl font-semibold"><?= $services[$i]->getTitre(); ?></h6>
                                    <p class="mt-2 mb-4 text-gray-600">
                                        <?= $services[$i]->getDescription(); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>

                    <?php for ($i = 3; $i < count($services); $i++) : ?>
                        <div class="hidden lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center hidden-service">
                            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                                <div class="px-4 py-5 flex-auto">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400">
                                        <!-- Icon -->
                                        <i class="fa-solid fa-briefcase"></i>
                                    </div>
                                    <!-- Text Box -->
                                    <h6 class="text-xl font-semibold"><?= $services[$i]->getTitre(); ?></h6>
                                    <p class="mt-2 mb-4 text-gray-600">
                                        <?= $services[$i]->getDescription(); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>

                <?php else : ?>
                    <p class="text-center fw-bold">Aucun service disponible</p>
                <?php endif; ?>

            </div>
            <div class="flex" data-aos="fade-up" data-aos-delay="600">
                <button id="voir-plus-moins" class="text-gray-600 hover:text-gray-800 focus:outline-none mx-auto custom-btn">
                    Voir plus
                </button>
            </div>

        </div>
    </section>
</main>


<div class="slideshow-container" data-aos="zoom-in-left">

    <?php if (!empty($avis)) : ?>
        <?php for ($i = 0; $i < count($avis); $i++) : ?>
            <?php if ((int)$avis[$i]->getAvisValide() === 1) : ?>
                <div class="mySlides">
                    <q><?= $avis[$i]->getCommentaire() ?></q>
                    <p class="author">- <?= $avis[$i]->getNom() ?></p>
                    <p class="card-text">Note : <?= $avis[$i]->getNote() ?> / 5</p>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
    <?php endif ?>


    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>
    <div class="d-flex">
        <a href="Avis/ajouterAvis" class="custom-btn mx-auto custom-color mb-3">Je donne mon avis </a>
    </div>

</div>