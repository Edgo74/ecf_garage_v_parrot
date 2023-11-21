
</form>
<h1 class = "text-center">Valider/Supprimer un Avis</h1>

<div class="container">
    <form method="POST" action ="">
    <input type = "hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
    <select name="avisId" class ="form-select mt-2">
        <option value=""></option>
        <?php foreach ($avis as $avi): ?>
            <option value="<?= $avi->getId() ?>"><?= $avi->getNom() ?></option>
        <?php endforeach; ?>
    </select>
    <div class="form-group mb-3">
        <label for="nom" class="form-label">Nom :</label>
        <input type="text" class="form-control" id="nom" name = "nom">
    </div>
    <div class="form-group mb-3">
        <label for="note" class="form-label">Note : </label>
        <input type="number" class="form-control" id="note" name = "note">
    </div>
    <div class="form-group mb-3">
        <label for="carburant" class="form-label">Commentaire : </label>
        <textarea name="comment" class ="form-control" id="comment" cols="30" rows="5"></textarea>
    </div>
    <a id = "validerButton" href="<?= URL ?>Avis/validerAvis/" class = "btn btn-success btngreen">Valider cet Avis</a>
    </form>
    <div class = "text-start my-3">
        <a id="deleteButton" href="<?= URL ?>Avis/supprimerAvis/" class = "btn btn-danger btnsup" onclick="return confirm('voulez-vous vraiment supprimer cet avis? ')">Supprimer cet Avis</a>
    </div>
</div>

