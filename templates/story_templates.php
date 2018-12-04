<?php function draw_stories($stories) {

?>
    <section id="stories_content">
        <?php for($i = 0; $i < 10 && $i < count($stories); $i++){ ?>
        <div>
            <p><?=$stories[$i]['textC']?> <br></p>
            <p><?=$stories[$i]['dateC']?><br></p>
        </div>      
        <?php } ?>
    </section>
<?php } ?>