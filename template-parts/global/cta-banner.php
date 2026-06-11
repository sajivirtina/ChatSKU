<?php
/**
 * Reusable CTA Banner — appears at bottom of inner pages
 *
 * @package ChatSKU
 */

$primary_url  = chatsku_option( 'register_url', '/register/' );
?>
<section class="cta-banner section-padding" aria-label="Call to action">
    <div class="container cta-banner__inner">
        <div class="cta-banner__content reveal">
            <h2 class="cta-banner__heading">Ready to make your catalog <em>talk back?</em></h2>
            <p class="cta-banner__sub">Start free, no credit card required. Most teams go live in under 4 hours.</p>
            <div class="cta-banner__actions">
                <a href="<?php echo esc_url( $primary_url ); ?>" class="chatsku-btn chatsku-btn--primary chatsku-btn--lg">
                    Start Free — No Credit Card Needed
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="<?php echo esc_url( home_url( '/demo-widget/' ) ); ?>" class="chatsku-btn chatsku-btn--secondary chatsku-btn--lg">
                    See Live Demo
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.cta-banner { background: var(--color-bg-secondary); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border); }
.cta-banner__inner { text-align: center; }
.cta-banner__heading { font-size: clamp(var(--font-size-2xl), 3.5vw, var(--font-size-4xl)); font-weight: 800; color: var(--color-text-primary); letter-spacing: -0.025em; margin: 0 0 var(--space-4) 0; }
.cta-banner__heading em { font-style: normal; color: var(--color-accent); }
.cta-banner__sub { font-size: var(--font-size-lg); color: var(--color-text-muted); margin: 0 0 var(--space-8) 0; }
.cta-banner__actions { display: flex; justify-content: center; flex-wrap: wrap; gap: var(--space-4); }
@media (max-width: 480px) { .cta-banner__actions { flex-direction: column; align-items: stretch; } }
</style>
