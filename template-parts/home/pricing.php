<?php
/**
 * Home — Pricing Section ("Simple pricing that scales with your catalog")
 *
 * Data via get_query_var( 'chatsku_pricing' ); falls back to mockup copy so the
 * section renders correctly before any ACF content is entered.
 *
 * Layout: a full-width "Every plan includes" panel (shared capabilities) above
 * three plan cards, each with its own distinct features.
 *
 * @package ChatSKU
 */

$data    = get_query_var( 'chatsku_pricing', [] );
$eyebrow = $data['eyebrow'] ?? 'Pricing';
$heading = $data['heading'] ?? 'Simple pricing that scales with your catalog';
$intro   = $data['intro']   ?? 'Every plan includes every feature. Plans differ only by catalog size and support — not by what the assistant can do.';

$includes_heading = $data['includes_heading'] ?? 'Every plan includes';
$includes_sub     = $data['includes_sub']     ?? 'Toggle on only the capabilities you need — nothing is locked behind a higher tier.';

// Shared capabilities shown in the "Every plan includes" panel (3-col grid).
$features = $data['features'] ?? [];
if ( empty( $features ) ) {
    $features = [
        '24/7 product Q&A assistant',
        'Natural language search',
        'Image search',
        'Voice search',
        'International language support',
        'Quote building & RFQ capture',
        'Customer groups & tiered pricing',
        'Order capture & lead routing',
        'ERP / PIM integration',
        'One line of embed code',
    ];
}

// Plans — each with its OWN feature list.
$plans = $data['plans'] ?? [];
if ( empty( $plans ) ) {
    $plans = [
        [
            'plan_name'        => 'Free Trial',
            'plan_tagline'     => 'For teams who want to see it work on their own catalog',
            'plan_price_label' => 'Free',
            'plan_price_note'  => 'No credit card required',
            'plan_featured'    => false,
            'plan_badge'       => '',
            'plan_cta_text'    => 'Start Free Trial',
            'plan_cta_url'     => chatsku_option( 'register_url', '/signup/' ),
            'plan_features'    => [
                'Up to 100 SKUs',
                'Free for 3 months or until your first quote, whichever comes first',
                'Email support',
            ],
        ],
        [
            'plan_name'        => 'Growth',
            'plan_tagline'     => 'For distributors ready to capture quotes and orders',
            'plan_price_label' => 'Flat monthly',
            'plan_price_note'  => 'Simple per-site pricing — no per-seat fees',
            'plan_featured'    => true,
            'plan_badge'       => 'Most popular',
            'plan_cta_text'    => 'Get a Price',
            'plan_cta_url'     => '/roi-calculator/',
            'plan_features'    => [
                'Unlimited SKUs',
                'Priority onboarding by our team',
                'Standard support',
            ],
        ],
        [
            'plan_name'        => 'Enterprise',
            'plan_tagline'     => 'For large catalogs, multiple brands, or dedicated support',
            'plan_price_label' => 'Custom',
            'plan_price_note'  => 'Tailored to your catalog and systems',
            'plan_featured'    => false,
            'plan_badge'       => '',
            'plan_cta_text'    => 'Talk to Sales',
            'plan_cta_url'     => '/contact/',
            'plan_features'    => [
                'Multi-catalog & multi-brand',
                'Hands-on ERP / PIM setup',
                'SSO & advanced security',
                'Dedicated success manager',
            ],
        ],
    ];
}

$note_text       = $data['note_text']       ?? 'Not sure which plan fits?';
$note_link1_text = $data['note_link1_text'] ?? 'Estimate your recoverable revenue';
$note_link1_url  = $data['note_link1_url']  ?? '/roi-calculator/';
$note_link2_text = $data['note_link2_text'] ?? 'book a 15-minute demo';
$note_link2_url  = $data['note_link2_url']  ?? '/demo/';

// Renders one "✓ text" feature row; accepts a string or an ACF ['feature_text'] row.
$render_feature = function ( $feature ) {
    $ftext = is_array( $feature ) ? ( $feature['feature_text'] ?? '' ) : $feature;
    if ( ! $ftext ) { return; }
    ?>
    <li>
        <svg class="hp-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
        <?php echo esc_html( $ftext ); ?>
    </li>
    <?php
};
?>
<section class="home-pricing section-padding" aria-labelledby="home-pricing-heading">
    <div class="container">

        <div class="section-head reveal">
            <?php if ( $eyebrow ) : ?>
                <span class="home-pricing__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>
            <h2 id="home-pricing-heading" class="section-head__title">
                <?php echo wp_kses( $heading, [ 'em' => [], 'strong' => [] ] ); ?>
            </h2>
            <?php if ( $intro ) : ?>
                <p class="section-head__subtitle home-pricing__intro"><?php echo esc_html( $intro ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( ! empty( $features ) ) : ?>
        <div class="home-pricing__includes reveal">
            <?php if ( $includes_heading ) : ?><h3 class="hpi-head"><?php echo esc_html( $includes_heading ); ?></h3><?php endif; ?>
            <?php if ( $includes_sub ) : ?><p class="hpi-sub"><?php echo esc_html( $includes_sub ); ?></p><?php endif; ?>
            <ul class="hpi-grid">
                <?php foreach ( $features as $feature ) { $render_feature( $feature ); } ?>
            </ul>
        </div>
        <?php endif; ?>

        <div class="home-pricing__grid">
            <?php foreach ( $plans as $i => $plan ) :
                $featured  = ! empty( $plan['plan_featured'] );
                $badge     = $plan['plan_badge'] ?? '';
                $pfeatures = $plan['plan_features'] ?? [];
                $delay     = 'reveal-delay-' . min( $i + 1, 4 );
            ?>
                <div class="hp-card reveal <?php echo esc_attr( $delay ); ?><?php echo $featured ? ' hp-card--featured' : ''; ?>">
                    <?php if ( $badge ) : ?>
                        <span class="hp-card__badge"><?php echo esc_html( $badge ); ?></span>
                    <?php endif; ?>

                    <p class="hp-card__name"><?php echo esc_html( $plan['plan_name'] ?? '' ); ?></p>
                    <?php if ( ! empty( $plan['plan_tagline'] ) ) : ?>
                        <p class="hp-card__tagline"><?php echo esc_html( $plan['plan_tagline'] ); ?></p>
                    <?php endif; ?>

                    <p class="hp-card__price"><?php echo esc_html( $plan['plan_price_label'] ?? '' ); ?></p>
                    <?php if ( ! empty( $plan['plan_price_note'] ) ) : ?>
                        <p class="hp-card__note"><?php echo esc_html( $plan['plan_price_note'] ); ?></p>
                    <?php endif; ?>

                    <?php if ( ! empty( $pfeatures ) ) : ?>
                        <ul class="hp-card__features">
                            <?php foreach ( $pfeatures as $feature ) { $render_feature( $feature ); } ?>
                        </ul>
                    <?php endif; ?>

                    <a href="<?php echo esc_url( $plan['plan_cta_url'] ?? '#' ); ?>" class="chatsku-btn <?php echo $featured ? 'chatsku-btn--primary' : 'chatsku-btn--secondary'; ?> chatsku-btn--full hp-card__cta">
                        <?php echo esc_html( $plan['plan_cta_text'] ?? 'Get Started' ); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ( $note_text || $note_link1_text || $note_link2_text ) : ?>
            <p class="home-pricing__foot reveal">
                <?php echo esc_html( $note_text ); ?>
                <?php if ( $note_link1_text ) : ?>
                    <a href="<?php echo esc_url( $note_link1_url ); ?>"><?php echo esc_html( $note_link1_text ); ?></a>
                <?php endif; ?>
                <?php if ( $note_link2_text ) : ?>
                    or <a href="<?php echo esc_url( $note_link2_url ); ?>"><?php echo esc_html( $note_link2_text ); ?></a>
                <?php endif; ?>
            </p>
        <?php endif; ?>

    </div>
</section>

<style>
.home-pricing { background: var(--color-bg-primary); }
.home-pricing__eyebrow {
    display: inline-block;
    font-size: var(--font-size-sm);
    font-weight: 600;
    color: var(--color-accent);
    background: var(--color-accent-glow);
    border: 1px solid var(--color-border-accent);
    border-radius: var(--radius-full);
    padding: 4px 14px;
    margin-bottom: var(--space-4);
}
.home-pricing__intro { max-width: 720px; margin-left: auto; margin-right: auto; }

/* Every plan includes — full-width panel */
.home-pricing__includes {
    margin-top: var(--space-12);
    padding: 28px 30px;
    border-radius: var(--radius-xl);
    border: 1px solid var(--color-border);
    background: var(--color-bg-card);
}
.hpi-head { text-align: center; font-size: 1.05rem; font-weight: 800; color: var(--color-text-primary); margin: 0; }
.hpi-sub  { text-align: center; font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 6px 0 22px; }
.hpi-grid {
    list-style: none; margin: 0; padding: 0;
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 14px 28px; max-width: 980px; margin: 0 auto;
}
.hpi-grid li { display: flex; align-items: flex-start; gap: 10px; font-size: var(--font-size-sm); color: var(--color-text-muted); line-height: 1.45; }

/* Plan cards */
.home-pricing__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
    align-items: start;
    margin-top: 22px;
}
.hp-card {
    position: relative;
    display: flex;
    flex-direction: column;
    padding: 28px 26px;
    border-radius: var(--radius-xl);
    border: 1px solid var(--color-border);
    background: var(--color-bg-card);
}
.hp-card--featured {
    border-color: var(--color-border-accent);
    box-shadow: 0 0 0 1px var(--color-border-accent), 0 18px 50px -20px rgba(0,201,177,0.35);
}
.hp-card__badge {
    position: absolute;
    top: 18px;
    left: 26px;
    font-size: 11px;
    font-weight: 700;
    color: var(--color-accent);
    background: var(--color-accent-glow);
    border: 1px solid var(--color-border-accent);
    border-radius: var(--radius-full);
    padding: 3px 12px;
}
.hp-card--featured .hp-card__name { margin-top: 26px; }
.hp-card__name { font-size: 1.25rem; font-weight: 800; color: var(--color-text-primary); margin: 0; }
.hp-card__tagline { font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 6px 0 0; line-height: var(--line-height-base); }
.hp-card__price { font-size: 1.6rem; font-weight: 800; color: var(--color-text-primary); margin: 20px 0 0; letter-spacing: -0.02em; }
.hp-card__note { font-size: 12.5px; color: var(--color-text-muted); margin: 6px 0 0; line-height: 1.55; }
.hp-card__features { list-style: none; margin: 20px 0 24px; padding: 18px 0 0; border-top: 1px solid var(--color-border); display: flex; flex-direction: column; gap: 12px; }
.hp-card__features li { display: flex; align-items: flex-start; gap: 10px; font-size: var(--font-size-sm); color: var(--color-text-muted); line-height: 1.45; }
.hp-check { width: 18px; height: 18px; flex-shrink: 0; color: var(--color-accent); margin-top: 1px; }
.hp-card__cta { margin-top: auto; }
.home-pricing__foot { text-align: center; margin-top: var(--space-10); color: var(--color-text-muted); font-size: var(--font-size-sm); }
.home-pricing__foot a { color: var(--color-accent); font-weight: 600; text-decoration: none; }
.home-pricing__foot a:hover { text-decoration: underline; }
@media (max-width: 900px) {
    .hpi-grid { grid-template-columns: 1fr 1fr; }
    .home-pricing__grid { grid-template-columns: 1fr; max-width: 460px; margin-left: auto; margin-right: auto; }
}
@media (max-width: 560px) {
    .hpi-grid { grid-template-columns: 1fr; }
}
</style>
