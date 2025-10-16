<?php
$business_title = get_field('business_title', 'option');
?>

<footer id="footer">
<div class="container">
    <a href="<?php echo get_home_url(); ?>/"><img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.jpg" alt="<?php echo $business_title; ?>"></a>
    <aside>
        <?php
        if (pll_current_language() == 'en') { ?>
            <p>Chiropractor, Chiropractic and Doctor of Chiropractic are Official Marks of the Federation of Canadian Chiropractic.</p>
            <p>&copy; <?php echo date('Y'); ?> Federation of Canadian Chiropractic. All Rights Reserved.</p>
        <?php } else if (pll_current_language() == 'fr') { ?>
            <p>Chiropraticien, chiropratique et docteur en chiropratique sont des marques officielles de la Fédération chiropratique canadienne.</p>
            <p>&copy; <?php echo date('Y'); ?> Fédération chiropratique canadienne. Tous les droits sont réservés.</p>
        <?php } ?>
    </aside>
</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>