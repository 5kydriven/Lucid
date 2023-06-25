<?php
    include 'connect.php';
    session_start();
    $currentID = $_SESSION['id'];
    $id = $_POST['id'];
    $content = $_POST['post'];
    
    $pic = $_FILES['image']['name'];
    $picture_tmp_name = $_FILES['image']['tmp_name'];
    $picFolder = '../uploads/'.$pic;

    if(isset($_POST['submit'])){
        $tbl = mysqli_query($conn, "SELECT * FROM user WHERE id = $currentID");
        
        while($row = mysqli_fetch_assoc($tbl)){ 
            move_uploaded_file($picture_tmp_name, $picFolder);
            mysqli_query($conn, "INSERT INTO feeds (dname, username, email, content, profile,userID,picture,message) VALUES ('".$row['name']."','".$row['username']."','".$row['email']."','$content','".$row['profile']."','$id','$pic','$id')");
            header('location: ../UserPage/otherPp.php?id='.$id);
        }
    }