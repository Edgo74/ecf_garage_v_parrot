<div class="container ">
    <?php if (Securite::estConnecte()) : ?>
        <div class="text-center">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Ajouter une voiture</button>
        </div>
        <?php include "views/Commons/add.php" ?>
    <?php endif ?>

    <div class="row d-flex mx-5 ">

        <div class="col-md-4 ">
            <div class="list-group">
                <label>Prix : </label>
                <input type="number" id="minimum_price" value="0" />
                <input type="number" id="maximum_price" value="50000" />
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="list-group">
                <label>Kilometre : </label>
                <input type="number" id="minimum_kilometre" value="0" />
                <input type="number" id="maximum_kilometre" value="500000" />
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="list-group">
                <label>Annee : </label>
                <input type="number" id="minimum_year" value="1950" />
                <input type="number" id="maximum_year" value="2024" />
            </div>
        </div>
    </div>

    <div class="filter_data">

    </div>
</div>