<?php
/**
 * Template Name: Pricing
 * Pricing Page — Multi-tier with Monthly/Annual toggle & SKUBit Calculator
 *
 * @package ChatSKU
 */

get_header();

// ── ACF field helpers ──────────────────────────────────────────────────────────
function pv2_field( $key, $fallback = '' ) {
    if ( function_exists( 'get_field' ) ) {
        $val = get_field( $key );
        return ( $val !== null && $val !== '' && $val !== false ) ? $val : $fallback;
    }
    return $fallback;
}

// ── Fallback defaults ──────────────────────────────────────────────────────────
$headline        = pv2_field( 'pricing_headline',        'Priced for How You Actually Use It' );
$headline_accent = pv2_field( 'pricing_headline_accent', 'Actually Use It' );
$subheadline     = pv2_field( 'pricing_subheadline',     'Flat monthly fee covers your catalog. SKUBits cover your AI-powered features. Use more, top up. Use less, pay nothing extra.' );
$toggle_monthly  = pv2_field( 'pricing_toggle_monthly',  'Monthly' );
$toggle_annual   = pv2_field( 'pricing_toggle_annual',   'Annual' );
$annual_badge    = pv2_field( 'pricing_annual_badge',    '1 MONTH FREE' );

// Use chatsku_get_repeater() (plugin) for repeater fields; fall back to hardcoded defaults
$_pid = get_the_ID() ?: 16;

$trust_badges_raw = ( function_exists( 'chatsku_get_repeater' ) && defined( 'CHATSKU_BADGE_SUB_FIELDS' ) )
    ? chatsku_get_repeater( 'pricing_trust_badges', $_pid, CHATSKU_BADGE_SUB_FIELDS )
    : [];
$trust_badges = ! empty( $trust_badges_raw ) ? array_column( $trust_badges_raw, 'badge_text' ) : [
    'Deploy in one line of code',
    'No website rebuild required',
    'Live within days',
    'Cancel anytime',
];

$plans_raw = ( function_exists( 'chatsku_get_repeater' ) && defined( 'CHATSKU_PLAN_SUB_FIELDS' ) )
    ? chatsku_get_repeater( 'pricing_plans', $_pid, CHATSKU_PLAN_SUB_FIELDS )
    : [];
$plans = ! empty( $plans_raw ) ? $plans_raw : [
    [
        'plan_name'          => 'Starter',
        'plan_featured'      => false,
        'plan_badge'         => '',
        'plan_accent_color'  => '#3B82F6',
        'plan_is_custom'     => false,
        'plan_custom_label'  => '',
        'plan_price_monthly' => 299,
        'plan_price_annual'  => 249,
        'plan_setup_fee'     => 'Setup from $2,500 — scoped to your catalog',
        'plan_skubits_count' => 500000,
        'plan_skubits_value' => '$50 in AI feature value',
        'plan_description'   => '',
        'plan_cta_text'      => 'Get Started',
        'plan_cta_url'       => '/signup/',
        'plan_features'      => [
            [ 'feature_text' => 'All Base + Functional features',  'feature_available' => 1 ],
            [ 'feature_text' => '50,000 text searches/mo',          'feature_available' => 1 ],
            [ 'feature_text' => 'AI product search',                'feature_available' => 1 ],
            [ 'feature_text' => 'RFQ & quote management',           'feature_available' => 1 ],
            [ 'feature_text' => 'Support chat',                     'feature_available' => 1 ],
            [ 'feature_text' => 'Email notifications',              'feature_available' => 1 ],
            [ 'feature_text' => 'Admin feature toggles',            'feature_available' => 1 ],
            [ 'feature_text' => 'Dedicated support',                'feature_available' => 1 ],
        ],
    ],
    [
        'plan_name'          => 'Growth',
        'plan_featured'      => true,
        'plan_badge'         => 'Most Popular',
        'plan_accent_color'  => '#00C9B1',
        'plan_is_custom'     => false,
        'plan_custom_label'  => '',
        'plan_price_monthly' => 599,
        'plan_price_annual'  => 499,
        'plan_setup_fee'     => 'Setup from $4,500 — scoped to your catalog',
        'plan_skubits_count' => 1500000,
        'plan_skubits_value' => '$150 in AI feature value',
        'plan_description'   => '',
        'plan_cta_text'      => 'Start Free Trial',
        'plan_cta_url'       => '/signup/',
        'plan_features'      => [
            [ 'feature_text' => 'Everything in Starter',            'feature_available' => 1 ],
            [ 'feature_text' => 'Image-based product search',       'feature_available' => 1 ],
            [ 'feature_text' => 'Voice search queries',             'feature_available' => 1 ],
            [ 'feature_text' => 'Order conversion tracking',        'feature_available' => 1 ],
            [ 'feature_text' => 'Quote status automation',          'feature_available' => 1 ],
            [ 'feature_text' => 'Order & inventory sync',           'feature_available' => 1 ],
            [ 'feature_text' => 'Admin SKUBit rate override',       'feature_available' => 1 ],
            [ 'feature_text' => 'Dedicated support',                'feature_available' => 1 ],
        ],
    ],
    [
        'plan_name'          => 'Professional',
        'plan_featured'      => false,
        'plan_badge'         => '',
        'plan_accent_color'  => '#8B5CF6',
        'plan_is_custom'     => false,
        'plan_custom_label'  => '',
        'plan_price_monthly' => 999,
        'plan_price_annual'  => 833,
        'plan_setup_fee'     => 'Setup from $7,500 — scoped to your catalog',
        'plan_skubits_count' => 3000000,
        'plan_skubits_value' => '$300 in AI feature value',
        'plan_description'   => '',
        'plan_cta_text'      => 'Get Started',
        'plan_cta_url'       => '/signup/',
        'plan_features'      => [
            [ 'feature_text' => 'Everything in Growth',             'feature_available' => 1 ],
            [ 'feature_text' => 'White-label branding',             'feature_available' => 1 ],
            [ 'feature_text' => 'Contract pricing & price lists',   'feature_available' => 1 ],
            [ 'feature_text' => 'Customer group discounts',         'feature_available' => 1 ],
            [ 'feature_text' => 'Price visibility rules',           'feature_available' => 1 ],
            [ 'feature_text' => 'Sales rep assignment',             'feature_available' => 1 ],
            [ 'feature_text' => 'Pipeline analytics',               'feature_available' => 1 ],
            [ 'feature_text' => 'Multi-store',                      'feature_available' => 1 ],
        ],
    ],
    [
        'plan_name'          => 'Enterprise',
        'plan_featured'      => false,
        'plan_badge'         => '',
        'plan_accent_color'  => '#F59E0B',
        'plan_is_custom'     => true,
        'plan_custom_label'  => 'Custom',
        'plan_price_monthly' => 0,
        'plan_price_annual'  => 0,
        'plan_setup_fee'     => 'Setup quoted per project — complexity-based',
        'plan_skubits_count' => 99999999,
        'plan_skubits_value' => 'Custom anchor rate available',
        'plan_description'   => '',
        'plan_cta_text'      => 'Talk to Sales',
        'plan_cta_url'       => 'mailto:hello@chatsku.com',
        'plan_features'      => [
            [ 'feature_text' => 'Everything in Professional',       'feature_available' => 1 ],
            [ 'feature_text' => 'Multi-store deployment',           'feature_available' => 1 ],
            [ 'feature_text' => 'Custom SKUBit anchor rate',        'feature_available' => 1 ],
            [ 'feature_text' => 'Dedicated account manager',        'feature_available' => 1 ],
            [ 'feature_text' => 'SLA guarantees',                   'feature_available' => 1 ],
            [ 'feature_text' => 'Custom integrations',              'feature_available' => 1 ],
            [ 'feature_text' => 'Contract billing',                 'feature_available' => 1 ],
            [ 'feature_text' => 'Onboarding & training',            'feature_available' => 1 ],
        ],
    ],
];

$skubit_title  = pv2_field( 'pricing_skubit_title',  'What is a SKUBit?' );
$skubit_body   = pv2_field( 'pricing_skubit_body',   "SKUBits are ChatSKU's usage currency for AI-powered Premium features. Your flat monthly fee includes a bundle of SKUBits. When you use Premium features — image search, voice queries, order sync — SKUBits are consumed at a fixed rate.\n\nBase features like text search (up to 50K/mo), support chat, quotes, and emails are fully covered by your flat fee. SKUBits only apply when you go beyond." );
$skubit_anchor = pv2_field( 'pricing_skubit_anchor', '1 SKUBit = $0.0001' );

$skubit_rates_raw = ( function_exists( 'chatsku_get_repeater' ) && defined( 'CHATSKU_RATE_SUB_FIELDS' ) )
    ? chatsku_get_repeater( 'pricing_skubit_rates', $_pid, CHATSKU_RATE_SUB_FIELDS )
    : [];
$skubit_rates = ! empty( $skubit_rates_raw ) ? $skubit_rates_raw : [
    [ 'rate_feature' => 'Image search (per query)',  'rate_bits' => 150, 'rate_value' => '$0.015' ],
    [ 'rate_feature' => 'Voice input (per query)',   'rate_bits' => 10,  'rate_value' => '$0.001' ],
    [ 'rate_feature' => 'Order conversion',          'rate_bits' => 200, 'rate_value' => '$0.02'  ],
    [ 'rate_feature' => 'Order/Quote sync',          'rate_bits' => 10,  'rate_value' => '$0.001' ],
    [ 'rate_feature' => 'Text search overage',       'rate_bits' => 12,  'rate_value' => '$0.0012'],
];

$calc_heading  = pv2_field( 'pricing_calc_heading',  'Estimate Your Monthly Cost' );
$calc_subtitle = pv2_field( 'pricing_calc_subtitle', 'Enter your catalog and traffic details. Your recommended plan updates in real time.' );

$faq_items_raw = ( function_exists( 'chatsku_get_repeater' ) && defined( 'CHATSKU_FAQ_SUB_FIELDS' ) )
    ? chatsku_get_repeater( 'pricing_faq_items', $_pid, CHATSKU_FAQ_SUB_FIELDS )
    : [];
$faq_items = ! empty( $faq_items_raw ) ? $faq_items_raw : [
    [ 'faq_question' => 'How does pricing work?',           'faq_answer' => 'Every plan is custom. We tailor pricing based on your catalog size, feature needs, and team requirements. Reach out to us and we\'ll put together a plan that fits.' ],
    [ 'faq_question' => 'Is there a free trial?',           'faq_answer' => 'Yes. We offer a free trial so you can experience ChatSKU with your own catalog before committing.' ],
    [ 'faq_question' => 'Do you charge per user?',          'faq_answer' => 'No. We work with you to define the right seat count for your team — no surprise per-seat fees.' ],
    [ 'faq_question' => 'What happens if my catalog grows?','faq_answer' => 'We\'ll work with you to adjust your plan as your needs evolve. Your widget stays live throughout any transition.' ],
    [ 'faq_question' => 'Can I cancel anytime?',            'faq_answer' => 'Yes. No long-term contracts or cancellation fees.' ],
    [ 'faq_question' => 'Do you offer annual billing?',     'faq_answer' => 'Yes — annual billing comes with 1 month free (equivalent to ~17% off). Toggle above to see annual prices.' ],
];

$cta_heading = pv2_field( 'pricing_cta_heading', 'Ready to see it in action?' );
$cta_sub     = pv2_field( 'pricing_cta_sub',     'Start your free trial — no credit card needed, no developer required.' );
$cta_btn     = pv2_field( 'pricing_cta_btn',     'Get Started Free' );
$cta_url     = pv2_field( 'pricing_cta_url2',    '/signup/' );

// Build JS plan data for calculator
$plans_js = [];
foreach ( $plans as $p ) {
    $plans_js[] = [
        'name'     => esc_js( $p['plan_name'] ?? '' ),
        'bits'     => (int) ( $p['plan_skubits_count'] ?? 0 ),
        'monthly'  => (int) ( $p['plan_price_monthly'] ?? 0 ),
        'annual'   => (int) ( $p['plan_price_annual'] ?? 0 ),
        'custom'   => (bool) ( $p['plan_is_custom'] ?? false ),
        'accent'   => esc_js( $p['plan_accent_color'] ?? '' ),
    ];
}
$plans_json = wp_json_encode( $plans_js );
?>

<main id="main" class="chatsku-main pricing-v2-main">

    <!-- ═══ 1. HERO ═══════════════════════════════════════════════════════════════ -->
    <section class="pv2-hero section-padding" aria-labelledby="pv2-hero-heading">
        <div class="pv2-hero__inner">

            <div class="pv2-hero__eyebrow reveal">
                <span class="pv2-eyebrow-badge">
                    <span class="pv2-eyebrow-badge__dot" aria-hidden="true"></span>
                    Transparent Pricing
                </span>
            </div>

            <h1 id="pv2-hero-heading" class="pv2-hero__title reveal reveal-delay-1">
                <?php
                $plain = esc_html( $headline );
                $accent = esc_html( $headline_accent );
                if ( $accent && strpos( $plain, $accent ) !== false ) {
                    $parts = explode( $accent, $plain, 2 );
                    echo esc_html( $parts[0] ) . '<span class="pv2-hero__title-accent">' . esc_html( $accent ) . '</span>' . esc_html( $parts[1] ?? '' );
                } else {
                    echo $plain;
                }
                ?>
            </h1>

            <p class="pv2-hero__sub reveal reveal-delay-2"><?php echo esc_html( $subheadline ); ?></p>

            <?php if ( ! empty( $trust_badges ) ) : ?>
            <ul class="pv2-trust-badges reveal reveal-delay-3" role="list" aria-label="Key benefits">
                <?php foreach ( $trust_badges as $badge ) : ?>
                <li class="pv2-trust-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                    <?php echo esc_html( $badge ); ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <!-- Billing toggle -->
            <div class="pv2-billing-toggle reveal reveal-delay-4" role="group" aria-label="Billing period">
                <span class="pv2-billing-toggle__label pv2-billing-toggle__label--monthly" id="billing-monthly-label"><?php echo esc_html( $toggle_monthly ); ?></span>
                <label class="pv2-toggle-switch" for="billing-toggle" aria-label="Switch to annual billing">
                    <input type="checkbox" id="billing-toggle" role="switch" aria-checked="false" aria-labelledby="billing-monthly-label billing-annual-label">
                    <span class="pv2-toggle-switch__track" aria-hidden="true"></span>
                </label>
                <span class="pv2-billing-toggle__label pv2-billing-toggle__label--annual" id="billing-annual-label">
                    <?php echo esc_html( $toggle_annual ); ?>
                    <?php if ( $annual_badge ) : ?>
                    <span class="pv2-billing-toggle__badge"><?php echo esc_html( $annual_badge ); ?></span>
                    <?php endif; ?>
                </span>
            </div>

        </div>
    </section>

    <!-- ═══ 2. PRICING CARDS ══════════════════════════════════════════════════════ -->
    <section class="pv2-plans" aria-labelledby="pv2-plans-heading">
        <h2 id="pv2-plans-heading" class="sr-only">Pricing plans</h2>
        <div class="pv2-plans__grid">

            <?php foreach ( $plans as $plan ) :
                $is_featured   = ! empty( $plan['plan_featured'] );
                $is_custom     = ! empty( $plan['plan_is_custom'] );
                $accent        = esc_attr( ( $plan['plan_accent_color'] ?? '' ) ?: '#00C9B1' );
                $price_mo      = (int) ( $plan['plan_price_monthly'] ?? 0 );
                $price_yr      = (int) ( $plan['plan_price_annual'] ?? 0 );
                $skubits_count = (int) ( $plan['plan_skubits_count'] ?? 0 );
                $skubits_fmt   = number_format( $skubits_count );
                $cta_href      = esc_url( $plan['plan_cta_url'] ?: '/signup/' );
                $cta_label     = esc_html( $plan['plan_cta_text'] ?: 'Get Started' );
                $plan_id       = 'plan-' . sanitize_title( $plan['plan_name'] );
            ?>
            <article
                class="pv2-card<?php echo $is_featured ? ' pv2-card--featured' : ''; ?>"
                style="--plan-accent: <?php echo $accent; ?>;"
                data-plan-bits="<?php echo $skubits_count; ?>"
                aria-labelledby="<?php echo esc_attr( $plan_id ); ?>-name"
            >
                <?php if ( $is_featured && ! empty( $plan['plan_badge'] ) ) : ?>
                <div class="pv2-card__featured-badge" aria-label="<?php echo esc_attr( $plan['plan_badge'] ); ?>">
                    <?php echo esc_html( $plan['plan_badge'] ); ?>
                </div>
                <?php endif; ?>

                <div class="pv2-card__top-bar" aria-hidden="true"></div>

                <div class="pv2-card__body">
                    <div class="pv2-card__name" id="<?php echo esc_attr( $plan_id ); ?>-name">
                        <?php echo esc_html( strtoupper( $plan['plan_name'] ) ); ?>
                    </div>

                    <div class="pv2-card__price" aria-live="polite">
                        <?php if ( $is_custom ) : ?>
                            <div class="pv2-card__price-custom"><?php echo esc_html( $plan['plan_custom_label'] ?: 'Custom' ); ?></div>
                        <?php else : ?>
                            <div class="pv2-card__price-number">
                                <span class="pv2-card__price-currency" aria-hidden="true">$</span>
                                <span class="pv2-price-monthly" aria-label="<?php echo esc_attr( '$' . $price_mo . ' per month, billed monthly' ); ?>"><?php echo esc_html( $price_mo ); ?></span>
                                <span class="pv2-price-annual" hidden aria-label="<?php echo esc_attr( '$' . $price_yr . ' per month, billed annually' ); ?>"><?php echo esc_html( $price_yr ); ?></span>
                                <span class="pv2-card__price-suffix">/mo</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ( ! empty( $plan['plan_setup_fee'] ) ) : ?>
                    <p class="pv2-card__setup"><?php echo esc_html( $plan['plan_setup_fee'] ); ?></p>
                    <?php endif; ?>

                    <?php if ( $skubits_count > 0 && $skubits_count < 99999999 ) : ?>
                    <div class="pv2-card__skubits" aria-label="Included SKUBits">
                        <span class="pv2-card__skubits-label">Included SKUBits</span>
                        <span class="pv2-card__skubits-count"><?php echo esc_html( $skubits_fmt ); ?> SKUBits</span>
                        <?php if ( ! empty( $plan['plan_skubits_value'] ) ) : ?>
                        <span class="pv2-card__skubits-value">≈ <?php echo esc_html( $plan['plan_skubits_value'] ); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php elseif ( ! empty( $plan['plan_skubits_value'] ) ) : ?>
                    <div class="pv2-card__skubits" aria-label="Included SKUBits">
                        <span class="pv2-card__skubits-label">Included SKUBits</span>
                        <span class="pv2-card__skubits-count">Custom bundle</span>
                        <span class="pv2-card__skubits-value"><?php echo esc_html( $plan['plan_skubits_value'] ); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $plan['plan_features'] ) ) : ?>
                    <ul class="pv2-card__features" role="list" aria-label="<?php echo esc_attr( $plan['plan_name'] ); ?> plan features">
                        <?php foreach ( $plan['plan_features'] as $feat ) :
                            $available = ! empty( $feat['feature_available'] );
                        ?>
                        <li class="pv2-card__feature<?php echo $available ? '' : ' pv2-card__feature--unavailable'; ?>">
                            <?php if ( $available ) : ?>
                            <svg class="pv2-card__feature-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                            <?php else : ?>
                            <svg class="pv2-card__feature-icon pv2-card__feature-icon--x" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <?php endif; ?>
                            <?php echo esc_html( $feat['feature_text'] ); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <a
                        href="<?php echo $cta_href; ?>"
                        class="pv2-card__cta<?php echo $is_featured ? ' pv2-card__cta--featured' : ''; ?>"
                        aria-label="<?php echo esc_attr( $cta_label . ' — ' . $plan['plan_name'] . ' plan' ); ?>"
                    >
                        <?php echo $cta_label; ?>
                        <?php if ( $is_featured ) : ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        <?php endif; ?>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>

        </div>
    </section>

    <!-- ═══ 3. SKUBIT EXPLAINER ═══════════════════════════════════════════════════ -->
    <section class="pv2-skubit section-padding" aria-labelledby="pv2-skubit-heading">
        <div class="pv2-skubit__inner">
            <div class="pv2-skubit__card reveal">

                <div class="pv2-skubit__left">
                    <h2 id="pv2-skubit-heading" class="pv2-skubit__title">
                        <?php
                        $st = esc_html( $skubit_title );
                        echo preg_replace( '/SKUBit/i', '<span class="pv2-skubit__title-accent">$0</span>', $st, 1 );
                        ?>
                    </h2>
                    <?php foreach ( explode( "\n\n", $skubit_body ) as $para ) : ?>
                        <p class="pv2-skubit__body"><?php echo esc_html( trim( $para ) ); ?></p>
                    <?php endforeach; ?>
                </div>

                <div class="pv2-skubit__right">
                    <div class="pv2-skubit__rate-card">
                        <p class="pv2-skubit__rate-label">SKUBit Anchor Rate</p>
                        <p class="pv2-skubit__anchor"><?php echo esc_html( $skubit_anchor ); ?></p>
                        <table class="pv2-skubit__rate-table" aria-label="SKUBit consumption rates">
                            <tbody>
                                <?php foreach ( $skubit_rates as $rate ) : ?>
                                <tr class="pv2-skubit__rate-row">
                                    <td class="pv2-skubit__rate-feature"><?php echo esc_html( $rate['rate_feature'] ); ?></td>
                                    <td class="pv2-skubit__rate-bits"><?php echo number_format( (int) $rate['rate_bits'] ); ?> SKUBits = <span class="pv2-skubit__rate-value"><?php echo esc_html( $rate['rate_value'] ); ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══ 4. SKUBIT CALCULATOR ══════════════════════════════════════════════════ -->
    <section class="pv2-calc section-padding" id="pricing-calculator" aria-labelledby="pv2-calc-heading">
        <div class="pv2-calc__inner">

            <div class="pv2-calc__header text-center reveal">
                <h2 id="pv2-calc-heading" class="pv2-calc__title"><?php echo esc_html( $calc_heading ); ?></h2>
                <p class="pv2-calc__subtitle"><?php echo esc_html( $calc_subtitle ); ?></p>
            </div>

            <!-- Recommended plan banner -->
            <div class="pv2-calc__recommendation" id="calc-recommendation" aria-live="polite" aria-label="Recommended plan">
                <div class="pv2-calc__rec-left">
                    <span class="pv2-calc__rec-label">Recommended Plan</span>
                    <strong class="pv2-calc__rec-plan" id="calc-rec-plan">Growth</strong>
                    <span class="pv2-calc__rec-price" id="calc-rec-price">$599.00/mo</span>
                </div>
                <div class="pv2-calc__rec-right">
                    <span class="pv2-calc__rec-stat"><span class="pv2-calc__rec-stat-label">Total SKUBits</span><strong id="calc-total-bits">0</strong></span>
                    <span class="pv2-calc__rec-stat"><span class="pv2-calc__rec-stat-label">SKUBit $ Value</span><strong id="calc-bits-value">$0.00</strong></span>
                    <span class="pv2-calc__rec-stat"><span class="pv2-calc__rec-stat-label">Est. Monthly Total</span><strong id="calc-monthly-total">$599.00</strong></span>
                </div>
            </div>

            <!-- Calculator body -->
            <div class="pv2-calc__body">

                <!-- Left: inputs -->
                <div class="pv2-calc__inputs">

                    <!-- Tabs -->
                    <div class="pv2-calc__tabs" role="tablist" aria-label="Calculator sections">
                        <?php
                        $calc_tabs = [
                            'catalog'   => [ 'label' => 'Catalog',   'icon' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>' ],
                            'traffic'   => [ 'label' => 'Traffic',   'icon' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>' ],
                            'commerce'  => [ 'label' => 'Commerce',  'icon' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>' ],
                            'syncs'     => [ 'label' => 'Syncs',     'icon' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><polyline points="23 20 23 14 17 14"/><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"/></svg>' ],
                            'premium'   => [ 'label' => 'Premium',   'icon' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>' ],
                        ];
                        $first = true;
                        foreach ( $calc_tabs as $tab_id => $tab ) : ?>
                        <button
                            class="pv2-calc__tab<?php echo $first ? ' pv2-calc__tab--active' : ''; ?>"
                            role="tab"
                            aria-selected="<?php echo $first ? 'true' : 'false'; ?>"
                            aria-controls="calc-panel-<?php echo esc_attr( $tab_id ); ?>"
                            id="calc-tab-<?php echo esc_attr( $tab_id ); ?>"
                            data-tab="<?php echo esc_attr( $tab_id ); ?>"
                        >
                            <?php echo $tab['icon']; ?>
                            <span><?php echo esc_html( $tab['label'] ); ?></span>
                        </button>
                        <?php $first = false; endforeach; ?>
                    </div>

                    <!-- Tab panels -->
                    <div class="pv2-calc__panels">

                        <!-- Catalog -->
                        <div id="calc-panel-catalog" role="tabpanel" aria-labelledby="calc-tab-catalog" class="pv2-calc__panel pv2-calc__panel--active">
                            <div class="pv2-calc__inputs-grid">
                                <div class="pv2-calc__input-group">
                                    <label class="pv2-calc__input-label" for="calc-catalog-pages">Catalog Pages</label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-catalog-pages" class="pv2-calc__number" value="1000" min="0" max="100000" data-calc="catalog_pages">
                                        <span class="pv2-calc__unit">pages</span>
                                    </div>
                                    <input type="range" class="pv2-calc__slider" min="0" max="10000" value="1000" step="100" aria-hidden="true" data-for="calc-catalog-pages">
                                </div>
                                <div class="pv2-calc__input-group">
                                    <label class="pv2-calc__input-label" for="calc-num-products"># of Products</label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-num-products" class="pv2-calc__number" value="500" min="0" max="100000" data-calc="num_products">
                                        <span class="pv2-calc__unit">products</span>
                                    </div>
                                    <input type="range" class="pv2-calc__slider" min="0" max="10000" value="500" step="50" aria-hidden="true" data-for="calc-num-products">
                                </div>
                                <div class="pv2-calc__input-group">
                                    <label class="pv2-calc__input-label" for="calc-images-per">Images per Product</label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-images-per" class="pv2-calc__number" value="3" min="0" max="20" data-calc="images_per_product">
                                        <span class="pv2-calc__unit">imgs</span>
                                    </div>
                                    <input type="range" class="pv2-calc__slider" min="0" max="20" value="3" step="1" aria-hidden="true" data-for="calc-images-per">
                                </div>
                                <div class="pv2-calc__input-group">
                                    <label class="pv2-calc__input-label" for="calc-variants">Avg Variants</label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-variants" class="pv2-calc__number" value="4" min="0" max="50" data-calc="avg_variants">
                                        <span class="pv2-calc__unit">variants</span>
                                    </div>
                                    <input type="range" class="pv2-calc__slider" min="0" max="50" value="4" step="1" aria-hidden="true" data-for="calc-variants">
                                </div>
                            </div>
                        </div>

                        <!-- Traffic -->
                        <div id="calc-panel-traffic" role="tabpanel" aria-labelledby="calc-tab-traffic" class="pv2-calc__panel" hidden>
                            <div class="pv2-calc__inputs-grid">
                                <div class="pv2-calc__input-group pv2-calc__input-group--auto">
                                    <label class="pv2-calc__input-label" for="calc-visitors">Chatbot Visitors/mo
                                        <span class="pv2-calc__auto-badge">Auto-calculated</span>
                                    </label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-visitors" class="pv2-calc__number" value="1750" min="0" max="1000000" data-calc="chatbot_visitors" readonly>
                                        <span class="pv2-calc__unit">visitors</span>
                                    </div>
                                    <p class="pv2-calc__auto-note">Based on catalog size. Override by typing a value.</p>
                                    <button type="button" class="pv2-calc__auto-unlock" data-target="calc-visitors">Override</button>
                                </div>
                            </div>
                        </div>

                        <!-- Commerce -->
                        <div id="calc-panel-commerce" role="tabpanel" aria-labelledby="calc-tab-commerce" class="pv2-calc__panel" hidden>
                            <div class="pv2-calc__inputs-grid">
                                <div class="pv2-calc__input-group">
                                    <label class="pv2-calc__input-label" for="calc-quotes">Quotes/mo</label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-quotes" class="pv2-calc__number" value="500" min="0" max="50000" data-calc="quotes_mo">
                                        <span class="pv2-calc__unit">quotes</span>
                                    </div>
                                    <input type="range" class="pv2-calc__slider" min="0" max="5000" value="500" step="50" aria-hidden="true" data-for="calc-quotes">
                                </div>
                                <div class="pv2-calc__input-group">
                                    <label class="pv2-calc__input-label" for="calc-orders">Orders/mo</label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-orders" class="pv2-calc__number" value="250" min="0" max="50000" data-calc="orders_mo">
                                        <span class="pv2-calc__unit">orders</span>
                                    </div>
                                    <input type="range" class="pv2-calc__slider" min="0" max="5000" value="250" step="50" aria-hidden="true" data-for="calc-orders">
                                </div>
                            </div>
                        </div>

                        <!-- Syncs -->
                        <div id="calc-panel-syncs" role="tabpanel" aria-labelledby="calc-tab-syncs" class="pv2-calc__panel" hidden>
                            <div class="pv2-calc__inputs-grid">
                                <div class="pv2-calc__input-group">
                                    <label class="pv2-calc__input-label" for="calc-order-syncs">Order Syncs/mo</label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-order-syncs" class="pv2-calc__number" value="15000" min="0" max="500000" data-calc="order_syncs">
                                        <span class="pv2-calc__unit">syncs</span>
                                    </div>
                                    <input type="range" class="pv2-calc__slider" min="0" max="100000" value="15000" step="1000" aria-hidden="true" data-for="calc-order-syncs">
                                </div>
                                <div class="pv2-calc__input-group">
                                    <label class="pv2-calc__input-label" for="calc-quote-syncs">Quote Syncs/mo</label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-quote-syncs" class="pv2-calc__number" value="30000" min="0" max="500000" data-calc="quote_syncs">
                                        <span class="pv2-calc__unit">syncs</span>
                                    </div>
                                    <input type="range" class="pv2-calc__slider" min="0" max="100000" value="30000" step="1000" aria-hidden="true" data-for="calc-quote-syncs">
                                </div>
                            </div>
                        </div>

                        <!-- Premium -->
                        <div id="calc-panel-premium" role="tabpanel" aria-labelledby="calc-tab-premium" class="pv2-calc__panel" hidden>
                            <div class="pv2-calc__inputs-grid">
                                <div class="pv2-calc__input-group">
                                    <label class="pv2-calc__input-label" for="calc-image-searches">Image Searches/mo</label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-image-searches" class="pv2-calc__number" value="4200" min="0" max="500000" data-calc="image_searches">
                                        <span class="pv2-calc__unit">searches</span>
                                    </div>
                                    <input type="range" class="pv2-calc__slider" min="0" max="50000" value="4200" step="100" aria-hidden="true" data-for="calc-image-searches">
                                </div>
                                <div class="pv2-calc__input-group">
                                    <label class="pv2-calc__input-label" for="calc-voice-searches">Voice Searches/mo</label>
                                    <div class="pv2-calc__input-row">
                                        <input type="number" id="calc-voice-searches" class="pv2-calc__number" value="7000" min="0" max="500000" data-calc="voice_searches">
                                        <span class="pv2-calc__unit">searches</span>
                                    </div>
                                    <input type="range" class="pv2-calc__slider" min="0" max="50000" value="7000" step="100" aria-hidden="true" data-for="calc-voice-searches">
                                </div>
                            </div>
                        </div>

                    </div><!-- /panels -->

                    <!-- Auto-calculated stats strip -->
                    <div class="pv2-calc__stats-strip" aria-label="Auto-calculated totals">
                        <div class="pv2-calc__stat"><span class="pv2-calc__stat-label">Chatbot Visitors</span><strong id="stat-visitors">1,750</strong></div>
                        <div class="pv2-calc__stat"><span class="pv2-calc__stat-label">Quotes/mo</span><strong id="stat-quotes">500</strong></div>
                        <div class="pv2-calc__stat"><span class="pv2-calc__stat-label">Orders/mo</span><strong id="stat-orders">250</strong></div>
                        <div class="pv2-calc__stat"><span class="pv2-calc__stat-label">Image Searches</span><strong id="stat-img-searches">4,200</strong></div>
                        <div class="pv2-calc__stat"><span class="pv2-calc__stat-label">Voice Searches</span><strong id="stat-voice-searches">7,000</strong></div>
                        <div class="pv2-calc__stat"><span class="pv2-calc__stat-label">Order Syncs</span><strong id="stat-order-syncs">15,000</strong></div>
                        <div class="pv2-calc__stat"><span class="pv2-calc__stat-label">Quote Syncs</span><strong id="stat-quote-syncs">30,000</strong></div>
                    </div>

                </div><!-- /inputs -->

                <!-- Right: consumption panel -->
                <div class="pv2-calc__output">
                    <div class="pv2-calc__consumption" aria-label="SKUBit consumption breakdown">
                        <p class="pv2-calc__consumption-label">SKUBit Consumption</p>
                        <p class="pv2-calc__consumption-total" id="output-total-bits" aria-live="polite">0<br><span>SKUBits</span></p>
                        <p class="pv2-calc__consumption-value" id="output-bits-value">= $0.00 in AI feature value</p>

                        <div class="pv2-calc__bars" role="list" aria-label="Consumption breakdown">
                            <?php
                            $bar_items = [
                                [ 'id' => 'bar-image',      'label' => 'Image Search'     ],
                                [ 'id' => 'bar-voice',      'label' => 'Voice + TTS'       ],
                                [ 'id' => 'bar-order-conv', 'label' => 'Order Conversion'  ],
                                [ 'id' => 'bar-order-sync', 'label' => 'Order Sync'        ],
                                [ 'id' => 'bar-quote-sync', 'label' => 'Quote Sync'        ],
                            ];
                            foreach ( $bar_items as $bar ) : ?>
                            <div class="pv2-calc__bar-row" role="listitem">
                                <span class="pv2-calc__bar-label"><?php echo esc_html( $bar['label'] ); ?></span>
                                <div class="pv2-calc__bar-track" aria-hidden="true">
                                    <div class="pv2-calc__bar-fill" id="<?php echo esc_attr( $bar['id'] ); ?>" style="width:0%"></div>
                                </div>
                                <span class="pv2-calc__bar-value" id="<?php echo esc_attr( $bar['id'] ); ?>-val">0</span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <p class="pv2-calc__base-note">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            Base features (first 50K support, quotes, emails) flat fee covered
                        </p>
                    </div>

                    <!-- Tier comparison -->
                    <div class="pv2-calc__tier-comparison" aria-label="Plan comparison">
                        <p class="pv2-calc__tier-label">Tier Comparison</p>
                        <div class="pv2-calc__tiers" id="calc-tiers">
                            <?php foreach ( $plans as $p ) :
                                if ( ! empty( $p['plan_is_custom'] ) ) continue;
                                $acc = esc_attr( $p['plan_accent_color'] ?: '#00C9B1' );
                            ?>
                            <div class="pv2-calc__tier" data-plan="<?php echo esc_attr( $p['plan_name'] ); ?>" data-bits="<?php echo (int) $p['plan_skubits_count']; ?>" data-price="<?php echo (int) $p['plan_price_monthly']; ?>" style="--plan-accent:<?php echo $acc; ?>;">
                                <span class="pv2-calc__tier-dot" aria-hidden="true"></span>
                                <span class="pv2-calc__tier-name"><?php echo esc_html( $p['plan_name'] ); ?></span>
                                <span class="pv2-calc__tier-price">$<?php echo number_format( (int) $p['plan_price_monthly'] ); ?>/mo</span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div><!-- /output -->
            </div><!-- /body -->

        </div>
    </section>

    <!-- ═══ 5. FAQ ════════════════════════════════════════════════════════════════ -->
    <section class="pv2-faq section-padding" aria-labelledby="pv2-faq-heading">
        <div class="pv2-faq__inner">

            <h2 id="pv2-faq-heading" class="pv2-faq__title text-center reveal">Frequently asked questions</h2>

            <div class="pv2-faq__accordion" role="list">
                <?php foreach ( $faq_items as $i => $item ) :
                    $faq_id = 'pv2-faq-' . $i;
                ?>
                <div class="pv2-faq__item" role="listitem">
                    <button
                        type="button"
                        class="pv2-faq__trigger"
                        aria-expanded="false"
                        aria-controls="<?php echo esc_attr( $faq_id ); ?>"
                        id="<?php echo esc_attr( $faq_id ); ?>-btn"
                    >
                        <span class="pv2-faq__question"><?php echo esc_html( $item['faq_question'] ); ?></span>
                        <span class="pv2-faq__chevron" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </button>
                    <div
                        class="pv2-faq__body"
                        id="<?php echo esc_attr( $faq_id ); ?>"
                        role="region"
                        aria-labelledby="<?php echo esc_attr( $faq_id ); ?>-btn"
                        hidden
                    >
                        <p class="pv2-faq__answer"><?php echo esc_html( $item['faq_answer'] ); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <p class="pv2-faq__more text-center reveal">
                <a href="/faq/" class="pv2-faq__more-link">
                    More questions? Visit the full FAQ
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </p>

        </div>
    </section>

    <!-- ═══ 6. BOTTOM CTA ════════════════════════════════════════════════════════ -->
    <section class="pv2-cta" aria-labelledby="pv2-cta-heading">
        <div class="container text-center">
            <h2 id="pv2-cta-heading" class="pv2-cta__heading reveal"><?php echo esc_html( $cta_heading ); ?></h2>
            <p class="pv2-cta__sub reveal reveal-delay-1"><?php echo esc_html( $cta_sub ); ?></p>
            <a href="<?php echo esc_url( $cta_url ); ?>" class="chatsku-btn chatsku-btn--primary pv2-cta__btn reveal reveal-delay-2">
                <?php echo esc_html( $cta_btn ); ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* ══════════════════════════════════════════════════════════════════════════════
   ChatSKU Pricing v2 — page-pricing.php styles
   BEM block prefix: pv2-
   ══════════════════════════════════════════════════════════════════════════════ */

/* ── Shared helpers ──────────────────────────────────────────────────────────── */
.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}

/* ── Hero ────────────────────────────────────────────────────────────────────── */
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

/* Billing toggle */
.pv2-billing-toggle {
    display: inline-flex; align-items: center; gap: 10px;
    background: var(--color-bg-secondary, #1e293b); border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 999px; padding: 6px 16px;
}
.pv2-billing-toggle__label {
    font-size: 0.875rem; font-weight: 600; color: var(--color-text-muted, #94a3b8);
    transition: color 0.2s;
}
.pv2-billing-toggle__label--monthly.is-active,
.pv2-billing-toggle__label--annual.is-active { color: var(--color-text-primary, #f8fafc); }
.pv2-billing-toggle__badge {
    display: inline-block; background: var(--color-accent, #00C9B1); color: #0d1117;
    font-size: 10px; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase;
    padding: 2px 8px; border-radius: 999px; margin-left: 6px;
}
/* Toggle switch */
.pv2-toggle-switch { position: relative; display: inline-block; width: 42px; height: 24px; cursor: pointer; }
.pv2-toggle-switch input { opacity: 0; width: 0; height: 0; }
.pv2-toggle-switch__track {
    position: absolute; inset: 0; background: var(--color-border, rgba(255,255,255,0.12));
    border-radius: 999px; transition: background 0.25s;
}
.pv2-toggle-switch__track::after {
    content: ''; position: absolute; left: 3px; top: 3px;
    width: 18px; height: 18px; background: #fff; border-radius: 50%;
    transition: transform 0.25s cubic-bezier(0.4,0,0.2,1);
}
.pv2-toggle-switch input:checked + .pv2-toggle-switch__track { background: var(--color-accent, #00C9B1); }
.pv2-toggle-switch input:checked + .pv2-toggle-switch__track::after { transform: translateX(18px); }
.pv2-toggle-switch input:focus-visible + .pv2-toggle-switch__track {
    outline: 2px solid var(--color-accent, #00C9B1); outline-offset: 2px;
}

/* ── Plans Grid ──────────────────────────────────────────────────────────────── */
.pv2-plans { padding-bottom: var(--space-16, 4rem); }
.pv2-plans__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    max-width: 1280px; margin: 0 auto; padding: 0 var(--space-6, 1.5rem);
}
@media (max-width: 1100px) { .pv2-plans__grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 640px)  { .pv2-plans__grid { grid-template-columns: 1fr; } }

/* Card */
.pv2-card {
    position: relative; background: var(--color-bg-secondary, #1e293b);
    border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 12px; overflow: hidden; display: flex; flex-direction: column;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.pv2-card:hover { border-color: rgba(255,255,255,0.15); }
.pv2-card--featured {
    border-color: var(--plan-accent, #00C9B1);
    box-shadow: 0 0 32px rgba(0,201,177,0.12), 0 0 64px rgba(0,201,177,0.06);
}
.pv2-card__top-bar {
    height: 3px; background: var(--plan-accent, #00C9B1);
    flex-shrink: 0;
}
.pv2-card__featured-badge {
    position: absolute; top: 12px; right: 12px;
    background: var(--plan-accent, #00C9B1); color: #0d1117;
    font-size: 10px; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
    padding: 3px 10px; border-radius: 999px;
}
.pv2-card__body { padding: 20px; display: flex; flex-direction: column; flex: 1; }
.pv2-card__name {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--plan-accent, #00C9B1); margin-bottom: 12px;
}
/* Price */
.pv2-card__price { margin-bottom: 8px; }
.pv2-card__price-number { display: flex; align-items: flex-start; line-height: 1; }
.pv2-card__price-currency {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif); font-size: 1.25rem;
    font-weight: 700; color: var(--color-text-primary, #f8fafc); margin-top: 6px;
}
.pv2-price-monthly, .pv2-price-annual {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(2rem, 4vw, 2.75rem); font-weight: 800;
    color: var(--color-text-primary, #f8fafc); letter-spacing: -0.03em;
}
.pv2-card__price-suffix {
    font-size: 0.875rem; color: var(--color-text-muted, #94a3b8);
    font-weight: 500; align-self: flex-end; margin-bottom: 4px; margin-left: 2px;
}
.pv2-card__price-custom {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(1.75rem, 4vw, 2.5rem); font-weight: 800;
    color: var(--color-text-primary, #f8fafc); letter-spacing: -0.03em;
}
.pv2-card__setup {
    font-size: 0.75rem; color: var(--color-text-muted, #94a3b8); line-height: 1.5; margin: 0 0 14px;
}
/* SKUBit box */
.pv2-card__skubits {
    background: rgba(255,255,255,0.03); border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 8px; padding: 10px 12px; margin-bottom: 14px;
}
.pv2-card__skubits-label {
    display: block; font-size: 0.6875rem; font-weight: 600; letter-spacing: 0.06em;
    text-transform: uppercase; color: var(--color-text-muted, #94a3b8); margin-bottom: 4px;
}
.pv2-card__skubits-count {
    display: block; font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: 1rem; font-weight: 700; color: var(--plan-accent, #00C9B1);
}
.pv2-card__skubits-value {
    display: block; font-size: 0.6875rem; color: var(--color-text-muted, #94a3b8); margin-top: 2px;
}
/* Features */
.pv2-card__features {
    list-style: none; margin: 0 0 auto; padding: 0; display: flex; flex-direction: column; gap: 7px;
}
.pv2-card__feature {
    display: flex; align-items: flex-start; gap: 8px;
    font-size: 0.8125rem; color: var(--color-text-secondary, #cbd5e1); line-height: 1.4;
}
.pv2-card__feature--unavailable { color: var(--color-text-muted, #94a3b8); }
.pv2-card__feature-icon { flex-shrink: 0; color: var(--plan-accent, #00C9B1); margin-top: 2px; }
.pv2-card__feature-icon--x { color: var(--color-text-faint, #64748b); }
/* CTA */
.pv2-card__cta {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    width: 100%; margin-top: 18px; padding: 11px 16px;
    border: 1px solid var(--color-border, rgba(255,255,255,0.15)); border-radius: 8px;
    font-size: 0.875rem; font-weight: 600; color: var(--color-text-primary, #f8fafc);
    text-decoration: none; transition: background 0.15s, border-color 0.15s;
    background: transparent;
}
.pv2-card__cta:hover { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.25); }
.pv2-card__cta--featured {
    background: var(--plan-accent, #00C9B1); border-color: var(--plan-accent, #00C9B1);
    color: #0d1117;
}
.pv2-card__cta--featured:hover { opacity: 0.9; background: var(--plan-accent, #00C9B1); }

/* ── SKUBit Explainer ────────────────────────────────────────────────────────── */
.pv2-skubit { background: rgba(30,41,59,0.3); }
.pv2-skubit__inner { max-width: 1100px; margin: 0 auto; padding: 0 var(--space-6, 1.5rem); }
.pv2-skubit__card {
    display: grid; grid-template-columns: 1fr 1fr; gap: 40px;
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 16px; padding: var(--space-10, 2.5rem);
}
@media (max-width: 800px) { .pv2-skubit__card { grid-template-columns: 1fr; gap: 24px; } }
.pv2-skubit__title {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800;
    color: var(--color-text-primary, #f8fafc); letter-spacing: -0.02em; margin: 0 0 16px;
}
.pv2-skubit__title-accent { color: var(--color-accent, #00C9B1); }
.pv2-skubit__body {
    font-size: 0.9375rem; color: var(--color-text-muted, #94a3b8); line-height: 1.75; margin: 0 0 12px;
}
.pv2-skubit__rate-card {
    background: rgba(255,255,255,0.03); border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 12px; padding: 20px;
}
.pv2-skubit__rate-label {
    font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase;
    color: var(--color-text-muted, #94a3b8); margin: 0 0 8px;
}
.pv2-skubit__anchor {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: 1.25rem; font-weight: 800; color: var(--color-accent, #00C9B1);
    letter-spacing: -0.01em; margin: 0 0 16px;
}
.pv2-skubit__rate-table { width: 100%; border-collapse: collapse; }
.pv2-skubit__rate-row td { padding: 6px 0; vertical-align: top; }
.pv2-skubit__rate-feature { font-size: 0.8125rem; color: var(--color-text-muted, #94a3b8); padding-right: 12px; }
.pv2-skubit__rate-bits { font-size: 0.8125rem; color: var(--color-text-secondary, #cbd5e1); white-space: nowrap; }
.pv2-skubit__rate-value { color: var(--color-accent, #00C9B1); font-weight: 600; }
.pv2-skubit__rate-row + .pv2-skubit__rate-row td { border-top: 1px solid var(--color-border, rgba(255,255,255,0.05)); }

/* ── Calculator ──────────────────────────────────────────────────────────────── */
.pv2-calc__inner { max-width: 1200px; margin: 0 auto; padding: 0 var(--space-6, 1.5rem); }
.pv2-calc__header { margin-bottom: var(--space-8, 2rem); }
.pv2-calc__title {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(1.5rem, 3.5vw, 2.25rem); font-weight: 800;
    color: var(--color-text-primary, #f8fafc); letter-spacing: -0.03em; margin: 0 0 var(--space-3, 0.75rem);
}
.pv2-calc__subtitle { font-size: 0.9375rem; color: var(--color-text-muted, #94a3b8); margin: 0; }

/* Recommendation banner */
.pv2-calc__recommendation {
    display: grid; grid-template-columns: 1fr auto; gap: 24px; align-items: center;
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 12px; padding: 16px 20px; margin-bottom: 20px;
}
@media (max-width: 600px) { .pv2-calc__recommendation { grid-template-columns: 1fr; } }
.pv2-calc__rec-label {
    display: block; font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.07em;
    text-transform: uppercase; color: var(--color-text-muted, #94a3b8); margin-bottom: 4px;
}
.pv2-calc__rec-plan {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: 1.25rem; font-weight: 800; color: var(--color-text-primary, #f8fafc);
    display: block;
}
.pv2-calc__rec-price { font-size: 0.875rem; color: var(--color-accent, #00C9B1); font-weight: 600; }
.pv2-calc__rec-right {
    display: flex; gap: 24px; flex-wrap: wrap;
}
.pv2-calc__rec-stat { display: flex; flex-direction: column; gap: 2px; }
.pv2-calc__rec-stat-label { font-size: 0.6875rem; color: var(--color-text-muted, #94a3b8); }
.pv2-calc__rec-stat strong { font-family: var(--font-heading, 'Space Grotesk', sans-serif); font-size: 0.9375rem; color: var(--color-accent, #00C9B1); }

/* Body */
.pv2-calc__body { display: grid; grid-template-columns: 1fr 360px; gap: 20px; align-items: start; }
@media (max-width: 900px) { .pv2-calc__body { grid-template-columns: 1fr; } }

/* Inputs side */
.pv2-calc__inputs {
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 12px; overflow: hidden;
}
/* Tabs */
.pv2-calc__tabs {
    display: flex; border-bottom: 1px solid var(--color-border, rgba(255,255,255,0.08));
    overflow-x: auto; scrollbar-width: none;
}
.pv2-calc__tabs::-webkit-scrollbar { display: none; }
.pv2-calc__tab {
    display: flex; align-items: center; gap: 6px; padding: 12px 16px;
    border: none; background: transparent; color: var(--color-text-muted, #94a3b8);
    font-size: 0.8125rem; font-weight: 600; cursor: pointer; white-space: nowrap;
    border-bottom: 2px solid transparent; margin-bottom: -1px; transition: color 0.15s, border-color 0.15s;
}
.pv2-calc__tab:hover { color: var(--color-text-primary, #f8fafc); }
.pv2-calc__tab--active { color: var(--color-accent, #00C9B1); border-bottom-color: var(--color-accent, #00C9B1); }
.pv2-calc__tab svg { flex-shrink: 0; }
/* Panels */
.pv2-calc__panels { padding: 20px; }
.pv2-calc__panel { display: none; }
.pv2-calc__panel--active { display: block; }
.pv2-calc__inputs-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
@media (max-width: 560px) { .pv2-calc__inputs-grid { grid-template-columns: 1fr; } }
.pv2-calc__input-group { display: flex; flex-direction: column; gap: 6px; }
.pv2-calc__input-label {
    font-size: 0.75rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase;
    color: var(--color-text-muted, #94a3b8);
}
.pv2-calc__input-row { display: flex; align-items: center; gap: 6px; }
.pv2-calc__number {
    flex: 1; background: #1C2128; border: 1px solid rgba(255,255,255,0.12);
    border-radius: 6px; padding: 8px 10px; font-size: 0.9375rem; font-weight: 700;
    color: var(--color-text-primary, #f8fafc); font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    min-width: 0; outline: none;
}
.pv2-calc__number:focus { border-color: var(--color-accent, #00C9B1); box-shadow: 0 0 0 2px rgba(0,201,177,0.15); }
.pv2-calc__number[readonly] { color: var(--color-text-muted, #94a3b8); cursor: default; }
.pv2-calc__unit { font-size: 0.75rem; color: var(--color-text-muted, #94a3b8); white-space: nowrap; }
.pv2-calc__slider {
    width: 100%; height: 3px; appearance: none; background: rgba(255,255,255,0.1);
    border-radius: 999px; outline: none; cursor: pointer;
}
.pv2-calc__slider::-webkit-slider-thumb {
    appearance: none; width: 14px; height: 14px; border-radius: 50%;
    background: var(--color-accent, #00C9B1); cursor: pointer;
}
.pv2-calc__slider::-moz-range-thumb {
    width: 14px; height: 14px; border-radius: 50%; border: none;
    background: var(--color-accent, #00C9B1); cursor: pointer;
}
/* Auto badge */
.pv2-calc__auto-badge {
    display: inline-block; background: rgba(0,201,177,0.1); color: var(--color-accent, #00C9B1);
    font-size: 9px; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
    padding: 2px 6px; border-radius: 4px; margin-left: 6px; vertical-align: middle;
}
.pv2-calc__auto-note { font-size: 0.75rem; color: var(--color-text-muted, #94a3b8); margin: 0; }
.pv2-calc__auto-unlock {
    align-self: flex-start; font-size: 0.75rem; color: var(--color-accent, #00C9B1);
    background: none; border: none; cursor: pointer; padding: 0; text-decoration: underline;
}
/* Stats strip */
.pv2-calc__stats-strip {
    display: flex; flex-wrap: wrap; gap: 0;
    border-top: 1px solid var(--color-border, rgba(255,255,255,0.08));
    padding: 12px 20px; background: rgba(255,255,255,0.01);
}
.pv2-calc__stat {
    flex: 1 1 auto; min-width: 100px; display: flex; flex-direction: column; gap: 2px;
    padding: 4px 12px 4px 0;
}
.pv2-calc__stat-label { font-size: 0.6875rem; color: var(--color-text-muted, #94a3b8); }
.pv2-calc__stat strong { font-size: 0.9375rem; font-family: var(--font-heading, 'Space Grotesk', sans-serif); color: var(--color-text-primary, #f8fafc); }

/* Output side */
.pv2-calc__output { display: flex; flex-direction: column; gap: 16px; }
.pv2-calc__consumption {
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 12px; padding: 20px;
}
.pv2-calc__consumption-label {
    font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase;
    color: var(--color-text-muted, #94a3b8); margin: 0 0 8px;
}
.pv2-calc__consumption-total {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: 2rem; font-weight: 800; color: var(--color-accent, #00C9B1);
    line-height: 1.1; margin: 0 0 4px;
}
.pv2-calc__consumption-total span { font-size: 1rem; font-weight: 600; }
.pv2-calc__consumption-value { font-size: 0.8125rem; color: var(--color-text-muted, #94a3b8); margin: 0 0 16px; }
/* Bars */
.pv2-calc__bars { display: flex; flex-direction: column; gap: 8px; margin-bottom: 12px; }
.pv2-calc__bar-row { display: grid; grid-template-columns: 110px 1fr 52px; gap: 8px; align-items: center; }
.pv2-calc__bar-label { font-size: 0.75rem; color: var(--color-text-muted, #94a3b8); }
.pv2-calc__bar-track { height: 4px; background: rgba(255,255,255,0.06); border-radius: 999px; overflow: hidden; }
.pv2-calc__bar-fill { height: 100%; background: var(--color-accent, #00C9B1); border-radius: 999px; transition: width 0.35s ease; }
.pv2-calc__bar-value { font-size: 0.75rem; color: var(--color-text-secondary, #cbd5e1); text-align: right; font-family: var(--font-heading, 'Space Grotesk', sans-serif); }
.pv2-calc__base-note { font-size: 0.75rem; color: var(--color-text-muted, #94a3b8); display: flex; align-items: flex-start; gap: 5px; margin: 0; line-height: 1.4; }
.pv2-calc__base-note svg { flex-shrink: 0; margin-top: 1px; }
/* Tier comparison */
.pv2-calc__tier-comparison {
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 12px; padding: 16px;
}
.pv2-calc__tier-label {
    font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase;
    color: var(--color-text-muted, #94a3b8); margin: 0 0 10px;
}
.pv2-calc__tiers { display: flex; flex-direction: column; gap: 6px; }
.pv2-calc__tier {
    display: grid; grid-template-columns: 16px 1fr auto; gap: 8px; align-items: center;
    padding: 6px 8px; border-radius: 6px; transition: background 0.15s;
}
.pv2-calc__tier--recommended { background: rgba(255,255,255,0.05); }
.pv2-calc__tier-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: var(--plan-accent, #00C9B1); flex-shrink: 0;
}
.pv2-calc__tier-name { font-size: 0.875rem; color: var(--color-text-secondary, #cbd5e1); font-weight: 500; }
.pv2-calc__tier--recommended .pv2-calc__tier-name { color: var(--color-text-primary, #f8fafc); font-weight: 600; }
.pv2-calc__tier-price { font-size: 0.8125rem; color: var(--color-text-muted, #94a3b8); font-family: var(--font-heading, 'Space Grotesk', sans-serif); }
.pv2-calc__tier--recommended .pv2-calc__tier-price { color: var(--plan-accent, #00C9B1); font-weight: 700; }

/* ── FAQ ─────────────────────────────────────────────────────────────────────── */
.pv2-faq__inner { max-width: 640px; margin: 0 auto; padding: 0 var(--space-6, 1.5rem); }
.pv2-faq__title {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800;
    color: var(--color-text-primary, #f8fafc); letter-spacing: -0.02em; margin: 0 0 var(--space-8, 2rem);
}
.pv2-faq__accordion { display: flex; flex-direction: column; gap: 8px; margin-bottom: var(--space-8, 2rem); }
.pv2-faq__item {
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 10px; overflow: hidden; transition: border-color 0.2s;
}
.pv2-faq__item:has(.pv2-faq__trigger[aria-expanded="true"]) { border-color: rgba(0,201,177,0.25); }
.pv2-faq__trigger {
    display: flex; align-items: center; justify-content: space-between; gap: var(--space-4, 1rem);
    width: 100%; padding: 18px 20px; border: none; background: transparent;
    cursor: pointer; text-align: left; transition: background 0.15s;
}
.pv2-faq__trigger:hover { background: rgba(255,255,255,0.03); }
.pv2-faq__question {
    font-size: 0.9375rem; font-weight: 600; color: var(--color-text-primary, #f8fafc); line-height: 1.5;
}
.pv2-faq__trigger[aria-expanded="true"] .pv2-faq__question { color: var(--color-accent, #00C9B1); }
.pv2-faq__chevron {
    display: flex; align-items: center; flex-shrink: 0;
    color: var(--color-text-muted, #94a3b8); transition: transform 0.25s cubic-bezier(0.4,0,0.2,1), color 0.2s;
}
.pv2-faq__trigger[aria-expanded="true"] .pv2-faq__chevron { transform: rotate(180deg); color: var(--color-accent, #00C9B1); }
.pv2-faq__body { padding: 0 20px 18px; }
.pv2-faq__body[hidden] { display: none; }
.pv2-faq__answer { font-size: 0.9375rem; color: var(--color-text-muted, #94a3b8); line-height: 1.75; margin: 0; }
.pv2-faq__more { margin: 0; }
.pv2-faq__more-link {
    display: inline-flex; align-items: center; gap: 6px;
    color: var(--color-accent, #00C9B1); font-size: 0.9375rem; font-weight: 600;
    text-decoration: none; transition: opacity 0.2s;
}
.pv2-faq__more-link:hover { opacity: 0.8; text-decoration: underline; text-underline-offset: 3px; }

/* ── Bottom CTA ──────────────────────────────────────────────────────────────── */
.pv2-cta {
    border-top: 1px solid var(--color-border, rgba(255,255,255,0.08));
    background: rgba(30,41,59,0.3); padding: var(--space-20, 5rem) var(--space-6, 1.5rem);
    text-align: center;
}
.pv2-cta__heading {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(1.75rem, 4vw, 2.5rem); font-weight: 800;
    color: var(--color-text-primary, #f8fafc); letter-spacing: -0.03em; margin: 0 0 var(--space-4, 1rem);
}
.pv2-cta__sub { font-size: 1.0625rem; color: var(--color-text-muted, #94a3b8); margin: 0 0 var(--space-8, 2rem); }
.pv2-cta__btn { display: inline-flex; align-items: center; gap: 8px; }
</style>

<script>
(function () {
    'use strict';

    // ── Plan data from PHP ────────────────────────────────────────────────────
    var PLANS = <?php echo $plans_json; ?>;

    // ── Billing toggle ────────────────────────────────────────────────────────
    var toggle = document.getElementById('billing-toggle');
    var labelMonthly = document.querySelector('.pv2-billing-toggle__label--monthly');
    var labelAnnual  = document.querySelector('.pv2-billing-toggle__label--annual');

    function updateBillingLabels(isAnnual) {
        if (labelMonthly) labelMonthly.classList.toggle('is-active', !isAnnual);
        if (labelAnnual)  labelAnnual.classList.toggle('is-active',  isAnnual);
    }
    updateBillingLabels(false);

    if (toggle) {
        toggle.addEventListener('change', function () {
            var isAnnual = this.checked;
            this.setAttribute('aria-checked', isAnnual ? 'true' : 'false');
            document.querySelectorAll('.pv2-price-monthly').forEach(function (el) { el.hidden = isAnnual; });
            document.querySelectorAll('.pv2-price-annual').forEach(function (el)  { el.hidden = !isAnnual; });
            updateBillingLabels(isAnnual);
        });
    }

    // ── FAQ accordion ─────────────────────────────────────────────────────────
    document.querySelectorAll('.pv2-faq__trigger').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var expanded  = this.getAttribute('aria-expanded') === 'true';
            var body = document.getElementById(this.getAttribute('aria-controls'));
            if (!body) return;
            this.setAttribute('aria-expanded', expanded ? 'false' : 'true');
            body.hidden = expanded;
        });
    });

    // ── Calculator tabs ───────────────────────────────────────────────────────
    document.querySelectorAll('.pv2-calc__tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            var tabId = this.dataset.tab;
            document.querySelectorAll('.pv2-calc__tab').forEach(function (t) {
                t.classList.remove('pv2-calc__tab--active');
                t.setAttribute('aria-selected', 'false');
            });
            document.querySelectorAll('.pv2-calc__panel').forEach(function (p) {
                p.classList.remove('pv2-calc__panel--active');
                p.hidden = true;
            });
            this.classList.add('pv2-calc__tab--active');
            this.setAttribute('aria-selected', 'true');
            var panel = document.getElementById('calc-panel-' + tabId);
            if (panel) { panel.classList.add('pv2-calc__panel--active'); panel.hidden = false; }
        });
    });

    // ── Slider ↔ number sync ──────────────────────────────────────────────────
    document.querySelectorAll('.pv2-calc__slider').forEach(function (slider) {
        var numId = slider.dataset['for'];
        var numEl = document.getElementById(numId);
        if (!numEl) return;
        slider.addEventListener('input', function () {
            numEl.value = this.value;
            recalculate();
        });
        numEl.addEventListener('input', function () {
            slider.value = this.value;
            recalculate();
        });
    });

    // Override unlock for auto-calc fields
    document.querySelectorAll('.pv2-calc__auto-unlock').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var target = document.getElementById(this.dataset.target);
            if (target) { target.removeAttribute('readonly'); target.focus(); }
            this.remove();
        });
    });

    // ── Calculator logic ──────────────────────────────────────────────────────
    function getVal(id) {
        var el = document.getElementById(id);
        return el ? (parseFloat(el.value) || 0) : 0;
    }
    function setVal(id, val) {
        var el = document.getElementById(id);
        if (el && el.readOnly) el.value = Math.round(val);
    }
    function fmtNum(n) {
        return n.toLocaleString('en-US', { maximumFractionDigits: 0 });
    }

    function recalculate() {
        var catalogPages   = getVal('calc-catalog-pages');
        var numProducts    = getVal('calc-num-products');
        var imagesPer      = getVal('calc-images-per');
        var variants       = getVal('calc-variants');
        var quotes         = getVal('calc-quotes');
        var orders         = getVal('calc-orders');
        var orderSyncs     = getVal('calc-order-syncs');
        var quoteSyncs     = getVal('calc-quote-syncs');
        var imgSearches    = getVal('calc-image-searches');
        var voiceSearches  = getVal('calc-voice-searches');

        // Auto-calc visitors
        var visEl = document.getElementById('calc-visitors');
        var visitors;
        if (visEl && visEl.readOnly) {
            visitors = Math.round(catalogPages * 1.5 + numProducts * 0.5);
            visEl.value = visitors;
        } else {
            visitors = getVal('calc-visitors');
        }

        // SKUBit calc
        var imgBits       = imgSearches * 150;
        var voiceBits     = voiceSearches * 10;
        var orderConvBits = orders * 200;
        var orderSyncBits = orderSyncs * 10;
        var quoteSyncBits = quoteSyncs * 10;
        var textOverage   = Math.max(0, visitors - 50000);
        var overageBits   = textOverage * 12;
        var totalBits     = imgBits + voiceBits + orderConvBits + orderSyncBits + quoteSyncBits + overageBits;
        var bitsValue     = totalBits * 0.0001;

        // Stats strip
        setText('stat-visitors',       fmtNum(visitors));
        setText('stat-quotes',         fmtNum(quotes));
        setText('stat-orders',         fmtNum(orders));
        setText('stat-img-searches',   fmtNum(imgSearches));
        setText('stat-voice-searches', fmtNum(voiceSearches));
        setText('stat-order-syncs',    fmtNum(orderSyncs));
        setText('stat-quote-syncs',    fmtNum(quoteSyncs));

        // Recommendation
        var recommended = PLANS[PLANS.length - 1];
        for (var i = 0; i < PLANS.length; i++) {
            if (!PLANS[i].custom && PLANS[i].bits >= totalBits) {
                recommended = PLANS[i];
                break;
            }
        }

        setText('calc-total-bits',    fmtNum(totalBits));
        setText('calc-bits-value',    '$' + bitsValue.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
        setText('output-total-bits',  fmtNum(totalBits) + '\nSKUBits');
        setText('output-bits-value',  '= $' + bitsValue.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' in AI feature value');

        if (!recommended.custom) {
            setText('calc-rec-plan',     recommended.name);
            setText('calc-rec-price',    '$' + fmtNum(recommended.monthly) + '.00/mo');
            setText('calc-monthly-total','$' + fmtNum(recommended.monthly) + '.00');
        } else {
            setText('calc-rec-plan',     recommended.name);
            setText('calc-rec-price',    'Custom pricing');
            setText('calc-monthly-total','Custom');
        }

        // Bars
        var maxBits = Math.max(totalBits, 1);
        setBar('bar-image',      imgBits,       maxBits);
        setBar('bar-voice',      voiceBits,     maxBits);
        setBar('bar-order-conv', orderConvBits, maxBits);
        setBar('bar-order-sync', orderSyncBits, maxBits);
        setBar('bar-quote-sync', quoteSyncBits, maxBits);

        // Tier comparison highlight
        document.querySelectorAll('.pv2-calc__tier').forEach(function (tier) {
            tier.classList.remove('pv2-calc__tier--recommended');
            if (tier.dataset.plan === recommended.name) {
                tier.classList.add('pv2-calc__tier--recommended');
            }
        });
    }

    function setText(id, text) {
        var el = document.getElementById(id);
        if (el) el.textContent = text;
    }
    function setBar(id, val, max) {
        var fill = document.getElementById(id);
        var valEl = document.getElementById(id + '-val');
        if (fill) fill.style.width = Math.min(100, (val / max) * 100).toFixed(1) + '%';
        if (valEl) valEl.textContent = fmtNum(val);
    }

    // Trigger all number inputs to fire recalculate
    document.querySelectorAll('.pv2-calc__number').forEach(function (input) {
        if (!input.readOnly) {
            input.addEventListener('input', recalculate);
        }
    });

    // Initial calculation
    recalculate();

})();
</script>
