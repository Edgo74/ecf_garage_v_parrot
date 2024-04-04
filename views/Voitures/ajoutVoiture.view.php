<ul class="breadcrumb">
    <li><a href="<?= URL ?>administrateur/administration">Panel Admin</a></li>
    <li><a href="<?= URL ?>Voitures/ajoutVoiture">Ajout Voiture</a></li>
</ul>
<h1 class="text-center my-2"> Ajout Voiture</h1>
<form method="POST" action="<?= URL ?>Voitures/ValidationAjoutVoiture" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
    <div class="container">
        <div class="row">
            <div class="form-group mb-3 col-md-6">
                <label for="Titre" class="form-label">Titre :</label>
                <input type="text" class="form-control" id="Titre" name="Titre">
            </div>
            <div class="form-group mb-3 col-md-6">
                <label for="year" class="form-label">Année de mise en circulation : </label>
                <input type="number" class="form-control" id="year" name="year">
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-3 col-md-6">
                <label for="carburant" class="form-label">type carburant : </label>
                <input type="texte" class="form-control" id="carburant" name="carburant">
            </div>
            <div class="form-group mb-3 col-md-6">
                <label for="kilometre" class="form-label">kilometre : </label>
                <input type="number" class="form-control" id="kilometre" name="kilometre">
            </div>
        </div>

        <div class="row">
            <div class="form-group mb-3 col-md-6">
                <label for="immatriculation" class="form-label">Immatriculation : </label>
                <input type="texte" class="form-control" id="immatriculation" name="immatriculation">
            </div>
            <div class="form-group mb-3 col-md-6">
                <label for="type" class="form-label">Type : </label>
                <input type="texte" class="form-control" id="type" name="type">
            </div>
        </div>

        <div class="row">
            <div class="form-group mb-3 col-md-6">
                <label for="date" class="form-label">Date d'arrivée : </label>
                <input type="date" class="form-control" id="date" name="date">
            </div>
            <div class="form-group mb-3 col-md-6">
                <label for="price" class="form-label">Prix : </label>
                <input type="number" class="form-control" id="price" name="price">
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="garantie" class="form-check-label">Garantie : </label>
            <input type="checkbox" class="form-check-input" id="garantie" name="garantie" value="1">
        </div>
        <div class="form-group mb-3">
            <label for="image" class="form-label">Image: </label>
            <input type="file" class="form-control " id="image" name="image">
        </div>

        <button id="validateButton" type="submit" class="btn btn-primary mb-3" disabled>Ajouter</button>
    </div>
</form>