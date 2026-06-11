<?php
/**
 * 404 Not Found Page
 *
 * @package ChatSKU
 */

get_header();
?>

<main id="main" class="chatsku-main error-404-main">
    <section class="error-404 section-padding">
        <div class="container text-center">

            <div class="error-404__number" aria-hidden="true">404</div>

            <h1 class="error-404__title">Page not found</h1>
            <p class="error-404__desc">
                The page you're looking for doesn't exist or has been moved.
            </p>

            <div class="error-404__actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="chatsku-btn chatsku-btn--primary chatsku-btn--lg">
                    ← Back to Home
                </a>
                <a href="<?php echo esc_url( home_url( '/demo-widget/' ) ); ?>" class="chatsku-btn chatsku-btn--secondary chatsku-btn--lg">
                    Try the Demo
                </a>
            </div>

            <!-- Quick links -->
            <div class="error-404__links">
                <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin-bottom: var(--space-4);">Or go directly to:</p>
                <div style="display: flex; flex-wrap: wrap; gap: var(--space-2); justify-content: center;">
                    <?php
                    $links = [
                        'Features' => home_url( '/features/' ),
                        'Pricing'  => home_url( '/pricing/' ),
                        'FAQ'      => home_url( '/faq/' ),
                        'Blog'     => home_url( '/blog/' ),
                        'Register' => home_url( '/register/' ),
                    ];
                    foreach ( $links as $label => $url ) : ?>
                        <a href="<?php echo esc_url( $url ); ?>" class="post-tag"><?php echo esc_html( $label ); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </section>
</main>

<?php get_footer(); ?>

<style>
.error-404 { text-align: center; min-height: calc(100vh - var(--header-height)); display: flex; align-items: center; }
.error-404__number {
    font-size: clamp(6rem, 20vw, 12rem);
    font-weight: 900;
    color: transparent;
    -webkit-text-stroke: 2px var(--color-border);
    letter-spacing: -0.05em;
    line-height: 1;
    margin-bottom: var(--space-4);
    background: linear-gradient(135deg, rgba(0,201,177,0.15) 0%, transparent 100%);
    -webkit-background-clip: text;
    background-clip: text;
}
.error-404__title { font-size: clamp(var(--font-size-3xl), 4vw, var(--font-size-5xl)); font-weight: 800; color: var(--color-text-primary); letter-spacing: -0.025em; margin-bottom: var(--space-5); }
.error-404__desc { font-size: var(--font-size-lg); color: var(--color-text-muted); margin-bottom: var(--space-10); max-width: 480px; margin-left: auto; margin-right: auto; }
.error-404__actions { display: flex; justify-content: center; flex-wrap: wrap; gap: var(--space-4); margin-bottom: var(--space-10); }
.error-404__links { margin-top: var(--space-4); }
.post-tag { padding: 6px 14px; background: rgba(255,255,255,0.04); border: 1px solid var(--color-border); border-radius: var(--radius-full); font-size: var(--font-size-sm); color: var(--color-text-muted); text-decoration: none; transition: border-color var(--transition-fast), color var(--transition-fast); }
.post-tag:hover { border-color: var(--color-border-accent); color: var(--color-accent); }
</style>
