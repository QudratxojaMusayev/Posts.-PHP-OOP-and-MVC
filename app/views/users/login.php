<?php require_once APPROOT ."/views/inc/header.php" ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="modal-dialog" role="document">
            <?php flash("register_success"); ?>
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Sign In</h4>
                </div>
                <form action="<?php echo URLROOT; ?>/users/login" method="post">
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <input type="email" name="email" class="form-control <?php echo (!empty($data["email_err"])) ? 'is-invalid': ''; ?>">
                            <label data-error="wrong" data-success="right" for="email">E-mail</label>
                            <span class="invalid-feedback"><?php echo $data["email_err"]; ?></span>
                        </div>

                        <div class="md-form mb-4">
                           <i class="fas fa-lock prefix grey-text"></i>
                           <input type="password" name="password" class="form-control <?php echo (!empty($data["password_err"])) ? 'is-invalid': ''; ?>">
                            <label data-error="wrong" data-success="right" for="password">Password</label>
                            <span class="invalid-feedback"><?php echo $data["password_err"]; ?></span>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <input type="submit" class="btn blue" value="Sign In">
                        </div>
                        <div class="row d-flex justify-content-center mt-3">
                            <p>Not have an account yet? <a href="<?php echo URLROOT; ?>/users/register">Sign Up</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php require_once APPROOT ."/views/inc/footer.php" ?>