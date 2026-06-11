<?php
/**
 * Template Name: Agency Partners
 * Agency Partner Application Page
 * @package ChatSKU
 */

// Handle form submission
if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['agency_nonce'] ) ) {
    if ( wp_verify_nonce( $_POST['agency_nonce'], 'chatsku_agency_partner' ) ) {
        $fields = [
            'first_name'    => sanitize_text_field( $_POST['first_name'] ?? '' ),
            'last_name'     => sanitize_text_field( $_POST['last_name'] ?? '' ),
            'email'         => sanitize_email( $_POST['email'] ?? '' ),
            'company'       => sanitize_text_field( $_POST['company'] ?? '' ),
            'website'       => esc_url_raw( $_POST['website'] ?? '' ),
            'phone'         => sanitize_text_field( $_POST['phone'] ?? '' ),
            'client_count'  => sanitize_text_field( $_POST['client_count'] ?? '' ),
            'platforms'     => array_map( 'sanitize_text_field', (array) ( $_POST['platforms'] ?? [] ) ),
            'client_types'  => sanitize_textarea_field( $_POST['client_types'] ?? '' ),
            'heard_from'    => sanitize_text_field( $_POST['heard_from'] ?? '' ),
            'additional'    => sanitize_textarea_field( $_POST['additional'] ?? '' ),
        ];
        $errors = [];
        if ( ! $fields['first_name'] ) $errors[] = 'First name is required.';
        if ( ! $fields['last_name'] )  $errors[] = 'Last name is required.';
        if ( ! is_email( $fields['email'] ) ) $errors[] = 'A valid email is required.';
        if ( ! $fields['company'] )    $errors[] = 'Company name is required.';
        if ( ! $fields['website'] )    $errors[] = 'Website URL is required.';
        if ( ! $fields['client_count'] ) $errors[] = 'Client count is required.';
        if ( empty( $fields['platforms'] ) ) $errors[] = 'Please select at least one platform.';
        if ( ! $fields['client_types'] ) $errors[] = 'Please describe your client types.';
        if ( ! $fields['heard_from'] )   $errors[] = 'Please tell us how you heard about ChatSKU.';
        if ( empty( $errors ) ) {
            $platforms_str = implode( ', ', $fields['platforms'] );

            // ── Save to database (always, regardless of email result) ──
            $post_id = wp_insert_post( [
                'post_type'   => 'partner_application',
                'post_title'  => 'Agency: ' . $fields['company'] . ' — ' . $fields['email'],
                'post_status' => 'publish',
                'meta_input'  => [
                    'app_type'     => 'agency',
                    'first_name'   => $fields['first_name'],
                    'last_name'    => $fields['last_name'],
                    'email'        => $fields['email'],
                    'company'      => $fields['company'],
                    'website'      => $fields['website'],
                    'phone'        => $fields['phone'],
                    'client_count' => $fields['client_count'],
                    'platforms'    => $platforms_str,
                    'client_types' => $fields['client_types'],
                    'heard_from'   => $fields['heard_from'],
                    'additional'   => $fields['additional'],
                    'submitted_at' => current_time( 'mysql' ),
                    'ip_address'   => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ),
                ],
            ] );

            // ── Send email notification ──
            $body = "Agency Partner Application\n\nName: {$fields['first_name']} {$fields['last_name']}\nEmail: {$fields['email']}\nCompany: {$fields['company']}\nWebsite: {$fields['website']}\nPhone: {$fields['phone']}\nClient Count: {$fields['client_count']}\nPlatforms: {$platforms_str}\nClient Types: {$fields['client_types']}\nHeard From: {$fields['heard_from']}\nAdditional: {$fields['additional']}\n\n---\nView in WP Admin: " . admin_url( 'edit.php?post_type=partner_application' );
            wp_mail(
                'partners@chatsku.com',
                "New Agency Partner Application from {$fields['company']}",
                $body,
                [ "Reply-To: {$fields['first_name']} {$fields['last_name']} <{$fields['email']}>" ]
            );

            wp_redirect( add_query_arg( 'applied', '1', get_permalink() ) );
            exit;
        }
    }
}
$applied = isset( $_GET['applied'] ) && $_GET['applied'] === '1';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class('agency-partners-page'); ?>>
<?php wp_body_open(); ?>

<style>
/* ── Agency Partner Page ──────────────────────────────────────────── */
.ap-page { min-height: 100vh; background: #0D1117; color: #E2E8F0; font-family: 'Inter', sans-serif; }

/* Sticky nav */
.ap-nav { position: fixed; top: 0; left: 0; right: 0; z-index: 300; background: rgba(13,17,23,0.95); backdrop-filter: blur(12px); border-bottom: 1px solid #21262D; }
.ap-nav__inner { max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; padding: 0 24px; height: 56px; }
.ap-nav__logo { display: flex; align-items: center; gap: 8px; text-decoration: none; }
.ap-nav__logo-icon { width: 22px; height: 22px; color: #00C9A7; }
.ap-nav__logo-text { font-size: 18px; font-weight: 700; color: #fff; letter-spacing: -0.02em; }
.ap-nav__logo-text span { color: #00C9A7; }
.ap-nav__login { font-size: 13px; color: #94A3B8; text-decoration: none; display: flex; align-items: center; gap: 4px; transition: color 0.15s; }
.ap-nav__login:hover { color: #fff; }

/* Hero */
.ap-hero { position: relative; padding-top: 56px; overflow: hidden; }
.ap-hero__bg { position: absolute; inset: 0; background: linear-gradient(135deg, #0D1117, #111820, #0D1117); }
.ap-hero__dots { position: absolute; inset: 0; opacity: 0.05; background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 28px 28px; }
.ap-hero__content { position: relative; max-width: 900px; margin: 0 auto; padding: 96px 24px 80px; text-align: center; }
.ap-hero__h1 { font-family: 'Space Grotesk', sans-serif; font-size: clamp(2rem, 4vw, 3rem); font-weight: 700; color: #fff; line-height: 1.2; margin: 0 0 20px; }
.ap-hero__h1 span { color: #00C9A7; }
.ap-hero__sub { font-size: 1.05rem; color: #94A3B8; max-width: 600px; margin: 0 auto 32px; line-height: 1.7; }
.ap-hero__actions { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 12px; }
.ap-btn-primary { display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; background: #00C9A7; color: #0D1117; font-weight: 600; font-size: 15px; border-radius: 8px; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 4px 20px rgba(0,201,167,0.3); transition: background 0.15s; }
.ap-btn-primary:hover { background: #00b396; }
.ap-btn-ghost { background: transparent; border: none; color: #94A3B8; font-size: 13px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; transition: color 0.15s; }
.ap-btn-ghost:hover { color: #fff; }

/* Sections */
.ap-section { padding: 80px 24px; }
.ap-section--alt { background: #161B22; }
.ap-section__inner { max-width: 1200px; margin: 0 auto; }
.ap-section__h2 { font-family: 'Space Grotesk', sans-serif; font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 700; color: #fff; text-align: center; margin: 0 0 48px; }

/* Cards grid */
.ap-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; }
.ap-card { background: #161B22; border: 1px solid #21262D; border-radius: 12px; padding: 28px; transition: box-shadow 0.2s; }
.ap-card:hover { box-shadow: 0 4px 20px rgba(0,201,167,0.08); }
.ap-card__icon { width: 44px; height: 44px; border-radius: 8px; background: rgba(0,201,167,0.1); display: flex; align-items: center; justify-content: center; margin-bottom: 16px; color: #00C9A7; }
.ap-card__title { font-family: 'Space Grotesk', sans-serif; font-size: 1.05rem; font-weight: 700; color: #fff; margin: 0 0 10px; }
.ap-card__body { font-size: 0.875rem; color: #94A3B8; line-height: 1.7; margin: 0; }

/* How It Works steps */
.ap-steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 32px; position: relative; }
.ap-steps::before { content: ''; position: absolute; top: 40px; left: 16.66%; right: 16.66%; height: 1px; background: rgba(0,201,167,0.2); }
@media (max-width: 768px) { .ap-steps::before { display: none; } }
.ap-step { text-align: center; }
.ap-step__circle { position: relative; display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; border-radius: 50%; background: rgba(0,201,167,0.1); border: 2px solid rgba(0,201,167,0.3); margin-bottom: 16px; color: #00C9A7; }
.ap-step__num { position: absolute; top: -4px; right: -4px; width: 22px; height: 22px; border-radius: 50%; background: #00C9A7; color: #0D1117; font-size: 11px; font-weight: 700; display: flex; align-items: center; justify-content: center; }
.ap-step__title { font-family: 'Space Grotesk', sans-serif; font-size: 1.05rem; font-weight: 700; color: #fff; margin: 0 0 8px; }
.ap-step__body { font-size: 0.8125rem; color: #94A3B8; line-height: 1.7; max-width: 260px; margin: 0 auto; }

/* Tier cards */
.ap-tiers { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; }
.ap-tier { position: relative; background: #161B22; border: 2px solid #21262D; border-radius: 12px; padding: 28px; transition: box-shadow 0.2s; }
.ap-tier--featured { border-color: #00C9A7; box-shadow: 0 0 20px rgba(0,201,167,0.15); }
.ap-tier__badge { position: absolute; top: -12px; left: 50%; transform: translateX(-50%); padding: 4px 14px; border-radius: 20px; font-size: 11px; font-weight: 600; background: #00C9A7; color: #0D1117; white-space: nowrap; }
.ap-tier__badge--gold { background: rgba(240,165,0,0.15); color: #F0A500; }
.ap-tier__header { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; padding-top: 8px; }
.ap-tier__icon { color: #00C9A7; }
.ap-tier__name { font-family: 'Space Grotesk', sans-serif; font-size: 1.05rem; font-weight: 700; color: #fff; margin: 0; }
.ap-tier__features { list-style: none; padding: 0; margin: 0 0 16px; display: flex; flex-direction: column; gap: 8px; }
.ap-tier__features li { display: flex; align-items: flex-start; gap: 8px; font-size: 0.8125rem; color: #CBD5E1; }
.ap-tier__features li svg { color: #00C9A7; flex-shrink: 0; margin-top: 2px; }
.ap-tier__best { border-top: 1px solid #21262D; padding-top: 14px; font-size: 0.75rem; color: #94A3B8; }
.ap-tier__best strong { color: #fff; }

/* Form */
.ap-form-wrap { background: #161B22; border: 1px solid #21262D; border-radius: 12px; padding: 40px; }
.ap-form-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.25rem; font-weight: 700; color: #fff; margin: 0 0 6px; }
.ap-form-sub { font-size: 0.875rem; color: #94A3B8; margin: 0 0 32px; }
.ap-form { display: flex; flex-direction: column; gap: 20px; }
.ap-field { display: flex; flex-direction: column; gap: 6px; }
.ap-field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
@media (max-width: 600px) { .ap-field-row { grid-template-columns: 1fr; } }
.ap-label { font-size: 0.875rem; font-weight: 500; color: #E2E8F0; }
.ap-input, .ap-textarea, .ap-select { width: 100%; background: #1C2128; border: 1px solid #30363D; border-radius: 6px; padding: 10px 14px; font-size: 0.875rem; color: #fff; outline: none; transition: border-color 0.15s, box-shadow 0.15s; box-sizing: border-box; font-family: 'Inter', sans-serif; }
.ap-input::placeholder, .ap-textarea::placeholder { color: #6E7681; }
.ap-input:focus, .ap-textarea:focus, .ap-select:focus { border-color: #00C9A7; box-shadow: 0 0 0 2px rgba(0,201,167,0.2); }
.ap-textarea { resize: vertical; min-height: 80px; }
.ap-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px; }
.ap-select option { background: #1C2128; }
.ap-checkboxes { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding-top: 4px; }
@media (max-width: 600px) { .ap-checkboxes { grid-template-columns: 1fr; } }
.ap-checkboxes-3 { grid-template-columns: 1fr 1fr 1fr; }
.ap-checkbox-item { display: flex; align-items: center; gap: 8px; cursor: pointer; }
.ap-checkbox-item input[type="checkbox"] { width: 16px; height: 16px; accent-color: #00C9A7; cursor: pointer; }
.ap-checkbox-item label { font-size: 0.8125rem; color: #E2E8F0; cursor: pointer; }
.ap-submit { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 14px; background: #00C9A7; color: #0D1117; font-weight: 600; font-size: 15px; border-radius: 8px; border: none; cursor: pointer; transition: background 0.15s; margin-top: 4px; }
.ap-submit:hover { background: #00b396; }
.ap-form-note { font-size: 0.75rem; color: #94A3B8; text-align: center; display: flex; align-items: center; justify-content: center; gap: 6px; }
.ap-errors { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 8px; padding: 12px 16px; margin-bottom: 20px; }
.ap-errors li { font-size: 0.8125rem; color: #F87171; }

/* Success */
.ap-success { text-align: center; padding: 80px 24px; }
.ap-success__icon { width: 64px; height: 64px; border-radius: 50%; background: rgba(0,201,167,0.2); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #00C9A7; }
.ap-success__h2 { font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 700; color: #fff; margin: 0 0 12px; }
.ap-success__p { color: #94A3B8; margin: 0; }

/* Simple footer */
.ap-footer { background: #0D1117; border-top: 1px solid #21262D; padding: 40px 24px; text-align: center; }
.ap-footer__links { display: flex; align-items: center; justify-content: center; gap: 24px; margin-bottom: 12px; }
.ap-footer__links a { font-size: 0.8125rem; color: #94A3B8; text-decoration: none; transition: color 0.15s; }
.ap-footer__links a:hover { color: #fff; }
.ap-footer__cr { font-size: 0.75rem; color: rgba(148,163,184,0.6); }
</style>

<div class="ap-page" id="ap-top">

    <!-- Sticky Nav -->
    <nav class="ap-nav">
        <div class="ap-nav__inner">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="ap-nav__logo">
                <svg class="ap-nav__logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <span class="ap-nav__logo-text">Chat<span>SKU</span></span>
            </a>
            <a href="<?php echo esc_url( home_url('/login/') ); ?>" class="ap-nav__login">
                Already a partner? Sign in
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
        </div>
    </nav>

    <?php if ( $applied ) : ?>

    <!-- Success State -->
    <div class="ap-success" style="padding-top:120px;">
        <div class="ap-success__icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h2 class="ap-success__h2">🎉 Application received!</h2>
        <p class="ap-success__p">We'll be in touch within 2 business days.</p>
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="ap-btn-primary" style="margin-top:24px;display:inline-flex;">Back to Home</a>
    </div>

    <?php else : ?>

    <!-- Hero -->
    <section class="ap-hero">
        <div class="ap-hero__bg"></div>
        <div class="ap-hero__dots"></div>
        <div class="ap-hero__content">
            <h1 class="ap-hero__h1">Partner With ChatSKU.<br><span>Add a New Revenue Stream</span> to Your Agency.</h1>
            <p class="ap-hero__sub">Refer your B2B clients and get rewarded every time ChatSKU delivers results. No extra overhead. No complex builds. Just growth.</p>
            <div class="ap-hero__actions">
                <button class="ap-btn-primary" onclick="document.getElementById('ap-form').scrollIntoView({behavior:'smooth'})">
                    Apply to Become a Partner
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>
                <button class="ap-btn-ghost" onclick="document.getElementById('ap-form').scrollIntoView({behavior:'smooth'})">
                    Learn how it works
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Why Partner -->
    <section class="ap-section">
        <div class="ap-section__inner">
            <h2 class="ap-section__h2">Why Partner With ChatSKU?</h2>
            <div class="ap-cards">
                <div class="ap-card">
                    <div class="ap-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="ap-card__title">A Genuine Revenue Opportunity</h3>
                    <p class="ap-card__body">The ChatSKU Partner Program is built to be revenue-generating for your agency — not just a referral badge. When your clients win, you win.</p>
                </div>
                <div class="ap-card">
                    <div class="ap-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/></svg>
                    </div>
                    <h3 class="ap-card__title">Easy to Recommend</h3>
                    <p class="ap-card__body">ChatSKU installs with a single line of code. No complex builds. No disruption to your client's existing site. It's one of the easiest solutions you'll ever bring to a client.</p>
                </div>
                <div class="ap-card">
                    <div class="ap-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="ap-card__title">Backed by Real Support</h3>
                    <p class="ap-card__body">Your dedicated partner manager will help you onboard clients, prepare for sales conversations, and make sure your partnership is producing results.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="ap-section ap-section--alt">
        <div class="ap-section__inner">
            <h2 class="ap-section__h2">How It Works</h2>
            <div class="ap-steps">
                <div class="ap-step">
                    <div class="ap-step__circle">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        <span class="ap-step__num">1</span>
                    </div>
                    <h3 class="ap-step__title">Apply</h3>
                    <p class="ap-step__body">Fill out the form below. We'll review your agency profile and reach out within 2 business days.</p>
                </div>
                <div class="ap-step">
                    <div class="ap-step__circle">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                        <span class="ap-step__num">2</span>
                    </div>
                    <h3 class="ap-step__title">Refer</h3>
                    <p class="ap-step__body">Share ChatSKU with your B2B clients who rely on static catalogs, manual quoting, or outdated buying processes.</p>
                </div>
                <div class="ap-step">
                    <div class="ap-step__circle">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        <span class="ap-step__num">3</span>
                    </div>
                    <h3 class="ap-step__title">Earn</h3>
                    <p class="ap-step__body">Generate ongoing revenue as long as your referred clients stay active on the platform.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner Tiers -->
    <section class="ap-section">
        <div class="ap-section__inner">
            <h2 class="ap-section__h2">Partner Tiers</h2>
            <p style="text-align:center;color:#94A3B8;margin:-32px 0 48px;font-size:0.9375rem;max-width:480px;margin-left:auto;margin-right:auto;">Choose the tier that matches your agency's goals. You can always upgrade as your partnership grows.</p>
            <div class="ap-tiers">
                <div class="ap-tier">
                    <div class="ap-tier__header">
                        <svg class="ap-tier__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        <h3 class="ap-tier__name">Referral Partner</h3>
                    </div>
                    <ul class="ap-tier__features">
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Revenue-generating from your very first referral</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Co-marketing materials included</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Partner portal access</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Email support</li>
                    </ul>
                    <div class="ap-tier__best"><strong>Best for:</strong> Agencies sending occasional referrals</div>
                </div>
                <div class="ap-tier ap-tier--featured">
                    <div class="ap-tier__badge">Most Popular</div>
                    <div class="ap-tier__header">
                        <svg class="ap-tier__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                        <h3 class="ap-tier__name">Preferred Partner</h3>
                    </div>
                    <ul class="ap-tier__features">
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Recurring revenue tied to client activity</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Priority onboarding support</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Co-branded sales collateral</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Dedicated partner manager</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Quarterly business reviews</li>
                    </ul>
                    <div class="ap-tier__best"><strong>Best for:</strong> Agencies actively selling ChatSKU to clients</div>
                </div>
                <div class="ap-tier">
                    <div class="ap-tier__badge ap-tier__badge--gold">Strategic</div>
                    <div class="ap-tier__header" style="padding-top:12px;">
                        <svg class="ap-tier__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        <h3 class="ap-tier__name">Strategic Partner</h3>
                    </div>
                    <ul class="ap-tier__features">
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Custom revenue arrangement</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> White-label options available</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Joint go-to-market planning</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Technical integration support</li>
                        <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Deep platform collaboration</li>
                    </ul>
                    <div class="ap-tier__best"><strong>Best for:</strong> Large agencies building ChatSKU into their core service offering</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Form -->
    <section class="ap-section ap-section--alt" id="ap-form">
        <div class="ap-section__inner" style="max-width:700px;">
            <div class="ap-form-wrap">
                <h2 class="ap-form-title">Apply to Join the ChatSKU Partner Program</h2>
                <p class="ap-form-sub">We review all applications within 2 business days.</p>

                <?php if ( ! empty( $errors ) ) : ?>
                <div class="ap-errors">
                    <ul style="margin:0;padding-left:16px;">
                        <?php foreach ( $errors as $e ) : ?>
                        <li><?php echo esc_html( $e ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form class="ap-form" method="POST" action="">
                    <?php wp_nonce_field( 'chatsku_agency_partner', 'agency_nonce' ); ?>
                    <div class="ap-field-row">
                        <div class="ap-field">
                            <label class="ap-label" for="first_name">First Name *</label>
                            <input class="ap-input" type="text" id="first_name" name="first_name" placeholder="Jane" required maxlength="50" value="<?php echo esc_attr( $_POST['first_name'] ?? '' ); ?>">
                        </div>
                        <div class="ap-field">
                            <label class="ap-label" for="last_name">Last Name *</label>
                            <input class="ap-input" type="text" id="last_name" name="last_name" placeholder="Smith" required maxlength="50" value="<?php echo esc_attr( $_POST['last_name'] ?? '' ); ?>">
                        </div>
                    </div>
                    <div class="ap-field">
                        <label class="ap-label" for="email">Work Email *</label>
                        <input class="ap-input" type="email" id="email" name="email" placeholder="jane@agency.com" required value="<?php echo esc_attr( $_POST['email'] ?? '' ); ?>">
                    </div>
                    <div class="ap-field-row">
                        <div class="ap-field">
                            <label class="ap-label" for="company">Agency / Company Name *</label>
                            <input class="ap-input" type="text" id="company" name="company" placeholder="Acme Digital" required maxlength="100" value="<?php echo esc_attr( $_POST['company'] ?? '' ); ?>">
                        </div>
                        <div class="ap-field">
                            <label class="ap-label" for="website">Website URL *</label>
                            <input class="ap-input" type="url" id="website" name="website" placeholder="https://acmedigital.com" required value="<?php echo esc_attr( $_POST['website'] ?? '' ); ?>">
                        </div>
                    </div>
                    <div class="ap-field">
                        <label class="ap-label" for="phone">Phone Number</label>
                        <input class="ap-input" type="tel" id="phone" name="phone" placeholder="+1 555-0123" maxlength="30" value="<?php echo esc_attr( $_POST['phone'] ?? '' ); ?>">
                    </div>
                    <div class="ap-field">
                        <label class="ap-label" for="client_count">How many B2B clients does your agency work with? *</label>
                        <select class="ap-select" id="client_count" name="client_count" required>
                            <option value="">Select range</option>
                            <?php foreach ( ['1-10','11-50','51-200','200+'] as $v ) : ?>
                            <option value="<?php echo $v; ?>" <?php selected( ($_POST['client_count'] ?? ''), $v ); ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="ap-field">
                        <label class="ap-label">What platforms do your clients typically use? *</label>
                        <div class="ap-checkboxes ap-checkboxes-3">
                            <?php foreach ( ['Magento','Shopify','WooCommerce','BigCommerce','Custom','Other'] as $p ) : ?>
                            <div class="ap-checkbox-item">
                                <input type="checkbox" id="platform_<?php echo sanitize_title($p); ?>" name="platforms[]" value="<?php echo esc_attr($p); ?>" <?php if(in_array($p, (array)($_POST['platforms'] ?? []))) echo 'checked'; ?>>
                                <label for="platform_<?php echo sanitize_title($p); ?>"><?php echo esc_html($p); ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="ap-field">
                        <label class="ap-label" for="client_types">What types of clients would you refer to ChatSKU? *</label>
                        <textarea class="ap-textarea" id="client_types" name="client_types" placeholder="e.g. manufacturers, distributors, industrial suppliers..." rows="3" required maxlength="1000"><?php echo esc_textarea( $_POST['client_types'] ?? '' ); ?></textarea>
                    </div>
                    <div class="ap-field">
                        <label class="ap-label" for="heard_from">How did you hear about ChatSKU? *</label>
                        <select class="ap-select" id="heard_from" name="heard_from" required>
                            <option value="">Select option</option>
                            <?php foreach ( ['colleague'=>'Referred by a colleague','linkedin'=>'LinkedIn','search'=>'Search','sindri-virtina'=>'Sindri / Virtina','conference'=>'Conference or event','other'=>'Other'] as $v => $l ) : ?>
                            <option value="<?php echo $v; ?>" <?php selected( ($_POST['heard_from'] ?? ''), $v ); ?>><?php echo $l; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="ap-field">
                        <label class="ap-label" for="additional">Anything else you'd like us to know?</label>
                        <textarea class="ap-textarea" id="additional" name="additional" placeholder="Optional" rows="3" maxlength="1000"><?php echo esc_textarea( $_POST['additional'] ?? '' ); ?></textarea>
                    </div>
                    <div class="ap-checkbox-item">
                        <input type="checkbox" id="agree_terms" name="agree_terms" value="1" required <?php if(!empty($_POST['agree_terms'])) echo 'checked'; ?>>
                        <label for="agree_terms">I agree to the <a href="<?php echo esc_url(home_url('/terms/')); ?>" style="color:#00C9A7;">ChatSKU Partner Program Terms &amp; Conditions</a></label>
                    </div>
                    <button type="submit" class="ap-submit">
                        Submit My Application
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </button>
                    <p class="ap-form-note">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Your information is never shared or sold.
                    </p>
                </form>
            </div>
        </div>
    </section>

    <?php endif; ?>

    <!-- Footer -->
    <footer class="ap-footer">
        <div class="ap-footer__links">
            <a href="<?php echo esc_url(home_url('/privacy/')); ?>">Privacy Policy</a>
            <a href="<?php echo esc_url(home_url('/terms/')); ?>">Terms</a>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a>
        </div>
        <p class="ap-footer__cr">© <?php echo date('Y'); ?> ChatSKU. All rights reserved.</p>
    </footer>

</div><!-- .ap-page -->

<?php wp_footer(); ?>
</body>
</html>
