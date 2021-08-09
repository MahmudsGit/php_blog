<?php
    if (isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deleteMsg = mysqli_query($conn,"DELETE FROM `categories` WHERE `id`=$id");
        if ($deleteMsg){
            echo "data delete successfully";
        }else{
            echo "data delete failed";
        }
    }
    $result = mysqli_query($conn, "SELECT c.`id`,c.`name` AS Cat_Name, c.`slug`, c.`status`,`users`.`name` FROM `categories` c LEFT JOIN `users` ON c.`created_by` = `users`.`id`");

?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage Categories</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php while ( $row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $row['Cat_Name']; ?></td>
                    <td><?php echo $row['slug']; ?></td>
                    <td>

                        <span class="text-<?php echo getStatusColor($row['status']); ?>"><?php echo getStatus($row['status']); ?></span>
                    </td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <a href="?page=update_catagory&&update=<?php echo $row['id']; ?>"class="btn btn-sm btn-info">Update</a>
                        <a href="?page=manage_catagory&&delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>