<div class="container">
    <?php if (Securite::estConnecte()) : ?>
        <div class="text-end">
            <a href="<?= URL ?>Voitures/ajoutVoiture" class="btn btn-primary">Ajouter une voiture</a>
        </div>
    <?php endif ?>
    <div class="row mb-5 align-items-center">
        <div class="col-md-1 mt-5">
            <p class="text-center">Prix:</p>
        </div>
        <div class="col-md-3">
            <div class="list-group">
                <input type="hidden" id="hidden_minimum_price" value="0" />
                <input type="hidden" id="hidden_maximum_price" value="500000" />
                <p id="price_show">50 - 50000</p>
                <div id="price_range"></div>
            </div>
        </div>
        <div class="col-md-1 mt-5">
            <p class="text-center">Km:</p>
        </div>
        <div class="col-md-3">
            <div class="list-group">
                <input type="hidden" id="hidden_minimum_kilometre" value="0" />
                <input type="hidden" id="hidden_maximum_kilometre" value="500000" />
                <p id="kilometre_show">50 - 500000</p>
                <div id="kilometre_range"></div>
            </div>
        </div>
        <div class="col-md-1 mt-5">
            <p class="text-center">Année:</p>
        </div>
        <div class="col-md-3">
            <div class="list-group">
                <input type="hidden" id="hidden_minimum_year" value="1970" />
                <input type="hidden" id="hidden_maximum_year" value="2024" />
                <p id="year_show">1980 - 2023</p>
                <div id="year_range"></div>
            </div>
        </div>
    </div>

    <div class="row d-flex filter_data">

    </div>
</div>