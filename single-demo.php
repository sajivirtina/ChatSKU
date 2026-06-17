<?php
/**
 * Single Demo (post type: demo) — header/footer-free white canvas.
 *
 * No theme header, no theme footer, white background. Renders the Elementor-built
 * page body (the_content). The live widget block is placed via the
 * [chatsku_calgary_demo] shortcode inside the content — it is not auto-rendered.
 * Mirrors page-black-canvas.php, but white and for the demo CPT.
 *
 * The widget block keeps its dark "Try it" cards; only the text that sits
 * directly on the white canvas (title / subheading) is recoloured for contrast.
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<style>
		/* ── White canvas base (overrides the dark site theme) ── */
		html, body {
			background-color: #ffffff !important;
			margin: 0;
			padding: 0;
		}
		body.demo-canvas .demo-single { width: 100%; }

		/* ── Widget header text legible on white (cards stay dark) ── */
		body.demo-canvas .cdw__title { color: #0f172a; }
		body.demo-canvas .cdw__sub   { color: #475569; }

		/* ── White-section utility for Elementor (parity w/ canvas) ── */
		.elementor-section.white-section,
		.e-con.white-section { background-color: #ffffff !important; color: #111111; }
		.elementor-section.white-section *,
		.e-con.white-section * { color: inherit; }
		.demo-template-default main#main {
		padding-top: 0;
	}
	</style>
</head>
<body <?php body_class( 'demo-canvas' ); ?>>
<?php wp_body_open(); ?>

<main id="main" class="chatsku-main demo-single" role="main">
	<?php
	while ( have_posts() ) :
		the_post();

		// The widget block is placed via the [chatsku_calgary_demo] shortcode
		// inside the Elementor content — it is no longer auto-rendered at the top.
		the_content();
	endwhile;
	?>
</main>

<?php wp_footer(); ?>
</body>
</html>
