<?php 
require_once("controllers/Horaires/Horaires.controller.php");
require_once("controllers/Garage/garage.controller.php");
$horairesController = new HorairesController();
$horaires = $horairesController->getHoraires();
$garageController = new GarageController();
$garage = $garageController->getGarage();

?>


<footer class="text-white py-2 footer mt-auto py-3 ">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="ms-3">Horaires d'ouverture :</h3>
                <div class="container my-3">
                    <ul class="list-unstyled">
                    <?php for ($i = 0; $i < count($horaires); $i++): ?>
                        <li>
                            <span class="fw-bold"><?= $horaires[$i]->getJour(); ?> : </span>
                            <?php
                                $horaireAffiche = ($horaires[$i]->getStatut() ==="open")
                                ? substr($horaires[$i]->getDebutHeure_AM(), 0, 5) . "-" . substr($horaires[$i]->getFinHeure_AM(), 0, 5) . ","
                                . substr($horaires[$i]->getDebutHeure_PM(), 0, 5) . "-" . substr($horaires[$i]->getFinHeure_PM(), 0, 5)
                                : "fermé";
                            echo $horaireAffiche;
                            ?>
                        </li>
                    <?php endfor; ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div><?= $garage[0]->getAdresse();?></div>
                <div><?= $garage[0]->getNumero();?></div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>

