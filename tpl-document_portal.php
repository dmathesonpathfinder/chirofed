<?php
/* Template Name: Member Portal */
get_header();
?>

<?php get_template_part( 'includes/interiorbanner' ); ?>

<?php

$title_board = get_field('title_board');
$title_executive = get_field('title_executive');
$title_regulatory = get_field('title_regulatory');
$dotitle_scccument = get_field('title_scc');
$title_ccec = get_field('title_ccec');
$title_aspc = get_field('title_aspc');
$title_saspc = get_field('title_saspc');

$user_roles = $current_user->roles;
$user_role = array_shift($user_roles);

if ($user_role == 'board') {
    $user_role_name = 'Board Member';
} elseif ($user_role == 'executive') {
    $user_role_name = 'Executive Member';
} elseif ($user_role == 'regulatory_council') {
    $user_role_name = 'Regulatory Council Member';
} elseif ($user_role == 'speciality_colleges_council') {
    $user_role_name = 'Speciality Colleges Council Member';
} elseif ($user_role == 'ccec') {
    $user_role_name = 'Council on Chiropractic Education Canada Member';
} elseif ($user_role == 'aspc') {
    $user_role_name = 'Accreditation Standards Policy Committee Member';
} elseif ($user_role == 'saspc') {
    $user_role_name = 'Specialty Accreditation Standards and Policies Committee Member';
}

echo '<section class="main" id="document-portal">';
echo '<div class="container">';

    echo '<section id="secondary">';
        echo '<div class="profile"><span>' . $user_role_name . '</span><img src="' . get_template_directory_uri() . '/images/profile-img.jpg" alt="' . $user_role_name . '"></div>';
        echo '<div class="buttons">';
        if ( is_page('member-portal') ) {
            echo '<a href="' . get_home_url() . '/member-portal/" class="active">Documents</a>';
        } else {
            echo '<a href="' . get_home_url() . '/member-portal/">Documents</a>';
        }
        echo '<a href="' . wp_logout_url() . '">Logout</a>';
        echo '</div>';
    echo '</section>';

    echo '<section id="primary">';

        if ( is_user_logged_in() ) {
            global $current_user;

            // if user role is board
            if( in_array('board', $current_user->roles) ) {

                if( have_rows('add_documents_board') ):
                    echo '<h3>' . $title_board . '</h3>';

                    echo '<ul class="titles">';
                        echo '<div>Document Title</div>';
                        echo '<div>Published Date</div>';
                        echo '<div>File Size</div>';
                        echo '<div>Actions</div>';
                    echo '</ul>';

                    echo '<ul class="documents">';
                        while( have_rows('add_documents_board') ): the_row();

                            $document = get_sub_field('document');
                            $document_date = get_the_date();
                            $document_id = $document['id'];
                            $document_icon = $document['icon'];
                            $document_size = filesize( get_attached_file( $document_id ) );
                            $document_size = size_format( $document_size, 2 );

                            echo '<li>';

                                echo '<div>';
                                    echo '<img src="' . esc_attr($document_icon) . '" alt="' . $document['title'] . '">';
                                    echo '<p><a href="' . $document['url'] . '" target="_blank">' . $document['title'] . '</a></p>';
                                echo '</div><div>';
                                    echo '<span>' . $document_date . '</span>';
                                echo '</div><div>';
                                    if ($document_size) {
                                        echo '<span>' . $document_size . '</span>';
                                    } else {
                                        echo '<span>Unknown</span>';
                                    }
                                echo '</div><div class="buttons">';
                                    echo '<a href="' . $document['url'] . '" target="_blank" class="button download" download><i class="fas fa-download"></i><span>Download</span></a>';
                                    echo '<a href="' . $document['url'] . '" target="_blank" class="button"><i class="fas fa-eye"></i><span>View</span></a>';
                                echo '</div>';

                            echo '</li>';

                        endwhile;
                    echo '</ul>';
                endif;
            }

            // if user role is executive








        } else {
            echo '<h4 style="text-align:center;">Sorry, you must be <a href="' . get_home_url() . '/login.php">logged in</a> to view this content.</h4>';
        }

    echo '</section>';

echo '</div>';
echo '</section>';
?>

<?php
  get_footer();
?>
