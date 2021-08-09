<?php
    if (isset($_POST['saveCatagory'])){
        $catagory_name = $_POST['catagory_name'];
        $catagory_status = $_POST['catagory_status'];
        $catagory_slug = $_POST['catagory_slug'];
        $created_by = $_SESSION['userId'];

        if (empty($catagory_name) or empty($catagory_slug)){
            echo "<script>alert('Filled Should not be Empty')</script>";
        }else{
            $result = mysqli_query($conn, "INSERT INTO `categories`(`name`, `status`, `slug`,`created_by`) VALUES ('$catagory_name',$catagory_status,'$catagory_slug','$created_by')");
            if ($result){
                $msg = "data Inserted successfully";

            }else{
                $errMsg = "data Inserted Failed!";
                return $errMsg;
            }
        }
    }
?>
<!-- Content Row -->
<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
            <div class="text-info"><?php if (isset($msg)){ echo $msg; } if (isset($errMsg)){ echo $errMsg; } ?></div>
            <div class="card-header">
                <h3>Add Post</h3>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="catagory_name" class="form-label">Catagory Name:</label>
                        <select name="catagory_name" class="form-control">
                            <option>Select a Catagory</option>
                            <option><?php ?></option>
                        </select>
                        <span class="text-danger"><?php if (isset($error['catagory_name'])) { echo $error['catagory_name'] ;}else{ echo ''; } ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php if (isset($title)){echo $title;} ?>" onkeyup="string_to_slug(this.value)">
                        <span class="text-danger"><?php if (isset($error['title'])) { echo $error['title'] ;}else{ echo ''; } ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="post_slug" class="form-label">Slug:</label>
                        <input type="text" class="form-control" id="post_slug" name="post_slug" value="<?php if (isset($catagory_name)){echo $catagory_name;} ?>" >
                    </div>
                    <div class="mb-3">
                        <label for="post_status" class="form-label">Status:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="post_status" id="catagory_status" value="1">
                                <label class="form-check-label" for="post_status">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="post_status" id="post_status" value="0">
                                <label class="form-check-label" for="post_status">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <input name="saveCatagory" type="submit" class="btn btn-primary" value="Add Catagory">
                </form>
            </div>
        </div>
    </div>
</div>