<?php
/**
 * Login Page Template
 * Template Name: Login
 *
 * @package ChatSKU
 */

get_header();

$headline      = chatsku_field( 'auth_headline',      false, 'Sign in to ChatSKU' );
$subheadline   = chatsku_field( 'auth_subheadline',   false, 'Welcome back. Sign in to manage your catalog and quotes.' );
$form_action   = chatsku_field( 'auth_form_action',   false, chatsku_option( 'external_app_url', '#' ) . '/login' );
$alt_text      = chatsku_field( 'auth_alt_link_text', false, "Don't have an account? Sign up free" );
$alt_url       = chatsku_field( 'auth_alt_link_url',  false, home_url( '/register/' ) );
$brand_image   = chatsku_field( 'auth_brand_image' );
?>

<main id="main" class="auth-page">

    <!-- Brand Side -->
    <div class="auth-page__brand">
        <div style="position: relative; z-index: 1; text-align: center;">
            <div style="font-size: 48px; font-weight: 900; color: var(--color-accent); margin-bottom: var(--space-4);">ChatSKU</div>
            <p style="color: var(--color-text-muted); font-size: var(--font-size-lg); max-width: 320px; margin: 0 auto;">AI-powered B2B chat that turns your catalog into a selling machine.</p>
            <?php if ( $brand_image && is_array( $brand_image ) ) : ?>
                <img src="<?php echo esc_url( $brand_image['url'] ); ?>" alt="" class="auth-page__brand-image" style="margin-top: var(--space-10);" loading="lazy">
            <?php else : ?>
                <!-- Decorative pattern -->
                <div style="margin-top: var(--space-12); display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; max-width: 280px; margin-left: auto; margin-right: auto; opacity: 0.3;">
                    <?php for ( $i = 0; $i < 9; $i++ ) : ?>
                        <div style="height: 40px; background: var(--color-accent); border-radius: 8px; opacity: <?php echo round( 0.3 + ( $i * 0.07 ), 2 ); ?>;"></div>
                    <?php endfor; ?>
                </div>
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
                <?php wp_nonce_field( 'chatsku_login', 'chatsku_login_nonce' ); ?>

                <div class="chatsku-form__group">
                    <label class="chatsku-form__label" for="login-email">Email Address</label>
                    <input
                        type="email"
                        id="login-email"
                        name="email"
                        class="chatsku-form__input"
                        placeholder="you@company.com"
                        required
                        autocomplete="email"
                    >
                </div>

                <div class="chatsku-form__group">
                    <label class="chatsku-form__label" for="login-password">
                        Password
                        <a href="<?php echo esc_url( chatsku_option( 'external_app_url', '#' ) . '/forgot-password' ); ?>" style="float: right; font-size: var(--font-size-xs); font-weight: 500; color: var(--color-accent);">Forgot password?</a>
                    </label>
                    <input
                        type="password"
                        id="login-password"
                        name="password"
                        class="chatsku-form__input"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <button type="submit" class="chatsku-btn chatsku-btn--primary chatsku-btn--full" style="margin-top: var(--space-2);">
                    Sign In
                </button>
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
