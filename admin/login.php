<?php
    require_once "../config/dbcon.php";
    if (isset($_SESSION['userEmail'])){
        header('location: index.php');
    }

    if (isset($_POST['adminLogin'])){

        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];

        $error = [];

        if (empty($userEmail)){
            $error['userEmail'] = "Fill up Email Field";
        }
        if (empty($userPassword)){
            $error['userPassword'] = "Fill up Password Field";
        }


        if (empty($error)){
            $emailCheck = mysqli_query($conn, "SELECT `id`,`email`,`password`,`status`,`name` FROM `users` WHERE `email` = '$userEmail'");

            if (mysqli_num_rows($emailCheck) == 1 ) {
                $userInfo = mysqli_fetch_assoc($emailCheck);
                if ($userInfo['password'] == md5($userPassword)){
                    if ($userInfo['status'] == 1){

                        $_SESSION['userName'] = $userInfo['name'];
                        $_SESSION['userId'] = $userInfo['id'];
                        $_SESSION['userEmail'] = $userInfo['email'];

                        header('location: index.php');
                    }else{
                        $loginError = "Your Acount is not active Now!";
                    }
                }else{
                    $loginError = "Email or Password doesn't Match!";
                }
            }else{
                $loginError = "Email or Password doesn't Match!";
            }

        }

    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2>Log-In</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="mb-3">
                                <span class="text-danger"><?php if (isset($loginError)) { echo $loginError."<br>"; }else{ echo ''; } ?></span>
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($userEmail)){echo $userEmail;} ?>">
                                <span class="text-danger"><?php if (isset($error['userEmail'])) { echo $error['userEmail'] ;}else{ echo ''; } ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="text-danger"><?php if (isset($error['userPassword'])){echo $error['userPassword'];}else{ echo ''; } ?></span>
                            </div>
                            <input name="adminLogin" type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>