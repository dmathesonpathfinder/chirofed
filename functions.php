<?php

/**=========================
  Custom stylesheets and javascripts
============================**/

function custom_enqueue_style() {
  wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), '1.0', 'all');
  wp_enqueue_style('customcss', get_template_directory_uri() . '/css/style.css', array(), '0.1', 'all');
}
function custom_enqueue_script() {
  wp_enqueue_script('customjui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '0.1', true);
  wp_enqueue_script('customjs', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '0.1', true);

  if ( is_front_page() ) {
    wp_enqueue_script('rotator', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'), '0.1', true);

  }
}

add_action('wp_enqueue_scripts', 'custom_enqueue_style');
add_action('wp_enqueue_scripts', 'custom_enqueue_script');


/**=========================
  Add custom styles to WP dashboard
============================**/

// Add styles to acf fields

function rem_acf_admin_head() { ?>
  <style type="text/css">
  .acf-input hr{
  border:0;
  border-top:3px solid var(--wp-admin-theme-color);
  }
  .acf-button .dashicons-plus-alt{
  margin-top:4px;
  }
  </style>
<?php }

add_action('acf/input/admin_head', 'rem_acf_admin_head');

// Add styles to tinymce editor

function rem_theme_add_editor_styles() {
  //Get the theme directory
  $theme_dir = get_template_directory_uri();

  add_editor_style( $theme_dir . '/css/wp-editor-styles.css' );
}
add_action( 'admin_init', 'rem_theme_add_editor_styles' );

// Remove h1 tags from tinymce editor

function rem_remove_tinymce_heading( $in ) {
        $in['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6;";
    return $in;
}
add_filter( 'tiny_mce_before_init', 'rem_remove_tinymce_heading' );

/**=========================
  Navigations
============================**/

function custom_theme_setup() {
  // Block theme support
  add_theme_support('block-templates');
  add_theme_support('block-template-parts');
  
  // Standard theme supports
  add_theme_support('menus');
  add_theme_support('post-thumbnails');
  add_theme_support('title-tag');
  add_theme_support('wp-block-styles');
  add_theme_support('responsive-embeds');
  add_theme_support('editor-styles');
  add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

  register_nav_menu('Main Navigation', 'Main Navigation');
}

add_action('init', 'custom_theme_setup');

/**=========================
  Remove hardcoded width and height on featured images
============================**/

function remove_img_attr($html) {
  return preg_replace('/(width|height)="\d+"\s/', "", $html);
}

add_filter('post_thumbnail_html', 'remove_img_attr');

set_post_thumbnail_size(420, 420);

/**=========================
  Customize excerpt length
============================**/

function custom_excerpt_length($length){
return 60;
}
add_filter('excerpt_length', 'custom_excerpt_length');

/**=========================
  Add custom REM banner to WP dashboard
============================**/

function customContent() {
  echo '
  <div id="rem-header">
    <a href="http://www.redearmedia.ca" target="_blank" class="rem-logo"><img src="https://www.redearmedia.ca/wp-content/themes/redearmedia/images/rem-logo.svg" alt="Red Ear Media"></a>
    <aside>
      <h3>Have A Question? Need A Hand?</h3>
      <h4>Tell Us How We Can Help!</h4>
    </aside>
    <hr>
    <ul class="contact-info">
      <li><a href="tel:902.410.1971"><i class="fas fa-phone"></i> 902.410.1971</a></li>
      <li><a href="mailto:info@redearmedia.ca"><i class="fas fa-envelope"></i> info@redearmedia.ca</a></li>
    </ul>
  </div>

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet" type="text/css">
  <link href="' . get_template_directory_uri() . '/css/rem-banner.css" rel="stylesheet" type="text/css">
  ';
}

function add_customDashboardWidget() {
  wp_add_dashboard_widget('rem-banner', 'REM Banner', 'customContent');
}

add_action('wp_dashboard_setup', 'add_customDashboardWidget' );

/**=========================
  Add ACF Options Page
============================**/

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

/**=========================
  Add SVG support
============================**/

function rem_custom_mime_types( $mimes ) {

// New allowed mime types.
$mimes['svg'] = 'image/svg+xml';

// Optional. Remove a mime type.
unset( $mimes['exe'] );

return $mimes;
}
add_filter( 'upload_mimes', 'rem_custom_mime_types' );

/**=========================
  Add custom pagination
============================**/

function custom_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/**=========================
  Remove menu items in dashboard
============================**/

add_action('admin_menu', 'remove_posts_menu');
function remove_posts_menu()
{
    remove_menu_page('edit-comments.php');
}


/**=========================
  Redirect custom user toles to member portal page
============================**/

function rem_login_redirect( $redirect_to, $request, $user ) {
    // is there a user to check?
    if (isset($user->roles) && is_array($user->roles)) {
        //c heck for our custom roles
        if ( ! in_array('administrator', $user->roles)) {
            // redirect them to another URL
            $redirect_to =  get_home_url() . '/member-portal';
        }
    }

    return $redirect_to;
}

add_filter( 'login_redirect', 'rem_login_redirect', 10, 3 );

/**=========================
  Remove 'protected:' text protected pages/posts
============================**/

add_filter( 'protected_title_format', 'remove_protected_text' );
function remove_protected_text() {
return __('%s');
}

/**=========================
  Change default login form logo
============================**/

function my_login_logo() {
  $logo_url = get_field('logo', 'option');
  $logo_id = $logo_url['id'];
  $metadata = wp_get_attachment_metadata($logo_id);
  $width = $metadata['width'];
  $height = $metadata['height'];
  ?>
    <style type="text/css">
        #login h1 a, .login h1 a{
        background-image:url(<?php echo $logo_url['url']; ?>);
        width:<?php echo $width; ?>px;
        height:<?php echo $height; ?>px;
        max-width:100%;
        background-size:auto;
        background-repeat:no-repeat;
        padding-bottom:10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/**=========================
  Change default login form background
============================**/

function my_login_bg() { ?>
    <style type="text/css">
        body.login:after{
        content:'';
        position:absolute;
        top:0;
        z-index:-1;
        width:100%;
        height:100%;
        background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/screenshot.png);
        background-repeat:no-repeat;
        background-size:cover;
        filter:blur(11px);
        opacity:0.4;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_bg' );

// change the login logo link to home url
function mb_login_url() {  return home_url(); }
add_filter( 'login_headerurl', 'mb_login_url' );

// change the alt text on the login logo to show site name
function mb_login_title() { return get_option( 'blogname' ); }
add_filter( 'login_headertitle', 'mb_login_title' );

/**=========================
  Change default dashboard footer text
============================**/

function rem_remove_footer_admin () {
	echo '<span id="footer-thankyou">' . wp_get_theme() . ' theme designed and built by <a href="https://www.redearmedia.ca/" target="_blank">Red Ear Media</a></span>';
}
add_filter( 'admin_footer_text', 'rem_remove_footer_admin' );

/**=========================
Add 'strong text' to specific page templates
============================**/

add_filter( 'display_post_states', 'ecs_add_post_state', 10, 2 );
function ecs_add_post_state( $post_states, $post ) {
    if( ('page' == get_post_type($post->ID)) && ('tpl-landing-page.php' == get_page_template_slug($post->ID)) ) {
        $post_states[] = 'Landing Page';
    }
    return $post_states;
}

?>