        <?php
            require_once "header.php" ;
            require_once "config/dbcon.php" ;
            $posts = mysqli_query($conn, "SELECT `posts`.*, `users`.`name`, `categories`.`name` AS cat_name FROM `posts` INNER JOIN `users` ON `posts`.`user_id` =`users`.`id` INNER JOIN `categories` ON `posts`.`cat_id` = `categories`.`id` WHERE `posts`.`status`= 1 ORDER BY `posts`.`id`");
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
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="#!">15</a></li>
                            <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                        </ul>
                    </nav>
                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                        <h1 class="">Releted Post Title</h1><hr class="my-0" />
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">January 1, 2021</div>
                                    <h2 class="card-title h4">Post Title</h2>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla.</p>
                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">January 1, 2021</div>
                                    <h2 class="card-title h4">Post Title</h2>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla.</p>
                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Side widgets-->
                <?php require_once "sidebar.php" ; ?>
            </div>
        </div>
        <!-- Footer-->
        <?php require_once "footer.php" ; ?>
