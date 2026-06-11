<?php
/**
 * 3 Steps to Live Section
 *
 * @package ChatSKU
 */

$data       = get_query_var( 'chatsku_steps', [] );
$heading    = $data['heading']    ?? '3 Steps to Live.';
$subheading = $data['subheading'] ?? 'Most teams go live the same day they sign up.';
$items      = $data['items']      ?? [];
$embed_code = $data['embed_code'] ?? '';

// Default steps
if ( empty( $items ) ) {
    $items = [
        [
            'step_number'      => 'Step 1',
            'step_title'       => 'Upload Your Catalog',
            'step_description' => 'Connect your product database (CSV, Shopify, ERP, etc.). ChatSKU parses every SKU, spec, and variant automatically.',
            'step_icon_svg'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>',
        ],
        [
            'step_number'      => 'Step 2',
            'step_title'       => 'Configure ChatSKU',
            'step_description' => 'Set your brand tone, integrations, and sales-flow — no developer, no code. Most setups finish in under an hour.',
            'step_icon_svg'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M21 12h-2M19.07 19.07l-1.41-1.41M12 21v-2M4.93 19.07l1.41-1.41M3 12h2M4.93 4.93l1.41 1.41"/></svg>',
        ],
        [
            'step_number'      => 'Step 3',
            'step_title'       => 'Go Live',
            'step_description' => 'Deploy the chat widget to your site immediately. One line of code is all it takes — then buyers start getting instant answers.',
            'step_icon_svg'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
        ],
    ];
}

// Default embed code snippet for display
if ( empty( $embed_code ) ) {
    $embed_code = '<script src="https://cdn.chatsku.com/widget.js" data-key="YOUR_KEY"></script>';
}
?>
<section class="steps-section section-padding" aria-labelledby="steps-heading" style="background: #000000;">
    <div class="container">

        <div class="section-head reveal">
            <span class="section-head__eyebrow">How It Works</span>
            <?php if ( $heading ) : ?>
                <h2 id="steps-heading" class="section-head__title"><?php echo esc_html( $heading ); ?></h2>
            <?php endif; ?>
            <?php if ( $subheading ) : ?>
                <p class="section-head__subtitle"><?php echo esc_html( $subheading ); ?></p>
            <?php endif; ?>
        </div>

        <!-- Steps Grid -->
        <?php if ( ! empty( $items ) ) : ?>
            <div class="steps-grid grid-3">
                <?php foreach ( $items as $i => $step ) :
                    $delay = 'reveal-delay-' . min( $i + 1, 5 );
                ?>
                    <div class="step-card reveal <?php echo esc_attr( $delay ); ?>">
                        <span class="step-card__number"><?php echo esc_html( $step['step_number'] ?? 'Step ' . ( $i + 1 ) ); ?></span>

                        <?php if ( ! empty( $step['step_icon_svg'] ) ) : ?>
                            <div class="step-card__icon" aria-hidden="true">
                                <?php echo $step['step_icon_svg']; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="step-card__title"><?php echo esc_html( $step['step_title'] ?? '' ); ?></h3>
                        <p class="step-card__description"><?php echo esc_html( $step['step_description'] ?? '' ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Embed Code Block -->
        <?php if ( $embed_code ) : ?>
            <div class="steps-embed reveal" style="max-width: 680px; margin: var(--space-12) auto 0;">
                <div class="embed-code-block">
                    <div class="embed-code-block__header">
                        <div class="embed-code-block__dots">
                            <span class="embed-code-block__dot"></span>
                            <span class="embed-code-block__dot"></span>
                            <span class="embed-code-block__dot"></span>
                        </div>
                        <span class="embed-code-block__label">embed.html</span>
                        <button class="embed-code-block__copy" type="button">Copy</button>
                    </div>
                    <pre class="embed-code-block__code"><?php echo esc_html( $embed_code ); ?></pre>
                </div>
                <div style="text-align: center; margin-top: var(--space-6);">
                    <a href="<?php echo esc_url( chatsku_option( 'register_url', '/signup/' ) ); ?>" class="chatsku-btn chatsku-btn--primary">
                        Get My Key →
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
