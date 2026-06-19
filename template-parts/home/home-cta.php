<?php
/**
 * Bottom CTA Section — "Ready to turn your catalog into a salesperson?"
 * Two-path layout: Start free (filled) / Get a guided demo (outline).
 *
 * Data via get_query_var( 'chatsku_cta' ); falls back to mockup copy.
 *
 * @package ChatSKU
 */

$data    = get_query_var( 'chatsku_cta', [] );
$heading = $data['heading'] ?? 'Ready to turn your catalog into a salesperson?';
$sub     = $data['sub']     ?? "Most suppliers will lose to competitors who respond faster. Whether you want to dive in or see it first, there's a path for you.";

$c1_eyebrow = $data['card1_eyebrow'] ?? 'Ready to go';
$c1_title   = $data['card1_title']   ?? 'Start free on your own catalog';
$c1_body    = $data['card1_body']    ?? "Spin up your buying assistant on your real products today. No credit card, no rebuild — just one line of code when you're happy.";
$c1_btn     = $data['card1_btn_text'] ?? 'Start Free — No Credit Card';
$c1_url     = $data['card1_btn_url']  ?? chatsku_option( 'register_url', '/signup/' );

$c2_eyebrow = $data['card2_eyebrow'] ?? 'Want to see it first';
$c2_title   = $data['card2_title']   ?? 'Get a guided demo';
$c2_body    = $data['card2_body']    ?? 'Prefer to watch it work on a catalog like yours before you commit? Book a 15-minute walkthrough with our team.';
$c2_btn     = $data['card2_btn_text'] ?? 'See Live Demo';
$c2_url     = $data['card2_btn_url']  ?? '/demo/';
?>
<section class="cta-section section-padding" aria-labelledby="cta-heading">
    <div class="cta-glow cta-glow--1" aria-hidden="true"></div>
    <div class="cta-glow cta-glow--2" aria-hidden="true"></div>

    <div class="container cta-inner">

        <div class="cta-head reveal">
            <h2 id="cta-heading" class="cta-heading"><?php echo wp_kses( $heading, [ 'em' => [], 'strong' => [] ] ); ?></h2>
            <?php if ( $sub ) : ?>
                <p class="cta-subheading"><?php echo esc_html( $sub ); ?></p>
            <?php endif; ?>
        </div>

        <div class="cta-paths">

            <div class="cta-path cta-path--primary reveal reveal-delay-1">
                <?php if ( $c1_eyebrow ) : ?><span class="cta-path__eyebrow"><?php echo esc_html( $c1_eyebrow ); ?></span><?php endif; ?>
                <h3 class="cta-path__title"><?php echo esc_html( $c1_title ); ?></h3>
                <?php if ( $c1_body ) : ?><p class="cta-path__body"><?php echo esc_html( $c1_body ); ?></p><?php endif; ?>
                <a href="<?php echo esc_url( $c1_url ); ?>" class="chatsku-btn chatsku-btn--primary chatsku-btn--lg cta-path__btn">
                    <?php echo esc_html( $c1_btn ); ?>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>

            <div class="cta-path reveal reveal-delay-2">
                <?php if ( $c2_eyebrow ) : ?><span class="cta-path__eyebrow"><?php echo esc_html( $c2_eyebrow ); ?></span><?php endif; ?>
                <h3 class="cta-path__title"><?php echo esc_html( $c2_title ); ?></h3>
                <?php if ( $c2_body ) : ?><p class="cta-path__body"><?php echo esc_html( $c2_body ); ?></p><?php endif; ?>
                <a href="<?php echo esc_url( $c2_url ); ?>" class="chatsku-btn chatsku-btn--secondary chatsku-btn--lg cta-path__btn">
                    <?php echo esc_html( $c2_btn ); ?>
                </a>
            </div>

        </div>

    </div>
</section>

<style>
.cta-section { position: relative; background: var(--color-bg-primary); overflow: hidden; }
.cta-glow { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
.cta-glow--1 { width: 500px; height: 500px; background: rgba(0,201,177,0.08); top: -100px; left: 50%; transform: translateX(-50%); }
.cta-glow--2 { width: 300px; height: 300px; background: rgba(99,102,241,0.06); bottom: 0; right: 10%; }
.cta-inner { position: relative; z-index: 1; }
.cta-head { max-width: 760px; margin: 0 auto var(--space-12); text-align: center; }
.cta-heading {
    font-size: clamp(var(--font-size-3xl), 4.4vw, var(--font-size-5xl));
    font-weight: 900;
    color: var(--color-text-primary);
    line-height: var(--line-height-tight);
    letter-spacing: -0.025em;
    margin: 0 0 var(--space-5);
}
.cta-heading em { font-style: normal; color: var(--color-accent); background: linear-gradient(135deg, var(--color-accent) 0%, #4eddcc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.cta-subheading { font-size: var(--font-size-lg); color: var(--color-text-muted); margin: 0; }
.cta-paths {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
    max-width: 920px;
    margin: 0 auto;
}
.cta-path {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 30px 28px;
    border-radius: var(--radius-xl);
    border: 1px solid var(--color-border);
    background: var(--color-bg-card);
}
.cta-path--primary { border-color: var(--color-border-accent); box-shadow: 0 0 0 1px var(--color-border-accent); }
.cta-path__eyebrow { font-size: 11px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 12px; }
.cta-path__title { font-size: 1.5rem; font-weight: 800; color: var(--color-text-primary); margin: 0 0 12px; line-height: var(--line-height-tight); }
.cta-path__body { font-size: var(--font-size-base); color: var(--color-text-muted); margin: 0 0 24px; line-height: var(--line-height-base); }
.cta-path__btn { margin-top: auto; }
@media (max-width: 760px) {
    .cta-paths { grid-template-columns: 1fr; max-width: 460px; }
}
@media (max-width: 480px) {
    .cta-path { align-items: stretch; }
    .cta-path__btn { text-align: center; justify-content: center; }
}
</style>
