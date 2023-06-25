<?php
    session_start();
    include 'connect.php';
    $id = $_SESSION['id'];

    $post = $_POST['post'];
    $picture = $_FILES['images']['name'];
    $picture_tmp_name = $_FILES['images']['tmp_name'];
    $picFolder = '../uploads/'.$picture;
    
    $tbl = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");

    while($row = mysqli_fetch_assoc($tbl)){ 
        $result = mysqli_query($conn, "INSERT INTO feeds (dname, username, email, content, profile,userID,picture) VALUES ('".$row['name']."','".$row['username']."','".$row['email']."','$post','".$row['profile']."','".$row['id']."','$picture')");
        move_uploaded_file($picture_tmp_name, $picFolder);
        header('location: ../UserPage/profile.php?id='.$id);
    }
 
?>