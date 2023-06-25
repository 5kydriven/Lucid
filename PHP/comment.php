<?php
    session_start();
    include 'connect.php';
    $id = $_SESSION['id'];

    if(isset($_POST['send'])){
        $comment = $_POST['comment'];
        $post_id = $_POST['id'];

        $query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
        
        while($user = mysqli_fetch_assoc($query)){
            mysqli_query($conn,"INSERT INTO comment (user_id, contents, post_id) VALUES ('".$user['id']."', '$comment','$post_id')");
            header('location: ../UserPage/comment.php?id='.$post_id);
        }   
    }