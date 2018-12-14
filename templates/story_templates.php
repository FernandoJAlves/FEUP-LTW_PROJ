<?php
  include_once('../database/dbUsers.php');
?>

<?php function draw_stories($stories) {
?>
        
    <section id="stories_content">
        
        <?php foreach ($stories as $story){ ?>
        <div>
            <a href="../pages/story.php?id=<?=$story['id']?>"> <?=$story['title']?> <br></a>
            <?php $imgPath = "../img/thumbnails/".$story['id'].".jpg";
                if(file_exists($imgPath)){ ?>
                  <img src =<?=$imgPath ?> alt="Excuse">
                <?php } ?>
            <p>Published: <?=$story['dateC']?><br></p>
            <p><?=$story['N_Comments']?> Comments<br></p>
            <?php draw_votes($story['id'],$story['votes']); ?>
            <div class="author">
                    <?php $imgPath = "../img/profiles_thumbnail/" . $story['username']. ".jpg";
                    if(!file_exists($imgPath)){
                    $imgPath = "../img/profiles_thumbnail/generic.png";
                    } ?>
                    <img src = <?=$imgPath ?> alt="Excuse">
                    <a href="../pages/profile.php?username=<?=$story['username']?>"><?=$story['username']?><br></a>
            </div>
            <br>
        </div>      
        <?php } ?>
    </section>
<?php } ?>
<!-- 



-->
<?php function draw_story($story) {

?>
    <script src="../javascript/reply.js" defer></script>
    
    <section id="stories_sec">    
        <section id="stories_content">
            <div>
                <h1><?=$story['title']?> <br></h1>
                <?php $imgPath = "../img/stories/".$story['id'].".jpg";
                if(file_exists($imgPath)){ ?>
                  <img src =<?=$imgPath ?> alt="Excuse">
                <?php } ?>
                <p><?=$story['textC']?><br></p>
                <p>Published: <?=$story['dateC']?><br></p>
                <p class="comments_count"><?=$story['N_Comments']?> Comments<br></p>
                <?php draw_votes($story['id'],$story['votes']); ?>
                <div class="author">
                    <?php $imgPath = "../img/profiles_thumbnail/" . $story['username']. ".jpg";
                    if(!file_exists($imgPath)){
                    $imgPath = "../img/profiles_thumbnail/generic.png";
                    } ?>
                    <img src = <?=$imgPath ?> alt="Excuse">
                    <a href="../pages/profile.php?username=<?=$story['username']?>"><?=$story['username']?><br></a>
                </div>
                <p data-id="<?=$story['id']?>" class="reply">Reply</p>
                <br>
            </div>      
        </section>
<?php } ?>
<!-- 



-->
<?php function draw_comments($id,$comments) {

?>
        <section id="comments_content" data-id="<?=$id?>">
        <a>Comments: </a>
        <?php if(draw_comments_recursive($id,$comments)){ ?>
            <a id="no_comments">This Story has no commentaries. Be the first one to comment.</a>
        <?php } ?>  
        </section>
    </section>
<?php } ?>
<!-- 



-->
<?php function draw_comments_recursive($id,$comments) {

?>
        <section data-id="<?=$id?>" class="comments">
        <?php if(count($comments) > 0){ ?>
            <?php foreach ($comments as $comment){ ?>
                <div>
                    <div class="author">
                    <?php $imgPath = "../img/profiles_thumbnail/" . $comment['username']. ".jpg";
                    if(!file_exists($imgPath)){
                    $imgPath = "../img/profiles_thumbnail/generic.png";
                    } ?>
                    <img src ="<?=$imgPath?>" alt="Excuse">
                    <a href="../pages/profile.php?username=<?=$comment['username']?>"><?=$comment['username']?>:<br></a>
                    </div>
                    <p><?=$comment['textC']?><br></p>
                    <p>Published: <?=$comment['dateC']?><br></p>
                    <p data-id="<?=$comment['id']?>" class="reply">Reply</p>
                </div>      
                <?php $new_comments = getComments($comment['id']);
                draw_comments_recursive($comment['id'],$new_comments);
            };       
            echo "</section>";
            return false; ?>
        <?php } else{ 
            echo "</section>";
            return true;}}?>



<?php function draw_votes($idStory,$num) {

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $user = getUser($username);
        $userId = $user['idUser'];
        $ret = getVote($idStory,$userId);
        $value = $ret['voteVal']; 
        if($value == false){
        $upvote = "../img/utilities/upvotegrey.png";
        $downvote = "../img/utilities/downvotegrey.png";
        }
        else if($value =="1"){
            $upvote = "../img/utilities/upvote.png";
            $downvote = "../img/utilities/downvotegrey.png";
        }
        else if($value =="-1"){
            $upvote = "../img/utilities/upvotegrey.png";
            $downvote = "../img/utilities/downvote.png";
        }
    }
    else{
        $username = "null";
        $upvote = "../img/utilities/upvotegrey.png";
        $downvote = "../img/utilities/downvotegrey.png";
    }
?>
<script src="../javascript/votes.js" defer></script>

    <img class="up-vote"  data-id="<?=$idStory?>" data-user="<?=$username?>" src = "<?=$upvote?>" alt="Upvote" width="20" height="20">
    <a class="vote-number" data-id="<?=$idStory?>"><?=$num?></a>
    <img class="down-vote"  data-id="<?=$idStory?>" data-user="<?=$username?>" src = "<?=$downvote?>" alt="Downvote" width="20" height="20">
            
<?php } ?>