<?php
    include '../PHP/connect.php';
    include '../PHP/function.php';
    session_start();

    $id = $_SESSION['id'];
    $post_id = $_GET['id'];
    
    //post
    $query = mysqli_query($conn, "SELECT * FROM feeds WHERE id = '$post_id'");
    $row = mysqli_fetch_assoc($query);

    $email = $row['email'];
    $pic = $row['picture'];
    $clean_email = str_replace("@gmail.com", "", $email);
    $sharedId = $row['sharedId'];

    //profile
    $rslt = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
    $user = mysqli_fetch_assoc($rslt);
    $mail = $user['email'];
    $cleanEmail = str_replace("@gmail.com", "", $mail);

    if(isset($_POST['back'])){
        header('location: user.php?id='.$id);
        exit();
    }

    $likesCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS likes FROM ratings WHERE post_id = '$post_id' and status = 'like'"))['likes'];
    // $dislikesCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS dislikes FROM ratings WHERE post_id = '$post_id' and status = 'dislike'"))['dislikes'];
    $status = mysqli_query($conn, "SELECT status FROM ratings WHERE post_id = '$post_id' AND user_id = '$id'");

    if(mysqli_num_rows($status) > 0) {
        $status = mysqli_fetch_assoc($status)['status'];
    } else {
        $status = 0;
    }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>comment - Lucid</title>
    <link rel="icon" href="../icons/lucidwhite.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/comment.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.css">
    <!-- <script src="https://use.fontawesome.com/fe459689b4.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    /* transition-property: background-color,color; */
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

                                <div class="compose-panel">
                                    <div class="search">
                                        <input class="search__input" type="text" placeholder="Search or paste URL">
                                    </div>
                                    <div class="navigation-bar">
                                        <!-- profile area -->
                                        <a href="profile.php">
                                            <div class="account__avatar" style="width: 46px; height: 46px;">
                                                <img src='<?='../userImages/'.$user['profile'];?>' class="profile">
                                            </div>
                                        </a>
                                        <div class="navigation-bar__profile">
                                            <a href="profile.php">
                                                <strong class="navigation-bar__profile-account">@<?= $cleanEmail?></strong>
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

                                    <!-- posting area -->
                                    <form class="compose-form" action="../php/post.php" method="post">
                                        <div class="compose-form__autosuggest-wrapper">
                                            <textarea type="text" placeholder="What's on your mind?" class="autosuggest-textarea__textarea" style="height: 27px !important;" name="post"></textarea>
                                        </div>
                                        <!-- <div class="compose-form__modifiers">
                                            <div class="compose-form__upload-wrapper">
                                                <div class="">

                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="compose-form__buttons-wrapper">
                                            <input type="file" name="">
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
                                        <form method="post">
                                        <h1 class="column-header">
                                            <button class="feed" name="back"><div class="feedbtn"><img src="../icons/arrow-89-32.png" class="homeFeed"><p>Back</p></div></button>
                                        </h1>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="columns-area columns-area--mobile">
                                <div class="column" role="region" aria-label="Home">
                                    <div class="scrollable">
                                        <div class="item-list" role="feed">
                                            
                                        <article>
                                                <div class="status">
                                                    <div class="status__info">
                                                        <a class="status__relative-time">
                                                            <span class="status__visibility-icon"></span>
                                                            <time><?= getTimeLapse($row['date'])?></time>
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
                                                            <a style="text-decoration: none;" onclick="show_hide()">
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
                                                <!-- comment area -->
                                             <div class="comment-box" id="comment-box">
                                                        <form action="../PHP/comment.php" method="post" class="form-comment">
                                                            <div class="submit-comment" id="submit-comment">
                                                                <input type="hidden" name="id" value="<?= $post_id ?>">
                                                                <input type="text" name="comment" class="comment-post" placeholder="add your comment">
                                                                <div class="send-comment">
                                                                    <button class="post-comment" name="send">
                                                                        <img src="../icons/send.png" style="height: 20px; width: 20px;">
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>            
                                                        
                                                        <?php
                                                            $query = mysqli_query($conn, "SELECT * FROM comment WHERE post_id = '$post_id' ORDER BY created DESC");

                                                            while($row = mysqli_fetch_assoc($query)) {
                                                                $userInfo = $row['user_id'];
                                                                $sql = mysqli_query($conn, "SELECT * FROM user WHERE id = '$userInfo'");
                                                                $sql2 = mysqli_fetch_assoc($sql);
                                                                $email = $sql2['email'];
                                                                $cleanEmail = str_replace("@gmail.com", "", $email);
                                                                $commentId = $row['id'];
                                                        ?>
                                                        <div class="comment-square" id="comment-square">
                                                            <!-- Comments and replies -->
                                                            <div class="comment-container-uploads">
                                                                <div class="comment-container">   
                                                                    <div class="comment-card"> 
                                                                        <div class="comment-head">
                                                                            <div class="comment-info">
                                                                                <div class="comment-avatar">
                                                                                    <img  src='<?='../userImages/'.$sql2['profile'];?>' style="height: 37px; width: 37px; border-radius: 30px;">
                                                                                </div>
                                                                                <div class="comment-user">
                                                                                    <div class="comment-name">
                                                                                        <?= $sql2['name']?>
                                                                                        <?php if($row['reply'] != 0) {
                                                                                            $repID = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM comment WHERE id = '".$row['reply']."'"));
                                                                                            $replyUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = '".$repID['user_id']."'"));

                                                                                            echo ' <i class="fa-solid fa-caret-right fa-lg" style="color: #ffffff; padding: 0 5px;"></i> '.$replyUser['name'];
                                                                                        }?>
                                                                                    </div>
                                                                                    <div class="comment-email">@<?= $cleanEmail?></div>
                                                                                </div>              
                                                                            </div>                                                                       
                                                                            <div class="comment-posted"><?= getTimeLapse($row['created'])?></div>
                                                                        </div>
                                                                        <div class="comment-caption"><p><?= $row['contents']?></p></div>
                                                                        <div class="comment-toolbar">
                                                                            <div class="reply tool" id="reply-btn">                                                                                    
                                                                                <button class="reply-button" type="submit">Reply</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                
                                                                </div>
                                                                <form action="../php/reply.php" method="post" class="form-reply">
                                                                    <div class="reply-container" id="reply-container">
                                                                        <input type="hidden" name="postid" value="<?= $post_id ?>">
                                                                        <input type="hidden" name="cmmtId" value="<?=$commentId?>">
                                                                        <input type="text" name="content" placeholder="Write a reply" class="reply-comment">
                                                                        <div class="submit-reply">
                                                                            <button type="submit" class="post-comment" name="sendreply">
                                                                                <img src="../icons/send.png" style="height: 20px; width: 20px;">  
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div> 
                                                        <?php }  ?>  
                                                    </div>                                          
                                            </article>                                            
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
                                            <img src="../icons/lucidwhite.png" style="height: 50px; width: 50px;">
                                            <h1>Lucid</h1>
                                        </a>
                                    </div>
                                    <hr>
                                    <a class="column-link column-link--transparent" id="home" href="user.php">
                                        <img src="../icons/house-32.png" class="navIcons">
                                        <span>Home</span>
                                    </a>
                                    <a class="column-link column-link--transparent">
                                        <img src="../icons/bell-3-32.png" class="navIcons">
                                        <span>Notifications</span>
                                    </a>
                                    <!-- <a class="column-link column-link--transparent">
                                        <img src="../icons/icons8-hashtag-30.png" class="navIcons">
                                        <span>Explore</span>
                                    </a>
                                    <a class="column-link column-link--transparent">
                                        <img src="../icons/filled-box-32.png" class="navIcons">
                                        <span>Local</span>
                                    </a>
                                    <a class="column-link column-link--transparent">
                                        <img src="../icons/globe-7-32.png" class="navIcons">
                                        <span>Federated</span>
                                    </a> -->
                                    <a class="column-link column-link--transparent">
                                        <img src="../icons/at-2-32.png" class="navIcons">
                                        <span>Private Mentions</span>
                                    </a>
                                    <a class="column-link column-link--transparent">
                                        <img src="../icons/bookmark-5-32.png" class="navIcons">
                                        <span>Bookmarks</span>
                                    </a>
                                    <a class="column-link column-link--transparent">
                                        <img src="../icons/star-8-32.png" class="navIcons">
                                        <span>Favorites</span>
                                    </a>
                                    <a class="column-link column-link--transparent">
                                        <img src="../icons/list-2-32.png" class="navIcons">
                                        <span>Lists</span>
                                    </a>
                                    <hr>
                                    <a class="column-link column-link--transparent">
                                        <img src="../icons/settings-4-32.png" class="navIcons">
                                        <span>Preferences</span>
                                    </a> 
                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- Modal area -->
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
                </div>
            </div>
        </div>
<script type="text/javascript">
    $('.like').click(function(){
        var data = {
          post_id: $(this).data('post-id'),
          user_id: <?php echo $id; ?>,
          status: $(this).hasClass('like') ? 'like' : 'dislike',
        };
        $.ajax({
          url: '../PHP/like.php',
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
<script src="../JavaScript/comment.js"></script>
</html>