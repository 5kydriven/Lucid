<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Lucid</title>
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
            <form class="simple_form new_user" id="new_user" action="php/signin.php" method="post">
                <h1 class="title">Sign in to Lucid.social.</h1>
                <p class="lead">Sign in with your lucid.social credentials. If your account is hosted on a different server, you will not be able to log in here.</p>
                <div class="fields-group">
                <?php if (isset($_GET['error'])) { ?>
     		        <div class="message">
                        <strong><?php echo $_GET['error']; ?></strong>
                    </div>
     	        <?php } ?>
                    <div class="input with_label email optional user_email">
                        <div class="label_input">
                            <label class="email optional">Username</label>
                            <div class="label_input__wrapper">
                                <input class="string optional" type="text" name="username" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fields-group">
                    <div class="input with_label password optional user_password">
                        <div class="label_input">
                            <label class="password optional">Password</label>
                            <div class="label_input__wrapper">
                                <input class="password optional" type="password" name="password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <button class="btn" name="login">Sign in</button>
                </div>
            </form>
            <div class="form-footer">
                <ul class="no-list">
                    <li><a href="signup.php">Sign up</a></li>
                    <li><a href="#">Forgot your password?</a></li>
                    <li><a href="#">Didn't recieve instructions?</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>