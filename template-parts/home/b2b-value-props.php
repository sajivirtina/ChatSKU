<?php
/**
 * B2B Value Propositions Section — 2×2 card grid
 * Matches chatsku.com "Built for the way B2B actually works."
 *
 * @package ChatSKU
 */

$data       = get_query_var( 'chatsku_b2b', [] );
$heading    = $data['heading']    ?? 'Built for the way B2B actually works.';
$subheading = $data['subheading'] ?? 'We built ChatSKU from the ground up for complex B2B buying cycles.';
$props      = $data['props']      ?? [];

if ( empty( $props ) ) {
    $props = [
        [
            'prop_title'       => 'No developer needed',
            'prop_description' => 'One line of code, works on any website. If you can paste text, you can deploy ChatSKU.',
            'prop_icon'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
        ],
        [
            'prop_title'       => 'Live in hours, not months',
            'prop_description' => 'Most stores launch the same day they sign up. No lengthy onboarding or setup calls required.',
            'prop_icon'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        ],
        [
            'prop_title'       => 'Not just another chatbot',
            'prop_description' => 'It knows your entire catalog — every SKU, every variant, every spec. It answers like your best sales rep.',
            'prop_icon'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>',
        ],
        [
            'prop_title'       => 'Built for B2B complexity',
            'prop_description' => 'Customer groups, tiered pricing, RFQ workflows, and quote management. Commerce the way B2B actually works.',
            'prop_icon'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>',
        ],
    ];
}
?>
<section class="b2b-section section-padding" aria-labelledby="b2b-heading">
    <div class="container">

        <div class="section-head reveal">
            <h2 id="b2b-heading" class="section-head__title">
                <?php echo wp_kses( $heading, [ 'em' => [], 'strong' => [] ] ); ?>
            </h2>
            <?php if ( $subheading ) : ?>
                <p class="section-head__subtitle"><?php echo esc_html( $subheading ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( ! empty( $props ) ) : ?>
            <div class="b2b-grid">
                <?php foreach ( $props as $i => $prop ) :
                    $delay = 'reveal-delay-' . min( $i + 1, 4 );
                ?>
                    <div class="b2b-card reveal <?php echo esc_attr( $delay ); ?>">
                        <?php if ( ! empty( $prop['prop_icon'] ) ) : ?>
                            <div class="b2b-card__icon" aria-hidden="true">
                                <?php echo $prop['prop_icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                            </div>
                        <?php endif; ?>
                        <div class="b2b-card__body">
                            <h3 class="b2b-card__title"><?php echo esc_html( $prop['prop_title'] ?? '' ); ?></h3>
                            <p class="b2b-card__desc"><?php echo esc_html( $prop['prop_description'] ?? '' ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<style>
.b2b-section { background: var(--color-bg-primary); }
.b2b-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    max-width: 900px;
    margin: 0 auto;
}
.b2b-card {
    display: flex;
    gap: 16px;
    align-items: flex-start;
    padding: 24px;
    border-radius: 16px;
    border: 1px solid var(--color-border);
    background: var(--color-bg-card);
    transition: border-color var(--transition-base);
}
.b2b-card:hover { border-color: rgba(0,201,177,0.3); }
.b2b-card__icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-accent-glow);
    border-radius: 12px;
    color: var(--color-accent);
    padding: 9px;
}
.b2b-card__icon svg { width: 100%; height: 100%; }
.b2b-card__title { font-size: var(--font-size-base); font-weight: 600; color: var(--color-text-primary); margin: 0 0 4px; }
.b2b-card__desc  { font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 0; line-height: var(--line-height-base); }
@media (max-width: 640px) {
    .b2b-grid { grid-template-columns: 1fr; }
}
</style>
