<?php function draw_stories($stories) {

?>
    <section id="stories_content">
        <?php foreach ($stories as $story){ ?>
        <div>
            <p><?=$story['title']?> <br></p>
            <p><?=$story['textC']?><br></p>
            <p>Published: <?=$story['dateC']?><br></p>
            <p><?=$story['N_Comments']?> Comments<br></p>
            <br>
        </div>      
        <?php } ?>
    </section>
<?php } ?>