<?php
  get_header();
?>

<?php get_template_part( 'includes/interiorbanner' ); ?>

<section class="main">
    <div class="container">
        <?php the_content(); ?>
    </div>
</section>

<?php get_footer(); ?>