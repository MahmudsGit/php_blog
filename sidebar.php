<?php
    $viewCategories = mysqli_query($conn, "SELECT * FROM `categories` WHERE `status`= 1");
?>
<div class="col-lg-4">
    <!-- Search widget-->
    <form action="search.php">
        <div class="card mb-4">
            <div class="card-header">Search</div>
            <div class="card-body">
                <div class="input-group">
                    <input class="form-control" name="search" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                    <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                </div>
            </div>
        </div>
    </form>
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <div class="row">
                <?php while ($categoryView = mysqli_fetch_assoc($viewCategories)){  ?>
                <div class="col-sm-6">
                    <ul class="list-unstyled mb-0">
                        <li><a href="category.php?category=<?php echo $categoryView['id'] ;?>"><h5 class="text-primary btn btn-outline-secondary" ><?php echo $categoryView['name'] ;?></h5></a></li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>