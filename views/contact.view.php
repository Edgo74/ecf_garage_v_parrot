<?php
$url = $_SERVER['REQUEST_URI'];
$path = parse_url($url, PHP_URL_PATH);
$segments = explode('/', $path);
$titre = end($segments);
?>



<h1 class="text-center">Formulaire de Contact</h1>
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-6">
            <form action="<?= URL ?>validation_contact" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                <div class="mb-3">
                    <label for="sujet" class="form-label">Sujet:</label>
                    <input type="text" name="sujet" id="sujet" value="<?php echo $titre; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom:</label>
                    <input type="text" name="nom" id="nom" placeholder="John" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" placeholder="Doe" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email:</label>
                    <input type="email" name="email" id="email" placeholder="john@gmail.com" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="numero" class="form-label">Numero:</label>
                    <input type="number" name="numero" id="numero" placeholder="06 12 34 56 78" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea name="message" class="form-control" id="" cols="30" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-2" value="Valider">Envoyer</button>
            </form>
        </div>
    </div>
</div>