<?php
/**
 * Template Name: Pricing — Cost Estimate
 *
 * Simplified pricing page: hero → pricing highlight → features → cost-estimate form.
 * No plan grid, no SKUBit calculator, no FAQ. Conversion-focused lead-capture variant.
 *
 * WPForms configuration required (WP Admin → WPForms → Edit Form ID 117):
 *   • Confirmations → Type: Message →
 *     "Thank you for submitting. Please check your inbox for your personal link
 *      to access the cost estimate."
 *   • Notifications → Email body → include link to Cost Calculator page
 *
 * @package ChatSKU
 */

get_header();

// ── Hardcoded defaults (mirrors page-pricing.php fallbacks) ───────────────────
$headline        = 'Priced for How You Actually Use It';
$headline_accent = 'Actually Use It';
$subheadline     = 'Flat monthly fee covers your catalog. SKUBits cover your AI-powered features. Use more, top up. Use less, pay nothing extra.';
$trust_badges    = [
    'Deploy in one line of code',
    'No website rebuild required',
    'Live within days',
    'Cancel anytime',
];

// ACF overrides (optional — same keys as pricing page)
if ( function_exists( 'get_field' ) ) {
    $headline        = get_field( 'pricing_headline' )        ?: $headline;
    $headline_accent = get_field( 'pricing_headline_accent' ) ?: $headline_accent;
    $subheadline     = get_field( 'pricing_subheadline' )     ?: $subheadline;
}

// ── Deduplicated feature list (all plans, 3 items excluded) ───────────────────
$features = [
    'All Base + Functional features',
    '50,000 text searches/mo',
    'AI product search',
    'RFQ & quote management',
    'Support chat',
    'Email notifications',
    'Admin feature toggles',
    'Dedicated support',
    'Image-based product search',
    'Voice search queries',
    'Order conversion tracking',
    'Quote status automation',
    'Order & inventory sync',
    'Admin SKUBit rate override',
    'Contract pricing & price lists',
    'Customer group discounts',
    'Price visibility rules',
    'Sales rep assignment',
    'Pipeline analytics',
    'Multi-store deployment',
    'Custom SKUBit anchor rate',
    'Custom integrations',
    'Contract billing',
    'Onboarding & training',
];
?>

<main id="main" class="chatsku-main pce-main">

    <!-- ═══ 1. HERO ═══════════════════════════════════════════════════════════════ -->
    <section class="pv2-hero section-padding" aria-labelledby="pce-hero-heading">
        <div class="pv2-hero__inner">

            <div class="pv2-hero__eyebrow reveal">
                <span class="pv2-eyebrow-badge">
                    <span class="pv2-eyebrow-badge__dot" aria-hidden="true"></span>
                    Transparent Pricing
                </span>
            </div>

            <h1 id="pce-hero-heading" class="pv2-hero__title reveal reveal-delay-1">
                <?php
                $plain  = esc_html( $headline );
                $accent = esc_html( $headline_accent );
                if ( $accent && strpos( $plain, $accent ) !== false ) {
                    $parts = explode( $accent, $plain, 2 );
                    echo esc_html( $parts[0] )
                        . '<span class="pv2-hero__title-accent">' . esc_html( $accent ) . '</span>'
                        . esc_html( $parts[1] ?? '' );
                } else {
                    echo $plain;
                }
                ?>
            </h1>

            <p class="pv2-hero__sub reveal reveal-delay-2"><?php echo esc_html( $subheadline ); ?></p>

            <ul class="pv2-trust-badges reveal reveal-delay-3" role="list" aria-label="Key benefits">
                <?php foreach ( $trust_badges as $badge ) : ?>
                <li class="pv2-trust-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                    <?php echo esc_html( $badge ); ?>
                </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </section>

    <!-- ═══ 2. PRICING HIGHLIGHT ══════════════════════════════════════════════════ -->
    <section class="pce-highlight section-padding" aria-labelledby="pce-highlight-heading">
        <div class="pce-highlight__inner">
            <div class="pce-highlight__card reveal">
                <div class="pce-highlight__label">Starting Plan</div>
                <h2 id="pce-highlight-heading" class="pce-highlight__text">
                    Starter at
                    <span class="pce-highlight__price">$2,500</span>
                    one-time fee
                    <!-- <span class="pce-highlight__sep">+</span> -->
                    <span class="pce-highlight__price">$299</span>/month
                </h2>
                <p class="pce-highlight__note">Setup is scoped to your catalog — no website rebuild required.</p>
            </div>
        </div>
    </section>

    <!-- ═══ 3. FEATURES ═══════════════════════════════════════════════════════════ -->
    <section class="pce-features section-padding" aria-labelledby="pce-features-heading">
        <div class="pce-features__inner">

            <div class="pce-features__header text-center reveal">
                <h2 id="pce-features-heading" class="pce-features__title">What's Included</h2>
                <p class="pce-features__intro">Available features are based on the plan you select.</p>
            </div>

            <ul class="pce-features__grid reveal reveal-delay-1" role="list" aria-label="Available features">
                <?php foreach ( $features as $feature ) : ?>
                <li class="pce-features__item">
                    <svg class="pce-features__icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                    <?php echo esc_html( $feature ); ?>
                </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </section>

    <!-- ═══ 4. COST ESTIMATE FORM ══════════════════════════════════════════════════ -->
    <section class="pce-form-section section-padding" id="cost-estimate" aria-labelledby="pce-form-heading">
        <div class="pce-form-section__inner">

            <div class="pce-form-section__card reveal">
                <div class="pce-form-section__header">
                    <h2 id="pce-form-heading" class="pce-form-section__title">
                        Would you like to estimate your costs?
                    </h2>
                    <p class="pce-form-section__sub">
                        Share a few details and we'll send a personal link to your cost estimate.
                    </p>
                </div>

                <div class="pce-form-section__form">
                    <?php echo do_shortcode( '[wpforms id="117" title="false"]' ); ?>
                </div>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* ══════════════════════════════════════════════════════════════════════════════
   ChatSKU Pricing — Cost Estimate (page-pricing-estimate.php)
   BEM block prefixes:
     pv2-  hero section (mirrors page-pricing.php — identical look)
     pce-  all new sections on this template
   ══════════════════════════════════════════════════════════════════════════════ */

/* ── Shared helpers ──────────────────────────────────────────────────────────── */
.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}

/* ══ pv2- HERO (copied verbatim from page-pricing.php) ═══════════════════════ */

.pv2-hero { padding-bottom: var(--space-8, 2rem); text-align: center; }
.pv2-hero__inner { max-width: 760px; margin: 0 auto; padding: 0 var(--space-6, 1.5rem); }
.pv2-hero__eyebrow { margin-bottom: var(--space-5, 1.25rem); }
.pv2-eyebrow-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(0,201,177,0.1); border: 1px solid rgba(0,201,177,0.3);
    color: var(--color-accent, #00C9B1); font-size: 12px; font-weight: 700;
    letter-spacing: 0.07em; text-transform: uppercase; padding: 5px 14px; border-radius: 999px;
}
.pv2-eyebrow-badge__dot {
    width: 6px; height: 6px; border-radius: 50%; background: var(--color-accent, #00C9B1);
    animation: pv2-pulse 2s ease-in-out infinite;
}
@keyframes pv2-pulse {
    0%,100%{opacity:1;transform:scale(1)}
    50%{opacity:.5;transform:scale(.8)}
}
.pv2-hero__title {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800;
    color: var(--color-text-primary, #f8fafc); letter-spacing: -0.03em; line-height: 1.1;
    margin: 0 0 var(--space-5, 1.25rem);
}
.pv2-hero__title-accent { color: var(--color-accent, #00C9B1); }
.pv2-hero__sub {
    font-size: clamp(0.95rem, 2vw, 1.0625rem); color: var(--color-text-muted, #94a3b8);
    line-height: 1.7; max-width: 580px; margin: 0 auto var(--space-8, 2rem);
}
.pv2-trust-badges {
    display: flex; flex-wrap: wrap; justify-content: center; gap: 6px 16px;
    list-style: none; margin: 0 0 var(--space-8, 2rem); padding: 0;
}
.pv2-trust-badge {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.8125rem; color: var(--color-text-secondary, #cbd5e1); font-weight: 500;
}
.pv2-trust-badge svg { color: var(--color-accent, #00C9B1); flex-shrink: 0; }

/* ══ pce- PRICING HIGHLIGHT ══════════════════════════════════════════════════ */

.pce-highlight { padding-top: 0; }
.pce-highlight__inner { max-width: 820px; margin: 0 auto; padding: 0 var(--space-6, 1.5rem); }
.pce-highlight__card {
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid var(--color-accent, #00C9B1);
    border-radius: 16px;
    padding: var(--space-10, 2.5rem) var(--space-12, 3rem);
    text-align: center;
    box-shadow: 0 0 40px rgba(0,201,177,0.1), 0 0 80px rgba(0,201,177,0.05);
    position: relative;
}
.pce-highlight__label {
    display: inline-block;
    background: rgba(0,201,177,0.12); border: 1px solid rgba(0,201,177,0.3);
    color: var(--color-accent, #00C9B1);
    font-size: 11px; font-weight: 700; letter-spacing: 0.09em; text-transform: uppercase;
    padding: 4px 14px; border-radius: 999px; margin-bottom: var(--space-5, 1.25rem);
}
.pce-highlight__text {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(1.5rem, 4vw, 2.25rem); font-weight: 800;
    color: var(--color-text-primary, #f8fafc); letter-spacing: -0.03em;
    line-height: 1.3; margin: 0 0 var(--space-4, 1rem);
}
.pce-highlight__price { color: var(--color-accent, #00C9B1); }
.pce-highlight__sep {
    display: inline-block;
    color: var(--color-text-muted, #94a3b8);
    font-weight: 600; margin: 0 4px;
}
.pce-highlight__note {
    font-size: 0.875rem; color: var(--color-text-muted, #94a3b8);
    margin: 0; line-height: 1.6;
}

/* ══ pce- FEATURES ════════════════════════════════════════════════════════════ */

.pce-features { background: rgba(30,41,59,0.25); }
.pce-features__inner { max-width: 1100px; margin: 0 auto; padding: 0 var(--space-6, 1.5rem); }
.pce-features__header { margin-bottom: var(--space-10, 2.5rem); }
.pce-features__title {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(1.5rem, 3.5vw, 2rem); font-weight: 800;
    color: var(--color-text-primary, #f8fafc); letter-spacing: -0.03em;
    margin: 0 0 var(--space-3, 0.75rem);
}
.pce-features__intro {
    font-size: 1rem; color: var(--color-text-muted, #94a3b8); margin: 0; line-height: 1.6;
}
.pce-features__grid {
    list-style: none; margin: 0; padding: 0;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px 24px;
}
@media (max-width: 860px) { .pce-features__grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 520px) { .pce-features__grid { grid-template-columns: 1fr; } }
.pce-features__item {
    display: flex; align-items: flex-start; gap: 9px;
    font-size: 0.875rem; color: var(--color-text-secondary, #cbd5e1);
    line-height: 1.5;
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 8px; padding: 10px 14px;
}
.pce-features__icon {
    flex-shrink: 0; color: var(--color-accent, #00C9B1); margin-top: 2px;
}

/* ══ pce- FORM SECTION ════════════════════════════════════════════════════════ */

.pce-form-section__inner { max-width: 700px; margin: 0 auto; padding: 0 var(--space-6, 1.5rem); }
.pce-form-section__card {
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px; padding: var(--space-10, 2.5rem) var(--space-12, 3rem);
}
@media (max-width: 600px) {
    .pce-form-section__card { padding: var(--space-8, 2rem) var(--space-6, 1.5rem); }
}
.pce-form-section__header { margin-bottom: var(--space-8, 2rem); text-align: center; }
.pce-form-section__title {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(1.375rem, 3vw, 1.875rem); font-weight: 800;
    color: var(--color-text-primary, #f8fafc); letter-spacing: -0.02em;
    margin: 0 0 var(--space-3, 0.75rem);
}
.pce-form-section__sub {
    font-size: 0.9375rem; color: var(--color-text-muted, #94a3b8);
    margin: 0; line-height: 1.6;
}

/* ── WPForms overrides (dark theme) ─────────────────────────────────────────── */
.pce-form-section__form .wpforms-form .wpforms-field-label {
    color: var(--color-text-secondary, #cbd5e1) !important;
    font-size: 0.8125rem !important; font-weight: 600 !important;
    letter-spacing: 0.03em !important;
}
.pce-form-section__form .wpforms-form input[type="text"],
.pce-form-section__form .wpforms-form input[type="email"],
.pce-form-section__form .wpforms-form input[type="url"],
.pce-form-section__form .wpforms-form input[type="tel"] {
    background: #1C2128 !important;
    border: 1px solid rgba(255,255,255,0.12) !important;
    border-radius: 8px !important;
    color: var(--color-text-primary, #f8fafc) !important;
    font-size: 0.9375rem !important;
    padding: 11px 14px !important;
    width: 100% !important;
    transition: border-color 0.15s, box-shadow 0.15s !important;
}
.pce-form-section__form .wpforms-form input:focus {
    border-color: var(--color-accent, #00C9B1) !important;
    box-shadow: 0 0 0 3px rgba(0,201,177,0.15) !important;
    outline: none !important;
}
.pce-form-section__form .wpforms-form input::placeholder {
    color: var(--color-text-faint, #64748b) !important;
}
.pce-form-section__form .wpforms-submit-container {
    margin-top: var(--space-6, 1.5rem) !important;
}
.pce-form-section__form .wpforms-form .wpforms-submit {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: var(--color-accent, #00C9B1) !important;
    color: #0d1117 !important;
    border: none !important;
    border-radius: 8px !important;
    font-family: var(--font-heading, 'Space Grotesk', sans-serif) !important;
    font-size: 0.9375rem !important;
    font-weight: 700 !important;
    padding: 13px 28px !important;
    cursor: pointer !important;
    width: 100% !important;
    transition: opacity 0.15s !important;
}
.pce-form-section__form .wpforms-form .wpforms-submit:hover { opacity: 0.88 !important; }
/* Confirmation message */
.pce-form-section__form .wpforms-confirmation-container-full {
    background: rgba(0,201,177,0.08) !important;
    border: 1px solid rgba(0,201,177,0.3) !important;
    border-radius: 10px !important;
    color: var(--color-text-primary, #f8fafc) !important;
    padding: var(--space-6, 1.5rem) !important;
    font-size: 1rem !important;
    line-height: 1.6 !important;
    text-align: center !important;
}
/* Error states */
.pce-form-section__form .wpforms-error {
    color: #f87171 !important; font-size: 0.8125rem !important; margin-top: 4px !important;
}
.pce-form-section__form .wpforms-has-error input {
    border-color: #f87171 !important;
}

/* ── section-padding utility (fallback if not in main.css) ───────────────────── */
.section-padding { padding-top: var(--space-section, clamp(60px, 8vw, 0px)); padding-bottom: clamp(60px, 8vw, 0px)); }
.pce-highlight {padding-top: 60px}
.wpforms-confirmation-container-full p {
    color: #fff !important;
}
</style>
