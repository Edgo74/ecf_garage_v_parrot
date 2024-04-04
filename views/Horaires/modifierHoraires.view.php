<ul class="breadcrumb">
  <li><a href="<?= URL ?>administrateur/administration">Panel Admin</a></li>
  <li><a href="<?= URL ?>Horaires/modifierHoraires">Gestion des Horaires</a></li>
</ul>
<h1 class="text-center mt-2">Horaires</h1>
<form action="modifierHorairesValidation" method="POST">
  <div class="container">
    <div class="row align-items-center">
      <div class=" col-md-6 offset-md-3">
        <input type="hidden" name="horaire_id">
        <select name="jours" id="" class="form-select my-3">
          <option value=""></option>
          <?php for ($i = 0; $i < count($horaires); $i++) : ?>
            <option value="<?= $i + 1 ?>"><?= $horaires[$i]->getJour(); ?></option>
          <?php endfor; ?>
        </select>
        <table class="table">
          <tbody>
            <tr>
              <td class="table-primary align-middle text-center">Statut</td>
              <td class="table-light">
                <select class="form-select" name="statut" id="">
                  <option value=""></option>
                  <option value="open">Open</option>
                  <option value="closed">Close</option>
                </select>
              </td>
            </tr>
            <tr>
              <td class="table-primary align-middle text-center">Debut AM</td>
              <td class="table-light"><input name="debutAM" class="form-control" type="time" required></td>
            </tr>
            <tr>
              <td class="table-primary align-middle text-center">Fin AM</td>
              <td class="table-light"><input name="finAM" class="form-control" type="time" required></td>
            </tr>
            <tr>
              <td class="table-primary align-middle text-center">Debut PM</td>
              <td class="table-light"><input name="debutPM" class="form-control" type="time" required></td>
            </tr>
            <tr>
              <td class="table-primary align-middle text-center">Fin PM</td>
              <td class="table-light"><input name="finPM" class="form-control" type="time" required></td>
            </tr>

          </tbody>

        </table>
        <div class="d-flex">
          <input type="submit" class="btn btn-primary mx-auto" value="Modifier les Horaires">
        </div>

      </div>
    </div>
  </div>
</form>