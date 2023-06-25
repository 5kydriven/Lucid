<?php
    include '../php/connect.php';
    include '../php/function.php';
    session_start();

    $id = $_SESSION['id'];

    $result = mysqli_query($conn, "SELECT *, date(created) AS date FROM user WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    $numPost = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS comments FROM feeds WHERE userID = '$id'"));

    $email = $row['email'];
    
    $lucidEmail = str_replace("gmail.com","lucid.social","$email");

    if(isset($_POST['back'])){
        header('location: user.php?id='.$id);
        exit();
    }

    if(isset($_GET['logout'])){
        unset($id);
        session_destroy();
        header('location: ../loginSignup/login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Lucid</title>
    <link rel="icon" href="../icons/lucidwhite.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/profile.css">
    <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://use.fontawesome.com/fe459689b4.js"></script> -->
</head>

<style media="screen">

    .status__action-bar .like, .status__action-bar .dislike{
    padding: 5px 67px;
    border: 0;
    color: #606984;
    border-radius: 4px;
    background: transparent;
    cursor: pointer;
    transition: all .1s ease-in;
    display: flex;
    align-items: center;
    font-size: 15px;
    font-weight: bold;
    }

    .status__action-bar .like:hover, .status__action-bar .dislike:hover{
        background-color: #c0cdd9;
    }

    .like.selected, .dislike.selected{
        color: #8c8dff;
    }
</style>

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
                                    <a href="profile.php?id=<?= $id ?>">
                                        <div class="account__avatar" style="width: 46px; height: 46px;">
                                            <img src="<?= '../userImages/'.$row['profile']?>">
                                        </div>
                                    </a>
                                    <div class="navigation-bar__profile">
                                            <a href="profile.php?id=<?= $id ?>">
                                                <strong class="navigation-bar__profile-account">@<?= trimMail($email)?></strong>
                                            </a>
                                            <a href="edit.php" class="navigation-bar__profile-edit">
                                                <span>Edit Profile</span>
                                            </a>
                                        </div>
                                    <div class="navigation-bar__actions">
                                        <button type="button" class="close icon-button" style="font-size: 18px; width: 27.1429px; height: 29.1429px; line-height: 18px;">
                                            <img src="../Icons/more.png">
                                        </button>
                                    </div>
                                </div>
                                <form class="compose-form" action="../php/profilePost.php" method="post" enctype="multipart/form-data">
                                    <div class="compose-form__autosuggest-wrapper">
                                        <textarea type="text" placeholder="What's on your mind?" class="autosuggest-textarea__textarea" style="height: 27px !important;" name="post"></textarea>
                                    </div>
                                    <div class="compose-form__buttons-wrapper">
                                        <input type="file" name="images">
                                    </div>
                                    <div class="compose-form__publish">
                                        <div class="compose-form__publish-button-wrapper">
                                            <button class="button button--block" type="submit">Publish!</button>
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
                                    <form method="post">
                                        <h1 class="column-header">
                                            <button class="feed" name="back"><div class="feedbtn"><img src="../Icons/arrow-89-32.png" class="homeFeed"><p>Back</p></div></button>
                                        </h1>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="columns-area columns-area--mobile">
                            <div class="column" role="region" aria-label="Home">
                                <div class="scrollable">
                                    <div class="item-list" role="feed">
                                        <div class="account-timeline__header">
                                            <div class="account__header">
                                                <div class="account__header__image">
                                                    <div class="account__header__info"></div>
                                                    <img src="<?= '../userImages/'.$row['background'];?>">
                                                </div>
                                                <div class="account__header__bar">
                                                    <div class="account__header__tabs">
                                                        <a class="avatar">
                                                            <div class="account__avatar" style="width: 90px; height: 90px;">
                                                                <img src="<?= '../userImages/'.$row['profile'];?>">
                                                            </div>
                                                        </a>
                                                        <div class="account__header__tabs__buttons">
                                                            <a href="edit.php"><button class="button logo-buton">Edit Profile</button></a>                                                             
                                                        </div>
                                                    </div>
                                                    <div class="account__header__tabs__name">
                                                        <h1>
                                                            <span><?= $row['name'];?></span>
                                                            <small>
                                                                <span>@<?= $lucidEmail?></span>
                                                            </small>
                                                        </h1>
                                                    </div>
                                                    <div class="account__header__extra">
                                                            <div class="account__header__bio">
                                                                <div class="account__header__content translate"><p><?= $row['bio'];?></p></div>
                                                                <div class="account__header__fields">
                                                                    <dl>
                                                                        <dt>
                                                                            <span>Joined</span>
                                                                        </dt>
                                                                        <dd><?= $row['date'];?></dd>
                                                                    </dl>
                                                                </div>
                                                            </div>
                                                            <div class="account__header__extra__links">
                                                                <a>
                                                                    <span>
                                                                        <strong>
                                                                            <span><?= $numPost['comments']; ?> </span>
                                                                        </strong>
                                                                        Posts
                                                                    </span>
                                                                </a>
                                                                <a>
                                                                    <span>
                                                                        <strong>
                                                                            <span>0</span>
                                                                        </strong>
                                                                        Following
                                                                    </span>
                                                                </a>
                                                                <a>
                                                                    <span>
                                                                        <strong>
                                                                            <span>0</span>
                                                                        </strong>
                                                                        Followers
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                               $result = mysqli_query($conn, "SELECT * FROM `feeds` WHERE userID = '$id' ORDER BY date DESC");
                                                
                                               //while($row = mysqli_fetch_assoc($result)){
                                                foreach($result as $row) :
                                                    
                                                    $pic = $row['picture'];
                                                    $time = $row['date'];
                                                    $sharedId = $row['sharedId'];

                                                            $post_id = $row['id'];
                                                            
                                                            $likesCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS likes FROM ratings WHERE post_id = '$post_id' and status = 'like'"))['likes'];

                                                            // $dislikesCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS dislikes FROM ratings WHERE post_id = '$post_id' and status = 'dislike'"))['dislikes'];

                                                            $status = mysqli_query($conn, "SELECT status FROM ratings WHERE post_id = '$post_id' AND user_id = '$id'");

                                                            if(mysqli_num_rows($status) > 0) {
                                                                $status = mysqli_fetch_assoc($status)['status'];
                                                            } else {
                                                                $status = 0;
                                                            }
                                            ?>
                                            <article>
                                                <div class="status">
                                                    <div class="status__info">
                                                        <a class="status__relative-time">
                                                            <span class="status__visibility-icon"></span>
                                                            <time><?= getTimeLapse($time)?></time>
                                                        </a>
                                                        <a class="status__display-name" href="otherPp.php?id=<?= $row['userID'];?>">
                                                            <div class="status__avatar">
                                                                <div class="account__avatar" style="width: 46px; height: 46px;">
                                                                    <img src='<?= '../userImages/'.$row['profile'];?>'>
                                                                </div>
                                                            </div>
                                                            <span class="display-name">
                                                                <bdi>
                                                                    <strong class="display-name__html"><?= $row['dname'];?></strong>
                                                                </bdi>
                                                                <span class="display-name__account">@<?= trimMail($row['email']);;?></span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="status__content status__content--with-action">
                                                        <p><?= $row['content'];?></p>
                                                    </div>
                                                    <?php if(!empty($pic)) { ?>
                                                        <div class="media-gallery" style="height: 308.25px;">
                                                            <div class="media-gallery__item" style="width: 100%; height: 100%;">
                                                                <a class="media-gallery__item-thumbnail">
                                                                    <?php echo "<img src='../uploads/$pic' style='object-position: 50% 50%;'>" ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php } else if ($sharedId != 0) {
                                                        $sharedRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM feeds WHERE id = '$sharedId'"));
                                                    ?>
                                                        <div class="shared-container__box">
                                                            <div class="status__info">
                                                                <a class="status__relative-time">
                                                                    <span class="status__visibility-icon"></span>
                                                                    <time><?= getTimeLapse($sharedRow['date'])?></time>
                                                                </a>
                                                                <a class="status__display-name" href="otherPp.php?id=<?= $sharedRow['userID'];?>">
                                                                    <div class="status__avatar">
                                                                        <div class="account__avatar" style="width: 46px; height: 46px;">
                                                                            <img src='<?= '../userImages/'.$sharedRow['profile'];?>'>
                                                                        </div>
                                                                    </div>
                                                                    <span class="display-name">
                                                                        <bdi>
                                                                            <strong class="display-name__html"><?= $sharedRow['dname'];?></strong>
                                                                            <span style="text-decoration: underline;">
                                                                            
                                                                        </bdi>
                                                                        <span class="display-name__account">@<?= trimMail($sharedRow['email']);?></span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <div class="status__content status__content--with-action">
                                                                <p><?= $sharedRow['content'];?></p>
                                                            </div>
                                                            <?php if(!empty($sharedRow['picture'])) {?>
                                                                <div class="media-gallery" style="height: 308.25px;">
                                                                    <div class="media-gallery__item" style="width: 100%; height: 100%;">
                                                                        <a class="media-gallery__item-thumbnail">
                                                                            <img src='../uploads/<?=$sharedRow['picture'];?>' style='object-position: 50% 50%;'>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>                                                  
                                                        <?php } ?>                                        
                                                        </div>
                                                        <div class="status__action-bar">                                                   
                                                            <button class = "like <?php if($status == 'like') echo "selected"; ?>" data-post-id = <?php echo $post_id; ?>>
                                                                <i class = "fa fa-thumbs-up fa-lg"></i>
                                                                <span class = "likes_count<?php echo $post_id; ?>" data-count = <?php echo $likesCount; ?>> <?php echo $likesCount; ?> </span>
                                                            </button>                                        
                                                            <a href="comment.php?id=<?= $row['id'];?>" style="text-decoration: none;">
                                                                <button class="status__action-bar__button icon-button" tabindex="0" >
                                                                    <img src="../Icons/comment.png" style=" width: 14px; height: 14px;">
                                                                    <span>
                                                                        <?php
                                                                            $idRes = mysqli_query($conn, "SELECT COUNT(*) AS comments FROM comment WHERE post_id = $post_id");
                                                                            $total = mysqli_fetch_assoc($idRes);

                                                                            echo $total['comments'];
                                                                        ?>
                                                                    </span>
                                                                </button>
                                                            </a>
                                                            <a class="share-box" href="share.php?postId=<?php echo $post_id;?>">
                                                                <button class='share-btn' name="share_btn">
                                                                    <i class="fa fa-share fa-lg"></i>
                                                                </button>
                                                            </a>
                                                        </div>   
                                                                                                 
                                            </article>
                                            <?php
                                                endforeach;
                                            ?>
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
                                        <a class="column-link column-link--logo" href="user.html">
                                            <img src="../Icons/lucidwhite.png" style="height: 50px; width: 50px;">
                                            <h1>Lucid</h1>
                                        </a>
                                    </div>
                                    <hr>
                                    <a class="column-link column-link--transparent" id="home" href="user.php">
                                        <img src="../Icons/house-32.png" class="navIcons">
                                        <span>Home</span>
                                    </a>
                                    <a href="notifcations.php" class="column-link column-link--transparent">
                                        <i class="fa-solid fa-bell"></i>
                                        <span>Notifications</span>
                                    </a>
                                    <a href="private.php" class="column-link column-link--transparent">
                                        <i class="fa-solid fa-at"></i>
                                        <span>Private Mentions</span>
                                    </a>
                                    <a href="bookmark.php" class="column-link column-link--transparent">
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
                    
                <!-- modal area -->
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
                            <a href="profile.php?logout=<?php $id ?>"><li class="l">Logout</li></a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $('.like, .dislike').click(function(){
        var data = {
          post_id: $(this).data('post-id'),
          user_id: <?php echo $id; ?>,
          status: $(this).hasClass('like') ? 'like' : 'dislike',
        };
        $.ajax({
          url: '../php/like.php',
          type: 'post',
          data: data,
          success:function(response){
            var post_id = data['post_id'];
            var likes = $('.likes_count' + post_id);  // Likes_count element
            var likesCount = likes.data('count');
            var dislikes = $('.dislikes_count' + post_id); // Dislikes_count element
            var dislikesCount = dislikes.data('count');

            var likeButton = $(".like[data-post-id=" + post_id + "]"); // Like button element
            var dislikeButton = $(".dislike[data-post-id=" + post_id + "]"); // Dislike button element
            if(response == 'newlike'){
              likes.html(likesCount + 1);
              likeButton.addClass('selected');
            }
            else if(response == 'newdislike'){
              dislikes.html(dislikesCount + 1);
              dislikeButton.addClass('selected');
            }
            else if(response == 'changetolike'){
              likes.html(parseInt($('.likes_count' + post_id).text()) + 1);
              dislikes.html(parseInt($('.dislikes_count' + post_id).text()) - 1);
              likeButton.addClass('selected');
              dislikeButton.removeClass('selected');
            }
            else if(response == 'changetodislike'){
              likes.html(parseInt($('.likes_count' + post_id).text()) - 1);
              dislikes.html(parseInt($('.dislikes_count' + post_id).text()) + 1);
              likeButton.removeClass('selected');
              dislikeButton.addClass('selected');
            }
            else if(response == 'deletelike'){
              likes.html(parseInt($('.likes_count' + post_id).text()) - 1);
              likeButton.removeClass('selected');
            }
            else if(response == 'deletedislike'){
              dislikes.html(parseInt($('.dislikes_count' + post_id).text()) - 1);
              dislikeButton.removeClass('selected');
            }
          }
        })
    })
</script>
</body>
<script src="script.js"></script>
</html>