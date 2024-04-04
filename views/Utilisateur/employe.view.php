<div class="dashboard">
    <h1 class="dashboard-header">
        Bonjour <?= $_SESSION['profil']['login'] ?>
    </h1>
    <div class="dashboard-links">
        <div class="accordion">
            <button class="accordion-btn">Administration Voitures</button>
            <div class="accordion-content">
                <a href="<?= URL ?>Voitures/ajoutVoiture">Ajout Voiture</a>
                <a href="<?= URL ?>Voitures/page_modifier_supprimer_voiture">Gestion Voiture</a>
                <a href="<?= URL ?>Voitures/listeVoitures">Liste Voiture</a>
            </div>
        </div>
        <div class="accordion">
            <button class="accordion-btn">Administration Avis</button>
            <div class="accordion-content">
                <a href="<?= URL ?>Avis/ajouterAvis">Ajout Avis</a>
                <a href="<?= URL ?>Avis/page_valider_supprimer_avis">Gestion Avis</a>
            </div>
        </div>
    </div>
</div>