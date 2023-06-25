<?php
    include '../php/connect.php';
    session_start();
    $id = $_SESSION['id'];
    $result = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    $email = $row['email'];
    $clean_email = str_replace("gmail.com", "lucid.social", $email);

    if(isset($_POST['button'])){

        $name = $_POST['dname'];
        $bio = $_POST['bio'];

        mysqli_query($conn, "UPDATE user SET name = '$name', bio = '$bio' WHERE id = '$id'");

        $head = $_FILES['background']['name'];
        $head_tmp_name = $_FILES['background']['tmp_name'];

        $avatar = $_FILES['avatar']['name'];
        $avatar_tmp_name = $_FILES['avatar']['tmp_name'];

        $headFolder = '../userImages/'.$head;
        $avatarFolder = '../userImages/'.$avatar;

        $default = $row['profile'];
        $defaultBG = $row['background'];

        if(empty($head)){
            mysqli_query($conn, "UPDATE user SET background = '$defaultBG' WHERE id = '$id'");
            if(empty($avatar)){
                mysqli_query($conn, "UPDATE user SET profile = '$default' WHERE id = '$id'");
                header('location: ../UserPage/edit.php');
            } else {
                mysqli_query($conn, "UPDATE user SET profile = '$avatar' WHERE id = '$id'");
                mysqli_query($conn, "UPDATE feeds SET profile = '$avatar' WHERE email = '".$row['email']."'");
                move_uploaded_file($avatar_tmp_name, $avatarFolder);
                header('location: ../UserPage/edit.php');
            }
        } else if(empty($avatar)){
            mysqli_query($conn, "UPDATE user SET profile = '$default' WHERE id = '$id'");
            if(empty($head)){
                mysqli_query($conn, "UPDATE user SET background = '$defaultBG' WHERE id = '$id'");
                header('location: ../UserPage/edit.php');
            } else {
                mysqli_query($conn, "UPDATE user SET background = '$head' WHERE id = '$id'");
                move_uploaded_file($head_tmp_name, $headFolder);
                header('location: ../UserPage/edit.php');
            }
        } else {
            mysqli_query($conn, "UPDATE user SET profile = '$avatar', background = '$head' WHERE id = '$id'");
            mysqli_query($conn, "UPDATE feeds SET profile = '$avatar' WHERE email = '".$row['email']."'");
            move_uploaded_file($avatar_tmp_name, $avatarFolder);
            move_uploaded_file($head_tmp_name, $headFolder);
            header('location: ../UserPage/edit.php'); 
            exit();     
        }

    }

    if(isset($_GET['logout'])){
        unset($id);
        session_destroy();
        header('location: ../signin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../icons/lucidwhite.png" type="image/x-icon">
        <link rel="stylesheet" href="../CSS/edit.css">
        <title>Edit Profile - Lucid</title>
    </head>
    <body class="admin theme-default no-reduce-motion">
        <div class="admin-wrapper">

            <!-- navigation bar -->
            <div class="sidebar-wrapper">
                <div class="sidebar-wrapper__inner">
                    <div class="sidebar">
                        <a href="user.php">
                            <img src="../icons/lucidwhite.png" class="logo logo--icon">
                        </a>
                        <ul>
                            <li id="web"><a href="user.php?id=<?= $id; ?>"><img src="../icons/arrow-89-24.png">Back to Lucid</a></li>
                            <li id="profile" style="background-color: #191b22; border-radius: 10px 0 0 10px;"><a href="edit.php" style="color: #fff;"><img src="../icons/user-24.png">Profile</a></li>
                            <li id="security"><a href="editAcc.php"><img src="../icons/lock-7-24.png">Account</a></li>
                            <li id="logout"><a href="edit.php?logout=<?php echo $id ?>"><img src="../icons/logout-24.png">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- profile -->
            <div class="content-wrapper">
                <div class="content">
                    <div class="content__heading">
                        <div class="content__heading__row">
                            <h2>Edit Profile</h2>
                        </div>
                    </div>
                    <form class="simple_form edit_account" id="edit_profile" method="post" action="" enctype="multipart/form-data">
                        <div class="fields-row">
                            <div class="fields-row__column fields-group fields-row__column-6">
                                <div class="input with_label string optional account_display_name">
                                    <div class="label_input">
                                        <label class="string optional">Display name</label>
                                        <div class="label_input__wrapper">
                                            <input type="text" name="dname" class="string optional" maxlength="30" id="account_display_name" value="<?= $row['name'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="input with_label text optional account_note">
                                    <div class="label_input">
                                        <label class="text optional">Bio</label>
                                        <div class="label_input__wrapper">
                                            <textarea maxlength="500" class="text optional" name="bio" id="account_note"><?= $row['bio']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fields-row">
                            <div class="fields-row__column fields-row__column-6">
                                <div class="card h-card">
                                    <a href="profile.php">
                                        <div class="card__img">
                                            <img src="<?php
                                                if($row['background'] == ''){
                                                    echo '../userImages/defaultBG.jfif';
                                                }else{
                                                    echo '../userImages/'.$row['background'];
                                                }
                                            ?>">
                                        </div>
                                        <div class="card__bar">
                                            <div class="avatar">
                                                <img width="48" height="48" class="u-photo" src="<?php
                                                    if($row['profile'] == ''){
                                                        $_SESSION['pic'] = '../userImages/default.png';
                                                        echo $_SESSION['pic'];
                                                    }else{
                                                        echo '../userImages/'.$row['profile'];
                                                    }
                                                ?>">
                                            </div>
                                            <div class="display-name">
                                                <bdi>
                                                    <strong class="emojify p-name"><?= $row['name'];?></strong>
                                                </bdi>
                                                <span>@<?= $row['email'];?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="fields-row__column fields-group fields-row__column-6">
                                <div class="input with_label file optional account_header field_with_hint">
                                    <div class="label_input">
                                        <label class="file optional">Header</label>
                                        <div class="label_input__wrapper">
                                            <input type="file" class="file optional" id="account_header" name="background">
                                        </div>
                                    </div>
                                    <span class="hint">
                                        PNG, GIF or JPG. At most 2 mb. Will be downscaled to 1500x500px
                                        <br>
                                        <a href="../php/delete.php?background">Delete</a>
                                    </span>
                                </div>
                                <div class="input with_label file optional account_header field_with_hint">
                                    <div class="label_input">
                                        <label class="file optional">Avatar</label>
                                        <div class="label_input__wrapper">
                                            <input type="file" class="file optional" id="account_header" name="avatar">
                                        </div>
                                    </div>
                                    <span class="hint">
                                        PNG, GIF or JPG. At most 2 mb. Will be downscaled to 1500x500px
                                        <br>
                                        <a href="../php/delete.php?avatar">Delete</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="actions">
                            <button name="button" type="submit" class="btn">Save changes</button>
                        </div>
                </div>
            </div>
            </form>
            <div class="sidebar-wrapper sidebar-wrapper--empty"></div>
        </div>
    </body>
</html>