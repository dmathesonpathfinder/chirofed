<?php /* Template Name: Member Portal */ ?>

<?php
  get_header();
?>

<?php get_template_part( 'includes/interiorbanner' ); ?>

<?php

    echo '<section class="main">';
    echo '<div class="container">';
      the_content();
    echo '</div>';
    echo '</section>';

?>

<?php
  get_footer();
?>
