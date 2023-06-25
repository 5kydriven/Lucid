<?php
    session_start();
    include 'connect.php';

    $id = $_SESSION['id'];
    $caption = $_POST['caption'];
    $shreId = $_POST['shareId'];

    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user where id = '$id'"));

    if(isset($_POST['share'])){
        
        mysqli_query($conn, "INSERT INTO feeds (dname, username, email, content, profile, userId, sharedId) VALUES ('".$row['name']."','".$row['username']."','".$row['email']."','$caption','".$row['profile']."','$id','$shreId')");
        header('location: ../UserPage/user.php?id='.$id);
        exit();
    }