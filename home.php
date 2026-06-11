<?php
/**
 * Blog Posts Page Template
 *
 * WordPress uses home.php (not archive.php) when a static page is set
 * as the "Posts page" in Settings > Reading.
 *
 * Template hierarchy for the blog listing:
 *   home.php → index.php
 *
 * @package ChatSKU
 */

get_header();

$is_paged = ( get_query_var( 'paged' ) > 1 );
?>

<main id="main" class="chatsku-main blog-archive-main">

    <!-- Hero — only on page 1 -->
    <?php if ( ! $is_paged ) : ?>
    <section class="blog-hero section-padding" style="padding-bottom: var(--space-12);">
        <div class="container text-center">

            <div class="blog-hero__eyebrow reveal">
                <span class="blog-eyebrow-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                    Blog
                </span>
            </div>

            <h1 class="blog-hero__title reveal reveal-delay-1">Insights for B2B Commerce</h1>
            <p class="blog-hero__subtitle reveal reveal-delay-2">Tips, guides, and product updates for manufacturers and distributors.</p>

        </div>
    </section>
    <?php else : ?>
    <!-- Minimal header on paginated pages -->
    <div style="padding-top: var(--space-10);"></div>
    <?php endif; ?>

    <!-- Posts -->
    <section class="blog-posts-section" style="padding-bottom: var(--space-20);">
        <div class="container">

            <?php
            /**
             * Single loop with a counter — avoids the WordPress have_posts()
             * auto-rewind bug that causes the first post to render twice when
             * called across multiple if/while blocks.
             */
            $loop_count = 0;
            $grid_open  = false;
            $has_posts  = have_posts();

            while ( have_posts() ) :
                the_post();
                $loop_count++;

                if ( $loop_count === 1 && ! $is_paged ) :
                    // ── Featured hero card (first post, page 1 only) ──────
                    $feat_cats = get_the_category();
                    $feat_cat  = ! empty( $feat_cats ) ? $feat_cats[0] : null;
                    $feat_rt   = chatsku_reading_time( get_the_ID() );
                    $feat_hero = chatsku_field( 'post_hero_image' );
                    ?>

                    <article class="blog-featured-post reveal" <?php post_class(); ?>>

                        <a href="<?php the_permalink(); ?>" class="blog-featured-post__image-link" tabindex="-1" aria-hidden="true">
                            <?php if ( $feat_hero && is_array( $feat_hero ) ) : ?>
                                <img src="<?php echo esc_url( $feat_hero['url'] ); ?>"
                                     alt="<?php echo esc_attr( $feat_hero['alt'] ?: get_the_title() ); ?>"
                                     class="blog-featured-post__image" loading="eager">
                            <?php elseif ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'chatsku-hero', [ 'class' => 'blog-featured-post__image', 'loading' => 'eager' ] ); ?>
                            <?php else : ?>
                                <div class="blog-featured-post__image-placeholder" aria-hidden="true">
                                    <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </a>

                        <div class="blog-featured-post__body">
                            <div class="blog-featured-post__meta">
                                <?php if ( $feat_cat ) : ?>
                                    <a class="blog-featured-post__cat" href="<?php echo esc_url( get_category_link( $feat_cat->term_id ) ); ?>">
                                        <?php echo esc_html( $feat_cat->name ); ?>
                                    </a>
                                    <span class="blog-featured-post__dot" aria-hidden="true">·</span>
                                <?php endif; ?>
                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                    <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
                                </time>
                                <span class="blog-featured-post__dot" aria-hidden="true">·</span>
                                <span><?php echo esc_html( $feat_rt ); ?> min read</span>
                            </div>

                            <h2 class="blog-featured-post__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <p class="blog-featured-post__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>

                            <a href="<?php the_permalink(); ?>" class="chatsku-btn chatsku-btn--secondary chatsku-btn--sm">
                                Read Article →
                            </a>
                        </div>

                    </article>

                <?php else :
                    // ── Regular grid card ────────────────────────────────
                    if ( ! $grid_open ) :
                        if ( ! $is_paged ) : ?>
                            <p class="blog-posts-grid-label reveal">More Articles</p>
                        <?php endif;
                        echo '<div class="grid-3 blog-posts-grid">';
                        $grid_open = true;
                    endif;

                    get_template_part( 'template-parts/blog/post-card' );

                endif;

            endwhile; // end main loop

            // Close grid div if it was opened
            if ( $grid_open ) echo '</div>';

            if ( ! $has_posts ) : ?>
                <div class="blog-empty">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" style="color: var(--color-text-faint); margin: 0 auto var(--space-5);">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                    <h2>No posts yet</h2>
                    <p>Check back soon for new content.</p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="chatsku-btn chatsku-btn--secondary">← Back to Home</a>
                </div>
            <?php endif; ?>

                <!-- Pagination -->
                <div class="blog-pagination">
                    <?php
                    the_posts_pagination( [
                        'mid_size'  => 2,
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                    ] );
                    ?>

        </div>
    </section>

    <?php get_template_part( 'template-parts/global/cta-banner' ); ?>

</main>

<?php get_footer(); ?>

<style>
/* ── Blog Hero ─────────────────────────────────────────────────────────── */
.blog-hero__eyebrow { margin-bottom: var(--space-5); }

.blog-eyebrow-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(0, 201, 177, 0.12);
    border: 1px solid rgba(0, 201, 177, 0.3);
    color: var(--color-accent);
    font-family: var(--font-sans);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 999px;
}
.blog-eyebrow-badge svg { flex-shrink: 0; }

.blog-hero__title {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 800;
    color: var(--color-text-primary);
    letter-spacing: -0.03em;
    line-height: 1.15;
    margin: 0 0 var(--space-5);
}

.blog-hero__subtitle {
    font-size: clamp(1rem, 2vw, 1.15rem);
    color: var(--color-text-secondary);
    line-height: 1.7;
    max-width: 560px;
    margin: 0 auto;
}

/* ── Featured Post ─────────────────────────────────────────────────────── */
.blog-featured-post {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: clamp(24px, 4vw, 48px);
    align-items: center;
    background: var(--color-bg-card);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-card);
    overflow: hidden;
    margin-bottom: var(--space-12);
    transition: border-color var(--transition-base), box-shadow var(--transition-base);
}
.blog-featured-post:hover {
    border-color: var(--color-border-accent);
    box-shadow: 0 12px 40px rgba(0,0,0,0.4);
}

.blog-featured-post__image-link { display: block; overflow: hidden; height: 100%; min-height: 300px; }
.blog-featured-post__image { width: 100%; height: 100%; object-fit: cover; min-height: 300px; transition: transform 0.4s ease; display: block; }
.blog-featured-post__image-placeholder {
    width: 100%; min-height: 300px;
    background: linear-gradient(135deg, var(--color-bg-secondary), rgba(15,23,42,0.8));
    display: flex; align-items: center; justify-content: center;
    color: var(--color-text-faint);
}
.blog-featured-post:hover .blog-featured-post__image { transform: scale(1.03); }

.blog-featured-post__body { padding: clamp(24px, 4vw, 48px); }

.blog-featured-post__meta {
    display: flex; align-items: center; gap: var(--space-2);
    font-size: var(--font-size-xs); color: var(--color-text-muted);
    margin-bottom: var(--space-4);
}
.blog-featured-post__cat {
    color: var(--color-accent); font-weight: 600;
    text-decoration: none; text-transform: uppercase; letter-spacing: 0.06em;
}
.blog-featured-post__dot { opacity: 0.5; }

.blog-featured-post__title {
    font-size: clamp(var(--font-size-2xl), 2.5vw, var(--font-size-3xl));
    font-weight: 800; color: var(--color-text-primary);
    line-height: var(--line-height-tight); letter-spacing: -0.02em;
    margin: 0 0 var(--space-4);
}
.blog-featured-post__title a { color: inherit; text-decoration: none; transition: color var(--transition-fast); }
.blog-featured-post__title a:hover { color: var(--color-accent); }

.blog-featured-post__excerpt {
    font-size: var(--font-size-base); color: var(--color-text-muted);
    line-height: var(--line-height-loose); margin: 0 0 var(--space-6);
}

/* ── Grid Label ────────────────────────────────────────────────────────── */
.blog-posts-grid-label {
    font-size: var(--font-size-xs); font-weight: 700;
    color: var(--color-text-faint); text-transform: uppercase;
    letter-spacing: 0.1em; margin-bottom: var(--space-6);
}

/* ── Pagination ────────────────────────────────────────────────────────── */
.blog-pagination { margin-top: var(--space-16); display: flex; justify-content: center; }
.blog-pagination .nav-links { display: flex; align-items: center; gap: var(--space-2); flex-wrap: wrap; justify-content: center; }
.blog-pagination .page-numbers {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 40px; height: 40px; padding: 0 var(--space-3);
    background: var(--color-bg-card); border: 1px solid var(--color-border);
    border-radius: var(--radius-md); font-size: var(--font-size-sm); font-weight: 500;
    color: var(--color-text-muted); text-decoration: none;
    transition: border-color var(--transition-fast), color var(--transition-fast);
}
.blog-pagination .page-numbers:hover { border-color: var(--color-border-accent); color: var(--color-accent); }
.blog-pagination .page-numbers.current { background: var(--color-accent); border-color: var(--color-accent); color: #0f172a; font-weight: 700; }

/* ── Empty ─────────────────────────────────────────────────────────────── */
.blog-empty {
    text-align: center; padding: var(--space-20) 0;
    display: flex; flex-direction: column; align-items: center; gap: var(--space-3);
}
.blog-empty h2 { font-size: var(--font-size-2xl); color: var(--color-text-muted); margin: 0; }
.blog-empty p  { color: var(--color-text-faint); margin: 0 0 var(--space-5); }

/* ── Responsive ────────────────────────────────────────────────────────── */
@media (max-width: 900px) {
    .blog-featured-post { grid-template-columns: 1fr; }
    .blog-featured-post__image-link,
    .blog-featured-post__image,
    .blog-featured-post__image-placeholder { min-height: 240px; }
}
@media (max-width: 640px) {
    .blog-featured-post__body { padding: var(--space-6); }
}
</style>
