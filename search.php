        <?php
            require_once "header.php" ;

            if (isset($_GET['search'])){
                $search = $_GET['search'];

                $catagories = mysqli_query($conn, "SELECT `posts`.*, `users`.`name` FROM `posts`,`users` WHERE (`title` LIKE '%$search%' OR `content` LIKE '%$search%') AND `posts`.`user_id` = `users`.`id` AND `posts`.`status` = 1 ORDER BY `posts`.`id` ASC ");
            }
        ?>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                        <?php  ?>
                        <h3 class=""><?php if (isset($search)){ echo "Search Resul For ". $search ; }?> </h3><hr class="my-0" /><br>

                        <?php foreach ($catagories as $catagory):  ?>
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img width="300px" height="150px" class="card-img-top" src="uploads/posts/<?php echo $catagory['image'] ; ?>" alt="<?php $catagory['image'] ; ?>" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted"><?php echo date('M d, Y', strtotime($catagory['created_at']) ) ; ?></div>
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
