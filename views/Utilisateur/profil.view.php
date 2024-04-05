<div class="main-wrapper text-center px-5 text-white">
    <div class="wrapper">
        <div id="time">

        </div>
        <div id="weather">

        </div>
    </div>

    <h1> <span class="little">Profil de </span><?= $utilisateur['mail'] ?></h1>

    <div class="mt-2">
        <a href="<?= URL ?>compte/modificationPassword" class="btn btn-primary">Changer de mot de passe</a>
    </div>

</div>

<div class="author">
    <p id="author" class=" text-white mt-5"></p>
</div>