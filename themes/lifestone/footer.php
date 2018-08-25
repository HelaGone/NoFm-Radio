<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lifestone
 */

?>

</div>
<!--================= Start Footer ==================-->
<footer class="section fp-auto-height">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">

                <div class="sub-footer"><span class="copyright"><?php echo esc_html(get_theme_mod('lifestone_footer_text')); ?></span></div>

            </div><!-- end of col-xs-12 -->

        </div><!-- end of row -->

    </div><!-- end of container-->

</footer><!-- end of footer -->

</div><!-- end of wrapper opened in header -->

<?php wp_footer(); ?>

</body>
</html>
