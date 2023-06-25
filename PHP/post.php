<?php
    session_start();
    include 'connect.php';

    $id = $_SESSION['id'];

    $post = $_POST['post'];
    $pic = $_FILES['image']['name'];
    $picture_tmp_name = $_FILES['image']['tmp_name'];
    $picFolder = '../uploads/'.$pic;

    $query = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");

    while($row = mysqli_fetch_assoc($query)){ 
            move_uploaded_file($picture_tmp_name, $picFolder);
            mysqli_query($conn, "INSERT INTO feeds (dname, username, email, content, profile,userID,picture) VALUES ('".$row['name']."','".$row['username']."','".$row['email']."','$post','".$row['profile']."','".$row['id']."','$pic')");
            header('location: ../UserPage/user.php?id='.$id);
    }