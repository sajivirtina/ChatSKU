<?php
/**
 * Thank You Page Template
 * Template Name: Thank You
 *
 * Displayed after Revenutize signup form submission.
 * URL: /thankyou/?lead_id=XXX&form_id=XXX
 *
 * @package ChatSKU
 */

get_header();

// Sanitise URL params (display only — not stored)
$lead_id = isset( $_GET['lead_id'] ) ? absint( $_GET['lead_id'] ) : 0;
$form_id = isset( $_GET['form_id'] ) ? absint( $_GET['form_id'] ) : 0;

// ACF-editable fields with sensible defaults
$heading     = chatsku_field( 'thankyou_heading',     false, "You're all set!" );
$subheading  = chatsku_field( 'thankyou_subheading',  false, "Thanks for signing up. We're getting your store ready — check your inbox for next steps." );
$card_text   = chatsku_field( 'thankyou_card_text',   false, 'Your AI-powered catalog is being set up. You\'ll receive an email with your login credentials and onboarding guide shortly.' );
$btn1_text   = chatsku_field( 'thankyou_btn1_text',   false, 'Back to Home' );
$btn1_url    = chatsku_field( 'thankyou_btn1_url',    false, home_url( '/' ) );
$btn2_text   = chatsku_field( 'thankyou_btn2_text',   false, 'Explore the Demo' );
$btn2_url    = chatsku_field( 'thankyou_btn2_url',    false, home_url( '/demo/' ) );
?>

<main id="main" class="chatsku-main thankyou-page" role="main">
    <div class="thankyou-wrap">

        <!-- Check icon -->
        <div class="thankyou-icon" aria-hidden="true">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5"/>
            </svg>
        </div>

        <!-- Heading -->
        <h1 class="thankyou-heading"><?php echo esc_html( $heading ); ?></h1>
        <p class="thankyou-subheading"><?php echo esc_html( $subheading ); ?></p>

        <!-- Info card -->
        <div class="thankyou-card">
            <!-- Logo -->
            <div class="thankyou-card__logo">
                <?php
                $logo_id = get_theme_mod( 'custom_logo' );
                if ( $logo_id ) :
                    echo wp_get_attachment_image( $logo_id, 'full', false, [
                        'class'  => 'thankyou-card__logo-img',
                        'alt'    => get_bloginfo( 'name' ),
                    ] );
                else : ?>
                    <span class="thankyou-card__logo-text">
                        <?php bloginfo( 'name' ); ?>
                    </span>
                <?php endif; ?>
            </div>

            <p class="thankyou-card__text"><?php echo esc_html( $card_text ); ?></p>
        </div>

        <!-- CTA buttons -->
        <div class="thankyou-actions">
            <a href="<?php echo esc_url( $btn1_url ); ?>" class="chatsku-btn chatsku-btn--primary">
                <?php echo esc_html( $btn1_text ); ?> →
            </a>
            <a href="<?php echo esc_url( $btn2_url ); ?>" class="chatsku-btn chatsku-btn--secondary">
                <?php echo esc_html( $btn2_text ); ?>
            </a>
        </div>

    </div>
</main>

<?php get_footer(); ?>

<style>
/* ── Thank You Page ──────────────────────────────────────────────────────── */
.thankyou-page {
    min-height: calc(100vh - var(--header-height, 64px));
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-16) var(--space-6);
    background: var(--color-bg-primary);
}

.thankyou-wrap {
    max-width: 600px;
    width: 100%;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-6);
}

/* ── Check icon ─────────────────────────────────────────────────────────── */
.thankyou-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(0, 201, 177, 0.12);
    border: 2px solid rgba(0, 201, 177, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-accent);
    margin-bottom: var(--space-2);
    animation: thankyou-pop 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
}

@keyframes thankyou-pop {
    from { transform: scale(0.5); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}

/* ── Text ───────────────────────────────────────────────────────────────── */
.thankyou-heading {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 900;
    color: var(--color-text-primary);
    letter-spacing: -0.025em;
    line-height: 1.15;
    margin: 0;
}

.thankyou-subheading {
    font-size: var(--font-size-lg);
    color: var(--color-text-muted);
    line-height: var(--line-height-base);
    margin: 0;
    max-width: 480px;
}

/* ── Info card ──────────────────────────────────────────────────────────── */
.thankyou-card {
    width: 100%;
    background: var(--color-bg-card);
    border: 1px solid var(--color-border);
    border-radius: 16px;
    padding: var(--space-8) var(--space-10);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-4);
    margin: var(--space-2) 0;
}

.thankyou-card__logo {
    display: flex;
    align-items: center;
    gap: 8px;
}

.thankyou-card__logo-img {
    height: 28px;
    width: auto;
    object-fit: contain;
}

.thankyou-card__logo-text {
    font-family: var(--font-heading);
    font-size: var(--font-size-xl);
    font-weight: 800;
    color: var(--color-text-primary);
}

.thankyou-card__text {
    font-size: var(--font-size-base);
    color: var(--color-text-muted);
    line-height: var(--line-height-base);
    margin: 0;
    max-width: 420px;
    text-align: center;
}

/* ── Action buttons ─────────────────────────────────────────────────────── */
.thankyou-actions {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    flex-wrap: wrap;
    justify-content: center;
    margin-top: var(--space-2);
}

@media (max-width: 480px) {
    .thankyou-actions {
        flex-direction: column;
        width: 100%;
    }
    .thankyou-actions .chatsku-btn {
        width: 100%;
        justify-content: center;
    }
    .thankyou-card {
        padding: var(--space-6);
    }
}
</style>
