<?php
  get_header();
?>

<?php get_template_part( 'includes/interiorbanner' ); ?>

<section id="main">
<div class="container">

  <?php
  if (pll_current_language() == 'en') { ?>
      <h3 style="text-align:center;">It looks like you found a page or post that doesn't exist</h3>
      <h4 style="text-align:center;">Please try one of the menu options above, or search using keywords.</h4>
  <?php } else if (pll_current_language() == 'fr') { ?>
      <h3 style="text-align:center;">Il semble que vous ayez trouvé une page ou un article qui n'existe pas</h3>
      <h4 style="text-align:center;">Essayez l'une des options de menu ci-dessus ou effectuez une recherche à l'aide de mots-clés.</h4>
  <?php } ?>

  <div id="search-box" class="centered">
    <div id="search-form">
        <form action="<?php echo get_home_url(); ?>/" method="get">
            <?php
            if (pll_current_language() == 'en') { ?>
                <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Type keyword(s) and hit 'enter' to search">
            <?php } else if (pll_current_language() == 'fr') { ?>
                <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Appuyez sur 'Entrée' pour rechercher">
            <?php } ?>
            <input type="submit" id="searchsubmit" value="" style="display:none;">
        </form>
    </div>
  </div>

</div>
</section>

<?php
  get_footer();
?>
