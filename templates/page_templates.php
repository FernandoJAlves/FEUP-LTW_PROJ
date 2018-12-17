<?php
  include_once('../includes/session.php');
  include_once('../database/dbQueries.php');
?>


<?php function draw_header($username) { 
/**
 * Draws the header for all pages. Receives an username
 * if the user is logged in in order to draw the logout
 * link.
 */?>
  <!DOCTYPE html>
  <html lang="en-US">
    <head>
      <title>GameIt</title>    
      <meta charset="UTF-8">
      <link rel="shortcut icon" href="../img/utilities/favicon.ico">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="../css/style.css" rel="stylesheet">
      <link href="../css/layout.css" rel="stylesheet">
      <link href="../css/profile.css" rel="stylesheet">
      <script src="../javascript/security.js" defer></script>
    </head>
    <body>
      <header>
        <h1><a href="home.php">GameIt</a></h1>
        <?php if ($username == NULL) { ?>
        <div id="signup">
          <div id="signupButtons">
            <button onclick="window.location.href='register.php'">Register</button>
            <button onclick="window.location.href='login.php'">Login</button>
          </div>
        <?php } 
        else { ?>
        <div id="session">
          <div>
          <?php $imgPath = "../img/profiles_thumbnail/" . $username. ".jpg";
          if(!file_exists($imgPath)){
            $imgPath = "../img/profiles_thumbnail/generic.png";
          } ?>
          <img src = <?=$imgPath ?> alt="Excuse">
          <a href="profile.php?username=<?=$username?>"><?= $username?></a>
          </div>
          <button onclick="window.location.href='../actions/action_logout.php'">Logout</button>
        </div>
        <?php } ?>
        <div id="searchBar">
          <form id="searchform" action="../pages/search.php" method="post">
            <input type="text" name="pattern" required>
            <input type="submit" value="Search">
          </form>
        </div>
      </header>
      <nav id="menu">
          <a href="home.php">Home</a>
          <a href="recent.php">Recent Section</a>
          <a href="hot.php">Hot Section</a>
          <a href="contro.php">Controversial Section</a>
      </nav>

<?php } ?>


<?php function draw_home() {

?>
    <section id="home_content">
      <article>
        <h1>GameIt</h1>
        <p>This website focuses on discussions about video games. Please don't be rude to other users</p>
      </article>        
    </section>


<?php } ?>

<?php function draw_login() {

?>

       <section id="login_content">
          <form action="../actions/action_login.php" method="post">
              <label> Username: </label> <input type="text" name="name">
              <label> Password: </label> <input type="password" name="pass">
              <input type="submit" value="Sign In">
          </form>    
          <?php if(isset($_SESSION['messages'])){?>
          <div><label id="message"><?=$_SESSION['messages']?></label></div>
          <?php }?>  
      </section>
<?php } ?>


<?php function draw_register() {

?>
  <script src="../javascript/register.js" defer></script>
    <section id="register_content">
        <form action="../actions/action_register.php" method="post">
            <label> Username: </label> <input type="text" name="name" required>
            <label> Age: </label> <input type="number" min="0" name="age" required>
            <label> E-mail: </label> <input type="email" name="email" required>
            <label> Password: </label> <input type="password" name="pass" required>
            <label> Confirm Password: </label> <input type="password" name="conf" required>
            <input type="submit" value="Sign Up">
        </form> 
        <?php if(isset($_SESSION['messages'])){?>
          <div><label id="message"><?=$_SESSION['messages']?></label></div>
        <?php }?>
             
    </section>
<?php } ?>


<?php function draw_profile($user) {

?>
    <section id="profile_content">
      <article>
        <?php if(isset($_SESSION['username'])){
        if($user['username'] == $_SESSION['username']){ ?>
        <a href="edit_profile.php">Edit Profile</a>
        <?php }} ?>
        <h1><?=$user['username']?></h1>
        <?php $imgPath = "../img/profiles/" . $user['username']. ".jpg";
        if(!file_exists($imgPath)){
          $imgPath = "../img/profiles/generic.png";
        }
        ?>
        <img src = <?=$imgPath ?> alt="Excuse">
        <p>E-mail: <?=$user['email']?></p>
        <p>Age: <?=$user['age']?></p>
        <p>Gameit Points: <?=$user['n_points']?></p>
        <p>Description: <?=$user['descriptionUser']?></p>
        </article> 
        <section id="activities">
          <h2>Activities</h2>
          <?php $commentables = getCommentables($user['idUser']); 
            foreach($commentables as $commentable){
              if($story = getStory($commentable['id'])){ ?>
                <div class="story">
                  <a href="../pages/story.php?id=<?=$story['id']?>"> <?=$story['title']?> <br></a>
                  <?php $imgPath = "../img/thumbnails/".$story['id'].".jpg";
                      if(file_exists($imgPath)){ ?>
                        <img src =<?=$imgPath ?> alt="Excuse">
                      <?php } ?>
                  <p><?=$story['N_Comments']?> Comments<br></p>
                  <p>Published: <?=$story['dateC']?><br></p>
                </div>                    
              <?php }
              else if ($comment = getComment($commentable['id'])){ 
                $story = getCommentStory($comment['id']) ?>
                <div class="comment"> 
                    <a href="../pages/story.php?id=<?=$story['id']?>">In Story: <?= $story['title']?> <br></a>
                    <p><?=$comment['textC']?><br></p>
                    <p>Published: <?=$comment['dateC']?><br></p>   
                </div>
              <?php }
            }
          ?>
        </section>
             
    </section>


<?php } ?>

<?php function draw_edit_profile($user) {

?>
<script src="../javascript/image.js" defer></script>
    <section id="profile_editor">
    <h1><?=$user['username']?></h1>
      <form id="editform" action="../actions/action_edit_profile.php" method="post" enctype="multipart/form-data">
        <?php $imgPath = "../img/profiles/" . $user['username']. ".jpg";
        if(!file_exists($imgPath)){
          $imgPath = "../img/profiles/generic.png";
        }
        ?>
        <img src = <?=$imgPath ?> alt="Excuse" class="imgProfile">
        <p>Change Profile Image: <Input class="imgInput" type="file" name="image"><p>
        <p>E-mail Address:  <input type="text" name="email" value="<?=$user['email']?>"></p>
        <p>Age: <input type="text" name="age" value="<?=$user['age']?>"></p>
        <textarea name="description" id="editform" cols="100" rows="10" ><?=$user['descriptionUser']?></textarea>
        <input type="submit" value="Save changes">
      </form>        
    </section>


<?php } ?>

<?php function draw_footer() {

?>
          <footer>
          <p>&copy; GameIt, 2018/2019</p>
        </footer>
      </body>
    </html>

<?php } ?>

<?php function draw_aside() {

?>
    <aside>
    <?php if(isset($_SESSION['username'])){ ?>
      <div id="create_post" onclick="location.href='create_post.php';">
        <a>Create a post</a>
      </div>
    <?php } ?>

  <?php if(basename($_SERVER['PHP_SELF']) != 'home.php'){ ?>
      <div id="links">
        <div id="home" onclick="location.href='home.php';">
          <a href="home.php">Home</a>
        </div>
        <div id="top" onclick="location.href='#';">
          <a href="#">Top</a>
        </div> 
      </div>
  <?php } ?>
    </aside>
<?php } ?>


<?php function draw_create_post() {

?>
<script src="../javascript/image.js" defer></script>
<section id="post_content">
        <form id="postform" action="../actions/action_add_story.php" method="post" enctype="multipart/form-data">
            <div><input id="title_input" type="text" name="title" placeholder="Insert Title" required><br></div>    
            <img src = "" class="imgProfile">
            <p>Story Image: <Input class="imgInput" type="file" name="image"></p>
            <br>
            <!--<a>Write you story:<br><br></a>-->
            <textarea name="story" id="postform" cols="100" rows="10" placeholder="Enter text here..."></textarea>
            <br>
            <input id="post_input" type="submit" value="Post">
        </form>      
        
    </section>
<?php } ?>


<?php function draw_not_found() {

?>
    <section id="not_found_content">
      <div>
        <p>Error 404: page not found</p>
      </div>       
    </section>
<?php } ?>