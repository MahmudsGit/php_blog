<?php
    $catagories = mysqli_query($conn,"SELECT `id`, `name` FROM `categories` WHERE `status`=1");

    if (isset($_POST['save_post'])){

        if(isset($_FILES['post_image'])){
            $errors= array();
            $file_name = $_FILES['post_image']['name'];
            $file_name_replaced = date('dymis').$_FILES['post_image']['name'];
            $file_size = $_FILES['post_image']['size'];
            $file_tmp = $_FILES['post_image']['tmp_name'];
            $file_type = $_FILES['post_image']['type'];
            $file_explode = explode('.',$_FILES['post_image']['name']);
            $file_ext=strtolower(end($file_explode));

            $expensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152) {
                $errors[]='File size must be excately 2 MB';
            }

            $post_catagory = $_POST['post_catagory'];
            $post_title = $_POST['post_title'];
            $post_slug = $_POST['post_slug'];
            $post_content = $_POST['post_content'];
            $post_status = $_POST['post_status'];
            $created_by = $_SESSION['userId'];

            if (empty($post_title) or empty($post_content)){
                echo "<script>alert('Filled Should not be Empty')</script>";
            }else{

                if(empty($errors)==true) {
                    $result = mysqli_query($conn, "INSERT INTO `posts`(`cat_id`, `title`, `slug`, `content`, `image`, `status`, `user_id`) VALUES ('$post_catagory','$post_title','$post_slug','$post_content','$file_name_replaced','$post_status','$created_by')");
                    if ($result){
                        move_uploaded_file($file_tmp,"../uploads/posts/".$file_name_replaced);
                        $msg = "Image Upload Success & data Inserted successfully";
                    }else{
                        $errMsg = "data Inserted Failed!";
                        return $errMsg;
                    }
                }else{
                    echo "<script>alert('$errors[0]!')</script>";
                }
            }
        }else{
            echo "<script>alert('Select a File!')</script>";
        }

    }
?>
<!-- Content Row -->
<div class="row justify-content-md-center">
    <div class="col-md-10">
        <div class="card">
            <div class="text-info"><?php if (isset($msg)){ echo $msg; } if (isset($errMsg)){ echo $errMsg; } ?></div>
            <div class="card-header">
                <h3>Add Post</h3>
            </div>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="post_catagory" class="form-label">Catagory Name:</label>
                        <select name="post_catagory" id="post_catagory" class="form-control">
                            <option>Select a Catagory</option>
                            <?php foreach ($catagories as $cat): ?>
                            <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
                            <?php endforeach;  ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="post_title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="post_title" name="post_title" value="<?php if (isset($title)){echo $title;} ?>" onkeyup="string_to_slug(this.value)">
                    </div>
                    <div class="mb-3">
                        <label for="post_slug" class="form-label">Slug:</label>
                        <input type="text" class="form-control" id="catagory_slug" name="post_slug" value="" >
                    </div>
                    <div class="mb-3">
                        <label for="post_content" class="form-label">Content:</label>
                        <textarea class="form-control" id="post_content" name="post_content" value=""></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="post_image" class="form-label">Image:</label>
                        <input type="file" class="form-control" id="post_image" name="post_image">
                    </div>
                    <div class="mb-3">
                        <label for="post_status" class="form-label">Status:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="post_status" id="post_status" value="1" required>
                                <label class="form-check-label" for="post_status">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="post_status" id="post_status" value="0" required>
                                <label class="form-check-label" for="post_status">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <input name="save_post" type="submit" class="btn btn-primary" value="Add Post">
                </form>
            </div>
        </div>
    </div>
</div>