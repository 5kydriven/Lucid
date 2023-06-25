<?php
    include 'connect.php';

    if(isset($_POST['signup'])){
        $Dname = mysqli_real_escape_string($conn, $_POST['Dname']);
        $Uname = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpass']));

        $default = 'default.png';
        $defaultBG = 'defaultBG.jpeg';

        $user = mysqli_query($conn, "SELECT * FROM `user` WHERE username = '$Uname'");
        $Rmail = mysqli_query($conn, "SELECT email FROM `user` WHERE email = '$email'");
        
        if(mysqli_num_rows($user) > 0){
            header("Location: ../signup.php?error=Username taken");
        } else if(mysqli_num_rows($Rmail) > 0) {
            header("Location: ../signup.php?error=E-mail address taken");
        } else {
            if($pass != $cpass){
                header("Location: ../signup.php?error=password don't match");
            } else{
                mysqli_query($conn, "INSERT INTO `user` (`name`, `email`, `username`, `password`,`profile`,`background`) VALUES ('$Dname','$email','$Uname','$pass','$default','$defaultBG')");
                header('location: ../signin.php');
                exit();   
            }
        }
    } 
?>
    