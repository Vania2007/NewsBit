<?php
include_once "dbconnect.php";
include_once "action.php";
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
include "header.php";
if (isset($_SESSION['user_login'])) {
    ?>
<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="author-block">
    <div class="author-thumb">
        <img src="./assets/theme/images/user.png" alt="author-image">
    </div>
    <div class="author-content">
        <h3><?php echo $_SESSION['user_login']; ?></h3>
        <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container account">
        <ul class="nav navbar-nav navbar-right" id="account_menu">
<?php

    echo "<li><a href='admin_panel.php'>Увійти в адміністративну панель</a></li>";
    echo "<li><a href='action.php?action=logout'>Вийти з аккаунту</a></li>";
} else {
    header("Location: autorize.php");
}
?>
        </ul>
    </div>
</nav>

    </div>
</div>
</section>
<?php
include "footer.php";
?>