<?php
    if (isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deleteMsg = mysqli_query($conn,"DELETE FROM `posts` WHERE `id`=$id");
        if ($deleteMsg){
            echo "data delete successfully";
        }else{
            echo "data delete failed";
        }
    }
    $result = mysqli_query($conn, "SELECT `posts`.*, `users`.`name`, `categories`.`name` AS cat_name
                                        FROM `posts`
                                        INNER JOIN `users` ON `posts`.`user_id` =`users`.`id`
                                        INNER JOIN `categories` ON `posts`.`cat_id` = `categories`.`id`");

?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage Posts</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Catagory</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Catagory</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php while ( $row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><img width="60px" height="60px" src="../uploads/posts/<?php echo $row['image']; ?>"></td>
                    <td><?php echo $row['cat_name']; ?></td>
                    <td>

                        <span class="text-<?php echo getStatusColor($row['status']); ?>"><?php echo getStatus($row['status']); ?></span>
                    </td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <a href="?page=update_post&&update=<?php echo $row['id']; ?>"class="btn btn-sm btn-info">Update</a>
                        <a href="?page=manage_post&&delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>