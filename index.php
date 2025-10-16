<?php
	get_header();
?>

<?php get_template_part( 'includes/banner' ); ?>

<section id="main">
<div class="container">

	<section class="blocks posts">

	<?php if (have_posts()): while (have_posts()): the_post(); ?>

		<aside class="post-block">
			<?php
			$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'large');
			$excerpt = get_field('excerpt');

            if( has_post_thumbnail() ) {
        		echo '<a href=" ' . get_permalink() . ' ">';
				echo '<img src=" ' . $featured_img_url . ' ">';
				echo '</a>';
            }
			?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php echo $excerpt; ?>
			<hr>
			<a href="<?php the_permalink(); ?>" class="button small">Read More</a>
        </aside>

	<?php endwhile; else: echo '<p>Sorry, no posts were found. Please check back later.</p>'; endif; ?>

    </section>

</div>
</section>

<?php
  get_footer();
?>