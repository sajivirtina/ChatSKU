<?php
/**
 * Demo Widget Page
 * Template Name: Demo Widget
 *
 * @package ChatSKU
 */

get_header();

$headline    = chatsku_field( 'dw_headline',      false, 'See ChatSKU in action' );
$subheadline = chatsku_field( 'dw_subheadline',   false, 'Try a live demo running on a sample industrial supplies catalog.' );
$embed_type  = chatsku_field( 'dw_embed_type',    false, 'iframe' );
$iframe_url  = chatsku_field( 'dw_iframe_url',    false, '' );
$script_code = chatsku_field( 'dw_script_code',   false, '' );
$fallback    = chatsku_field( 'dw_fallback_image' );
$instructions= chatsku_field( 'dw_instructions',  false, [] );
$queries     = chatsku_field( 'dw_sample_queries', false, [] );

// Default sample queries
if ( empty( $queries ) ) {
    $queries = [
        [ 'query_text' => 'Do you have 3/8" zinc bolts in stock?' ],
        [ 'query_text' => 'Show me acrylic sheets under $30' ],
        [ 'query_text' => 'What\'s the lead time on polycarbonate panels?' ],
        [ 'query_text' => 'I need 500 units of clear tubing, 1/2" diameter' ],
    ];
}
?>

<main id="main" class="chatsku-main demo-widget-main">

    <!-- Hero -->
    <section class="demo-hero section-padding" style="padding-bottom: var(--space-8); background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);">
        <div class="container">
            <div class="demo-hero__inner">
                <div class="demo-hero__content">
                    <span class="badge badge--success reveal" style="margin-bottom: var(--space-4); display: inline-flex;">● Live Demo</span>
                    <h1 class="section-head__title reveal reveal-delay-1" style="text-align: left; margin-bottom: var(--space-4);">
                        <?php echo esc_html( $headline ); ?>
                    </h1>
                    <p class="section-head__subtitle reveal reveal-delay-2" style="text-align: left; margin: 0 0 var(--space-8);">
                        <?php echo esc_html( $subheadline ); ?>
                    </p>

                    <!-- Sample queries -->
                    <?php if ( ! empty( $queries ) ) : ?>
                        <div class="demo-queries reveal reveal-delay-3">
                            <p style="font-size: var(--font-size-sm); color: var(--color-text-muted); margin-bottom: var(--space-3);">Try these searches:</p>
                            <div class="demo-queries__buttons">
                                <?php foreach ( $queries as $q ) :
                                    $query_text = $q['query_text'] ?? '';
                                    if ( ! $query_text ) continue;
                                ?>
                                    <button
                                        class="demo-query-btn"
                                        type="button"
                                        data-query="<?php echo esc_attr( $query_text ); ?>"
                                    >
                                        <?php echo esc_html( $query_text ); ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Widget embed area -->
                <div class="demo-hero__widget">
                    <?php if ( $embed_type === 'iframe' && $iframe_url ) : ?>
                        <iframe
                            id="demo-widget-iframe"
                            src="<?php echo esc_url( $iframe_url ); ?>"
                            title="ChatSKU Live Demo Widget"
                            class="demo-iframe"
                            loading="lazy"
                            allow="camera; microphone"
                        ></iframe>
                    <?php elseif ( $embed_type === 'script' && $script_code ) : ?>
                        <div id="chatsku-demo-container">
                            <?php echo $script_code; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                        </div>
                    <?php elseif ( $fallback && is_array( $fallback ) ) : ?>
                        <img
                            src="<?php echo esc_url( $fallback['url'] ); ?>"
                            alt="<?php echo esc_attr( $fallback['alt'] ?: 'ChatSKU demo widget' ); ?>"
                            class="demo-fallback-image"
                            loading="lazy"
                        >
                    <?php else : ?>
                        <!-- Placeholder when no embed configured -->
                        <div class="demo-placeholder">
                            <div class="demo-placeholder__inner">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color: var(--color-accent); margin-bottom: 12px;"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                                <p style="color: var(--color-text-muted); font-size: 14px;">Configure your demo widget URL in WordPress Admin → Demo Widget page → ACF fields</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats bar -->
    <div class="demo-stats-bar">
        <div class="container demo-stats-bar__inner">
            <?php
            $stats = [
                '14+ Products'         => null,
                'AI Smart Search'      => null,
                '24/7 Instant Quotes'  => null,
                'Fast Response Time'   => null,
            ];
            foreach ( $stats as $label => $val ) : ?>
                <div class="demo-stat">
                    <span><?php echo esc_html( $label ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- How It Works -->
    <section class="section-padding bg-secondary">
        <div class="container">
            <div class="section-head reveal">
                <span class="section-head__eyebrow">How It Works</span>
                <h2 class="section-head__title">3 Steps to Live</h2>
            </div>
            <div class="grid-3">
                <?php
                $steps = [
                    [ 'n' => '1', 'title' => 'Search Naturally',    'desc' => 'Buyers type or speak their needs in plain English.' ],
                    [ 'n' => '2', 'title' => 'Build Your Quote',     'desc' => 'Add products, quantities, and custom items to a formal quote.' ],
                    [ 'n' => '3', 'title' => 'Submit & Track',       'desc' => 'Submit the RFQ and track its status through the entire lifecycle.' ],
                ];
                foreach ( $steps as $i => $s ) : ?>
                    <div class="step-card reveal reveal-delay-<?php echo $i + 1; ?>">
                        <span class="step-card__number">Step <?php echo esc_html( $s['n'] ); ?></span>
                        <h3 class="step-card__title"><?php echo esc_html( $s['title'] ); ?></h3>
                        <p class="step-card__description"><?php echo esc_html( $s['desc'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php get_template_part( 'template-parts/global/cta-banner' ); ?>

</main>

<?php get_footer(); ?>

<style>
.demo-hero__inner { display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-12); align-items: start; }
.demo-iframe { width: 100%; height: 600px; border: 1px solid var(--color-border); border-radius: 16px; background: #131e30; }
.demo-fallback-image { width: 100%; border-radius: 16px; }
.demo-placeholder { background: #131e30; border: 1px solid var(--color-border); border-radius: 16px; height: 500px; display: flex; align-items: center; justify-content: center; text-align: center; }
.demo-placeholder__inner { padding: var(--space-8); }
.demo-queries__buttons { display: flex; flex-wrap: wrap; gap: var(--space-2); }
.demo-query-btn {
    padding: 8px 16px;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-full);
    font-size: var(--font-size-sm);
    color: var(--color-text-muted);
    cursor: pointer;
    font-family: var(--font-sans);
    transition: border-color var(--transition-fast), color var(--transition-fast), background var(--transition-fast);
}
.demo-query-btn:hover, .demo-query-btn.is-active {
    border-color: var(--color-border-accent);
    color: var(--color-accent);
    background: var(--color-accent-glow);
}
/* Stats bar */
.demo-stats-bar { background: rgba(255,255,255,0.02); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border); padding: var(--space-4) 0; }
.demo-stats-bar__inner { display: flex; justify-content: center; flex-wrap: wrap; gap: var(--space-8); }
.demo-stat { font-size: var(--font-size-sm); font-weight: 600; color: var(--color-text-muted); display: flex; align-items: center; gap: var(--space-2); }
.demo-stat::before { content: '●'; color: var(--color-accent); font-size: 8px; }
@media (max-width: 900px) {
    .demo-hero__inner { grid-template-columns: 1fr; }
    .demo-iframe { height: 480px; }
}
</style>
