<?php
	get_header();
?>

<?php get_template_part( 'includes/banner' ); ?>

<section id="main">
<div class="container">

    <?php
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'large');

      if( has_post_thumbnail() ) { echo '<img src=" ' . $featured_img_url . ' " class="alignright">'; }

      if( have_rows('modules') ) {

        while ( have_rows('modules') ) : the_row();

            get_template_part( 'includes/modules' );

        endwhile;

      } else {

        the_content();

      }

    ?>

</div>
</section>

<?php
  get_footer();
?>