<?php
/**
 * Register Page Template
 * Template Name: Register
 *
 * @package ChatSKU
 */

get_header();

$headline    = chatsku_field( 'auth_headline',      false, 'Start free today' );
$subheadline = chatsku_field( 'auth_subheadline',   false, 'No credit card required. Go live in under 4 hours.' );
$form_action = chatsku_field( 'auth_form_action',   false, chatsku_option( 'external_app_url', '#' ) . '/register' );
$alt_text    = chatsku_field( 'auth_alt_link_text', false, 'Already have an account? Sign in' );
$alt_url     = chatsku_field( 'auth_alt_link_url',  false, home_url( '/login/' ) );
$brand_image = chatsku_field( 'auth_brand_image' );
?>

<main id="main" class="auth-page">

    <!-- Brand Side -->
    <div class="auth-page__brand">
        <div style="position: relative; z-index: 1; text-align: center;">
            <div style="font-size: 48px; font-weight: 900; color: var(--color-accent); margin-bottom: var(--space-4);">ChatSKU</div>
            <p style="color: var(--color-text-muted); font-size: var(--font-size-lg); max-width: 320px; margin: 0 auto;">Join hundreds of B2B companies turning their static catalogs into interactive storefronts.</p>
            <ul class="check-list" style="text-align: left; margin-top: var(--space-10); max-width: 280px; margin-left: auto; margin-right: auto;">
                <li class="check-list__item">Free Starter plan — no credit card</li>
                <li class="check-list__item">Upload your catalog in minutes</li>
                <li class="check-list__item">Go live same day</li>
                <li class="check-list__item">AI learns your full catalog</li>
            </ul>
            <?php if ( $brand_image && is_array( $brand_image ) ) : ?>
                <img src="<?php echo esc_url( $brand_image['url'] ); ?>" alt="" class="auth-page__brand-image" style="margin-top: var(--space-10);" loading="lazy">
            <?php endif; ?>
        </div>
    </div>

    <!-- Form Side -->
    <div class="auth-page__form-side">
        <div class="auth-form">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="auth-form__logo" aria-label="Back to ChatSKU home">
                <span style="font-size: 24px; font-weight: 900; color: var(--color-accent);">ChatSKU</span>
            </a>

            <h1 class="auth-form__title"><?php echo esc_html( $headline ); ?></h1>
            <p class="auth-form__subtitle"><?php echo esc_html( $subheadline ); ?></p>

            <form class="chatsku-form" action="<?php echo esc_url( $form_action ); ?>" method="POST">
                <?php wp_nonce_field( 'chatsku_register', 'chatsku_register_nonce' ); ?>

                <div class="chatsku-form__group">
                    <label class="chatsku-form__label" for="reg-company">Company Name <span style="color: var(--color-error);">*</span></label>
                    <input type="text" id="reg-company" name="company_name" class="chatsku-form__input" placeholder="Acme Industrial Supply" required autocomplete="organization">
                </div>

                <div class="chatsku-form__group">
                    <label class="chatsku-form__label" for="reg-name">Your Name <span style="color: var(--color-error);">*</span></label>
                    <input type="text" id="reg-name" name="contact_name" class="chatsku-form__input" placeholder="Jane Smith" required autocomplete="name">
                </div>

                <div class="chatsku-form__group">
                    <label class="chatsku-form__label" for="reg-email">Work Email <span style="color: var(--color-error);">*</span></label>
                    <input type="email" id="reg-email" name="email" class="chatsku-form__input" placeholder="you@company.com" required autocomplete="email">
                </div>

                <div class="chatsku-form__group">
                    <label class="chatsku-form__label" for="reg-password">Password <span style="color: var(--color-error);">*</span></label>
                    <input type="password" id="reg-password" name="password" class="chatsku-form__input" placeholder="Min. 8 characters" required autocomplete="new-password" minlength="8">
                </div>

                <div class="chatsku-form__group">
                    <label class="chatsku-form__label" for="reg-industry">Industry</label>
                    <select id="reg-industry" name="industry" class="chatsku-form__select">
                        <option value="">Select your industry...</option>
                        <option value="manufacturing">Manufacturing</option>
                        <option value="distribution">Distribution / Wholesale</option>
                        <option value="industrial">Industrial Supply</option>
                        <option value="building">Building Materials</option>
                        <option value="food">Food & Beverage</option>
                        <option value="electronics">Electronics</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="chatsku-form__group">
                    <label class="chatsku-form__label" for="reg-website">Website URL</label>
                    <input type="url" id="reg-website" name="website" class="chatsku-form__input" placeholder="https://yourcompany.com" autocomplete="url">
                </div>

                <button type="submit" class="chatsku-btn chatsku-btn--primary chatsku-btn--full" style="margin-top: var(--space-2);">
                    Create Free Account →
                </button>

                <p style="font-size: var(--font-size-xs); color: var(--color-text-faint); text-align: center; margin-top: var(--space-4);">
                    By signing up, you agree to our
                    <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>" style="color: var(--color-text-muted);">Terms of Service</a>
                    and
                    <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" style="color: var(--color-text-muted);">Privacy Policy</a>.
                </p>
            </form>

            <?php if ( $alt_text ) : ?>
                <p class="auth-form__alt-link">
                    <a href="<?php echo esc_url( $alt_url ); ?>"><?php echo esc_html( $alt_text ); ?></a>
                </p>
            <?php endif; ?>
        </div>
    </div>

</main>

<?php get_footer(); ?>
