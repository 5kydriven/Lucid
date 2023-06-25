<?php
    include 'connect.php';
    session_start();
    $id = $_SESSION['id'];

    $uname = mysqli_real_escape_string($conn, $_POST['username']);
    $oldpass = mysqli_real_escape_string($conn, md5($_POST['currentpass']));
    $newpass = mysqli_real_escape_string($conn, md5($_POST['newpass']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpass']));

    if(isset($_POST['save'])){
        $result = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
        $row = mysqli_fetch_assoc($result);
        $pass = $row['password'];

        if($oldpass != $pass){
            header('location: ../UserPage/editAcc.php?error=Old password invalid!');
        } else if($newpass != $cpass){
            header("location: ../UserPage/editAcc.php?error=Password don't match!");
        } else{
            mysqli_query($conn, "UPDATE user SET password = '$newpass', username = '$uname' WHERE id = '$id'");
            header('location: ../UserPage/editAcc.php?success=Your account has been updated succesfully.');
        }  
    }