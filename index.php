<?php
// Silence is golden. This is the fallback template.
// All routing is handled by specific template files (front-page.php, page-*.php, archive.php, single.php, 404.php).
get_header();
?>
<main id="main" class="chatsku-main">
    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <div class="entry-content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; else : ?>
            <p><?php esc_html_e( 'No content found.', 'chatsku' ); ?></p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer();
