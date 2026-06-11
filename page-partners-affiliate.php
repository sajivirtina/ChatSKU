<?php
/**
 * Template Name: Affiliate Partner
 * Affiliate Partner Application Page
 * @package ChatSKU
 */

// Handle form submission
if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['affiliate_nonce'] ) ) {
    if ( wp_verify_nonce( $_POST['affiliate_nonce'], 'chatsku_affiliate' ) ) {
        $fields = [
            'first_name'   => sanitize_text_field( $_POST['first_name'] ?? '' ),
            'last_name'    => sanitize_text_field( $_POST['last_name'] ?? '' ),
            'email'        => sanitize_email( $_POST['email'] ?? '' ),
            'url'          => esc_url_raw( $_POST['url'] ?? '' ),
            'phone'        => sanitize_text_field( $_POST['phone'] ?? '' ),
            'audience'     => sanitize_text_field( $_POST['audience'] ?? '' ),
            'channels'     => array_map( 'sanitize_text_field', (array) ( $_POST['channels'] ?? [] ) ),
            'network_size' => sanitize_text_field( $_POST['network_size'] ?? '' ),
            'additional'   => sanitize_textarea_field( $_POST['additional'] ?? '' ),
        ];
        $errors = [];
        if ( ! $fields['first_name'] ) $errors[] = 'First name is required.';
        if ( ! $fields['last_name'] )  $errors[] = 'Last name is required.';
        if ( ! is_email( $fields['email'] ) ) $errors[] = 'A valid email is required.';
        if ( ! $fields['url'] )        $errors[] = 'Website or LinkedIn URL is required.';
        if ( ! $fields['audience'] )   $errors[] = 'Please describe your audience.';
        if ( empty( $fields['channels'] ) ) $errors[] = 'Select at least one promotion channel.';
        if ( ! $fields['network_size'] ) $errors[] = 'Please select your network size.';
        if ( empty( $errors ) ) {
            $channels_str = implode( ', ', $fields['channels'] );

            // ── Save to database (always, regardless of email result) ──
            $post_id = wp_insert_post( [
                'post_type'   => 'partner_application',
                'post_title'  => 'Affiliate: ' . $fields['first_name'] . ' ' . $fields['last_name'] . ' — ' . $fields['email'],
                'post_status' => 'publish',
                'meta_input'  => [
                    'app_type'     => 'affiliate',
                    'first_name'   => $fields['first_name'],
                    'last_name'    => $fields['last_name'],
                    'email'        => $fields['email'],
                    'url'          => $fields['url'],
                    'phone'        => $fields['phone'],
                    'audience'     => $fields['audience'],
                    'channels'     => $channels_str,
                    'network_size' => $fields['network_size'],
                    'additional'   => $fields['additional'],
                    'submitted_at' => current_time( 'mysql' ),
                    'ip_address'   => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ),
                ],
            ] );

            // ── Send email notification ──
            $body = "Affiliate Program Application\n\nName: {$fields['first_name']} {$fields['last_name']}\nEmail: {$fields['email']}\nURL: {$fields['url']}\nPhone: {$fields['phone']}\nAudience: {$fields['audience']}\nChannels: {$channels_str}\nNetwork Size: {$fields['network_size']}\nAdditional: {$fields['additional']}\n\n---\nView in WP Admin: " . admin_url( 'edit.php?post_type=partner_application' );
            wp_mail(
                'partners@chatsku.com',
                "New Affiliate Application from {$fields['first_name']} {$fields['last_name']}",
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
<?php get_header(); ?>

<style>
/* ── Affiliate Page ────────────────────────────────────────────────── */
.aff-page { background: #0D1117; color: #E2E8F0; min-height: 100vh; }

/* Hero */
.aff-hero { position: relative; padding-top: 96px; padding-bottom: 56px; overflow: hidden; }
.aff-hero__dots { position: absolute; inset: 0; opacity: 0.03; background-image: radial-gradient(#00C9A7 1px, transparent 1px); background-size: 24px 24px; }
.aff-hero__inner { position: relative; max-width: 760px; margin: 0 auto; padding: 0 24px; text-align: center; }
.aff-breadcrumb { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 12px; color: #94A3B8; margin-bottom: 24px; }
.aff-breadcrumb a { color: #94A3B8; text-decoration: none; transition: color 0.15s; }
.aff-breadcrumb a:hover { color: #00C9A7; }
.aff-breadcrumb span { color: #00C9A7; }
.aff-hero__h1 { font-family: 'Space Grotesk', sans-serif; font-size: clamp(1.875rem, 4vw, 3rem); font-weight: 700; color: #fff; line-height: 1.2; margin: 0 0 16px; }
.aff-hero__sub { font-size: 1rem; color: #94A3B8; line-height: 1.7; max-width: 580px; margin: 0 auto 32px; }
.aff-pills { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-bottom: 32px; }
.aff-pill { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; border-radius: 99px; background: #161B22; border: 1px solid #21262D; font-size: 13px; color: #E2E8F0; }
.aff-btn { display: inline-flex; align-items: center; gap: 8px; padding: 13px 32px; background: #00C9A7; color: #0D1117; font-weight: 600; font-size: 15px; border-radius: 8px; text-decoration: none; border: none; cursor: pointer; transition: background 0.15s; }
.aff-btn:hover { background: #00b396; }

/* Sections */
.aff-section { padding: 64px 24px; }
.aff-section__inner { max-width: 1100px; margin: 0 auto; }
.aff-section__h2 { font-family: 'Space Grotesk', sans-serif; font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 700; color: #fff; text-align: center; margin: 0 0 40px; }

/* Cards */
.aff-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(270px, 1fr)); gap: 20px; }
.aff-card { background: #161B22; border: 1px solid #21262D; border-radius: 12px; padding: 24px; }
.aff-card__emoji { font-size: 1.75rem; display: block; margin-bottom: 12px; }
.aff-card__title { font-family: 'Space Grotesk', sans-serif; font-size: 1rem; font-weight: 600; color: #fff; margin: 0 0 8px; }
.aff-card__body { font-size: 0.8125rem; color: #94A3B8; line-height: 1.7; margin: 0; }

/* How it works */
.aff-steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; }
.aff-step { background: #161B22; border: 1px solid #21262D; border-radius: 12px; padding: 24px; }
.aff-step__num { font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 700; color: #00C9A7; display: block; margin-bottom: 10px; }
.aff-step__title { font-family: 'Space Grotesk', sans-serif; font-size: 1rem; font-weight: 600; color: #fff; margin: 0 0 8px; }
.aff-step__body { font-size: 0.8125rem; color: #94A3B8; line-height: 1.7; margin: 0; }

/* What you get */
.aff-get-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 32px; max-width: 680px; margin: 0 auto; }
@media (max-width: 600px) { .aff-get-grid { grid-template-columns: 1fr; } }
.aff-get-item { display: flex; align-items: flex-start; gap: 10px; font-size: 0.875rem; color: #E2E8F0; }
.aff-get-item svg { color: #00C9A7; flex-shrink: 0; margin-top: 2px; }

/* Form */
.aff-form-card { background: #161B22; border: 1px solid #21262D; border-radius: 12px; padding: 36px; max-width: 700px; margin: 0 auto; }
.aff-form-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.25rem; font-weight: 700; color: #fff; margin: 0 0 4px; }
.aff-form-sub { font-size: 0.875rem; color: #94A3B8; margin: 0 0 28px; }
.aff-form { display: flex; flex-direction: column; gap: 18px; }
.aff-field { display: flex; flex-direction: column; gap: 6px; }
.aff-field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
@media (max-width: 580px) { .aff-field-row { grid-template-columns: 1fr; } }
.aff-label { font-size: 0.875rem; font-weight: 500; color: #E2E8F0; }
.aff-input, .aff-select, .aff-textarea { width: 100%; background: #1C2128; border: 1px solid #30363D; border-radius: 6px; padding: 10px 14px; font-size: 0.875rem; color: #fff; outline: none; transition: border-color 0.15s, box-shadow 0.15s; box-sizing: border-box; font-family: 'Inter', sans-serif; }
.aff-input::placeholder, .aff-textarea::placeholder { color: #6E7681; }
.aff-input:focus, .aff-select:focus, .aff-textarea:focus { border-color: #00C9A7; box-shadow: 0 0 0 2px rgba(0,201,167,0.2); }
.aff-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px; }
.aff-select option { background: #1C2128; }
.aff-textarea { resize: vertical; min-height: 72px; }
.aff-checkboxes { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; padding-top: 4px; }
@media (max-width: 580px) { .aff-checkboxes { grid-template-columns: 1fr; } }
.aff-check-item { display: flex; align-items: center; gap: 8px; cursor: pointer; }
.aff-check-item input[type="checkbox"] { width: 15px; height: 15px; accent-color: #00C9A7; cursor: pointer; }
.aff-check-item label { font-size: 0.8125rem; color: #E2E8F0; cursor: pointer; }
.aff-submit { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 13px; background: #00C9A7; color: #0D1117; font-weight: 600; font-size: 15px; border-radius: 8px; border: none; cursor: pointer; transition: background 0.15s; }
.aff-submit:hover { background: #00b396; }
.aff-form-note { font-size: 0.75rem; color: #94A3B8; text-align: center; display: flex; align-items: center; justify-content: center; gap: 6px; }
.aff-errors { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 8px; padding: 12px 16px; margin-bottom: 20px; }
.aff-errors li { font-size: 0.8125rem; color: #F87171; }

/* Success */
.aff-success { text-align: center; padding: 64px 24px; }
.aff-success__icon { color: #00C9A7; margin-bottom: 20px; }
.aff-success__h2 { font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 700; color: #fff; margin: 0 0 12px; }
.aff-success__p { color: #94A3B8; max-width: 420px; margin: 0 auto; line-height: 1.6; }
</style>

<div class="aff-page">
    <?php if ( $applied ) : ?>
    <div class="aff-success" style="padding-top:120px;">
        <div class="aff-success__icon">
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-5"/></svg>
        </div>
        <h2 class="aff-success__h2">🎉 You're in!</h2>
        <p class="aff-success__p">Check your email for your affiliate link and dashboard access. Welcome to the ChatSKU Partner Program.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="aff-btn" style="margin-top:28px;">Back to Home</a>
    </div>
    <?php else : ?>

    <!-- Hero -->
    <section class="aff-hero">
        <div class="aff-hero__dots"></div>
        <div class="aff-hero__inner">
            <div class="aff-breadcrumb">
                <a href="<?php echo esc_url(home_url('/partners/')); ?>">Partners</a>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Affiliate Program</span>
            </div>
            <h1 class="aff-hero__h1">Share ChatSKU. Earn When Your Referrals Buy.</h1>
            <p class="aff-hero__sub">Join the ChatSKU Affiliate Program — built for B2B content creators, industry consultants, newsletter writers, and LinkedIn voices who reach manufacturing, distribution, and wholesale audiences.</p>
            <div class="aff-pills">
                <span class="aff-pill">⚡ Instant approval</span>
                <span class="aff-pill">🔗 One unique link</span>
                <span class="aff-pill">📊 Real-time dashboard</span>
            </div>
            <button class="aff-btn" onclick="document.getElementById('aff-form').scrollIntoView({behavior:'smooth'})">
                Get My Affiliate Link
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
        </div>
    </section>

    <!-- How It Works -->
    <section class="aff-section">
        <div class="aff-section__inner">
            <h2 class="aff-section__h2">How It Works</h2>
            <div class="aff-steps">
                <div class="aff-step"><span class="aff-step__num">01</span><h3 class="aff-step__title">Sign Up</h3><p class="aff-step__body">Fill out the short form below. Approval is fast — usually same day.</p></div>
                <div class="aff-step"><span class="aff-step__num">02</span><h3 class="aff-step__title">Share</h3><p class="aff-step__body">Get your unique referral link and share it however you reach your audience — LinkedIn posts, newsletters, YouTube, podcasts, blog content, or direct referrals.</p></div>
                <div class="aff-step"><span class="aff-step__num">03</span><h3 class="aff-step__title">Earn</h3><p class="aff-step__body">Every time someone signs up through your link and becomes an active ChatSKU customer, you generate revenue. Track everything in real time.</p></div>
            </div>
        </div>
    </section>

    <!-- Who This Is For -->
    <section class="aff-section" style="background:#161B22;">
        <div class="aff-section__inner">
            <h2 class="aff-section__h2">Who This Is For</h2>
            <div class="aff-cards">
                <div class="aff-card"><span class="aff-card__emoji">📝</span><h3 class="aff-card__title">Content Creators</h3><p class="aff-card__body">You write, post, or speak to B2B audiences — manufacturers, distributors, procurement pros. ChatSKU is a natural fit for your followers.</p></div>
                <div class="aff-card"><span class="aff-card__emoji">🧠</span><h3 class="aff-card__title">Industry Consultants</h3><p class="aff-card__body">You advise B2B companies on operations, sales, or digital strategy. ChatSKU is a tool your clients need and you can benefit from recommending.</p></div>
                <div class="aff-card"><span class="aff-card__emoji">📧</span><h3 class="aff-card__title">Newsletter &amp; Community Owners</h3><p class="aff-card__body">You run a list or community of industrial buyers or B2B operators. One mention of ChatSKU to the right audience can generate meaningful returns.</p></div>
            </div>
        </div>
    </section>

    <!-- What You Get -->
    <section class="aff-section">
        <div class="aff-section__inner">
            <h2 class="aff-section__h2">What You Get</h2>
            <div class="aff-get-grid">
                <?php
                $benefits = [
                    'Unique trackable referral link',
                    'Dedicated affiliate support contact',
                    'Real-time referral and earnings dashboard',
                    'No minimum audience size required',
                    'Ready-made promotional copy and banners',
                    'Revenue generated on active customer referrals',
                ];
                foreach ( $benefits as $b ) :
                ?>
                <div class="aff-get-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <?php echo esc_html( $b ); ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Signup Form -->
    <section class="aff-section" style="background:#161B22;" id="aff-form">
        <div class="aff-section__inner">
            <div class="aff-form-card">
                <h2 class="aff-form-title">Join the ChatSKU Affiliate Program</h2>
                <p class="aff-form-sub">Quick approval. No minimums. Start sharing the same day.</p>

                <?php if ( ! empty( $errors ) ) : ?>
                <div class="aff-errors"><ul style="margin:0;padding-left:16px;"><?php foreach($errors as $e) echo '<li>'.esc_html($e).'</li>'; ?></ul></div>
                <?php endif; ?>

                <form class="aff-form" method="POST" action="">
                    <?php wp_nonce_field( 'chatsku_affiliate', 'affiliate_nonce' ); ?>
                    <div class="aff-field-row">
                        <div class="aff-field">
                            <label class="aff-label" for="first_name">First Name *</label>
                            <input class="aff-input" type="text" id="first_name" name="first_name" placeholder="Jane" required maxlength="50" value="<?php echo esc_attr($_POST['first_name'] ?? ''); ?>">
                        </div>
                        <div class="aff-field">
                            <label class="aff-label" for="last_name">Last Name *</label>
                            <input class="aff-input" type="text" id="last_name" name="last_name" placeholder="Smith" required maxlength="50" value="<?php echo esc_attr($_POST['last_name'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="aff-field">
                        <label class="aff-label" for="email">Email Address *</label>
                        <input class="aff-input" type="email" id="email" name="email" placeholder="jane@example.com" required value="<?php echo esc_attr($_POST['email'] ?? ''); ?>">
                    </div>
                    <div class="aff-field">
                        <label class="aff-label" for="url">Website, Blog, or LinkedIn URL *</label>
                        <input class="aff-input" type="url" id="url" name="url" placeholder="Where do you reach your audience?" required value="<?php echo esc_attr($_POST['url'] ?? ''); ?>">
                    </div>
                    <div class="aff-field">
                        <label class="aff-label" for="phone">Phone Number</label>
                        <input class="aff-input" type="tel" id="phone" name="phone" placeholder="+1 (555) 000-0000" maxlength="30" value="<?php echo esc_attr($_POST['phone'] ?? ''); ?>">
                    </div>
                    <div class="aff-field">
                        <label class="aff-label" for="audience">How would you describe your audience? *</label>
                        <select class="aff-select" id="audience" name="audience" required>
                            <option value="">Select one…</option>
                            <?php foreach ( ['B2B manufacturers and distributors','Procurement and sourcing professionals','Industrial business owners','eCommerce and digital strategy community','General business audience','Other'] as $o ) : ?>
                            <option value="<?php echo esc_attr($o); ?>" <?php selected(($_POST['audience'] ?? ''), $o); ?>><?php echo esc_html($o); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="aff-field">
                        <label class="aff-label">How do you plan to promote ChatSKU? *</label>
                        <div class="aff-checkboxes">
                            <?php foreach ( ['LinkedIn posts','Newsletter or email list','Blog or website','YouTube or podcast','Direct referrals / personal network','Other'] as $ch ) : ?>
                            <div class="aff-check-item">
                                <input type="checkbox" id="ch_<?php echo sanitize_title($ch); ?>" name="channels[]" value="<?php echo esc_attr($ch); ?>" <?php if(in_array($ch,(array)($_POST['channels']??[]))) echo 'checked'; ?>>
                                <label for="ch_<?php echo sanitize_title($ch); ?>"><?php echo esc_html($ch); ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="aff-field">
                        <label class="aff-label" for="network_size">Approximate audience or network size *</label>
                        <select class="aff-select" id="network_size" name="network_size" required>
                            <option value="">Select one…</option>
                            <?php foreach ( ['Under 1,000','1,000 – 5,000','5,000 – 25,000','25,000+','Prefer not to say'] as $s ) : ?>
                            <option value="<?php echo esc_attr($s); ?>" <?php selected(($_POST['network_size'] ?? ''), $s); ?>><?php echo esc_html($s); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="aff-field">
                        <label class="aff-label" for="additional">Anything else you'd like us to know?</label>
                        <textarea class="aff-textarea" id="additional" name="additional" placeholder="Optional" maxlength="1000"><?php echo esc_textarea($_POST['additional'] ?? ''); ?></textarea>
                    </div>
                    <div class="aff-check-item">
                        <input type="checkbox" id="agree_terms" name="agree_terms" value="1" required <?php if(!empty($_POST['agree_terms'])) echo 'checked'; ?>>
                        <label for="agree_terms">I agree to the ChatSKU <a href="<?php echo esc_url(home_url('/terms/')); ?>" style="color:#00C9A7;">Affiliate Program Terms &amp; Conditions</a></label>
                    </div>
                    <button type="submit" class="aff-submit">
                        Get My Affiliate Link
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </button>
                    <p class="aff-form-note">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Your info is never shared or sold. Approval typically same business day.
                    </p>
                </form>
            </div>
        </div>
    </section>

    <?php endif; ?>
</div><!-- .aff-page -->

<?php get_footer(); ?>
