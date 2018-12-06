<?php
  include_once('../templates/page_templates.php');
  include_once('../templates/story_templates.php');
  include_once('../database/dbQueries.php');
  draw_header($_SESSION['username']);
  $stories = hotStories();
  draw_stories($stories);
  draw_aside();
  draw_footer();

?>