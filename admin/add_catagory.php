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
                <h3>Add Catagory</h3>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="catagory_name" class="form-label">Catagory Name:</label>
                        <input type="text" class="form-control" id="catagory_name" name="catagory_name" value="<?php if (isset($catagory_name)){echo $catagory_name;} ?>" onkeyup="string_to_slug(this.value)">
                        <span class="text-danger"><?php if (isset($error['catagory_name'])) { echo $error['catagory_name'] ;}else{ echo ''; } ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="catagory_slug" class="form-label">Slug:</label>
                        <input type="text" class="form-control" id="catagory_slug" name="catagory_slug" value="<?php if (isset($catagory_name)){echo $catagory_name;} ?>" >
                    </div>
                    <div class="mb-3">
                        <label for="catagory_status" class="form-label">Status:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="catagory_status" id="catagory_status" value="1" required>
                                <label class="form-check-label" for="catagory_status">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="catagory_status" id="catagory_status" value="0" required>
                                <label class="form-check-label" for="catagory_status">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <input name="saveCatagory" type="submit" class="btn btn-primary" value="Add Catagory">
                </form>
            </div>
        </div>
    </div>
</div>