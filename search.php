<?php
include_once "dbconnect.php";
include_once "action.php";
if (!isset($_SESSION)) {
    session_start();
}
include "header.php";

$query = $_GET['search'];
$out = search($query, 5);
if (count($out) > 0) {
    ?>
    <section class="error-404 section-padding bg-white">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 text-center">
                <div class="search-info mb-4">
                    <i class="fa fa-search"></i>
                    <h2 class="mt-5">Результати пошуку за "<?php echo $query; ?>"</h2>
                    <hr>
                </div>
            </div>
        </div>

        <div class="row mt-5">
    <?php
foreach ($out as $row) {
        ?>
            <div class="col-lg-4 col-md-6">
                <div class="post-block-wrapper clearfix mb-5 mb-lg-0">
                    <div class="post-thumbnail">
                        <a href="post.php?post_id=<?php echo $row['id']; ?>">
                            <img class="img-fluid" src="<?php echo $row['image']; ?>" alt="post-image"/>
                        </a>
                    </div>
                    <div class="post-content">
                        <h2 class="post-title mt-3">
                            <a href="post.php?post_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                        </h2>
                        <div class="post-meta mb-2">
                            <span class="posted-time"><i class="fa fa-clock-o mr-2"></i><?php echo $row['date']; ?></span>
                            <span class="post-author">
                                by <?php echo $row['login']; ?>
                            </span>
                        </div>
                         <p><?php echo mb_substr($row['message'], 0, mb_strrpos(mb_substr($row['message'], 0, 150), ' ')) . "..."; ?></p>
                    </div>
                </div>
            </div>
<?php
}
} else {
    echo <<<EOD
    <div class="col-lg-6 container alert alert-warning" role="alert">
        Новин за вашим запитом нема!
    </div>
    EOD;
}
?>
        </div>
    </div>
</section>


</div>
</div>
</div>
</section>
<div class="py-40"></div>
<?php
require "footer.php";
?>