<?php
    session_start();
    include '../PHP/connect.php';
    include '../PHP/function.php';

    $id = $_SESSION['id'];

    $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$id'"));

    if(isset($_GET['logout'])){
        logout();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification - Lucid</title>
    <link rel="icon" href="../Icons/lucidwhite.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/notification.css">
    <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.css">
    <!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>

<body>
        <div class="notranslate app-holder" id="mastodon">
            <div tabindex="-1">
                <div class="ui">
                    <div class="columns-area__panels">

                        <!-- Left side area -->
                        <div class="columns-area__panels__pane">
                            <div class="columns-area__panels__pane__inner">

                                <!-- profile area -->
                                <div class="compose-panel">
                                    <div class="search">
                                        <input class="search__input" type="text" placeholder="Search or paste URL">
                                    </div>
                                    <div class="navigation-bar">
                                        <a href="profile.php?id=<?=$id?>">
                                            <div class="account__avatar" style="width: 46px; height: 46px;">
                                                <img src="<?= '../userImages/'.$rows['profile']?>">
                                            </div>
                                        </a>
                                        <div class="navigation-bar__profile">
                                            <a href="profile.php?id=<?=$id?>">
                                                <strong class="navigation-bar__profile-account">@<?= trimMail($rows['email']);?></strong>
                                            </a>
                                            <a href="edit.php" class="navigation-bar__profile-edit">
                                                <span>Edit Profile</span>
                                            </a>
                                        </div>
                                        <div class="navigation-bar__actions">
                                            <button type="button" class="close icon-button" style="font-size: 18px; width: 23.1429px; height: 23.1429px; line-height: 18px;">
                                                <img src="../Icons/more.png">
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Posting area -->
                                    <form class="compose-form" action="../PHP/post.php" method="post" enctype="multipart/form-data">
                                        <div class="compose-form__autosuggest-wrapper">
                                            <textarea type="text" placeholder="What's on your mind?" class="autosuggest-textarea__textarea" style="height: 27px !important;" name="post"></textarea>
                                        </div>
                                        <div class="compose-form__buttons-wrapper">
                                            <input type="file" name="image">
                                        </div>
                                        <div class="compose-form__publish">
                                            <div class="compose-form__publish-button-wrapper">
                                                <button class="button button--block" type="submit" name="publish">Publish!</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="link-footer">
                                        <p>
                                            <strong>Lucid.social</strong>: 
                                            <a href="#">About</a><span> · </span>
                                            <a href="#">Status</a><span> · </span>
                                            <a href="#">Invite</a><span> · </span>
                                            <a href="#">People</a><span> · </span>
                                            <a href="#">Profile directory</a><span> · </span>
                                            <a href="#">Privacy policy</a>
                                        </p><br>
                                        <p>
                                            <strong>Lucid</strong>: 
                                            <a href="#">About</a><span> · </span>
                                            <a href="#">Get the app</a><span> · </span>
                                            <a href="#">keyboard</a><span> · </span>
                                            <a href="#">Shortcuts</a><span> · </span>
                                            <a href="#">View source code</a><span> · </span>
                                            v4.1.1
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- center or newsfeed area -->
                        <div class="columns-area__panels__main">
                            <div class="tabs-bar__wrapper">
                                <div id="tabs-bar__portal">
                                    <div class="column-header__wrapper">
                                        <h1 class="column-header">
                                            <button class="feed"><div class="feedbtn"><i class="fa-solid fa-bell"></i><p style="margin-left: 5px;">Notifications</p></div></button>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="columns-area columns-area--mobile">
                                <div class="column" role="region" aria-label="Home">
                                    <div class="scrollable">
                                        <div class="item-list" role="feed">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- rightside or navigation area -->
                        <div class="columns-area__panels__pane columns-area__panels__pane--start">
                            <div class="columns-area__panels__pane__inner">
                                <div class="navigation-panel">
                                    <div class="navigation-panel__logo">
                                        <a class="column-link column-link--logo">
                                            <img src="../Icons/lucidwhite.png" style="height: 50px; width: 50px;">
                                            <h1>Lucid</h1>
                                        </a>
                                    </div>
                                    <hr>
                                    <a class="column-link column-link--transparent" id="home" href="user.php">
                                        <img src="../Icons/house-32.png" class="navIcons">
                                        <span>Home</span>
                                    </a>
                                    <a href="notifications.php" class="column-link column-link--transparent  active">
                                        <i class="fa-solid fa-bell"></i>
                                        <span>Notifications</span>
                                    </a>
                                    <a class="column-link column-link--transparent" href="private.php">
                                        <i class="fa-solid fa-at"></i>
                                        <span>Private Mentions</span>
                                    </a>
                                    <a href="bookmark.css" class="column-link column-link--transparent">
                                        <i class="fa-solid fa-bookmark"></i>
                                        <span>Bookmarks</span>
                                    </a>
                                    <a class="column-link column-link--transparent">
                                        <img src="../Icons/star-8-32.png" class="navIcons">
                                        <span>Favorites</span>
                                    </a>
                                    <a class="column-link column-link--transparent">
                                        <img src="../Icons/list-2-32.png" class="navIcons">
                                        <span>Lists</span>
                                    </a>
                                    <hr>
                                    <a class="column-link column-link--transparent">
                                        <img src="../Icons/settings-4-32.png" class="navIcons">
                                        <span>Preferences</span>
                                    </a> 
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="modal">
                            <div class="modal-container">
                                <ul>
                                    <a href="edit.php"><li class="e">Edit Profile</li></a>
                                    <a><li class="c">Preferences</li></a>
                                    <a><li class="c" id="hr">Pinned Post</li></a>                                   
                                    <a><li class="c">Follow Request</li></a>
                                    <a><li class="c">Favourites</li></a>
                                    <a><li class="c">Bookmarks</li></a>
                                    <a><li class="c">Lists</li></a>
                                    <a><li class="c" id="hr">Followed hashtags</li></a>
                                    <a><li class="c">Muted Users</li></a>
                                    <a><li class="c">Block Users</li></a>
                                    <a><li class="c">Block Domains</li></a>
                                    <a><li class="c" id="hr">Muted words</li></a>
                                    <a href="user.php?logout=<?php echo $id?>"><li class="l">Logout</li></a>
                                </ul>
                            </div>
                        </div>

</body>
<script src="../JavaScript/user.js"></script>
</html>