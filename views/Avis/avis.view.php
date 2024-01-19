<h1 class="text-center">Ajouter un nouvel avis</h1>
<form method="POST" action="<?= URL ?>Avis/ajoutAvisValidation">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
    <div class="container">
        <div class="form-group mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="form-group mb-3">
            <label for="note" class="form-label">Note : </label>
            <input type="number" class="form-control" id="note" name="note" placeholder="veuillez mettre une note sur 5 ">
        </div>
        <div class="form-group mb-3">
            <label for="carburant" class="form-label">Commentaire : </label>
            <textarea name="comment" class="form-control" id="comment" cols="30" rows="5"></textarea>
        </div>
        <button id="validateButton" type="submit" class="btn btn-primary mb-3" disabled>Ajouter</button>
    </div>
</form>