<?php
/**
 * Bottom CTA Section
 *
 * @package ChatSKU
 */

$data          = get_query_var( 'chatsku_cta', [] );
$heading       = $data['heading']        ?? 'Ready to make your catalog <em>talk back?</em>';
$subheading    = $data['subheading']     ?? 'Start free, no credit card required. Most teams go live in under 4 hours.';
$primary_text  = $data['primary_text']   ?? 'Start Free — No Credit Card Needed';
$primary_url   = $data['primary_url']    ?? chatsku_option( 'register_url', '/signup/' );
$secondary_text= $data['secondary_text'] ?? 'See Live Demo';
$secondary_url = $data['secondary_url']  ?? '/demo-widget/';
?>
<section class="cta-section section-padding" aria-labelledby="cta-heading">
    <!-- Glow decorations -->
    <div class="cta-glow cta-glow--1" aria-hidden="true"></div>
    <div class="cta-glow cta-glow--2" aria-hidden="true"></div>

    <div class="container cta-inner">

        <div class="cta-content reveal">
            <h2 id="cta-heading" class="cta-heading">
                <?php echo wp_kses( $heading, [ 'em' => [], 'strong' => [] ] ); ?>
            </h2>

            <?php if ( $subheading ) : ?>
                <p class="cta-subheading"><?php echo esc_html( $subheading ); ?></p>
            <?php endif; ?>

            <div class="cta-actions">
                <a href="<?php echo esc_url( $primary_url ); ?>" class="chatsku-btn chatsku-btn--primary chatsku-btn--lg">
                    <?php echo esc_html( $primary_text ); ?>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <?php if ( $secondary_text ) : ?>
                    <a href="<?php echo esc_url( $secondary_url ); ?>" class="chatsku-btn chatsku-btn--secondary chatsku-btn--lg">
                        <?php echo esc_html( $secondary_text ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<style>
.cta-section {
    position: relative;
    text-align: center;
    background: var(--color-bg-primary);
    overflow: hidden;
}
.cta-glow {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
}
.cta-glow--1 {
    width: 500px;
    height: 500px;
    background: rgba(0, 201, 177, 0.08);
    top: -100px;
    left: 50%;
    transform: translateX(-50%);
}
.cta-glow--2 {
    width: 300px;
    height: 300px;
    background: rgba(99, 102, 241, 0.06);
    bottom: 0;
    right: 10%;
}
.cta-inner { position: relative; z-index: 1; }
.cta-content { max-width: 700px; margin: 0 auto; }
.cta-heading {
    font-size: clamp(var(--font-size-3xl), 4vw, var(--font-size-5xl));
    font-weight: 900;
    color: var(--color-text-primary);
    line-height: var(--line-height-tight);
    letter-spacing: -0.025em;
    margin: 0 0 var(--space-5) 0;
}
.cta-heading em {
    font-style: normal;
    color: var(--color-accent);
    background: linear-gradient(135deg, var(--color-accent) 0%, #4eddcc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.cta-subheading {
    font-size: var(--font-size-lg);
    color: var(--color-text-muted);
    margin: 0 0 var(--space-10) 0;
}
.cta-actions {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: var(--space-4);
}
@media (max-width: 480px) {
    .cta-actions { flex-direction: column; align-items: stretch; }
    .cta-actions .chatsku-btn { text-align: center; }
}
</style>
