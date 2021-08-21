<?php
require_once "header.php" ;
if (isset($_GET['post'])){
    $id = $_GET['post'];
    $viewposts = mysqli_query($conn, "SELECT `posts`.*, `users`.`name`, `categories`.`name` AS cat_name FROM `posts` INNER JOIN `users` ON `posts`.`user_id` =`users`.`id` INNER JOIN `categories` ON `posts`.`cat_id` = `categories`.`id` WHERE `posts`.`id` = $id AND `posts`.`status` = 1");
    $postview = mysqli_fetch_assoc($viewposts);
}
?>
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h3 class="mb-1"><?php echo $postview['title'] ; ?></h3>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on <?php echo date('M d, Y', strtotime($postview['created_at']) ) ; ?> || By <strong> <?php echo $postview['name'] ; ?></strong></div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="category.php?category=<?php echo $postview['cat_id'] ; ?>"><?php echo $postview['cat_name'] ; ?></a>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="uploads/posts/<?php echo $postview['image'] ; ?>" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <?php echo $postview['content']; ?>
                </section>
            </article>
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                <h2 class="">Releted Post From <?php echo $postview['cat_name']; ?></h2><hr class="my-0" /><br>

                <?php
                $catId = $postview['cat_id'];
                $catagories = mysqli_query($conn, "SELECT `posts`.*, `users`.`name`, `categories`.`name` AS cat_name FROM `posts` INNER JOIN `users` ON `posts`.`user_id` =`users`.`id` INNER JOIN `categories` ON `posts`.`cat_id` = `categories`.`id` WHERE `posts`.`status`= 1 AND `posts`.`cat_id` = $catId ");
                foreach ($catagories as $catagory):  ?>
                    <div class="col-lg-6">
                        <!-- Blog post-->
                        <div class="card mb-4">
                            <a href="#!"><img width="300px" height="150px" class="card-img-top" src="uploads/posts/<?php echo $catagory['image'] ; ?>" alt="<?php $catagory['image'] ; ?>" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted"><?php echo date('M d, Y', strtotime($catagory['created_at']) ) ; ?> || <i>Category: </i><?php echo $catagory['cat_name'] ; ?></div>
                                <h2 class="card-title h4"><?php echo $catagory['title']; ?></h2>
                                <p class="card-text"><?php echo substr($catagory['content'],0,150) ?> ...</p>
                                <a class="btn btn-primary" href="post.php?post=<?php echo $catagory['id']; ?>">Read more →</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <!-- Side widgets-->
        <?php require_once "sidebar.php" ; ?>
    </div>
</div>
<!-- Footer-->
<?php require_once "footer.php" ; ?>
