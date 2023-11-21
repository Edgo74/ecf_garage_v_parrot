<div class=" bg-danger text-white mt-3">
        <p class = "text-center display-5">Nos Services</p>
</div>
    

<div class="container mt-4">
    <?php if(Securite::estConnecte() && Securite::estAdministrateur() ): ?>
        <a href="<?= URL ?>Services/ajouterService" class = "btn btn-primary">Ajouter un Service</a>
    <?php endif ?>
    <div class="row mt-4">
        <?php for($i=0; $i<count($services); $i++): ?>
        <div class="col-md-4 mb-4 <?php if($i > 2) echo 'd-none'; ?>">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title"><?= $services[$i]->getTitre(); ?> </h4>
                    <p class="card-text"><?= $services[$i]->getDescription(); ?> </p>

                    <div class="text-center ">
                    <?php if(Securite::estConnecte() && Securite::estAdministrateur()):?>
                        <a href="<?= URL ?>Services/modifierService/<?=  $services[$i]->getId() ?>"  class = "btn btn-primary">Modifier</a>
                        <a href="<?= URL ?>Services/supprimerService/<?=  $services[$i]->getId() ?>"  class = "btn btn-danger btnsup" onclick="return confirm('voulez-vous vraiment supprimer ce service ? ')">Supprimer</a>
                    <?php endif?>
                </div>
                </div>
            </div>
        </div>
        <?php endfor;?>
    </div>
</div>
<div class = "text-center mb-3 ">
    <button class = "btn btn-primary text-center fadeIn" id = "Voirplus">Voir plus</button>
</div>

<h1 class="text-center m-5">Vos avis</h1>

<div class="container mb-5">
   <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
       <!-- Wrapper for carousel items -->
       <div class="carousel-inner">
       <?php for($i=0; $i<count($avis); $i++):?>
        <?php if(Securite::estConnecte() || (int)$avis[$i]->getAvisValide() === 1): ?>
           <div class="carousel-item <?php if($i == 0) echo 'active'; ?>" data-bs-interval="4000">
               <div class="card">
               <div class="card-body">
                  <h5 class="card-title"><?= $avis[$i]->getNom() ?></h5>
                  <p class="card-text"><?= $avis[$i]->getCommentaire() ?></p>
                  <p class="card-text">Note : <?= $avis[$i]->getNote()?> / 5</p>
                  <?php if(Securite::estConnecte()):?>
                        <a href="<?= URL ?>Avis/ajouterAvis" class="btn btn-primary">Ajouter</a>
                        <a href="<?= URL ?>Avis/supprimerAvis/<?=  $avis[$i]->getId() ?>" class="btn btn-danger btnsup" onclick="return confirm('voulez-vous vraiment supprimer cet avis ? ')">Supprimer</a>
                        <?php if((int)$avis[$i]->getAvisValide() === 0):?>
                            <a href="<?= URL ?>Avis/validerAvis/<?=  $avis[$i]->getId() ?>" class = "btn btn-success  btngreen">Valider</a>
                        <?php endif; ?>
                    <?php endif;?>
               </div>
               </div>
           </div>
           <?php endif; ?>
        <?php endfor;?>
       </div>
   </div>
</div>

<div class = "text-center mb-3 ">
    <a href="Avis/ajouterAvis" class = "btn btn-primary text-center">Je donne mon avis</a>
</div>
