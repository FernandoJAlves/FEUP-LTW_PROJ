<?php function draw_stories($stories) {

?>
    <section id="stories_content">
        <?php foreach ($stories as $story){ ?>
        <div>
            <a href="../pages/story.php?id=<?=$story['id']?>"> <?=$story['title']?> <br></a>
            <p><?=$story['textC']?><br></p>
            <p>Published: <?=$story['dateC']?><br></p>
            <p><?=$story['N_Comments']?> Comments<br></p>
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
        </div>      
    <?php } ?>
    </section>
<?php } ?>