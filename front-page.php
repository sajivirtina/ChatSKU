<?php
/**
 * Home Page Template
 * Template Name: Home (Front Page)
 *
 * @package ChatSKU
 */

get_header();

// ── Hero ─────────────────────────────────────────────────────────────────────
$hero_eyebrow           = chatsku_field( 'hero_eyebrow',           false, 'AI-Powered B2B eCommerce' );
$hero_headline          = chatsku_field( 'hero_headline',          false, "Your catalog is losing buyers you'll never know about. <em>ChatSKU answers them. Day one.</em>" );
$hero_subheadline       = chatsku_field( 'hero_subheadline',       false, 'Built for manufacturers, distributors, and wholesalers. AI-powered chat that lets buyers search your catalog, get spec answers, and submit quotes 24/7 — without rebuilding your site.' );
$hero_primary_cta_text  = chatsku_field( 'hero_primary_cta_text',  false, 'Start Free — No Card Needed' );
$hero_primary_cta_url   = chatsku_field( 'hero_primary_cta_url',   false, chatsku_option( 'register_url', '/signup/' ) );
$hero_secondary_cta_text= chatsku_field( 'hero_secondary_cta_text',false, 'Try Live Demo' );
$hero_secondary_cta_url = chatsku_field( 'hero_secondary_cta_url', false, '/demo/' );
$hero_image             = chatsku_field( 'hero_image' );
$hero_stats             = chatsku_field( 'hero_stats', false, [] );

// ── The Problem ───────────────────────────────────────────────────────────────
$problem_heading        = chatsku_field( 'problem_heading',    false, "Your catalog shouldn't be a dead end." );
$problem_subheading     = chatsku_field( 'problem_subheading', false, "B2B buying is broken. Here's what your customers are dealing with right now." );

// ── Three Steps ───────────────────────────────────────────────────────────────
$steps_heading          = chatsku_field( 'steps_heading',    false, '3 Steps to Live.' );
$steps_subheading       = chatsku_field( 'steps_subheading', false, 'Most teams go live the same day they sign up.' );
$steps_items            = chatsku_field( 'steps_items',      false, [] );
$steps_embed_code       = chatsku_field( 'steps_embed_code' );

// ── B2B Value Props ───────────────────────────────────────────────────────────
$b2b_heading            = chatsku_field( 'b2b_heading',    false, 'Built for the way B2B actually works.' );
$b2b_subheading         = chatsku_field( 'b2b_subheading', false, 'We built ChatSKU from the ground up for complex B2B buying cycles.' );
$b2b_props              = chatsku_field( 'b2b_props',      false, [] );

// ── Power Feature ─────────────────────────────────────────────────────────────
$power_heading          = chatsku_field( 'power_heading',    false, 'Your customers. Your pricing. <em>Your rules.</em>' );
$power_subheading       = chatsku_field( 'power_subheading', false, 'Import your existing customer list, organize them into groups, and set custom pricing — all from your dashboard.' );

// ── Pricing / Trust / CTA ─────────────────────────────────────────────────────
// Defaults (mockup copy) live in the partials; pass ACF values, null = use partial default.
$pricing = [
    'eyebrow'          => chatsku_field( 'pricing_eyebrow',          false, null ),
    'heading'          => chatsku_field( 'pricing_heading',          false, null ),
    'intro'            => chatsku_field( 'pricing_intro',            false, null ),
    'includes_heading' => chatsku_field( 'pricing_includes_heading', false, null ),
    'includes_sub'     => chatsku_field( 'pricing_includes_sub',     false, null ),
    'features'         => chatsku_field( 'pricing_features',         false, [] ),
    'plans'           => chatsku_field( 'pricing_plans',           false, [] ),
    'note_text'       => chatsku_field( 'pricing_note_text',       false, null ),
    'note_link1_text' => chatsku_field( 'pricing_note_link1_text', false, null ),
    'note_link1_url'  => chatsku_field( 'pricing_note_link1_url',  false, null ),
    'note_link2_text' => chatsku_field( 'pricing_note_link2_text', false, null ),
    'note_link2_url'  => chatsku_field( 'pricing_note_link2_url',  false, null ),
];

$trust = [
    'eyebrow' => chatsku_field( 'trust_eyebrow', false, null ),
    'heading' => chatsku_field( 'trust_heading', false, null ),
    'intro'   => chatsku_field( 'trust_intro',   false, null ),
    'stats'   => chatsku_field( 'trust_stats',   false, [] ),
    'cards'   => chatsku_field( 'trust_cards',   false, [] ),
];

$cta = [
    'heading'        => chatsku_field( 'cta_heading',        false, null ),
    'sub'            => chatsku_field( 'cta_subheading',     false, null ),
    'card1_eyebrow'  => chatsku_field( 'cta_card1_eyebrow',  false, null ),
    'card1_title'    => chatsku_field( 'cta_card1_title',    false, null ),
    'card1_body'     => chatsku_field( 'cta_card1_body',     false, null ),
    'card1_btn_text' => chatsku_field( 'cta_card1_btn_text', false, null ),
    'card1_btn_url'  => chatsku_field( 'cta_card1_btn_url',  false, null ),
    'card2_eyebrow'  => chatsku_field( 'cta_card2_eyebrow',  false, null ),
    'card2_title'    => chatsku_field( 'cta_card2_title',    false, null ),
    'card2_body'     => chatsku_field( 'cta_card2_body',     false, null ),
    'card2_btn_text' => chatsku_field( 'cta_card2_btn_text', false, null ),
    'card2_btn_url'  => chatsku_field( 'cta_card2_btn_url',  false, null ),
];
?>

<main id="main" class="chatsku-main home-main">

    <!-- ═══ 1. HERO ═══════════════════════════════════════════════════════════ -->
    <?php
    set_query_var( 'chatsku_hero', [
        'eyebrow'           => $hero_eyebrow,
        'headline'          => $hero_headline,
        'subheadline'       => $hero_subheadline,
        'primary_cta_text'  => $hero_primary_cta_text,
        'primary_cta_url'   => $hero_primary_cta_url,
        'secondary_cta_text'=> $hero_secondary_cta_text,
        'secondary_cta_url' => $hero_secondary_cta_url,
        'image'             => $hero_image,
        'stats'             => $hero_stats,
    ] );
    get_template_part( 'template-parts/home/hero' );
    ?>

    <!-- ═══ 2. THE PROBLEM ════════════════════════════════════════════════════ -->
    <?php
    set_query_var( 'chatsku_features', [
        'heading'    => $problem_heading,
        'subheading' => $problem_subheading,
    ] );
    get_template_part( 'template-parts/home/features-grid' );
    ?>

    <!-- ═══ 3. THE SOLUTION ═══════════════════════════════════════════════════ -->
    <?php get_template_part( 'template-parts/home/solution' ); ?>

    <!-- ═══ PRICING ══════════════════════════════════════════════════════════ -->
    <?php
    set_query_var( 'chatsku_pricing', $pricing );
    get_template_part( 'template-parts/home/pricing' );
    ?>

    <!-- ═══ 4. HOW IT WORKS — 3 STEPS ════════════════════════════════════════ -->
    <?php
    set_query_var( 'chatsku_steps', [
        'heading'    => $steps_heading,
        'subheading' => $steps_subheading,
        'items'      => $steps_items,
        'embed_code' => $steps_embed_code,
    ] );
    get_template_part( 'template-parts/home/three-steps' );
    ?>

    <!-- ═══ 5. BUILT FOR B2B ═════════════════════════════════════════════════ -->
    <?php
    set_query_var( 'chatsku_b2b', [
        'heading'    => $b2b_heading,
        'subheading' => $b2b_subheading,
        'props'      => $b2b_props,
    ] );
    get_template_part( 'template-parts/home/b2b-value-props' );
    ?>

    <!-- ═══ 6. POWER FEATURE ══════════════════════════════════════════════════ -->
    <?php
    set_query_var( 'chatsku_power', [
        'heading'    => $power_heading,
        'subheading' => $power_subheading,
    ] );
    get_template_part( 'template-parts/home/power-feature' );
    ?>

    <!-- ═══ TRUST / CREDIBILITY ══════════════════════════════════════════════ -->
    <?php
    set_query_var( 'chatsku_trust', $trust );
    get_template_part( 'template-parts/home/trust' );
    ?>

    <!-- ═══ BOTTOM CTA ═══════════════════════════════════════════════════════ -->
    <?php
    set_query_var( 'chatsku_cta', $cta );
    get_template_part( 'template-parts/home/home-cta' );
    ?>

</main>

<?php get_footer(); ?>
