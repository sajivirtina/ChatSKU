<?php
/**
 * Template Name: Black Canvas
 * Template Post Type: page
 *
 * No header, no footer. Black background. Elementor-ready.
 * Use for campaign / funnel pages that need a clean dark canvas.
 *
 * @package ChatSKU
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <style>
    /* ── Black canvas base ─────────────────────────────────── */
    html, body {
      background-color: #000 !important;
      margin: 0;
      padding: 0;
    }

    /* ── Full-width Elementor layout ───────────────────────── */
    .chatsku-black-canvas-content {
      padding: 0;
      margin: 0;
      width: 100%;
    }

    /* ── White-section utility (optional Elementor CSS class) ─ */
    /* Assign CSS class "white-section" to any Elementor section */
    /* for a clean white panel inside the black layout.          */
    .elementor-section.white-section,
    .e-con.white-section {
      background-color: #ffffff !important;
      color: #111111;
    }
    .elementor-section.white-section *,
    .e-con.white-section * {
      color: inherit;
    }

    /* ── Expose ChatSKU brand tokens to Elementor ──────────── */
    :root {
      --e-global-color-chatsku-accent:    #00C9B1;
      --e-global-color-chatsku-bg:        #0f172a;
      --e-global-color-chatsku-secondary: #1e293b;
      --e-global-color-chatsku-text:      #f8fafc;
      --e-global-color-chatsku-muted:     #94a3b8;
    }
  </style>
</head>
<body <?php body_class( 'chatsku-black-canvas' ); ?>>
<?php wp_body_open(); ?>

<main id="main" class="chatsku-black-canvas-content" role="main">
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) :
      the_post();
      the_content();
    endwhile;
  endif;
  ?>
</main>

<?php wp_footer(); ?>
</body>
</html>
