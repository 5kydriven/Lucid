<?php
    session_start();

    include 'connect.php';
    $crrntID = $_SESSION['id'];

    if(isset($_POST['sendreply'])){
        $postID = $_POST['postid']; //comment id
        $cmtID = $_POST['cmmtId'];
        $content = $_POST['content'];

        mysqli_query($conn, "INSERT INTO comment (user_id,post_id,contents,reply) VALUES ('$crrntID','$postID','$content','$cmtID')");
        header("location: ../UserPage/comment.php?id=".$postID);
    }
