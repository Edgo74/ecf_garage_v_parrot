<nav class ="navbar navbar-white bg-white navbar-expand-md sticky-top ps-3">
    <button class ="navbar-toggler" type = "button" data-bs-toggle ="collapse" data-bs-target ="#navbarText" aria-controls="navbarText">
        <span class ="navbar-toggler-icon"></span>
    </button>
    
    <div class ="collapse navbar-collapse" id ="navbarText">
        <ul class ="navbar-nav">
            <li class ="nav-item">
                <a href = "<?= URL; ?>accueil" class = "nav-link active">Accueil</a>
            </li>
            <li>
                <a href = "<?= URL; ?>Voitures" class = "nav-link">Nos Voitures</a>
            </li>
            <li>
                <a href = "<?= URL; ?>contact" class = "nav-link">Contact</a>
            </li>

            <?php if(!Securite::estConnecte()): ?>
            <li>
                <a href="<?= URL; ?>login" class="nav-link">Se Connecter</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a href="<?= URL; ?>compte/deconnexion" class="nav-link">Deconnexion</a>
            </li>
            <li class="nav-item">
                <a href="<?= URL; ?>compte/page_gestion_employe" class="nav-link">Page gestion employés</a>
            </li>
            <?php if(Securite::estAdministrateur()): ?>
                <li class="nav-item">
                    <a href="<?= URL; ?>administrateur/administration" class="nav-link">Administration</a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        </ul>
    </div>
</nav>


