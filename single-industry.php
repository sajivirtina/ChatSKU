<?php
/**
 * Single Industry — landing page template.
 *
 * Renders the Elementor-built content for an industry landing page at
 * /industry/{slug}/. Uses the full site header and footer (unlike single-demo.php
 * which is a header/footer-free canvas).
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="chatsku-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php get_footer(); ?>
