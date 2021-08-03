<?php

    $conn = mysqli_connect('localhost','root','','sm_blog');
    session_start();
    if (!$conn){
        exit();
    }

?>