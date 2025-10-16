<?php
$banner_image = get_field('banner_image', 51);
?>

<section id="banner">
<?php
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
if( has_post_thumbnail() ) { 
    echo '<img src="' . $featured_img_url . '" alt="' . get_the_title() . '">'; 
} else if ($banner_image) { 
    echo '<img src="' . $banner_image['url'] . '" alt="' . get_the_title() . '">'; 
}
?>
<div class="wrapper">
    <div class="container">
        <?php
        if (pll_current_language() == 'en') {
            if (is_home() || is_front_page()) {
                echo '<h1>Latest News</h1>';
            } else {
                echo '<h1>' . get_the_title() . '</h1>';
            }
        } else if (pll_current_language() == 'fr') {
            if (is_home() || is_front_page()) {
                echo '<h1>Dernières nouvelles</h1>';
            } else {
                echo '<h1>' . get_the_title() . '</h1>';
            }
        }
        ?>
    </div>
</div>
</section>