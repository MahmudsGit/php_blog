<?php
    $id = $_GET['update'];
    $showCatagory = mysqli_query($conn,"SELECT * FROM `categories` WHERE `id`=$id");

    if (isset($_POST['update_Catagory'])){
        $update_catagory_name = $_POST['update_catagory_name'];
        $update_catagory_slug = $_POST['update_catagory_slug'];
        $update_catagory_status = $_POST['update_catagory_status'];

    if (empty($update_catagory_name) or empty($update_catagory_slug)){
        echo "<script>alert('Filled Should not be Empty')</script>";
    }else{
        $result = mysqli_query($conn, "UPDATE `categories` SET `name`='$update_catagory_name',`slug`='$update_catagory_slug',`status`='$update_catagory_status' WHERE `id`=$id");
        if ($result){
            header("location: index.php?page=manage_catagory");

        }else{
            $msg = "data updated Failed!";
            return $msg;
        }
        }
    }
?>
<!-- Content Row -->
<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
            <div class="text-info"><?php if (isset($msg)){ echo $msg; }  ?></div>
            <div class="card-header">
                <h3>Update Catagory</h3>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <?php while ($viewCatagory = mysqli_fetch_assoc($showCatagory)){  ?>
                    <div class="mb-3">
                        <label for="update_catagory_name" class="form-label">Update Catagory Name:</label>
                        <input type="text" class="form-control" id="update_catagory_name" name="update_catagory_name" value="<?php echo $viewCatagory['name']; ?>" onkeyup="string_to_slug(this.value)">
                    </div>
                    <div class="mb-3">
                        <label for="update_catagory_slug" class="form-label">Update Slug:</label>
                        <input type="text" class="form-control" id="catagory_slug" name="update_catagory_slug" value="<?php echo $viewCatagory['slug']; ?>" >
                    </div>
                    <div class="mb-3">
                        <label for="update_catagory_status" class="form-label">Update Status:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="update_catagory_status" id="update_catagory_status" value="1" <?php if ($viewCatagory['status']==1){ echo "checked";} ?>>
                                <label class="form-check-label" for="update_catagory_status">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="update_catagory_status" id="update_catagory_status" value="0"<?php if ($viewCatagory['status']==0){ echo "checked";} ?>>
                                <label class="form-check-label" for="update_catagory_status">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <input name="update_Catagory" type="submit" class="btn btn-primary" value="Update Catagory">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>