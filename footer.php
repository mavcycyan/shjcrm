<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sharjahsystem
 */

$curLang = (get_bloginfo("language") == 'en-US') ? 'en' : 'ar';
?>
    <?php $footer = ($curLang == 'en') ? get_field('footer', 'options') : get_field('footer_ar', 'options'); ?>
    <footer id="footer">
        <div class="container">
            <div class="offset-sm-3 col-sm-6">
                <div class="footer-title"><?php echo $footer['txt']; ?></div>
                <div class="row">
                    <div class="col-sm-4">
                        <a href="/<?php echo $curLang; ?>/sites/" class="footer-link">
                            <div class="fl-icon"><span class="icon-map"></span></div>
                            <div class="fl-title"><?php echo $footer['sites']; ?></div>
                        </a>
                    </div><!--col-sm-4-->
                    <div class="col-sm-4">
                        <a href="/<?php echo $curLang; ?>/objects/" class="footer-link">
                            <div class="fl-icon"><span class="icon-jar"></span></div>
                            <div class="fl-title"><?php echo $footer['objects']; ?></div>
                        </a>
                    </div><!--col-sm-4-->
                    <div class="col-sm-4">
                        <a href="/<?php echo $curLang; ?>/periods/" class="footer-link">
                            <div class="fl-icon"><span class="icon-rock"></span></div>
                            <div class="fl-title"><?php echo $footer['period']; ?></div>
                        </a>
                    </div><!--col-sm-4-->
                </div><!--row-->
                <div class="copyright">
                    <?php echo $footer['copy']; ?> <?php echo date('Y'); ?>
                </div>
            </div><!--col-sm-6-->
        </div><!--comtainer-->
    </footer><!--footer-->

<?php wp_footer(); ?>

</body>
</html>
