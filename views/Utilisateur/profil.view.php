<div class="main-wrapper text-center px-5 text-white">
    <div class="wrapper">
        <div id="time">

        </div>
        <div id="weather">

        </div>
    </div>

    <h1> <span class="little">Profil de </span><?= $utilisateur['mail'] ?></h1>
    <div>
        <div>
            <img src="<?= URL; ?>public/Assets/images/<?= $utilisateur['image'] ?>" class="image" alt="photo de profil" />
        </div>
        <form method="POST" action="<?= URL ?>compte/validationModificationProfilImage" enctype="multipart/form-data">
            <label for="image">Changer l'image de profil </label><br />
            <input type="file" class="form-control-file" id="image" name="image" onchange="submit();" />
        </form>
    </div>

    <div class="mt-2">
        <a href="<?= URL ?>compte/modificationPassword" class="btn btn-primary">Changer de mot de passe</a>
    </div>

</div>

<div class="author">
    <p id="author" class=" text-white mt-5"></p>
</div>