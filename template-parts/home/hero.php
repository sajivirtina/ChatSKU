<?php
/**
 * Hero Section
 *
 * @package ChatSKU
 */

$data = get_query_var( 'chatsku_hero', [] );
$eyebrow          = $data['eyebrow']           ?? 'AI-Powered B2B eCommerce';
$headline         = $data['headline']          ?? '';
$subheadline      = $data['subheadline']       ?? '';
$primary_text     = $data['primary_cta_text']  ?? 'Start Free';
$primary_url      = $data['primary_cta_url']   ?? '/signup/';
$secondary_text   = $data['secondary_cta_text']?? 'See Demo';
$secondary_url    = $data['secondary_cta_url'] ?? '#';
$image            = $data['image']             ?? null;
$stats            = $data['stats']             ?? [];

// Default stats if none set
if ( empty( $stats ) ) {
    $stats = [
        [ 'stat_value' => '< 1 Day',  'stat_label' => 'Average Setup Time' ],
        [ 'stat_value' => '24/7',     'stat_label' => 'Buyer Assistance, Every Minute' ],
        [ 'stat_value' => '1 Line',   'stat_label' => 'of Code to Deploy' ],
    ];
}
?>
<section class="hero" aria-labelledby="hero-headline">
    <div class="container hero__inner">

        <!-- Hero Content -->
        <div class="hero__content">

            <?php if ( $eyebrow ) : ?>
                <span class="hero__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>

            <h1 id="hero-headline" class="hero__headline">
                <?php echo wp_kses( $headline, [ 'em' => [], 'strong' => [], 'br' => [] ] ); ?>
            </h1>

            <?php if ( $subheadline ) : ?>
                <p class="hero__subheadline"><?php echo esc_html( $subheadline ); ?></p>
            <?php endif; ?>

            <div class="hero__actions">
                <a href="<?php echo esc_url( $primary_url ); ?>" class="chatsku-btn chatsku-btn--primary chatsku-btn--lg">
                    <?php echo esc_html( $primary_text ); ?>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <?php if ( $secondary_text ) : ?>
                    <a href="<?php echo esc_url( $secondary_url ); ?>" class="chatsku-btn chatsku-btn--secondary chatsku-btn--lg">
                        <?php echo esc_html( $secondary_text ); ?>
                    </a>
                <?php endif; ?>
            </div>
            <p class="hero__sub-note">Bring your existing catalog (and customers). We'll handle the rest, fast.</p>

            <?php if ( ! empty( $stats ) ) : ?>
                <div class="hero__stats">
                    <?php foreach ( $stats as $stat ) : ?>
                        <div class="hero__stat">
                            <span class="hero__stat-value"><?php echo esc_html( $stat['stat_value'] ?? '' ); ?></span>
                            <span class="hero__stat-label"><?php echo esc_html( $stat['stat_label'] ?? '' ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div><!-- .hero__content -->

        <!-- Hero Visual -->
        <div class="hero__visual">
            <a href="<?php echo esc_url( home_url( '/demo/' ) ); ?>" class="hero__image-wrap" aria-label="See live demo of ChatSKU chat widget">
                <?php if ( $image && is_array( $image ) ) : ?>
                    <img
                        src="<?php echo esc_url( $image['url'] ); ?>"
                        alt="<?php echo esc_attr( $image['alt'] ?: 'ChatSKU chat widget demo' ); ?>"
                        class="hero__image"
                        width="<?php echo esc_attr( $image['width'] ?? '' ); ?>"
                        height="<?php echo esc_attr( $image['height'] ?? '' ); ?>"
                        loading="eager"
                        fetchpriority="high"
                    >
                <?php else : ?>
                    <!-- Placeholder mockup when no image set -->
                    <div class="hero__mockup-placeholder" aria-hidden="true">
                        <div class="mockup-chat">
                            <div class="mockup-chat__header">
                                <div class="mockup-chat__avatar">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                                </div>
                                <div>
                                    <p class="mockup-chat__name">ChatSKU</p>
                                    <p class="mockup-chat__status">● AI Product Assistant</p>
                                </div>
                            </div>
                            <div class="mockup-chat__body">
                                <div class="mockup-msg mockup-msg--bot">Do you have 3/8" zinc-plated bolts, qty 500, net-30?</div>
                                <div class="mockup-msg mockup-msg--user">Yes — SKU ZB-375-500 is in stock. Lead time 4 days. Want me to start a quote?</div>
                                <div class="mockup-msg mockup-msg--typing"><span></span><span></span><span></span></div>
                            </div>
                            <div class="mockup-chat__input">
                                <span>Ask about any product...</span>
                                <button aria-label="Send">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="hero__orb hero__orb--1" aria-hidden="true"></div>
                <div class="hero__orb hero__orb--2" aria-hidden="true"></div>
            </a>
        </div><!-- .hero__visual -->

    </div><!-- .hero__inner -->
</section><!-- .hero -->

<!-- Scrolling ticker bar -->
<div class="hero-ticker" aria-hidden="true">
    <div class="hero-ticker__track">
        <?php
        // Duplicate for seamless loop
        for ( $i = 0; $i < 4; $i++ ) : ?>
            <span class="hero-ticker__item">Buyers who can't find answers after hours don't wait. They move on. <a href="<?php echo esc_url( home_url( '/demo/' ) ); ?>" class="hero-ticker__link">→ See how ChatSKU captures them.</a></span>
            <span class="hero-ticker__sep" aria-hidden="true">|</span>
        <?php endfor; ?>
    </div>
</div>

<style>
/* Hero image wrap — clickable link to demo */
a.hero__image-wrap {
    display: block;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    border-radius: 20px;
}
a.hero__image-wrap:hover {
    transform: translateY(-4px) scale(1.01);
    box-shadow: 0 32px 64px rgba(0, 201, 177, 0.15);
}

/* Hero mockup placeholder styles */
.hero__mockup-placeholder {
    background: #1a2538;
    border-radius: 16px;
    overflow: hidden;
    padding: 0;
}
.mockup-chat { display: flex; flex-direction: column; }
.mockup-chat__header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    background: #131e30;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}
.mockup-chat__avatar {
    width: 36px; height: 36px;
    background: var(--color-accent-glow);
    border: 1px solid var(--color-border-accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-accent);
    flex-shrink: 0;
}
.mockup-chat__name  { font-size: 13px; font-weight: 700; color: #f8fafc; margin: 0; }
.mockup-chat__status{ font-size: 11px; color: var(--color-accent); margin: 0; }
.mockup-chat__body  { padding: 16px; display: flex; flex-direction: column; gap: 10px; min-height: 320px; }
.mockup-msg {
    max-width: 85%;
    padding: 10px 14px;
    border-radius: 12px;
    font-size: 13px;
    line-height: 1.5;
    color: #e2e8f0;
}
.mockup-msg--bot  { background: #253046; align-self: flex-start; border-radius: 4px 12px 12px 12px; }
.mockup-msg--user { background: rgba(0,201,177,0.15); border: 1px solid rgba(0,201,177,0.25); align-self: flex-end; color: #f8fafc; border-radius: 12px 4px 12px 12px; }
.mockup-msg--typing { display: flex; gap: 4px; align-items: center; padding: 12px 16px; align-self: flex-start; background: #253046; border-radius: 4px 12px 12px 12px; }
.mockup-msg--typing span { width: 6px; height: 6px; background: var(--color-accent); border-radius: 50%; animation: typing-dot 1.2s ease-in-out infinite; }
.mockup-msg--typing span:nth-child(2) { animation-delay: 0.2s; }
.mockup-msg--typing span:nth-child(3) { animation-delay: 0.4s; }
@keyframes typing-dot { 0%,60%,100% { opacity: 0.3; transform: scale(0.8); } 30% { opacity: 1; transform: scale(1); } }
.mockup-chat__input {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 14px;
    background: #131e30;
    border-top: 1px solid rgba(255,255,255,0.08);
    font-size: 13px;
    color: #64748b;
}
.hero__sub-note { font-size: 13px; color: var(--color-text-muted); font-style: italic; margin: var(--space-3) 0 0; }
.hero-ticker__link {
    color: var(--color-accent);
    font-weight: 500;
    text-decoration: none;
}
.hero-ticker__sep { margin: 0 var(--space-6); color: var(--color-border); }
.mockup-chat__input button {
    width: 30px; height: 30px;
    background: var(--color-accent);
    border: none;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0f172a;
    cursor: pointer;
    flex-shrink: 0;
}
</style>
