<?php
	get_header();
?>

<?php get_template_part( 'includes/interiorbanner' ); ?>

<section id="main" class="search-results">
<div class="container">

    <?php if ( have_posts() ) : ?>

    <?php
    if (pll_current_language() == 'en') { ?>
        <h2>Showing Results for: <span><?php echo get_search_query(); ?></span></h2>
    <?php } else if (pll_current_language() == 'fr') { ?>
        <h2>Affichage des résultats pour: <span><?php echo get_search_query(); ?></span></h2>
    <?php } ?>

	  <?php while ( have_posts() ) : the_post(); ?>

        <div class="archive-block">

            <h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php the_excerpt(); ?>
            <?php
            if (pll_current_language() == 'en') { ?>
                <a href="<?php echo get_permalink(); ?>" class="button">Read More</a>
            <?php } else if (pll_current_language() == 'fr') { ?>
                <a href="<?php echo get_permalink(); ?>" class="button">Lire la suite</a>
            <?php } ?>

        </div>

    <?php endwhile;

    else : ?>

        <?php
        if (pll_current_language() == 'en') { ?>
            <h2><?php _e( 'Nothing Found' ); ?></h2>
            <div class="contents">
              <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.' ); ?></p>
            </div>
        <?php } else if (pll_current_language() == 'fr') { ?>
            <h2><?php _e( "rien n'a été trouvé" ); ?></h2>
            <div class="contents">
              <p><?php _e( "Désolé, mais aucun résultat ne convient à vos critères de recherche. Veuillez réessayer avec d'autres mots-clés." ); ?></p>
            </div>
        <?php } ?>


    <?php endif; ?>

</div>
</section>

<?php
  get_footer();
?>
