<?php
    session_start();
    include '../PHP/function.php';
    include '../PHP/connect.php';

    $id = $_SESSION['id'];
    
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/user.css">
    <link rel="icon" href="../Icons/lucidwhite.png" type="image/x-icon">
    <title>Share</title>
</head>
<body>
    <div class="background">
        <div class="share-modal">
            <div class="share-modal__container">
                <div class="share-title">
                    <h2>Write post</h2>
                    <a href="user.php">
                        <button class="close-share"><img src="../Icons/cancel.png"></button>
                    </a>
                </div>
                <form method="post" action="../PHP/share.php">
                    <div class='header-share'>
                        <div class="status__avatar">
                            <div class="account__avatar" style="width: 46px; height: 46px;">
                                <img src='<?= '../userImages/'.$row['profile'];?>'>
                            </div>
                        </div>
                        <a class="status__display-name">
                            <span class="display-name">
                                <bdi>
                                    <strong class="display-name__html"><?= $row['name'];?></strong>
                                </bdi>
                                <span class="display-name__account">@<?= trimMail($row['email']);;?></span>
                            </span>
                        </a>
                    </div>                               
                    <div class="share-contents">
                        <input type="text" name="caption" placeholder="What's on your mind, Name?">
                        <?php if (isset($_GET['postId'])) {
                            $shareContent = $_GET['postId']; 
                            $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM feeds WHERE id = '$shareContent'"));     
                        ?>
                        <input type="hidden" name="shareId" value="<?=$shareContent;?>">
                        <div class="shared-post-box">                  
                            <div class="status__info">
                                <a class="status__relative-time">
                                    <span class="status__visibility-icon"></span>
                                    <time><?= getTimeLapse($data['date']) ?></time>
                                </a>
                                <a class="status__display-name" href="otherPp.php?id=<?= $data['userID']; ?>">
                                    <div class="status__avatar">
                                        <div class="account__avatar" style="width: 46px; height: 46px;">
                                            <img src='<?= '../userImages/' . $data['profile']; ?>'>
                                        </div>
                                    </div>
                                    <span class="display-name">
                                        <bdi>
                                            <strong class="display-name__html"><?= $data['dname']; ?></strong>
                                        </bdi>
                                        <span class="display-name__account">@<?= trimMail($data['email']); ?></span>
                                    </span>
                                </a>
                            </div>                                        
                            <div class="shared-content">                       
                                <p><?= $data['content']; ?></p>
                            </div>
                            <?php if(!empty($data['picture'])) {?>
                                <div class="shared-gallery" style="height: 180px;">
                                    <div class="shared-media" style="height: 100%; width: 100%;">
                                         <img src="../uploads/<?= $data["picture"];?>" >
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="share-footer">
                        <button class="footer-share__btn" type="submit" name="share">Share</button>
                    </div>
                </form>
            </div>
        </div>
</div>
</div>
</div>
    </div>
</body>
</html>