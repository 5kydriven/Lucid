<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Lucid</title>
    <link rel="icon" href="Icons/lucidwhite.png" type="image/x-icon">
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-alt">
        <div class="logo-container">
            <h1>
                <a href="index.html">
                    <img src="Icons/lucidwhite.png">
                </a>
            </h1>
        </div>
        <div class="form-container">
            <form class="simple_form new_user" id="new_user" action="php/signup.php" method="post" enctype="multipart/form-data">
                <h1 class="title">Let's get you set up on Lucid.social.</h1>
                <p class="lead">With an account on this Lucid server, you'll be able to follow any other person on the network, regardless of where their account is hosted.</p>
                <div class="fields-group">
                <?php if (isset($_GET['error'])) { ?>
     		        <div class="message">
                        <strong><?php echo $_GET['error']; ?></strong>
                    </div>
     	        <?php } ?>
                    <div class="input with_label string optional user_account_display_name">
                        <div class="label_input">
                            <div class="label_input__wrapper">
                                <input placeholder="Display name" class="string optional" type="text" name="Dname" required>
                            </div>
                        </div>
                    </div>
                    <div class="input with_label string optional user_account_username">
                        <div class="label_input">
                            <div class="label_input__wrapper">
                                <input placeholder="Username" maxlength="30" class="string required" type="text" name="username" required>
                            </div>
                        </div>
                    </div>
                    <div class="input email required user_email">
                        <input placeholder="E-mail address" class="string email required" type="email" name="email" required>
                    </div>
                    <div class="input password required user_password">
                        <input placeholder="Password" maxlength="72" class="password required" type="password" name="password" required>
                    </div>
                    <div class="input string optional user_confirm_password">
                        <input placeholder="Confirm password" class="string optional" type="password" name="cpass" required>
                    </div>
                </div>
                <div class="fields-group"></div>
                <div class="actions"><button class="btn" name="signup">Sign up</button></div>
            </form>
            <div class="form-footer">
                <ul class="no-list">
                    <li><a href="signin.php">Sign in</a></li>
                    <li><a href="#">Didn't recieve instructions?</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>