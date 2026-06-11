<?php
/**
 * Search Results Template
 *
 * @package ChatSKU
 */

get_header();
?>

<main id="main" class="chatsku-main search-main">

    <section class="page-hero section-padding" style="padding-bottom: var(--space-8);">
        <div class="container text-center">
            <span class="section-head__eyebrow">Search</span>
            <h1 class="section-head__title">
                <?php if ( get_search_query() ) : ?>
                    Results for: <em><?php echo esc_html( get_search_query() ); ?></em>
                <?php else : ?>
                    Search
                <?php endif; ?>
            </h1>
            <div style="margin-top: var(--space-6); max-width: 480px; margin-left: auto; margin-right: auto;">
                <?php get_search_form(); ?>
            </div>
        </div>
    </section>

    <section class="search-results section-padding" style="padding-top: 0;">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <div class="grid-3">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/blog/post-card' ); ?>
                    <?php endwhile; ?>
                </div>
                <div style="margin-top: var(--space-12); display: flex; justify-content: center;">
                    <?php the_posts_pagination( [ 'prev_text' => '← Prev', 'next_text' => 'Next →' ] ); ?>
                </div>
            <?php else : ?>
                <div style="text-align: center; padding: var(--space-16) 0;">
                    <h2 style="color: var(--color-text-muted); margin-bottom: var(--space-4);">No results found</h2>
                    <p style="color: var(--color-text-faint); margin-bottom: var(--space-8);">Try a different search term.</p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="chatsku-btn chatsku-btn--secondary">← Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
