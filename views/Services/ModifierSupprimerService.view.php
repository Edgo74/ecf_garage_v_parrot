<h1 class="text-center">Modifier/Supprimer un Service</h1>

<div class="container">
    <form method="POST" action="<?= URL ?>Services/ValidationModifService">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
        <select name="serviceId" class="form-select mt-2">
            <option value=""></option>
            <?php foreach ($services as $service) : ?>
                <option value="<?= $service->getId() ?>"><?= $service->getTitre() ?></option>
            <?php endforeach; ?>
        </select>
        <div class="mb-3">
            <label for="Titre">Titre:</label>
            <input type="text" name="Titre" class="form-control">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <input type="hidden" name="identifiant" value="">
        <button type="submit" class="btn btn-primary my-3">Modifier</button>
    </form>
    <div class=text-start>
        <a id="deleteButton" href="<?= URL ?>Services/supprimerService/" class="btn btn-danger btnsup" onclick="return confirm('voulez-vous vraiment supprimer ce service ? ')">Supprimer</a>
    </div>
</div>