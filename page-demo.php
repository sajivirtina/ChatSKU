<?php
/**
 * Demo Page Template — Live Interactive Demo
 * Template Name: Demo
 *
 * @package ChatSKU
 */

get_header();

$theme_uri = get_template_directory_uri();
?>

<main id="main" class="chatsku-main demo-live-main">

    <!-- ═══════════════════════════════════════════════════════════════
         DESKTOP LAYOUT  (hidden on mobile, shown lg+)
    ════════════════════════════════════════════════════════════════ -->
    <section class="demo-desktop-section section-padding demo-hide-mobile">
        <div class="container">
            <div class="demo-two-col">

                <!-- ── LEFT COLUMN ─────────────────────────────────── -->
                <div class="demo-left-col">

                    <h1 class="demo-left__title reveal">See ChatSKU in action</h1>
                    <p class="demo-left__subtitle reveal reveal-delay-1">
                        This is a live widget running on a sample industrial supplies catalog.
                        Search for products, ask questions, and submit a quote — just like your customers would.
                    </p>

                    <!-- Panel 1: Search Tips -->
                    <div class="demo-panel reveal reveal-delay-2" id="demo-search-tips">
                        <p class="demo-panel__lead">Try searching like your customers would:</p>

                        <ul class="demo-tips-list">
                            <li class="demo-tips-list__item">
                                <span class="demo-tip__label">
                                    <span class="demo-tip__icon demo-tip__icon--spelling">Aa</span>
                                    <span><strong>Spelling correction:</strong> Type <code>Plexiclass</code> instead of Plexiglass</span>
                                </span>
                                <button class="demo-try-btn" type="button" data-query="Plexiclass">Try It</button>
                            </li>
                            <li class="demo-tips-list__item">
                                <span class="demo-tip__label">
                                    <span class="demo-tip__icon demo-tip__icon--mic">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                                    </span>
                                    <span><strong>Voice Input:</strong> Click the microphone and say <em>Acrylic Tubes</em></span>
                                </span>
                            </li>
                            <li class="demo-tips-list__item">
                                <span class="demo-tip__label">
                                    <span class="demo-tip__icon demo-tip__icon--synonym">≈</span>
                                    <span><strong>Synonyms:</strong> Type <code>pipes</code> (the demo store has only hoses)</span>
                                </span>
                                <button class="demo-try-btn" type="button" data-query="pipes">Try It</button>
                            </li>
                        </ul>

                        <p class="demo-panel__lead demo-panel__lead--italic">Or try natural language queries:</p>

                        <div class="demo-lang" role="group" aria-label="Question language">
                            <button type="button" class="demo-lang-btn demo-lang-btn--active" data-lang="en" aria-pressed="true">English</button>
                            <button type="button" class="demo-lang-btn" data-lang="es" aria-pressed="false">Español</button>
                        </div>

                        <ul class="demo-tips-list demo-tips-list--nl">
                            <li class="demo-tips-list__item">
                                <span class="demo-tip__query" id="demo-q1-text"
                                    data-en="Do you have a 1/4 inch stainless steel ball valve for high pressure?"
                                    data-es="¿Tienen una válvula de bola de acero inoxidable de 1/4 de pulgada para alta presión?">Do you have a 1/4 inch stainless steel ball valve for high pressure?</span>
                                <button id="demo-q1-btn" class="demo-try-btn" type="button"
                                    data-query-en="Do you have a 1/4 inch stainless steel ball valve for high pressure?"
                                    data-query-es="¿Tienen una válvula de bola de acero inoxidable de 1/4 de pulgada para alta presión?"
                                    data-query="Do you have a 1/4 inch stainless steel ball valve for high pressure?">Try It</button>
                            </li>
                            <li class="demo-tips-list__item">
                                <span class="demo-tip__query">I need safety glasses that are anti-fog for my warehouse</span>
                                <button class="demo-try-btn" type="button" data-query="I need safety glasses that are anti-fog for my warehouse">Try It</button>
                            </li>
                            <li class="demo-tips-list__item">
                                <span class="demo-tip__query">What schedule 80 PVC pipe do you carry in 1 inch?</span>
                                <button class="demo-try-btn" type="button" data-query="What schedule 80 PVC pipe do you carry in 1 inch?">Try It</button>
                            </li>
                        </ul>
                    </div><!-- /demo-panel search tips -->

                    <!-- Panel 2: Image Search -->
                    <div class="demo-panel reveal reveal-delay-3" id="demo-image-search">
                        <p class="demo-panel__lead">Or click on any image to try image search</p>
                        <div class="demo-image-grid">
                            <button class="demo-img-btn" type="button" data-img="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-hoist-control.png" aria-label="Search by hoist control image">
                                <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-hoist-control.png" alt="Hoist control" loading="lazy">
                            </button>
                            <button class="demo-img-btn" type="button" data-img="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-hydro-pump.png" aria-label="Search by hydraulic pump image">
                                <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-hydro-pump.png" alt="Hydraulic pump" loading="lazy">
                            </button>
                            <button class="demo-img-btn" type="button" data-img="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-reservoir.png" aria-label="Search by reservoir image">
                                <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-reservoir.png" alt="Reservoir" loading="lazy">
                            </button>
                        </div>
                    </div><!-- /demo-panel image search -->

                    <!-- CTA -->
                    <div class="demo-left__cta reveal">
                        <a href="<?php echo esc_url( home_url( '/signup/' ) ); ?>" class="chatsku-btn chatsku-btn--primary chatsku-btn--lg">
                            Start My Free Trial
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>

                </div><!-- /demo-left-col -->

                <!-- ── RIGHT COLUMN ────────────────────────────────── -->
                <div class="demo-right-col">

                    <!-- Tab Toggle -->
                    <div class="demo-tab-bar" role="tablist" aria-label="Demo view">
                        <button
                            class="demo-tab demo-tab--active"
                            id="tab-widget"
                            role="tab"
                            aria-selected="true"
                            aria-controls="panel-widget"
                            type="button"
                            data-tab="widget"
                        >Customer Chat Widget</button>
                        <button
                            class="demo-tab"
                            id="tab-dashboard"
                            role="tab"
                            aria-selected="false"
                            aria-controls="panel-dashboard"
                            type="button"
                            data-tab="dashboard"
                        >Admin Dashboard</button>
                    </div>

                    <!-- Panel: Customer Chat Widget -->
                    <div class="demo-tab-panel demo-tab-panel--active" id="panel-widget" role="tabpanel" aria-labelledby="tab-widget">

                        <!-- Inline / Bubble mode toggle -->
                        <div class="demo-mode-toggle" aria-label="Widget display mode">
                            <button class="demo-mode-btn demo-mode-btn--active" type="button" data-mode="inline">Inline</button>
                            <button class="demo-mode-btn" type="button" data-mode="bubble">Bubble</button>
                        </div>

                        <!-- Widget wrapper card -->
                        <div class="demo-widget-card" id="demo-widget-card">
                            <!-- Loading spinner -->
                            <div class="demo-widget-spinner" id="demo-widget-spinner" aria-label="Loading widget" role="status">
                                <div class="demo-spinner"></div>
                                <span>Loading demo...</span>
                            </div>
                            <!-- Widget mount point -->
                            <div id="chatsku-widget" style="width:100%; height:calc(100vh - 260px); min-height:400px; max-height:600px;"></div>
                        </div>

                    </div><!-- /panel-widget -->

                    <!-- Panel: Admin Dashboard -->
                    <div class="demo-tab-panel" id="panel-dashboard" role="tabpanel" aria-labelledby="tab-dashboard" hidden>

                        <!-- Image Carousel -->
                        <div class="demo-carousel" id="demo-carousel" aria-label="Admin dashboard screenshots">

                            <!-- Slide track -->
                            <div class="demo-carousel__track-wrap">
                                <div class="demo-carousel__track" id="demo-carousel-track">
                                    <?php
                                    $dashboard_slides = [
                                        [ 'src' => '/images/dashboard-overview.png',          'label' => 'Overview' ],
                                        [ 'src' => '/images/dashboard-products.png',           'label' => 'Products' ],
                                        [ 'src' => '/images/dashboard-quotes.png',             'label' => 'Quotes' ],
                                        [ 'src' => '/images/dashboard-orders.png',             'label' => 'Orders' ],
                                        [ 'src' => '/images/dashboard-customers.png',          'label' => 'Customers' ],
                                        [ 'src' => '/images/dashboard-analytics.png',          'label' => 'Analytics' ],
                                        [ 'src' => '/images/dashboard-chatbot-settings.png',   'label' => 'Chatbot Settings' ],
                                        [ 'src' => '/images/dashboard-team.png',               'label' => 'Team' ],
                                    ];
                                    foreach ( $dashboard_slides as $i => $slide ) : ?>
                                        <div class="demo-carousel__slide<?php echo $i === 0 ? ' demo-carousel__slide--active' : ''; ?>" data-index="<?php echo esc_attr( $i ); ?>" role="group" aria-label="<?php echo esc_attr( $slide['label'] ); ?> screenshot, slide <?php echo esc_attr( $i + 1 ); ?> of <?php echo count( $dashboard_slides ); ?>">
                                            <img
                                                src="<?php echo esc_url( $slide['src'] ); ?>"
                                                alt="<?php echo esc_attr( $slide['label'] ); ?> dashboard screenshot"
                                                loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"
                                                class="demo-carousel__img"
                                            >
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Prev / Next -->
                            <button class="demo-carousel__nav demo-carousel__nav--prev" id="demo-carousel-prev" type="button" aria-label="Previous slide">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                            </button>
                            <button class="demo-carousel__nav demo-carousel__nav--next" id="demo-carousel-next" type="button" aria-label="Next slide">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>

                            <!-- Thumbnail pill navigation -->
                            <div class="demo-carousel__thumbs" role="tablist" aria-label="Go to slide">
                                <?php foreach ( $dashboard_slides as $i => $slide ) : ?>
                                    <button
                                        class="demo-carousel__thumb<?php echo $i === 0 ? ' demo-carousel__thumb--active' : ''; ?>"
                                        type="button"
                                        role="tab"
                                        aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                                        aria-label="Go to <?php echo esc_attr( $slide['label'] ); ?>"
                                        data-slide="<?php echo esc_attr( $i ); ?>"
                                    ><?php echo esc_html( $slide['label'] ); ?></button>
                                <?php endforeach; ?>
                            </div>

                        </div><!-- /demo-carousel -->

                        <!-- Request Admin Demo CTA -->
                        <div class="demo-dashboard__cta">
                            <a href="<?php echo esc_url( chatsku_option( 'register_url', '/signup/' ) ); ?>" class="chatsku-btn chatsku-btn--primary">
                                Request Admin Demo
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
                        </div>

                    </div><!-- /panel-dashboard -->

                </div><!-- /demo-right-col -->

            </div><!-- /demo-two-col -->
        </div><!-- /container -->
    </section><!-- /demo-desktop-section -->


    <!-- ═══════════════════════════════════════════════════════════════
         MOBILE LAYOUT  (shown on mobile, hidden lg+)
    ════════════════════════════════════════════════════════════════ -->
    <section class="demo-mobile-section section-padding demo-show-mobile">
        <div class="container">

            <!-- Mobile Header -->
            <h1 class="demo-left__title">See ChatSKU in action</h1>
            <p class="demo-left__subtitle" style="margin-bottom: var(--space-6);">
                This is a live widget running on a sample industrial supplies catalog.
                Search for products, ask questions, and submit a quote — just like your customers would.
            </p>

            <!-- Quick Chips -->
            <div class="demo-quick-chips" aria-label="Quick search suggestions">
                <?php
                $mobile_chips = [
                    'Plexiclass',
                    'pipes',
                    'Do you have a 1/4 inch stainless steel ball valve for high pressure?',
                    'I need safety glasses that are anti-fog for my warehouse',
                    'What schedule 80 PVC pipe do you carry in 1 inch?',
                ];
                foreach ( $mobile_chips as $chip ) : ?>
                    <button class="demo-chip demo-try-btn" type="button" data-query="<?php echo esc_attr( $chip ); ?>">
                        <?php echo esc_html( $chip ); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Mobile Widget Area -->
            <div class="demo-widget-card demo-widget-card--mobile" id="demo-widget-card-mobile" style="margin-top: var(--space-6);">
                <div class="demo-widget-spinner" id="demo-widget-spinner-mobile" aria-label="Loading widget" role="status">
                    <div class="demo-spinner"></div>
                    <span>Loading demo...</span>
                </div>
                <div id="chatsku-widget-mobile" style="width:100%; height:calc(100vh - 260px); min-height:400px; max-height:600px;"></div>
            </div>

            <!-- Mobile Image Search -->
            <div class="demo-panel" style="margin-top: var(--space-6);">
                <p class="demo-panel__lead">Or click on any image to try image search</p>
                <div class="demo-image-grid">
                    <button class="demo-img-btn" type="button" data-img="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-hoist-control.png" data-target="mobile" aria-label="Search by hoist control image">
                        <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-hoist-control.png" alt="Hoist control" loading="lazy">
                    </button>
                    <button class="demo-img-btn" type="button" data-img="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-hydro-pump.png" data-target="mobile" aria-label="Search by hydraulic pump image">
                        <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-hydro-pump.png" alt="Hydraulic pump" loading="lazy">
                    </button>
                    <button class="demo-img-btn" type="button" data-img="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-reservoir.png" data-target="mobile" aria-label="Search by reservoir image">
                        <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/demo-reservoir.png" alt="Reservoir" loading="lazy">
                    </button>
                </div>
            </div>

            <!-- Mobile CTA -->
            <div style="margin-top: var(--space-8); text-align: center;">
                <a href="<?php echo esc_url( home_url( '/signup/' ) ); ?>" class="chatsku-btn chatsku-btn--primary chatsku-btn--lg">
                    Start My Free Trial
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>

        </div><!-- /container -->
    </section><!-- /demo-mobile-section -->


    <!-- ═══════════════════════════════════════════════════════════════
         STATS STRIP
    ════════════════════════════════════════════════════════════════ -->
    <section class="demo-stats-strip" aria-label="Key statistics">
        <div class="container">

            <!-- Stats Row -->
            <div class="demo-stats-row">
                <div class="demo-stat reveal">
                    <span class="demo-stat__value">~4 hours</span>
                    <span class="demo-stat__label">Average setup time</span>
                </div>
                <div class="demo-stat reveal reveal-delay-1">
                    <span class="demo-stat__value">1 line</span>
                    <span class="demo-stat__label">Of code to embed</span>
                </div>
                <div class="demo-stat reveal reveal-delay-2">
                    <span class="demo-stat__value">Any site</span>
                    <span class="demo-stat__label">Works on any website</span>
                </div>
            </div>

            <!-- Strip CTA -->
            <div class="demo-stats-cta reveal">
                <h2 class="demo-stats-cta__heading">Ready to add this to your site?</h2>
                <p class="demo-stats-cta__sub">Start free. Live in days, not months of dev time. No credit card required.</p>
                <div class="demo-stats-cta__buttons">
                    <a href="<?php echo esc_url( home_url( '/signup/' ) ); ?>" class="chatsku-btn chatsku-btn--primary chatsku-btn--lg">
                        Start Free
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <a href="https://calendly.com" target="_blank" rel="noopener noreferrer" class="chatsku-btn chatsku-btn--secondary chatsku-btn--lg">
                        Book a Demo Call
                    </a>
                </div>
            </div>

        </div><!-- /container -->
    </section><!-- /demo-stats-strip -->

</main>

<?php get_footer(); ?>

<!-- ═══════════════════════════════════════════════════════════════════
     PAGE STYLES
════════════════════════════════════════════════════════════════════ -->
<style>
/* ── Responsive visibility helpers ───────────────────────────────── */
.demo-hide-mobile { display: block; }
.demo-show-mobile { display: none; }
@media (max-width: 1023px) {
    .demo-hide-mobile { display: none; }
    .demo-show-mobile { display: block; }
}

/* ── Two-column layout ───────────────────────────────────────────── */
.demo-two-col {
    display: grid;
    grid-template-columns: 0.7fr 1.3fr;
    gap: clamp(32px, 4vw, 64px);
    align-items: start;
}

/* ── Left column ─────────────────────────────────────────────────── */
.demo-left-col {
    position: sticky;
    top: 100px;
}

.demo-left__title {
    font-family: var(--font-heading);
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    font-weight: 800;
    color: var(--color-text-primary);
    letter-spacing: -0.025em;
    line-height: 1.2;
    margin: 0 0 var(--space-4);
}

.demo-left__subtitle {
    font-family: var(--font-sans);
    font-size: 1rem;
    color: var(--color-text-secondary);
    line-height: 1.7;
    margin: 0 0 var(--space-6);
}

/* ── Demo panels (dark cards) ────────────────────────────────────── */
.demo-panel {
    background: var(--color-bg-secondary);
    border: 1px solid var(--color-border);
    border-radius: 14px;
    padding: 20px;
    margin-bottom: var(--space-4);
}

.demo-panel__lead {
    font-family: var(--font-sans);
    font-size: 13px;
    font-weight: 600;
    color: var(--color-text-secondary);
    margin: 0 0 12px;
}

.demo-panel__lead--italic {
    font-style: italic;
    margin-top: 16px;
    color: var(--color-text-muted);
}

/* ── Search tips list ────────────────────────────────────────────── */
.demo-tips-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.demo-tips-list__item {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    font-family: var(--font-sans);
    font-size: 13px;
    color: var(--color-text-secondary);
    line-height: 1.5;
}

.demo-tip__label {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    flex: 1;
    min-width: 0;
}

.demo-tip__icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    margin-top: 1px;
}

.demo-tip__icon--spelling { background: rgba(251, 191, 36, 0.15); color: #fbbf24; }
.demo-tip__icon--mic      { background: rgba(0, 201, 177, 0.15);  color: var(--color-accent); }
.demo-tip__icon--synonym  { background: rgba(139, 92, 246, 0.15); color: #a78bfa; font-size: 16px; }

.demo-tip__label strong { color: var(--color-text-primary); font-weight: 600; }
.demo-tip__label code {
    background: rgba(255,255,255,0.07);
    border: 1px solid var(--color-border);
    border-radius: 4px;
    padding: 1px 5px;
    font-size: 12px;
    color: var(--color-accent);
    font-family: monospace;
}
.demo-tip__label em { font-style: italic; color: var(--color-accent); }

.demo-tips-list--nl .demo-tip__query {
    font-style: italic;
    color: var(--color-text-secondary);
    flex: 1;
}

.demo-try-btn {
    flex-shrink: 0;
    background: rgba(0, 201, 177, 0.1);
    border: 1px solid rgba(0, 201, 177, 0.25);
    color: var(--color-accent);
    font-family: var(--font-sans);
    font-size: 11px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s;
    white-space: nowrap;
    align-self: flex-start;
    margin-top: 2px;
}

.demo-try-btn:hover {
    background: rgba(0, 201, 177, 0.2);
    border-color: rgba(0, 201, 177, 0.45);
}

/* ── Image search grid ───────────────────────────────────────────── */
.demo-image-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-top: 12px;
}

.demo-img-btn {
    background: none;
    border: 1px solid var(--color-border);
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    padding: 0;
    transition: border-color 0.2s, transform 0.2s;
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.demo-img-btn:hover {
    border-color: var(--color-accent);
    transform: scale(1.03);
}

.demo-img-btn img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* ── Left CTA ────────────────────────────────────────────────────── */
.demo-left__cta {
    margin-top: var(--space-6);
}

/* ── Tab bar ─────────────────────────────────────────────────────── */
.demo-tab-bar {
    display: flex;
    background: var(--color-bg-secondary);
    border: 1px solid var(--color-border);
    border-radius: 10px;
    padding: 4px;
    margin-bottom: var(--space-4);
    gap: 4px;
}

.demo-tab {
    flex: 1;
    background: transparent;
    border: none;
    border-radius: 7px;
    color: var(--color-text-muted);
    font-family: var(--font-sans);
    font-size: 13px;
    font-weight: 600;
    padding: 9px 16px;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
    text-align: center;
}

.demo-tab:hover {
    color: var(--color-text-primary);
}

.demo-tab--active {
    background: rgba(0, 201, 177, 0.12);
    color: var(--color-accent);
}

/* ── Tab panels ──────────────────────────────────────────────────── */
.demo-tab-panel { display: none; }
.demo-tab-panel--active { display: block; }

/* ── Mode toggle ─────────────────────────────────────────────────── */
.demo-mode-toggle {
    display: inline-flex;
    background: var(--color-bg-secondary);
    border: 1px solid var(--color-border);
    border-radius: 8px;
    padding: 3px;
    margin-bottom: var(--space-3);
    gap: 2px;
}

.demo-mode-btn {
    background: transparent;
    border: none;
    border-radius: 6px;
    color: var(--color-text-muted);
    font-family: var(--font-sans);
    font-size: 13px;
    font-weight: 600;
    padding: 6px 14px;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
}

.demo-mode-btn--active {
    background: rgba(0, 201, 177, 0.12);
    color: var(--color-accent);
}

.demo-lang { display: inline-flex; background: var(--color-bg-secondary); border: 1px solid var(--color-border); border-radius: 8px; padding: 3px; margin-bottom: var(--space-3); gap: 2px; }
.demo-lang-btn { background: transparent; border: none; border-radius: 6px; color: var(--color-text-muted); font-family: var(--font-sans); font-size: 13px; font-weight: 600; padding: 6px 14px; cursor: pointer; transition: background 0.2s, color 0.2s; }
.demo-lang-btn--active { background: rgba(0, 201, 177, 0.12); color: var(--color-accent); }

/* ── Widget card ─────────────────────────────────────────────────── */
.demo-widget-card {
    background: var(--color-bg-secondary);
    border: 1px solid var(--color-border);
    border-radius: 16px;
    overflow: hidden;
    position: relative;
}

/* ── Loading spinner ─────────────────────────────────────────────── */
.demo-widget-spinner {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 14px;
    background: var(--color-bg-secondary);
    z-index: 10;
    font-family: var(--font-sans);
    font-size: 13px;
    color: var(--color-text-muted);
    transition: opacity 0.3s;
}

.demo-widget-spinner.is-hidden {
    opacity: 0;
    pointer-events: none;
}

.demo-spinner {
    width: 32px;
    height: 32px;
    border: 3px solid rgba(0, 201, 177, 0.15);
    border-top-color: var(--color-accent);
    border-radius: 50%;
    animation: demo-spin 0.8s linear infinite;
}

@keyframes demo-spin { to { transform: rotate(360deg); } }

/* ── Carousel ────────────────────────────────────────────────────── */
.demo-carousel {
    background: var(--color-bg-secondary);
    border: 1px solid var(--color-border);
    border-radius: 16px;
    overflow: hidden;
    position: relative;
}

.demo-carousel__track-wrap {
    overflow: hidden;
    aspect-ratio: 16 / 9;
    background: #0a1628;
}

.demo-carousel__track {
    display: flex;
    height: 100%;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.demo-carousel__slide {
    flex: 0 0 100%;
    height: 100%;
    display: none;
}

.demo-carousel__slide--active {
    display: block;
}

.demo-carousel__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.demo-carousel__nav {
    position: absolute;
    top: calc(50% - 48px);
    transform: translateY(-50%);
    width: 38px;
    height: 38px;
    background: rgba(15, 23, 42, 0.85);
    border: 1px solid var(--color-border);
    border-radius: 50%;
    color: var(--color-text-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s;
    z-index: 5;
}

.demo-carousel__nav:hover {
    background: rgba(0, 201, 177, 0.15);
    border-color: rgba(0, 201, 177, 0.4);
    color: var(--color-accent);
}

.demo-carousel__nav--prev { left: 12px; }
.demo-carousel__nav--next { right: 12px; }

.demo-carousel__thumbs {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    padding: 14px 16px;
    border-top: 1px solid var(--color-border);
    background: rgba(0,0,0,0.2);
}

.demo-carousel__thumb {
    background: rgba(255,255,255,0.05);
    border: 1px solid var(--color-border);
    border-radius: 999px;
    color: var(--color-text-muted);
    font-family: var(--font-sans);
    font-size: 11px;
    font-weight: 600;
    padding: 4px 11px;
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s, color 0.2s;
    white-space: nowrap;
}

.demo-carousel__thumb:hover {
    color: var(--color-text-primary);
    border-color: rgba(255,255,255,0.2);
}

.demo-carousel__thumb--active {
    background: rgba(0, 201, 177, 0.15);
    border-color: rgba(0, 201, 177, 0.35);
    color: var(--color-accent);
}

/* ── Dashboard CTA ───────────────────────────────────────────────── */
.demo-dashboard__cta {
    display: flex;
    justify-content: center;
    padding: var(--space-5) 0 var(--space-2);
}

/* ── Quick chips (mobile) ────────────────────────────────────────── */
.demo-quick-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.demo-chip {
    background: rgba(255,255,255,0.05);
    border: 1px solid var(--color-border);
    border-radius: 999px;
    color: var(--color-text-secondary);
    font-family: var(--font-sans);
    font-size: 13px;
    font-weight: 500;
    padding: 7px 14px;
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s, color 0.2s;
    text-align: left;
    max-width: 100%;
    white-space: normal;
    word-break: break-word;
}

.demo-chip:hover {
    background: rgba(0, 201, 177, 0.1);
    border-color: rgba(0, 201, 177, 0.3);
    color: var(--color-accent);
}

/* ── Stats strip ─────────────────────────────────────────────────── */
.demo-stats-strip {
    border-top: 1px solid var(--color-border);
    background: rgba(30, 41, 59, 0.3);
    padding: clamp(48px, 6vw, 80px) 0;
}

.demo-stats-row {
    display: flex;
    justify-content: center;
    gap: clamp(32px, 6vw, 80px);
    flex-wrap: wrap;
    margin-bottom: clamp(36px, 5vw, 60px);
}

.demo-stat {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    text-align: center;
}

.demo-stat__value {
    font-family: var(--font-heading);
    font-size: clamp(1.75rem, 3.5vw, 2.75rem);
    font-weight: 800;
    color: var(--color-accent);
    letter-spacing: -0.02em;
    line-height: 1;
}

.demo-stat__label {
    font-family: var(--font-sans);
    font-size: 14px;
    color: var(--color-text-muted);
    font-weight: 500;
}

.demo-stats-cta {
    text-align: center;
}

.demo-stats-cta__heading {
    font-family: var(--font-heading);
    font-size: clamp(1.5rem, 3vw, 2.25rem);
    font-weight: 800;
    color: var(--color-text-primary);
    letter-spacing: -0.025em;
    margin: 0 0 var(--space-3);
}

.demo-stats-cta__sub {
    font-family: var(--font-sans);
    font-size: 1rem;
    color: var(--color-text-muted);
    margin: 0 0 var(--space-6);
}

.demo-stats-cta__buttons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: var(--space-4);
}

@media (max-width: 480px) {
    .demo-stats-cta__buttons { flex-direction: column; align-items: stretch; }
    .demo-stats-row { gap: 28px; }
}
</style>

<!-- ═══════════════════════════════════════════════════════════════════
     PAGE JAVASCRIPT
════════════════════════════════════════════════════════════════════ -->
<script>
(function () {
    'use strict';

    /* ─────────────────────────────────────────────────────────────────
       CONFIG
    ───────────────────────────────────────────────────────────────── */
    var WIDGET_SRC     = 'https://app.chatsku.com/widget/widget.js';
    var WIDGET_API_KEY = 'a9135858e5829054ecdb6a567234cf187875344f42ef54ba104400c4436f7dca';

    /* Active embed mode: 'inline' | 'bubble' */
    var activeMode = 'inline';

    /* Snapshot of body children BEFORE any widget loads.
       Populated in init() so widget-injected elements can be identified and removed. */
    var bodySnapshot = null;

    /* Carousel state */
    var carouselIndex  = 0;
    var carouselSlides = [];
    var carouselThumbs = [];

    /* ─────────────────────────────────────────────────────────────────
       WIDGET LOADING
    ───────────────────────────────────────────────────────────────── */

    /**
     * Inject the widget script with the correct data-embed / data-container.
     * @param {string} containerId  DOM id of the mount element.
     * @param {string} mode         'inline' | 'bubble'
     * @param {string} spinnerElId  DOM id of the spinner element.
     */
    function loadWidget(containerId, mode, spinnerElId) {
        /* ── 1. Call widget's own destroy / unmount API if available ── */
        var apis = [window.ChatSKU, window.chatsku, window.ImpelHub, window.impelhub];
        apis.forEach(function (api) {
            if (api) {
                if (typeof api.destroy  === 'function') { try { api.destroy();  } catch(e) {} }
                if (typeof api.unmount  === 'function') { try { api.unmount();  } catch(e) {} }
                if (typeof api.teardown === 'function') { try { api.teardown(); } catch(e) {} }
            }
        });

        /* ── 2. Remove widget script tags ── */
        document.querySelectorAll('script[data-chatsku-widget]').forEach(function (s) {
            s.parentNode.removeChild(s);
        });

        /* ── 3. Remove every <body> child that wasn't there before the first widget load.
                This catches bubble launchers, panels, iframes, overlays — whatever the
                widget appended — without needing to know its class or id names. ── */
        if (bodySnapshot) {
            Array.from(document.body.children).forEach(function (el) {
                if (!bodySnapshot.has(el)) {
                    el.parentNode && el.parentNode.removeChild(el);
                }
            });
        }

        /* ── 4. Clear the container ── */
        var container = document.getElementById(containerId);
        if (container) {
            container.innerHTML = '';
        }

        /* Show spinner */
        var spinner = document.getElementById(spinnerElId);
        if (spinner) {
            spinner.classList.remove('is-hidden');
        }

        /* Build and append the new script tag */
        var script = document.createElement('script');
        script.src                      = WIDGET_SRC;
        script.setAttribute('data-api-key',   WIDGET_API_KEY);
        script.setAttribute('data-embed',     mode);
        script.setAttribute('data-container', containerId);
        script.setAttribute('data-chatsku-widget', '1');
        script.async = true;

        /* Hide spinner after 1500ms */
        script.onload = function () {
            setTimeout(function () {
                if (spinner) spinner.classList.add('is-hidden');
            }, 1500);
        };
        script.onerror = function () {
            if (spinner) spinner.classList.add('is-hidden');
        };

        document.body.appendChild(script);
    }

    /* ─────────────────────────────────────────────────────────────────
       WIDGET — MODE TOGGLE (Inline / Bubble)
    ───────────────────────────────────────────────────────────────── */
    function initModeToggle() {
        var modeButtons = document.querySelectorAll('.demo-mode-btn');
        modeButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var mode = btn.getAttribute('data-mode');
                if (mode === activeMode) return;
                activeMode = mode;

                /* Update button active state */
                modeButtons.forEach(function (b) { b.classList.remove('demo-mode-btn--active'); });
                btn.classList.add('demo-mode-btn--active');

                /* Reload widget in new mode */
                loadWidget('chatsku-widget', activeMode, 'demo-widget-spinner');
            });
        });
    }

    /* ─────────────────────────────────────────────────────────────────
       TAB SWITCHING
    ───────────────────────────────────────────────────────────────── */
    function initTabs() {
        var tabs   = document.querySelectorAll('.demo-tab');
        var panels = document.querySelectorAll('.demo-tab-panel');

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var target = tab.getAttribute('data-tab');

                /* Update tab states */
                tabs.forEach(function (t) {
                    t.classList.remove('demo-tab--active');
                    t.setAttribute('aria-selected', 'false');
                });
                tab.classList.add('demo-tab--active');
                tab.setAttribute('aria-selected', 'true');

                /* Update panel states */
                panels.forEach(function (panel) {
                    panel.classList.remove('demo-tab-panel--active');
                    panel.hidden = true;
                });
                var activePanel = document.getElementById('panel-' + target);
                if (activePanel) {
                    activePanel.classList.add('demo-tab-panel--active');
                    activePanel.hidden = false;
                }
            });
        });
    }

    /* ─────────────────────────────────────────────────────────────────
       "TRY IT" BUTTONS — inject text into the widget input
    ───────────────────────────────────────────────────────────────── */
    function injectTextIntoWidget(query) {
        /* ChatSKU widget likely renders inside an iframe or shadow DOM.
           Try the most common selectors inside the widget container first,
           then fall back to the page-level input. */
        var containers = [
            document.getElementById('chatsku-widget'),
            document.getElementById('chatsku-widget-mobile'),
            document
        ];

        var input = null;

        for (var i = 0; i < containers.length; i++) {
            var root = containers[i];
            if (!root) continue;

            /* Try #ciq-input first (ChatSKU native), then generic text inputs */
            var candidate = root.querySelector('#ciq-input')
                         || root.querySelector('input[type="text"]')
                         || root.querySelector('textarea');

            if (candidate) {
                input = candidate;
                break;
            }

            /* If the container has an iframe, try to access its document */
            var iframes = root.querySelectorAll('iframe');
            for (var j = 0; j < iframes.length; j++) {
                try {
                    var iframeDoc = iframes[j].contentDocument || iframes[j].contentWindow.document;
                    candidate = iframeDoc.querySelector('#ciq-input')
                             || iframeDoc.querySelector('input[type="text"]')
                             || iframeDoc.querySelector('textarea');
                    if (candidate) { input = candidate; break; }
                } catch (e) {
                    /* cross-origin iframe — skip */
                }
                if (input) break;
            }
            if (input) break;
        }

        if (!input) return;

        /* Use the native value setter to trigger React/Vue controlled inputs */
        var nativeInputSetter = Object.getOwnPropertyDescriptor(window.HTMLInputElement.prototype, 'value')
            || Object.getOwnPropertyDescriptor(window.HTMLTextAreaElement.prototype, 'value');

        if (nativeInputSetter && nativeInputSetter.set) {
            nativeInputSetter.set.call(input, query);
        } else {
            input.value = query;
        }

        /* Dispatch events so the widget's framework picks up the change */
        input.dispatchEvent(new Event('input',  { bubbles: true }));
        input.dispatchEvent(new Event('change', { bubbles: true }));
        input.focus();
    }

    function initTryItButtons() {
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('.demo-try-btn');
            if (!btn) return;
            var query = btn.getAttribute('data-query');
            if (!query) return;
            injectTextIntoWidget(query);
        });
    }

    /* ─────────────────────────────────────────────────────────────────
       IMAGE SEARCH — inject an image file into the widget's file input
    ───────────────────────────────────────────────────────────────── */
    function injectImageIntoWidget(imgUrl, targetSuffix) {
        /* Determine which widget container to target */
        var containerId = (targetSuffix === 'mobile') ? 'chatsku-widget-mobile' : 'chatsku-widget';
        var container   = document.getElementById(containerId) || document;

        fetch(imgUrl)
            .then(function (res) { return res.blob(); })
            .then(function (blob) {
                /* Derive a filename from the URL */
                var filename = imgUrl.split('/').pop() || 'image.png';
                var file     = new File([blob], filename, { type: blob.type || 'image/png' });

                /* Find the file input in the widget (or its iframe) */
                var fileInput = null;

                var candidates = [container];
                var iframes    = container.querySelectorAll ? container.querySelectorAll('iframe') : [];
                for (var i = 0; i < iframes.length; i++) {
                    try {
                        candidates.push(iframes[i].contentDocument || iframes[i].contentWindow.document);
                    } catch (e) { /* cross-origin */ }
                }

                for (var k = 0; k < candidates.length; k++) {
                    var root = candidates[k];
                    var el   = root.querySelector ? root.querySelector('input[type="file"]') : null;
                    if (el) { fileInput = el; break; }
                }

                if (!fileInput) return;

                /* Use DataTransfer to set files property (read-only) */
                var dt = new DataTransfer();
                dt.items.add(file);
                fileInput.files = dt.files;
                fileInput.dispatchEvent(new Event('change', { bubbles: true }));
                fileInput.dispatchEvent(new Event('input',  { bubbles: true }));
            })
            .catch(function (err) {
                console.warn('[ChatSKU Demo] Image fetch failed:', err);
            });
    }

    function initImageButtons() {
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('.demo-img-btn');
            if (!btn) return;
            var imgUrl = btn.getAttribute('data-img');
            var target = btn.getAttribute('data-target') || 'desktop';
            if (!imgUrl) return;
            injectImageIntoWidget(imgUrl, target);
        });
    }

    /* ─────────────────────────────────────────────────────────────────
       IMAGE CAROUSEL
    ───────────────────────────────────────────────────────────────── */
    function goToSlide(index) {
        if (carouselSlides.length === 0) return;

        /* Clamp index */
        index = ((index % carouselSlides.length) + carouselSlides.length) % carouselSlides.length;
        carouselIndex = index;

        /* Update slides */
        carouselSlides.forEach(function (slide, i) {
            slide.classList.toggle('demo-carousel__slide--active', i === index);
        });

        /* Update thumbs */
        carouselThumbs.forEach(function (thumb, i) {
            var active = i === index;
            thumb.classList.toggle('demo-carousel__thumb--active', active);
            thumb.setAttribute('aria-selected', active ? 'true' : 'false');
        });
    }

    function initCarousel() {
        var carousel = document.getElementById('demo-carousel');
        if (!carousel) return;

        carouselSlides = Array.from(carousel.querySelectorAll('.demo-carousel__slide'));
        carouselThumbs = Array.from(carousel.querySelectorAll('.demo-carousel__thumb'));

        var prevBtn = document.getElementById('demo-carousel-prev');
        var nextBtn = document.getElementById('demo-carousel-next');

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                goToSlide(carouselIndex - 1);
            });
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                goToSlide(carouselIndex + 1);
            });
        }

        /* Thumbnail navigation */
        carouselThumbs.forEach(function (thumb, i) {
            thumb.addEventListener('click', function () {
                goToSlide(i);
            });
        });

        /* Keyboard navigation when carousel is focused */
        carousel.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft')  goToSlide(carouselIndex - 1);
            if (e.key === 'ArrowRight') goToSlide(carouselIndex + 1);
        });
    }

    /* ─────────────────────────────────────────────────────────────────
       BOOT
    ───────────────────────────────────────────────────────────────── */
    /* EN/ES toggle for the first natural-language query only */
    function setDemoQ1Lang(lang){
        var S = lang==='es' ? 'es' : 'en';
        var txt = document.getElementById('demo-q1-text'), btn = document.getElementById('demo-q1-btn');
        if (txt) txt.textContent = txt.dataset[S];
        if (btn) btn.dataset.query = btn.getAttribute('data-query-'+S);
        document.querySelectorAll('.demo-lang-btn').forEach(function(b){
            var on = b.dataset.lang===S;
            b.classList.toggle('demo-lang-btn--active', on);
            b.setAttribute('aria-pressed', on?'true':'false');
        });
    }
    function initDemoQ1Lang(){
        document.querySelectorAll('.demo-lang-btn').forEach(function(b){ b.addEventListener('click', function(){ setDemoQ1Lang(b.dataset.lang); }); });
        setDemoQ1Lang('en');
    }

    function init() {
        initTabs();
        initModeToggle();
        initTryItButtons();
        initImageButtons();
        initCarousel();
        initDemoQ1Lang();

        /* Snapshot all current <body> children BEFORE any widget script runs.
           loadWidget() will use this to remove everything the widget injects. */
        bodySnapshot = new Set(Array.from(document.body.children));

        /* Load the primary (desktop) widget */
        loadWidget('chatsku-widget', activeMode, 'demo-widget-spinner');

        /* Detect if we are on mobile and load the mobile widget instance */
        if (window.innerWidth < 1024) {
            loadWidget('chatsku-widget-mobile', activeMode, 'demo-widget-spinner-mobile');
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
</script>
