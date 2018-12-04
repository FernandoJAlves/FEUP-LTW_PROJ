<?php
  include_once('../includes/session.php');
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
      <link rel="shortcut icon" href="../img/favicon.ico">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="../css/style.css" rel="stylesheet">
      <link href="../css/layout.css" rel="stylesheet">
    </head>
    <body>
      <header>
        <h1><a href="home.html">GameIt</a></h1>
        <div id="signup">
          <div>
          <a href="register.html">Register</a>
          </div>
          <div>
          <a href="login.html">Login</a>
          </div>
        </div>
      </header>
      <nav id="menu">
          <a href="home.html">Home</a>
          <a href="recent.html">Recent Section</a>
          <a href="hot.html">Hot Section</a>
          <a href="contro.html">Controversial Section</a>
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
          <form action="login.php" method="post">
              Username: <input type="text" name="name"><br>
              Password: <input type="password" name="pass"><br>
              <input type="submit" value="Sign In">
          </form>      
      </section>
<?php } ?>


<?php function draw_register() {

?>
    <section id="register_content">
        <form action="../actions/action_register.php" method="post">
            <div>Username: <input type="text" name="name"><br></div>
            <div>Age: <input type="text" name="age"><br></div>
            <div>E-mail: <input type="text" name="email"><br></div>
            <div>Password: <input type="password" name="pass"><br></div>
            <div>Confirm Password: <input type="password" name="conf"><br></div>
            <input type="submit" value="Sign Up">
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
