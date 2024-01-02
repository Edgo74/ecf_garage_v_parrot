<div class="text-center">
    <h1>Profil de <?= $utilisateur['mail'] ?></h1>
    <div>
        <div>
            <img src="<?= URL; ?>public/Assets/images/<?= $utilisateur['image'] ?>" width="100px" alt="photo de profil" />
        </div>
        <form method="POST" action="<?= URL ?>compte/validationModificationProfilImage" enctype="multipart/form-data">
            <label for="image">Changer l'image de profil </label><br />
            <input type="file" class="form-control-file" id="image" name="image" onchange="submit();" />
        </form>
    </div>

    <div class="mt-2">
        <a href="<?= URL ?>compte/modificationPassword" class="btn btn-primary">Changer le mot de passe</a>
    </div>
</div>