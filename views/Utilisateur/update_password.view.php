<div class="container mt-5">
    <div class="row wrapper">
        <div class=" col-md-6 offset-md-3">
            <h3 class="text-center  mb-3">Update Password</h3>
            <form action="<?= URL ?>validation_update_password" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? "" ?>">
                <div class="form-group">
                    <label for="reset_password">Password</label>
                    <input type="password" class="form-control" id="reset_password" name="reset_password" required>
                </div>
                <input id="submit" type="submit" class="btn btn-block btn-primary mt-3" value="Update Password">
            </form>
        </div>
    </div>
</div>