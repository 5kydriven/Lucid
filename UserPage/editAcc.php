<?php
    include '../php/connect.php';
    session_start();
    $id = $_SESSION['id'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

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
        <link rel="icon" href="../images/lucidwhite.png" type="image/x-icon">
        <link rel="stylesheet" href="../CSS/edit.css">
        <title>Edit Account - Lucid</title>
    </head>
    <body class="admin theme-default no-reduce-motion">
        <div class="admin-wrapper">

            <!-- navigation bar -->
            <div class="sidebar-wrapper">
                <div class="sidebar-wrapper__inner">
                    <div class="sidebar">
                        <a href="user.html">
                            <img src="../icons/lucidwhite.png" class="logo logo--icon">
                        </a>
                        <ul>
                            <li id="web"><a href="user.php"><img src="../icons/arrow-89-24.png">Back to Lucid</a></li>
                            <li id="profile"><a href="edit.php"><img src="../icons/user-24.png">Profile</a></li>
                            <li id="security" style="background-color: #191b22; border-radius: 10px 0 0 10px;"><a href="editAcc.php" style="color: #fff;"><img src="../icons/lock-7-24.png">Account</a></li>
                            <li id="logout"><a href="editAcc.php?logout=<?php echo $id ?>"><img src="../icons/logout-24.png">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- account -->
            <div class="content-wrapper">
                <div class="content">
                    <div class="content__heading">
                        <div class="content__heading__row">
                            <h2>Account Settings</h2>
                        </div>
                    </div>
                    <?php if(isset($_GET['success'])) { ?>
                        <div class="flash-message success" id="error_explanation">
                            <strong><?php echo $_GET['success']; ?></strong>
                        </div>
                    <?php } ?>
                    <h3>Account status</h3>
                    <p class="hint">
                        <span class="positive-hint">Your account is fully operational.</span>
                    </p>
                    <hr class="spacer">
                    <h3>Security</h3>
                    <form class="simple_form auth_account" id="edit_user" action="../php/updateAcc.php" method="post">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="flash-message alert" id="error_explanation">
                            <strong><?php echo $_GET['error']; ?></strong>
                        </div>
                    <?php } ?>
                        <div class="fields-row">
                            <div class="fields-row__column fields-group fields-row__column-6">
                                <div class="input with_label email required user_email field_with_hint">
                                    <div class="label_input">
                                        <label class="email required">Username <abbr title="required">*</abbr></label>
                                        <div class="label_input__wrapper">
                                            <input type="text" name="username" class="string email required" required="required" maxlength="30" id="user_email" value="<?= $row['username'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields-row__column fields-group fields-row__column-6">
                                <div class="input with_label password required user_current_password">
                                    <div class="label_input">
                                        <label class="password required">Current password <abbr title="required">*</abbr></label>
                                        <div class="label_input__wrapper">
                                            <input type="password" name="currentpass" class="password required" required="required" id="user_current_password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fields-row">
                            <div class="fields-row__column fields-group fields-row__column-6">
                                <div class="input with_label password optional user_password field_with_hint">
                                    <div class="label_input">
                                        <label class="password optional">New password</label>
                                        <div class="label_input__wrapper">
                                            <input type="password" class="password optional" id="user_password" name="newpass">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="fields-row__column fields-group fields-row__column-6">
                                <div class="input with_label password optional user_password_confirmation">
                                    <div class="label_input">
                                        <label class="password optional">Confirm new password</label>
                                        <div class="label_input__wrapper">
                                            <input type="password" class="password optional" id="user_password_confirmation" name="cpass">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="actions">
                            <button class="btn button" name="save" type="submit">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="sidebar-wrapper sidebar-wrapper--empty"></div>
        </div>
    </body>
</html>