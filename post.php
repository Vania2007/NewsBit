<?php
include_once "dbconnect.php";
include_once "action.php";
if (!isset($_SESSION)) {
    session_start();
}
include "header.php";

if (isset($_GET['post_id'])) {
    $id = $_GET['post_id'];
    $row = getPost($id);
    ?>
        <section class="block-wrapper no-sidebar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="single-post">
                            <div class="post-header mb-5">
                                <a href="category.php?category=<?php echo $row['category']; ?>" class="post-category"><?php echo $row['category']; ?></a>
                                <h2 class="post-title">
                                    <?php echo $row['title']; ?>
                                </h2>
                            </div>
                            <div class="post-body">
                                <div class="post-featured-image">
                                    <img src="<?php echo $row['image']; ?>" class="img-fluid" alt="featured-image">
                                </div>
                                <div class="entry-content">
                                    <p>
                                        <?php echo $row['message']; ?>
                                    </p>
                                </div>
                                <br>
                                <hr>
                                <div class="author-block">
                                    <div class="author-thumb">
                                        <img src="./assets/theme/images/user.png" alt="author-image">
                                    </div>
                                    <div class="author-content">
                                        <h3><?php echo $row['login']; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
} else {
    echo "No post found with the given ID.";
}

include "footer.php";
?>