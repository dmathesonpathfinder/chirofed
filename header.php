<?php
$business_title = get_field('business_title', 'option');
$logo = get_field('logo', 'option');
$banner_image = get_field('banner_image');
?>

<!doctype html>
<html lang="en">
  <head>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/all.min.css" rel="stylesheet">

  </head>
  <?php wp_head(); ?>

<body <?php body_class(); ?>>

<?php get_template_part( 'includes/loginmodal' ); ?>

<section id="header">
<div class="container">
    <a href="<?php echo get_home_url(); ?>/" class="logo"><img src="<?php echo $logo['url']; ?>" alt="<?php echo $business_title; ?>"></a>
    <aside id="meta">
        <ul id="top-nav"<?php if ( is_user_logged_in() ) { echo ' class="logged-in"'; } ?>>
            <?php
            if ( current_user_can('administrator') && is_user_logged_in() ) {
                echo '<li><a href="' . get_home_url() . '/contact"><i class="fas fa-envelope"></i> Contact</a></li>';
                echo '<li><a href="' . wp_logout_url() . '"><i class="fas fa-sign-out-alt"></i> Logout</a></li>';
            } else if ( is_user_logged_in() && pll_current_language() == 'en') {
                echo '<li><a href="' . get_home_url() . '/contact"><i class="fas fa-envelope"></i> Contact</a></li>';
                echo '<li><a href="' . get_home_url() . '/member-portal"><i class="fas fa-user"></i> Member Portal</a></li>';
                echo '<li><a href="' . wp_logout_url() . '"><i class="fas fa-sign-out-alt"></i> Logout</a></li>';
            } else if ( ! is_user_logged_in() &&  pll_current_language() == 'en') {
                echo '<li><a href="' . get_home_url() . '/contact"><i class="fas fa-envelope"></i> Contact</a></li>';
               
            } else if ( is_user_logged_in() && pll_current_language() == 'fr') {
                echo '<li><a href="' . get_home_url() . '/contactez-nous/"><i class="fas fa-envelope"></i> Contactez-nous</a></li>';
                echo '<li><a href="' . wp_logout_url() . '"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>';
            } else if ( ! is_user_logged_in() && pll_current_language() == 'fr') {
                echo '<li><a href="' . get_home_url() . '/contactez-nous/"><i class="fas fa-envelope"></i> Contactez-nous</a></li>';
                echo '<li><a href="#" id="login-button"><i class="fas fa-sign-in-alt"></i> Accès Membre</a></li>';
            }
            ?>
        </ul>
        <ul id="language-select">
            <?php pll_the_languages(); ?>
        </ul>
    </aside>
    <aside id="navigation">
        <?php wp_nav_menu( array('menu' => 'Main Navigation', 'depth' => '3', 'container' => '' )); ?>
        <div id="search-box">
            <div id="search-form">
                <form action="<?php echo get_home_url(); ?>/" method="get" id="searchform">
                    <?php if (pll_current_language() == 'en') { ?>
                        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Type keyword(s) and hit 'enter' to search">
                    <?php } else if (pll_current_language() == 'fr') { ?>
                        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Appuyez sur 'Entrée' pour rechercher">
                    <?php } ?>
                    <input type="submit" id="searchsubmit" value="" style="display:none;">
                </form>
            </div>
            <a href="#" class="fas fa-search"></a>
        </div>
    </aside>
</div>
</section>