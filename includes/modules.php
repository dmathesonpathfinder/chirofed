<?php

// Headings

if( get_row_layout() == 'heading' ): ?>

<?php

$header_type = get_sub_field('heading_type');
$header_text = get_sub_field('heading_text');
$header_align = get_sub_field('heading_align');
$header_open_tag = '<' . $header_type . ' align=' . $header_align . '>';
$header_close_tag = '</' . $header_type . '>';

if ($header_type):
echo '<section class="main title-block"><div class="container">';
echo $header_open_tag . $header_text . $header_close_tag;
echo '</div></section>';
endif;



// Text Columns

elseif( get_row_layout() == 'text' ):

        $text1 = get_sub_field('text_area_1');
        $text2 = get_sub_field('text_area_2');
        $text3 = get_sub_field('text_area_3');
?>

        <?php
        if( have_rows('settings') ): while( have_rows('settings') ): the_row();

                $columns = get_sub_field('columns');
                $background_color = get_sub_field('background_color');

        if($background_color == null){
                echo '<section class="main"><div class="container">';
        } else {
                echo '<section class="main" style="background-color:' . $background_color . ';padding-top:60px;margin-bottom:60px;"><div class="container">';
        }

        ?>

                <?php if( $columns == '1' ): ?>

                        <section class="rem-columns single-column">
                        <div><?php echo $text1; ?></div>
                        </section>

                <?php endif;

                if( $columns == '2' ): ?>

                        <section class="rem-columns">
                        <div><?php echo $text1; ?></div>
                        <div><?php echo $text2; ?></div>
                        </section>

                <?php endif;

                if( $columns == '3' ): ?>

                        <section class="rem-columns">
                        <div><?php echo $text1; ?></div>
                        <div><?php echo $text2; ?></div>
                        <div><?php echo $text3; ?></div>
                        </section>

                <?php endif;

        endwhile;
        endif;

        echo '</div></section>';
        ?>

<?php

// Dividers

elseif( get_row_layout() == 'divider' ):

        echo '<section class="main"><div class="container">';

        echo '<hr class="divider">';

        echo '</div></section>';

endif; ?>