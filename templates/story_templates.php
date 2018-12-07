<?php function draw_stories($stories) {

?>
    <section id="stories_content">
        <?php foreach ($stories as $story){ ?>
        <div>
            <a href="../pages/story.php?id=<?=$story['id']?>"> <?=$story['title']?> <br></a>
            <p><?=$story['textC']?><br></p>
            <p>Published: <?=$story['dateC']?><br></p>
            <p><?=$story['N_Comments']?> Comments<br></p>
            <img src = "../img/upvote.png" alt="Upvote" width="20" height="20">
            <img src = "../img/downvote.png" alt="Downvote" width="20" height="20">
            <br>
        </div>      
        <?php } ?>
    </section>
<?php } ?>


<?php function draw_story($story) {

?>
    <article id="stories_content">
        <div>
            <h1><?=$story['title']?> <br></h1>
            <p><?=$story['textC']?><br></p>
            <p>Published: <?=$story['dateC']?><br></p>
            <p><?=$story['N_Comments']?> Comments<br></p>
            <img src = "../img/upvote.png" alt="Upvote" width="20" height="20">
            <img src = "../img/downvote.png" alt="Downvote" width="20" height="20">
            <br>
        </div>      
</article>
<?php } ?>


<?php function draw_comments($comments) {

?>
    <section id="comments_content">
    <a>Comments: </a>
    <?php foreach ($comments as $comment){ ?>
        <div>
            <p><?=$comment['textC']?><br></p>
            <p>Published: <?=$comment['dateC']?><br></p>
            <img src = "../img/upvote.png" alt="Upvote" width="20" height="20">
            <img src = "../img/downvote.png" alt="Downvote" width="20" height="20">
        </div>      
    <?php } ?>
    </section>
<?php } ?>