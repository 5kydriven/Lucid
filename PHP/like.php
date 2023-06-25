<?php
    include 'connect.php';

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    $ratings = mysqli_query($conn,"SELECT * FROM ratings WHERE post_id = '$post_id' AND user_id = '$user_id'");

    if(mysqli_num_rows($ratings) > 0 ){
        $rating = mysqli_fetch_assoc($ratings);
        if($rating['status'] == $status){
            mysqli_query($conn, "DELETE FROM ratings WHERE post_id = '$post_id' AND user_id = '$user_id'");
            echo "delete" . $status;
        } else {
            mysqli_query($conn, "UPDATE ratings SET status = '$status' WHERE post_id = '$post_id' AND user_id = '$user_id'");
            echo "changeto" . $status;
        }
    } else {
        mysqli_query($conn, "INSERT INTO ratings VALUES ('', '$user_id', '$post_id', '$status')");
        echo "new" . $status;
    }