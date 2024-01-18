<h1 class="text-center">Modifier/Supprimer un Service</h1>

<div class="container">
    <form method="POST" action="<?= URL ?>Services/ValidationModifService">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
        <select id="select" name="serviceId" class="form-select mt-2">
            <option value=""></option>
            <?php foreach ($services as $service) : ?>
                <option value="<?= $service->getId() ?>"><?= $service->getTitre() ?></option>
            <?php endforeach; ?>
        </select>
        <div class="mb-3">
            <label for="Titre">Titre:</label>
            <input type="text" name="Titre" id="Titre" class="form-control">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <input type="hidden" name="identifiant" value="">
        <div class="mt-2">
            <button type="submit" id="validateButton" class="btn btn-primary" disabled>Modifier</button>
            <a id="deleteButton" href="<?= URL ?>Services/supprimerService/" class="btn btn-danger btnsup">Supprimer</a>
        </div>
    </form>
</div>