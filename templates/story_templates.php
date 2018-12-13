<?php function draw_stories($stories) {
?>
    <script src="../javascript/votes.js" defer></script>
        
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
            <img class="up-vote"  data-id="<?=$story['id']?>" src = "../img/utilities/upvote.png" alt="Upvote" width="20" height="20">
            <a class="vote-number" data-id="<?=$story['id']?>"><?=$story['votes']?></a>
            <img class="down-vote"  data-id="<?=$story['id']?>" src = "../img/utilities/downvote.png" alt="Downvote" width="20" height="20">
            <div class="author">
                    <?php $imgPath = "../img/profiles_thumbnail/" . $story['username']. ".jpg";
                    if(!file_exists($imgPath)){
                    $imgPath = "../img/profiles_thumbnail/generic.png";
                    } ?>
                    <img src = <?=$imgPath ?> alt="Excuse">
                    <p><?=$story['username']?><br></p>
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
    <script src="../javascript/votes.js" defer></script>
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
                <p><?=$story['N_Comments']?> Comments<br></p>
                <img class="up-vote"  data-id="<?=$story['id']?>" src = "../img/utilities/upvote.png" alt="Upvote" width="20" height="20">
                <a class="vote-number" data-id="<?=$story['id']?>"><?=$story['votes']?></a>
                <img class="down-vote"  data-id="<?=$story['id']?>" src = "../img/utilities/downvote.png" alt="Downvote" width="20" height="20">
                
                <div class="author">
                    <?php $imgPath = "../img/profiles_thumbnail/" . $story['username']. ".jpg";
                    if(!file_exists($imgPath)){
                    $imgPath = "../img/profiles_thumbnail/generic.png";
                    } ?>
                    <img src = <?=$imgPath ?> alt="Excuse">
                    <p><?=$story['username']?><br></p>
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
                    <p><?=$comment['username']?>:<br></p>
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