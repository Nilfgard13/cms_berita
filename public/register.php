<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/register.php';
?>

<?php view('header', ['title' => 'Register']) ?>

<!-- <form action="register.php" method="post">
    <h1>Sign Up</h1>

    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?//= $inputs['username'] ?? '' ?>"
               class="<?//= error_class($errors, 'username') ?>">
        <small><?//= $errors['username'] ?? '' ?></small>
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?//= $inputs['email'] ?? '' ?>"
               class="<?//= error_class($errors, 'email') ?>">
        <small><?//= $errors['email'] ?? '' ?></small>
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?//= $inputs['password'] ?? '' ?>"
               class="<?//= error_class($errors, 'password') ?>">
        <small><?//= $errors['password'] ?? '' ?></small>
    </div>

    <div>
        <label for="password2">Password Again:</label>
        <input type="password" name="password2" id="password2" value="<?//= $inputs['password2'] ?? '' ?>"
               class="<?//= error_class($errors, 'password2') ?>">
        <small><?//= $errors['password2'] ?? '' ?></small>
    </div>

    <div>
        <label for="agree">
            <input type="checkbox" name="agree" id="agree" value="checked" <?//= $inputs['agree'] ?? '' ?> /> I
            agree
            with the
            <a href="#" title="term of services">term of services</a>
        </label>
        <small><?//= $errors['agree'] ?? '' ?></small>
    </div>

    <button type="submit">Register</button>

    <footer>Already a member? <a href="login.php">Login here</a></footer>

</form> -->

<!--New Code-->

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="../src/assets/images/logo.svg">
                        </div>
                        <h4>New here?</h4>
                        <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                        <form class="pt-3" action="register.php" method="post">
                            <div class="form-group">
                                <input type="text" name="username" id="username"
                                    value="<?= $inputs['username'] ?? '' ?>"
                                    class="<?= error_class($errors, 'username') ?> form-control form-control-lg"
                                    placeholder="Username">
                                <small><?= $errors['username'] ?? '' ?></small>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" value="<?= $inputs['email'] ?? '' ?>"
                                    class="<?= error_class($errors, 'email') ?> form-control form-control-lg"
                                    placeholder="Email">
                                <small><?= $errors['email'] ?? '' ?></small>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password"
                                    value="<?= $inputs['password'] ?? '' ?>"
                                    class="<?= error_class($errors, 'password') ?> form-control form-control-lg"
                                    placeholder="Password">
                                <small><?= $errors['password'] ?? '' ?></small>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password2" id="password2"
                                    value="<?= $inputs['password2'] ?? '' ?>"
                                    class="<?= error_class($errors, 'password2') ?> form-control form-control-lg"
                                    placeholder="Confirm Password">
                                <small><?= $errors['password2'] ?? '' ?></small>
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <label class="form-check-label text-muted" for="agree">
                                        <input type="checkbox" class="form-check-input" name="agree" id="agree"
                                            value="checked" <?= $inputs['agree'] ?? '' ?> /> I agree to all Terms &
                                        Conditions </label>
                                    <small><?= $errors['agree'] ?? '' ?></small>
                                </div>
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button
                                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                    type="submit">SIGN UP</button>
                            </div>
                            <div class="text-center mt-4 font-weight-light"> Already have an account? <a
                                    href="login.php" class="text-primary">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

<?php view('footer') ?>