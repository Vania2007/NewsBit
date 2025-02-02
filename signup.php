<?php
include_once "dbconnect.php";
include_once "action.php";
ob_start();
include "header.php";
if (!isset($_SESSION)) {
    session_start();
}
$str_form = <<<EOD
<section class="login-signup section-padding">
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-7">
            <div class="signup">
                <div class="text-center"><a href="index.php"><img src="./assets/theme/images/logos/logo.png" alt="" class="img-fluid"></a></div>
                <h3 class="mt-4">Реєстрація</h3>
                <p class="mb-5">Приєднуйтесь до нас і почувайте себе краще</p>
                <form action="signup.php" class="signup-form" method='post' onSubmit='return overify_login(this);'>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="login">Логін</label>
                            <input type="text" class="form-control" id="login" name="login" placeholder="Логін">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type='submit' class="btn btn-primary" name='go' value='Зареєструватися'>
                        <p class="mt-5 mb-0">Маєте аккаунт? <a href="autorize.php">Увійти</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
EOD;
if (!isset($_POST['go'])) {
    echo $str_form;
} else {
    if (!check_log($_POST['login'])) {
        registration($_POST['login'], $_POST['password']);
    } else {
        echo <<<EOD
    <div class="col-lg-6 container alert alert-warning mt-5" role="alert">
        Користувач з таким логіном вже існує!
    </div>
    EOD;
        echo $str_form;

    }
}
include "footer.php";
