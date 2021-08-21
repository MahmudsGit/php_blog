        <?php
            require_once "header.php" ;

                $page = 1;
                $per_page = 5;
                $totalPost = mysqli_query($conn, "SELECT * FROM `posts` WHERE `status`=1");
                $total_post_data = mysqli_num_rows($totalPost);
                $total_page = ceil($total_post_data/$per_page);

                if (isset($_GET['page'])){
                    $pageNo = $_GET['page'];
                }else{
                    $pageNo = 1;
                }

                $limit = ($pageNo-1)*5;

            $posts = mysqli_query($conn, "SELECT `posts`.*, `users`.`name`, `categories`.`name` AS cat_name FROM `posts` INNER JOIN `users` ON `posts`.`user_id` =`users`.`id` INNER JOIN `categories` ON `posts`.`cat_id` = `categories`.`id` WHERE `posts`.`status`= 1 ORDER BY `posts`.`id` LIMIT $limit,$per_page");

        ?>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <?php foreach ($posts as $post): ?>
                    <div class="card mb-4">
                        <a href="#!"><img height="300px" width="700px" class="card-img-top" src="uploads/posts/<?php echo $post['image'] ; ?>" alt="<?php $post['image'] ; ?>" /></a>
                        <div class="card-body">
                            <div class="small text-muted"><?php echo date('M d, Y', strtotime($post['created_at']) ) ; ?> || By <strong> <?php echo $post['name'] ; ?></strong> || <i>Category: </i><?php echo $post['cat_name'] ; ?></div>
                            <h3 class="card-title"><?php echo $post['title'] ; ?></h3>
                            <p class="card-text"><?php echo substr($post['content'],0,150) ?> ...</p>
                            <a class="btn btn-primary" href="post.php?post=<?php echo $post['id']; ?>">Read more →</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item "><a class="page-link" href="?page=<?php echo $page ?>" tabindex="-1" aria-disabled="true">Newer</a></li>
                            <?php
                            for ($page=1; $page <= $total_page; $page++) {
                            ?>
                            <li class="page-item" aria-current="page"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
                            <?php } ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page ?>">Older</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Side widgets-->
                <?php require_once "sidebar.php" ; ?>
            </div>
        </div>
        <!-- Footer-->
        <?php require_once "footer.php" ; ?>
