        <?php
            require_once "header.php" ;

            if (isset($_GET['category'])){
                $id = $_GET['category'];
                $catagories = mysqli_query($conn, "SELECT `posts`.*, `users`.`name`, `categories`.`name` AS cat_name FROM `posts` INNER JOIN `users` ON `posts`.`user_id` =`users`.`id` INNER JOIN `categories` ON `posts`.`cat_id` = `categories`.`id` WHERE `posts`.`status`= 1 AND `posts`.`cat_id` = $id ");
            }

        ?>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                        <?php while ($catView = mysqli_fetch_assoc($catagories)){
                            if (isset($catView['cat_name'])){
                                $showcatName = $catView['cat_name'];
                            }
                        }
                        ?>
                        <h2 class=""><?php if (isset($showcatName)){ echo "All post From ". $showcatName; }else{ echo "No Post Available"; } ?> </h2><hr class="my-0" /><br>

                        <?php foreach ($catagories as $catagory):  ?>
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
