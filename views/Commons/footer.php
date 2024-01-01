<?php
require_once("controllers/Horaires/Horaires.controller.php");
require_once("controllers/Garage/garage.controller.php");
$horairesController = new HorairesController();
$horaires = $horairesController->getHoraires();
$garageController = new GarageController();
$garage = $garageController->getGarage();

?>

<footer>
    <div class="container footer">
        <div class="display">
            <div class="titre-horaires">
                <h3 class="m-3">Horaires d'ouverture :</h3>
            </div>
            <div class="m-3">
                <ul class="list-unstyled mt-3">
                    <?php for ($i = 0; $i < count($horaires); $i++) : ?>
                        <li>
                            <span class="fw-bold"><?= $horaires[$i]->getJour(); ?> : </span>
                            <?php
                            $horaireAffiche = ($horaires[$i]->getStatut() === "open")
                                ? substr($horaires[$i]->getDebutHeure_AM(), 0, 5) . "-" . substr($horaires[$i]->getFinHeure_AM(), 0, 5) . ","
                                . substr($horaires[$i]->getDebutHeure_PM(), 0, 5) . "-" . substr($horaires[$i]->getFinHeure_PM(), 0, 5)
                                : "fermé";
                            echo $horaireAffiche;
                            ?>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
            <div class="adresse">
                <h3 class="ms-3">Adresse:</h3>
                <ul>
                    <li><?= $garage[0]->getAdresse(); ?></li>
                    <li><?= $garage[0]->getNumero(); ?></li>
                    <li> <a href="<?= URL ?>mentions" class="text-decoration-none ">Mentions Légales</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>