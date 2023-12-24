<nav class="navbar navbar-white bg-white navbar-expand-md sticky-top ps-3">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="<?= URL; ?>accueil" class="nav-link <?= (page == 'accueil') ? "active" : ""; ?>">Accueil</a>
            </li>
            <li>
                <a href="<?= URL; ?>Voitures" class="nav-link <?= (page == 'Voitures') ? "active" : ""; ?>">Nos Voitures</a>
            </li>
            <li>
                <a href="<?= URL; ?>contact" class="nav-link <?= (page == 'contact') ? "active" : ""; ?>">Contact</a>
            </li>

            <?php if (!Securite::estConnecte()) : ?>
                <li>
                    <a href="<?= URL; ?>login" class="nav-link <?= (page == 'login') ? "active" : ""; ?>">Se Connecter</a>
                </li>
            <?php else : ?>
                <li>
                    <a href="<?= URL; ?>compte/profil" class="nav-link <?= (page == 'profil') ? "active" : ""; ?>">Profil</a>
                </li>
                <?php if (Securite::estEmploye()) : ?>
                    <li class="nav-item">
                        <a href="<?= URL; ?>compte/page_gestion_employe" class="nav-link <?= (page == 'compte/page_gestion_employe') ? "active" : ""; ?>">Page gestion employés</a>
                    </li>
                <?php endif ?>
                <li class="nav-item">
                    <a href="<?= URL; ?>compte/deconnexion" class="nav-link">Deconnexion</a>
                </li>
                <?php if (Securite::estAdministrateur()) : ?>
                    <li class="nav-item">
                        <a href="<?= URL; ?>administrateur/administration" class="nav-link <?= (page == 'administrateur/administration') ? "active" : ""; ?>">Administration</a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </div>
</nav>