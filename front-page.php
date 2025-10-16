<?php
    get_header();

    $banner_image = get_field('banner_image');
    $banner_heading = get_field('banner_heading');
    $banner_text = get_field('banner_text');
    $banner_button = get_field('banner_button');

    $whoweare_heading = get_field('whoweare_heading');
    $whoweare_text = get_field('whoweare_text');
    $whoweare_button = get_field('whoweare_button');

    $goals_image = get_field('goals_image');
    $goals_heading = get_field('goals_heading');
    $goals_subheading = get_field('goals_subheading');
    $goals_button = get_field('goals_button');
?>

<section id="banner">
<?php
if($banner_image) {
    echo '<img src="' . $banner_image['url'] . '" alt="' . $banner_heading . '">';
}
?>
<div class="wrapper">
    <div class="container">
        <?php
        if($banner_heading) {
            echo '<h1>' . $banner_heading . '</h1>';
        }

        if($banner_text) {
            echo '<p>' . $banner_text . '</p>';
        }

        if($banner_button) {
            echo '<a href="' . $banner_button['url'] . '" class="button" target="' . $banner_button['target'] . '">' . $banner_button['title'] . '</a>';
        }
        ?>
    </div>
</div>
</section>

<section id="main" class="intro">
<div class="container">
    <?php
    if($whoweare_text) {
        echo $whoweare_text;
    }

    if($whoweare_button) {
        echo '<a href="' . $whoweare_button['url'] . '" class="button" target="' . $whoweare_button['target'] . '">' . $whoweare_button['title'] . '</a>';
    }
    ?>
</div>
</section>

<section id="main" class="goals">
<img src="<?php echo get_template_directory_uri(); ?>/images/bg-img-goals.jpg" alt="" class="bg-img">
<div class="container">
    <?php
    if($goals_heading) {
        echo '<h2>' . $goals_heading . '</h2>';
    }

    if($goals_subheading) {
        echo '<h3>' . $goals_subheading . '</h3>';
    }

    if( have_rows('add_blocks') ):

    echo '<div class="blocks col-3">';

      while ( have_rows('add_blocks') ) : the_row();

        $block_icon = get_sub_field('block_icon');
        $block_text = get_sub_field('block_text');

        echo '<aside>';
        echo '<i class="fas fa-' . $block_icon . '"></i>';
        echo '<p>' . $block_text . '</p>';
        echo '</aside>';

      endwhile;

    echo '</div>';

    endif;

    if($goals_button) {
        echo '<a href="' . $goals_button['url'] . '" class="button" target="' . $goals_button['target'] . '">' . $goals_button['title'] . '</a>';
    }
    ?>
</div>
</section>

<?php
  get_footer();
?>
