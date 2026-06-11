<?php
/**
 * Single Blog Post Template
 *
 * @package ChatSKU
 */

get_header();

$hero_image    = chatsku_field( 'post_hero_image' );
$author_bio    = chatsku_field( 'post_author_bio' );
$cta_heading   = chatsku_field( 'post_cta_heading' );
$cta_url       = chatsku_field( 'post_cta_url' );
$related_posts = chatsku_field( 'post_related', false, [] );
$reading_time  = chatsku_reading_time();
$categories    = get_the_category();
$first_cat     = ! empty( $categories ) ? $categories[0] : null;
?>

<!-- Reading Progress Bar -->
<div class="reading-progress" id="reading-progress" role="progressbar" aria-label="Reading progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>

<main id="main" class="chatsku-main single-post-main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <!-- Post Hero -->
        <header class="post-hero section-padding" style="padding-bottom: var(--space-10);">
            <div class="container container--narrow">

                <!-- Breadcrumb -->
                <nav class="post-breadcrumb" aria-label="Breadcrumb">
                    <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
                    <?php if ( $first_cat ) : ?>
                        <span aria-hidden="true">→</span>
                        <a href="<?php echo esc_url( get_category_link( $first_cat->term_id ) ); ?>"><?php echo esc_html( $first_cat->name ); ?></a>
                    <?php endif; ?>
                </nav>

                <!-- Category badge + reading time -->
                <div class="post-hero__badges">
                    <?php if ( $first_cat ) : ?>
                        <a href="<?php echo esc_url( get_category_link( $first_cat->term_id ) ); ?>" class="post-category-badge">
                            <?php echo esc_html( $first_cat->name ); ?>
                        </a>
                    <?php endif; ?>
                    <span class="post-reading-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <?php echo esc_html( $reading_time ); ?> min read
                    </span>
                </div>

                <h1 class="post-title"><?php the_title(); ?></h1>

                <!-- Post meta -->
                <div class="post-meta">
                    <img
                        src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ), [ 'size' => 80 ] ) ); ?>"
                        alt="<?php echo esc_attr( get_the_author() ); ?>"
                        class="post-meta__avatar"
                        width="44"
                        height="44"
                        loading="eager"
                    >
                    <div class="post-meta__info">
                        <span class="post-meta__author"><?php echo esc_html( get_the_author() ); ?></span>
                        <span class="post-meta__sep" aria-hidden="true">·</span>
                        <time class="post-meta__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                            <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
                        </time>
                    </div>
                </div>

            </div>
        </header>

        <!-- Hero / Featured Image -->
        <?php
        $has_hero = ( $hero_image && is_array( $hero_image ) ) || has_post_thumbnail();
        if ( $has_hero ) :
        ?>
        <div class="post-hero-image-wrap container">
            <?php if ( $hero_image && is_array( $hero_image ) ) : ?>
                <img
                    src="<?php echo esc_url( $hero_image['url'] ); ?>"
                    alt="<?php echo esc_attr( $hero_image['alt'] ?: get_the_title() ); ?>"
                    class="post-hero__image"
                    loading="eager"
                    fetchpriority="high"
                >
            <?php else : ?>
                <?php the_post_thumbnail( 'chatsku-hero', [ 'class' => 'post-hero__image', 'loading' => 'eager' ] ); ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Divider -->
        <div class="container container--narrow"><hr class="post-divider"></div>

        <!-- Post Content -->
        <article class="post-content" id="post-content">
            <div class="container container--narrow">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <!-- In-article CTA -->
                <?php if ( $cta_heading ) : ?>
                    <div class="post-cta-block">
                        <p class="post-cta-block__eyebrow">Ready to modernize your catalog?</p>
                        <h3 class="post-cta-block__heading"><?php echo esc_html( $cta_heading ); ?></h3>
                        <a href="<?php echo esc_url( $cta_url ?: '/signup/' ); ?>" class="chatsku-btn chatsku-btn--primary">
                            Get Started Free →
                        </a>
                    </div>
                <?php else : ?>
                    <!-- Default CTA block always shown -->
                    <div class="post-cta-block">
                        <p class="post-cta-block__eyebrow">Turn your catalog into a 24/7 sales channel</p>
                        <h3 class="post-cta-block__heading">Stop sending PDFs. Start capturing demand.</h3>
                        <a href="<?php echo esc_url( home_url( '/signup/' ) ); ?>" class="chatsku-btn chatsku-btn--primary">
                            Try ChatSKU Free →
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Tags -->
                <?php $tags = get_the_tags(); if ( $tags ) : ?>
                    <div class="post-tags">
                        <span class="post-tags__label">Tagged:</span>
                        <?php foreach ( $tags as $tag ) : ?>
                            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="post-tag">
                                #<?php echo esc_html( $tag->name ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Author Bio -->
                <?php $bio = $author_bio ?: get_the_author_meta( 'description' ); ?>
                <?php if ( $bio ) : ?>
                    <div class="post-author-box">
                        <img
                            src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ), [ 'size' => 80 ] ) ); ?>"
                            alt="<?php echo esc_attr( get_the_author() ); ?>"
                            class="post-author-box__avatar"
                            width="64"
                            height="64"
                            loading="lazy"
                        >
                        <div class="post-author-box__content">
                            <p class="post-author-box__label">About the author</p>
                            <p class="post-author-box__name"><?php echo esc_html( get_the_author() ); ?></p>
                            <p class="post-author-box__bio"><?php echo esc_html( $bio ); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Post Nav -->
                <nav class="post-nav" aria-label="Post navigation">
                    <?php
                    $prev = get_previous_post();
                    $next = get_next_post();
                    if ( $prev || $next ) :
                    ?>
                    <div class="post-nav__inner">
                        <?php if ( $prev ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="post-nav__item post-nav__item--prev">
                            <span class="post-nav__dir">← Previous</span>
                            <span class="post-nav__title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
                        </a>
                        <?php endif; ?>
                        <?php if ( $next ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="post-nav__item post-nav__item--next">
                            <span class="post-nav__dir">Next →</span>
                            <span class="post-nav__title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </nav>

            </div>
        </article>

        <!-- Related Posts -->
        <?php if ( ! empty( $related_posts ) ) : ?>
            <section class="post-related bg-secondary" style="padding: var(--space-16) 0;">
                <div class="container">
                    <h2 class="post-related__heading">Related Articles</h2>
                    <div class="grid-3">
                        <?php foreach ( $related_posts as $related_post ) :
                            $orig = $post;
                            $post = $related_post;
                            setup_postdata( $post );
                            get_template_part( 'template-parts/blog/post-card' );
                            $post = $orig;
                            wp_reset_postdata();
                        endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>


    <?php endwhile; endif; ?>

    <?php get_template_part( 'template-parts/global/cta-banner' ); ?>

</main>

<?php get_footer(); ?>

<style>
/* ── Reading Progress Bar ────────────────────────────────────────────────── */
.reading-progress {
    position: fixed;
    top: var(--header-height);
    left: 0;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, var(--color-accent), #4eddcc);
    z-index: calc(var(--z-header) - 1);
    transition: width 0.1s linear;
    border-radius: 0 2px 2px 0;
}
.admin-bar .reading-progress { top: calc(var(--header-height) + 32px); }
@media (max-width: 782px) { .admin-bar .reading-progress { top: calc(var(--header-height) + 46px); } }

/* ── Breadcrumb ───────────────────────────────────────────────────────────── */
.post-breadcrumb {
    display: flex; align-items: center; gap: 8px;
    font-size: var(--font-size-sm); color: var(--color-text-muted);
    margin-bottom: var(--space-5);
}
.post-breadcrumb a { color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast); }
.post-breadcrumb a:hover { color: var(--color-accent); }

/* ── Hero Badges ─────────────────────────────────────────────────────────── */
.post-hero__badges { display: flex; align-items: center; gap: var(--space-3); margin-bottom: var(--space-5); flex-wrap: wrap; }

.post-category-badge {
    display: inline-block;
    padding: 4px 12px;
    background: var(--color-accent-glow);
    border: 1px solid var(--color-border-accent);
    border-radius: var(--radius-full);
    font-size: var(--font-size-xs); font-weight: 700;
    color: var(--color-accent); text-transform: uppercase;
    letter-spacing: 0.08em; text-decoration: none;
    transition: background var(--transition-fast);
}
.post-category-badge:hover { background: rgba(0, 201, 177, 0.2); text-decoration: none; }

.post-reading-badge {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: var(--font-size-xs); font-weight: 500; color: var(--color-text-muted);
}

/* ── Post Title ──────────────────────────────────────────────────────────── */
.post-title {
    font-size: clamp(var(--font-size-3xl), 4vw, 3.25rem);
    font-weight: 900; color: var(--color-text-primary);
    letter-spacing: -0.03em; line-height: 1.12;
    margin: 0 0 var(--space-7);
}

/* ── Post Meta ───────────────────────────────────────────────────────────── */
.post-meta { display: flex; align-items: center; gap: var(--space-3); }
.post-meta__avatar { width: 44px; height: 44px; border-radius: 50%; border: 2px solid var(--color-border-accent); flex-shrink: 0; }
.post-meta__info { display: flex; align-items: center; gap: 8px; font-size: var(--font-size-sm); flex-wrap: wrap; }
.post-meta__author { font-weight: 700; color: var(--color-text-primary); }
.post-meta__sep { color: var(--color-text-faint); }
.post-meta__date { color: var(--color-text-muted); }

/* ── Hero Image ──────────────────────────────────────────────────────────── */
.post-hero-image-wrap { margin-top: var(--space-10); }
.post-hero__image { width: 100%; border-radius: 20px; max-height: 520px; object-fit: cover; display: block; }

/* ── Post Divider ────────────────────────────────────────────────────────── */
.post-divider { border: none; border-top: 1px solid var(--color-border); margin: var(--space-10) 0; }

/* ── Post Content ────────────────────────────────────────────────────────── */
.post-content { padding-bottom: var(--space-16); }

/* ── In-article CTA ──────────────────────────────────────────────────────── */
.post-cta-block {
    background: linear-gradient(135deg, rgba(0,201,177,0.07) 0%, rgba(30,41,59,0.6) 100%);
    border: 1px solid var(--color-border-accent);
    border-radius: 20px;
    padding: var(--space-10) var(--space-8);
    text-align: center;
    margin: var(--space-12) 0;
}
.post-cta-block__eyebrow {
    font-size: var(--font-size-xs); font-weight: 700; color: var(--color-accent);
    text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 var(--space-3);
}
.post-cta-block__heading {
    font-size: clamp(var(--font-size-xl), 2.5vw, var(--font-size-2xl));
    font-weight: 800; color: var(--color-text-primary);
    margin: 0 0 var(--space-6); line-height: var(--line-height-snug);
}

/* ── Tags ────────────────────────────────────────────────────────────────── */
.post-tags { display: flex; align-items: center; flex-wrap: wrap; gap: var(--space-2); margin-top: var(--space-10); }
.post-tags__label { font-size: var(--font-size-xs); font-weight: 600; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.06em; margin-right: var(--space-1); }
.post-tag {
    padding: 4px 12px;
    background: rgba(255,255,255,0.04); border: 1px solid var(--color-border);
    border-radius: var(--radius-full); font-size: var(--font-size-xs);
    color: var(--color-text-muted); text-decoration: none;
    transition: border-color var(--transition-fast), color var(--transition-fast);
}
.post-tag:hover { border-color: var(--color-border-accent); color: var(--color-accent); }

/* ── Author Box ──────────────────────────────────────────────────────────── */
.post-author-box {
    display: flex; gap: var(--space-5); align-items: flex-start;
    background: var(--color-bg-card); border: 1px solid var(--color-border);
    border-radius: 20px; padding: var(--space-7); margin-top: var(--space-10);
}
.post-author-box__avatar { width: 64px; height: 64px; border-radius: 50%; flex-shrink: 0; }
.post-author-box__label { font-size: var(--font-size-xs); font-weight: 700; color: var(--color-accent); text-transform: uppercase; letter-spacing: 0.08em; margin: 0 0 4px; }
.post-author-box__name { font-size: var(--font-size-base); font-weight: 700; color: var(--color-text-primary); margin: 0 0 6px; }
.post-author-box__bio { font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 0; line-height: var(--line-height-base); }

/* ── Post Nav ────────────────────────────────────────────────────────────── */
.post-nav { margin-top: var(--space-12); }
.post-nav__inner { display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-4); }
.post-nav__item {
    display: flex; flex-direction: column; gap: 6px;
    padding: var(--space-5); background: var(--color-bg-card);
    border: 1px solid var(--color-border); border-radius: var(--radius-lg);
    text-decoration: none; transition: border-color var(--transition-fast), background var(--transition-fast);
}
.post-nav__item:hover { border-color: var(--color-border-accent); background: rgba(30,41,59,0.95); }
.post-nav__item--next { text-align: right; }
.post-nav__dir { font-size: var(--font-size-xs); font-weight: 600; color: var(--color-accent); text-transform: uppercase; letter-spacing: 0.06em; }
.post-nav__title { font-size: var(--font-size-sm); font-weight: 600; color: var(--color-text-primary); line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

/* ── Related ─────────────────────────────────────────────────────────────── */
.post-related__heading {
    font-size: clamp(var(--font-size-2xl), 2.5vw, var(--font-size-3xl));
    font-weight: 800; color: var(--color-text-primary);
    letter-spacing: -0.02em; margin-bottom: var(--space-10);
}

/* ── Responsive ──────────────────────────────────────────────────────────── */
@media (max-width: 640px) {
    .post-nav__inner { grid-template-columns: 1fr; }
    .post-nav__item--next { text-align: left; }
    .post-author-box { flex-direction: column; }
}
</style>

<script>
(function () {
    var bar     = document.getElementById('reading-progress');
    var content = document.getElementById('post-content');
    if (!bar || !content) return;

    function updateProgress() {
        var rect   = content.getBoundingClientRect();
        var total  = content.offsetHeight - window.innerHeight;
        var scrolled = Math.max(0, -rect.top);
        var pct    = total > 0 ? Math.min(100, (scrolled / total) * 100) : 0;
        bar.style.width = pct + '%';
        bar.setAttribute('aria-valuenow', Math.round(pct));
    }

    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();
})();
</script>
