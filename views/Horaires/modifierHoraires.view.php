<form action="modifierHorairesValidation" method="POST">
<input type = "hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
  <div class="container my-3">
    <table class="table">
      <thead>
        <tr>
          <th>Jour</th>
          <th>Statut</th>
          <th>Debut AM</th>
          <th>Fin  AM</th>
          <th>Debut PM</th>
          <th>Fin PM</th>
        </tr>
      </thead>
      <tbody>
        <?php for ($i = 0; $i < count($horaires); $i++): ?>
          <tr id="hours-<?= $i; ?>">
            <td class="fw-bold"><?= $horaires[$i]->getJour(); ?></td>
            <td>
              <select class="form-select" name="hours[<?= $horaires[$i]->getId(); ?>][status]"  onchange="toggleHours(<?= $i; ?>, this.value)">
                <option value="open" <?= $horaires[$i]->getStatut() === 'closed' ? 'selected' : '' ?>>Open</option>
                <option value="closed" <?= $horaires[$i]->getStatut() === 'closed' ? 'selected' : '' ?>>Closed</option>
              </select>
            </td>
            <td><input class="form-control" type="time" name="hours[<?= $horaires[$i]->getId(); ?>][debutHeure_AM]" value="<?= $horaires[$i]->getDebutHeure_AM(); ?>"></td>
            <td><input class="form-control" type="time" name="hours[<?= $horaires[$i]->getId(); ?>][finHeure_AM]" value="<?= $horaires[$i]->getFinHeure_AM(); ?>"></td>
            <td><input class="form-control" type="time" name="hours[<?= $horaires[$i]->getId(); ?>][debutHeure_PM]" value="<?= $horaires[$i]->getDebutHeure_PM(); ?>"></td>
            <td><input class="form-control" type="time" name="hours[<?= $horaires[$i]->getId(); ?>][finHeure_PM]" value="<?= $horaires[$i]->getFinHeure_PM(); ?>"></td>
        </tr>
        <?php endfor; ?>
      </tbody>
    </table>
    <input type="submit" class="btn btn-primary">
  </div>
</form>
