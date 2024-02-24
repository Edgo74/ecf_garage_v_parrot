<div class="container mt-5">
    <div class="row wrapper">
        <div class=" col-md-6 offset-md-3">
            <h3 class="text-center  mb-3">Reset Password</h3>
            <form action="<?= URL ?>validation_reset_password" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? "" ?>">
                <div class="form-group">
                    <label for="reset_email">Email</label>
                    <input class="form-control" id="reset_email" name="reset_email" required>
                </div>
                <input id="submit" type="submit" class="btn btn-block btn-primary mt-3" value="Reset Password">
            </form>
        </div>
    </div>
</div>