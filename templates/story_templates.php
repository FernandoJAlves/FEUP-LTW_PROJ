<?php function draw_stories($stories) {
?>
    <script src="../javascript/votes.js" defer></script>
        
    <section id="stories_content">
        
        <?php foreach ($stories as $story){ ?>
        <div>
            <a href="../pages/story.php?id=<?=$story['id']?>"> <?=$story['title']?> <br></a>
            <p><?=$story['textC']?><br></p>
            <p>Published: <?=$story['dateC']?><br></p>
            <p><?=$story['N_Comments']?> Comments<br></p>
            <img class="up-vote"  data-id="<?=$story['id']?>" src = "../img/upvote.png" alt="Upvote" width="20" height="20">
            <a class="vote-number" data-id="<?=$story['id']?>"><?=$story['votes']?></a>
            <img class="down-vote"  data-id="<?=$story['id']?>" src = "../img/downvote.png" alt="Downvote" width="20" height="20">
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
                <p><?=$story['textC']?><br></p>
                <p>Published: <?=$story['dateC']?><br></p>
                <p><?=$story['N_Comments']?> Comments<br></p>
                <img class="up-vote"  data-id="<?=$story['id']?>" src = "../img/upvote.png" alt="Upvote" width="20" height="20">
                <a class="vote-number" data-id="<?=$story['id']?>"><?=$story['votes']?></a>
                <img class="down-vote"  data-id="<?=$story['id']?>" src = "../img/downvote.png" alt="Downvote" width="20" height="20">
                <p data-id="<?=$story['id']?>" class="reply">Reply</p>
                <br>
            </div>      
        </section>
<?php } ?>
<!-- 



-->
<?php function draw_comments($comments) {

?>
        <section id="comments_content">
        <?php if(count($comments) > 0){ ?>
            <a>Comments: </a>
            <?php foreach ($comments as $comment){ ?>
                <div>
                    <p><?=$comment['textC']?><br></p>
                    <p>Published: <?=$comment['dateC']?><br></p>
                </div>      
            <?php } ?>
        <?php } else {?>
            <a>This Story has no commentaries. Be the first one to comment.</a>
        <?php } ?>
        </section>
    </section>
<?php } ?>