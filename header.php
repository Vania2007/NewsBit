<?php
include_once "dbconnect.php";
include_once "action.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NewsBit - News Magazine Newspaper HTML Template</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-name" content="newsbit" />
    <link rel="apple-touch-icon" href="//mindmup.s3.amazonaws.com/lib/img/apple-touch-icon.png" />
    <link rel="shortcut icon" href="favicon.ico" >
    <link href="external/google-code-prettify/prettify.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="external/jquery.hotkeys.js"></script>
    <script src="external/google-code-prettify/prettify.js"></script>

    <link rel="shortcut icon" href="./assets/source/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="./assets/source/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/source/images/apple-touch-icon.png">

    <!-- THEME CSS
	================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./assets/theme/plugins/bootstrap/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="./assets/theme/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="./assets/theme/plugins/slick-carousel/slick.css">
    <link rel="stylesheet" href="./assets/theme/plugins/slick-carousel/slick-theme.css">
    <!-- manin stylesheet -->
    <link rel="stylesheet" href="./assets/theme/css/style.css">

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

</head>
<body>
<div class="trending-bar-dark hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="trending-bar-title">Trending News</h3>
                <div class="trending-news-slider">
                    <div class="item">
                        <div class="post-content">
                            <h2 class="post-title title-sm">
                                <a href="./">Ex-Googler warns coding bootcamps are lacking</a>
                            </h2>
                        </div>
                    </div>
                    <div class="item">
                        <div class="post-content">
                            <h2 class="post-title title-sm">
                                <a href="./">Intel’s new smart glasses actually look good</a>
                            </h2>
                        </div>
                    </div>
                    <div class="item">
                        <div class="post-content">
                            <h2 class="post-title title-sm">
                                <a href="./" >Here's How To Get Free Pizza On 2 hour</a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12 col-sm-12 col-xs-12 top-nav-social-lists text-lg-right col-lg-4 ml-lg-auto">
                <ul class="list-unstyled mt-4 mt-lg-0">
                    <li>
                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-facebook-f"></i>
                            </span>
                        </a>
                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-twitter"></i>
                            </span>
                        </a>
                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-google-plus"></i>
                            </span>
                        </a>
                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-youtube"></i>
                            </span>
                        </a>
                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-linkedin"></i>
                            </span>
                        </a>
                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-pinterest-p"></i>
                            </span>
                        </a>
                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-rss"></i>
                            </span>
                        </a>
                        <a href="https://github.com/Vania2007">
                            <span class="social-icon">
                                <i class="fa fa-github"></i>
                            </span>
                        </a>
                        <a href="https://www.youtube.com/@IvanMomot-p9b">
                            <span class="social-icon">
                                <i class="fa fa-reddit-alien"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>

<header class="header-navigation d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="logo">
                    <a href="index.php">
                        <img src="./assets/theme/images/logos/logo.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="main-navbar clearfix bg-dark ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg site-main-nav navigation">
                      <a class="navbar-brand d-lg-none" href="index.php">
                        <img src="./assets/theme/images/logos/footer-logo.png" alt="">
                     </a>

                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="./">Головна</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Категорії
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="category.php?category=Політика">Політика</a>
                <a class="dropdown-item" href="category.php?category=Бізнес">Бізнес</a>
                <a class="dropdown-item" href="category.php?category=Суспільство">Суспільство</a>
                <a class="dropdown-item" href="category.php?category=Технології">Технології</a>
                <a class="dropdown-item" href="category.php?category=Спорт">Спорт</a>
                <a class="dropdown-item" href="category.php?category=Кримінал">Кримінал</a>
                <a class="dropdown-item" href="category.php?category=Культура">Культура</a>
                <a class="dropdown-item" href="category.php?category=Шоу-бізнес">Шоу-бізнес</a>
                <a class="dropdown-item" href="category.php?category=Автомобільне">Автомобільне</a>
                <a class="dropdown-item" href="category.php?category=Екологія">Екологія</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Пости
            </a>
            <div class="dropdown-menu">
                <?php
$out = out_for_nav(5);
foreach ($out as $row) {
    echo "<a class='dropdown-item' href='post.php?post_id=" . $row["id"] . "'>" . $row["title"] . "</a>";
}
?>
            </div>
        </li>
    </ul>
    <div class="second-block row">
    <div class="search navbar nav-search d-lg-block">
        <span id="search">
            <i class="fa fa-search"></i>
        </span>
    </div>
    <div class="navbar nav-user ml-3">
        <span>
            <a href="account.php" id="account-icon"><i class="fa-solid fa-user fa-lg"></i></a>
        </span>
    </div>
</div>
</div>
                </nav>

            </div>
        </div>
    </div>
    <form class="site-search" method="get" action="search.php">
        <input type="text" id="searchInput" name="search" placeholder="Шукати..." autofocus="">
        <div class="search-close">
            <span class="close-search">
                <i class="fa fa-times"></i>
            </span>
        </div>
    </form>
</div>
