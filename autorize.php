<?php
include_once "dbconnect.php";
include_once "action.php";
if (!isset($_SESSION)) {
    session_start();
}
$str_form = <<<EOD
<section class="login-signup section-padding">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-7">
                <div class="login">
                    <div class="text-center"><a href="index.php"><img src="./assets/theme/images/logos/logo.png" alt="" class="img-fluid"></a></div>

                    <h3 class="mt-4">Вхід</h3>
                    <p class="mb-5">Введіть свій логін та пароль</p>
                    <form action="autorize.php" class="login-form row" method='post' onSubmit='return overify_login(this);'>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="loginemail">Логін</label>
                                <input type="text" id="loginemail" class="form-control" name="login" placeholder="Введіть логін" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="loginPassword">Пароль</label>
                                <input type="password" id="loginPassword" class="form-control" name="pas" placeholder="Введіть пароль" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type='submit' class="btn btn-primary" name='go' value='Увійти'>

                            <p class="mt-5 mb-0">Не маєте аккаунта? <a href="signup.php">Зареєтруйтеся</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
EOD;
if (isset($_SESSION['user_login'])) {
    header("Location: admin_panel.php");
} else {
    if (!isset($_POST['go'])) {
        include "header.php";
        echo $str_form;
    } else {
        if (check_autorize($_POST['login'], $_POST['pas'])) {
            header("Location: admin_panel.php");
        } else {
            include "header.php";
            echo <<<EOD
    <div class="col-lg-6 container alert alert-danger mt-5" role="alert">
        Неправильний логін чи пароль!
    </div>
    EOD;
            echo $str_form;

        }
    }
}
require "footer.php";
