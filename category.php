<?php
include_once "dbconnect.php";
include_once "action.php";
if (!isset($_SESSION)) {
    session_start();
}
include "header.php";

$category = $_GET['category'];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;
$out = out_category($category, $limit, $offset);
if (count($out) > 0) {
    ?>
    <section class="featured-posts">
    <div class="container">
    <div class="row no-gutters">
    <?php
foreach ($out as $row) {
        ?>

<div class="col-md-6 col-xs-12 col-lg-12 mb-5">
<div class="featured-slider mr-md-3 mr-lg-3">
<div class="item" style="background-image:url(<?php echo $row['image']; ?>)">
<div class="post-content">
<a href="category.php?category=<?php echo $row['category'] ?>>" class="post-category"><?php echo $row['category']; ?></a>
<h2 class="slider-post-title">
                                <a href="post.php?post_id=<?php echo $row["id"] ?>'"><?php echo $row['title']; ?></a>
                            </h2>
                            <div class="post-meta mt-2">
                                <span class="posted-time"><i class="fa fa-clock-o mr-2 text-danger"></i><?php echo $row['date']; ?></span>
                                <span class="post-author">
                                    by
                                    <?php echo $row['login'] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
}
} else {
    echo <<<EOD
    <div class="col-lg-6 container alert alert-warning mt-5" role="alert">
        Новин в цій категорії поки нема!
    </div>
    EOD;
}
?>
</div>
        </div>
        <nav aria-label="pagination-wrapper" class="pagination-wrapper">
  <ul class="pagination justify-content-center">
    <?php

$total_pages = ceil(count_category($category) / $limit);
if ($page > 1) {
    echo '<li class="page-item"><a class="page-link" href="?category=' . $category . '&page=' . ($page - 1) . '">Попередня</a></li>';
}
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
    } else {
        echo '<li class="page-item"><a class="page-link" href="?category=' . $category . '&page=' . $i . '">' . $i . '</a></li>';
    }
}
if ($page < $total_pages) {
    echo '<li class="page-item"><a class="page-link" href="?category=' . $category . '&page=' . ($page + 1) . '">Наступна</a></li>';
}
?>
  </ul>
</nav>
    </div>
</section>
<div class="py-40"></div>
<?php
require "footer.php";
?>