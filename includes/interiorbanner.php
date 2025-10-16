<?php
$banner_image = get_field('banner_image', 51);
?>

<section id="banner" class="interior <?php if ( is_search() || is_404() ) { echo 'search-results'; } ?>">
<?php
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
if( has_post_thumbnail() ) { echo '<img src=" ' . $featured_img_url . ' " alt="' . get_the_title() . '">'; }
else { echo '<img src=" ' . $banner_image['url'] . ' " alt="' . get_the_title() . '">'; }
?>
<div class="wrapper">
    <div class="container">

        <?php
        if (pll_current_language() == 'en') {

            if ( is_404() ) {
                echo '<h1>Sorry!</h1>';
            }
            else if ( is_search() ) {
                echo '<h1>Search Results</h1>';
            }
            else {
                echo '<h1>' . get_the_title() . '</h1>';
            }

        } else if (pll_current_language() == 'fr') {

            if ( is_404() ) {
                echo '<h1>Pardon!</h1>';
            }
            else if ( is_search() ) {
                echo '<h1>Résultats de recherche</h1>';
            }
            else {
                echo '<h1>' . get_the_title() . '</h1>';
            }

        } ?>
    </div>
</div>
</section>