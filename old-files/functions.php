<?php
/**
 * ChatSKU Theme Functions
 *
 * @package ChatSKU
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

// ─── Constants ───────────────────────────────────────────────────────────────
define( 'CHATSKU_VERSION',   '1.0.1' );
define( 'CHATSKU_DIR',       get_template_directory() );
define( 'CHATSKU_URI',       get_template_directory_uri() );
define( 'CHATSKU_ASSETS',    CHATSKU_URI . '/assets' );

// ─── Load modules ────────────────────────────────────────────────────────────
require_once CHATSKU_DIR . '/inc/setup.php';
require_once CHATSKU_DIR . '/inc/enqueue.php';
require_once CHATSKU_DIR . '/inc/helpers.php';

// ACF-dependent files — only load when ACF is active
if ( function_exists( 'acf_add_options_page' ) ) {
    require_once CHATSKU_DIR . '/inc/acf-options.php';
}

// Register ACF field groups programmatically (fallback + for version control)
if ( function_exists( 'acf_add_local_field_group' ) ) {
    require_once CHATSKU_DIR . '/inc/acf-fields.php';
}

// ─── ACF Local JSON ───────────────────────────────────────────────────────────
// Save ACF field group JSON to theme folder (version control friendly)
add_filter( 'acf/settings/save_json', function() {
    return CHATSKU_DIR . '/acf-json';
} );

// Load ACF field group JSON from theme folder
add_filter( 'acf/settings/load_json', function( $paths ) {
    $paths[] = CHATSKU_DIR . '/acf-json';
    return $paths;
} );


/**
 * ChatSKU Demo Shortcode
 * Usage: [chatsku_demo]
 */

if ( ! function_exists( 'chatsku_demo_shortcode' ) ) {
    function chatsku_demo_shortcode( $atts = [] ) {
        $atts = shortcode_atts(
            [
                'trial_url'     => home_url( '/signup/' ),
                'demo_call_url' => 'https://calendly.com',
                'register_url'  => function_exists( 'chatsku_option' ) ? chatsku_option( 'register_url', '/signup/' ) : home_url( '/signup/' ),
                'widget_src'    => 'https://app.chatsku.com/widget/widget.js',
                'widget_api_key'=> 'a9135858e5829054ecdb6a567234cf187875344f42ef54ba104400c4436f7dca',
            ],
            $atts,
            'chatsku_demo'
        );

        $theme_uri = get_template_directory_uri();

        ob_start();
        ?>
            <section class="demo-desktop-section demo-hide-mobile">
                    <div class="demo-two-col">

                        <div class="demo-left-col">

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

                                <ul class="demo-tips-list demo-tips-list--nl">
                                    <li class="demo-tips-list__item">
                                        <span class="demo-tip__query">Do you have a 1/4 inch stainless steel ball valve for high pressure?</span>
                                        <button class="demo-try-btn" type="button" data-query="Do you have a 1/4 inch stainless steel ball valve for high pressure?">Try It</button>
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
                            </div>

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
                            </div>

                        </div>

                        <div class="demo-right-col">

                            <div class="demo-tab-bar" role="tablist" aria-label="Demo view">
                                <button class="demo-tab demo-tab--active" id="tab-widget" role="tab" aria-selected="true" aria-controls="panel-widget" type="button" data-tab="widget">Customer Chat Widget</button>
                                <button class="demo-tab" id="tab-dashboard" role="tab" aria-selected="false" aria-controls="panel-dashboard" type="button" data-tab="dashboard">Admin Dashboard</button>
                            </div>

                            <div class="demo-tab-panel demo-tab-panel--active" id="panel-widget" role="tabpanel" aria-labelledby="tab-widget">
                                <div class="demo-mode-toggle" aria-label="Widget display mode">
                                    <button class="demo-mode-btn demo-mode-btn--active" type="button" data-mode="inline">Inline</button>
                                    <button class="demo-mode-btn" type="button" data-mode="bubble">Bubble</button>
                                </div>

                                <div class="demo-widget-card" id="demo-widget-card">
                                    <div class="demo-widget-spinner" id="demo-widget-spinner" aria-label="Loading widget" role="status">
                                        <div class="demo-spinner"></div>
                                        <span>Loading demo...</span>
                                    </div>
                                    <div id="chatsku-widget" style="width:100%; height:calc(100vh - 260px); min-height:400px; max-height:600px;"></div>
                                </div>
                            </div>

                            <div class="demo-tab-panel" id="panel-dashboard" role="tabpanel" aria-labelledby="tab-dashboard" hidden>
                                <div class="demo-carousel" id="demo-carousel" aria-label="Admin dashboard screenshots">
                                    <div class="demo-carousel__track-wrap">
                                        <div class="demo-carousel__track" id="demo-carousel-track">
                                            <?php
                                            $dashboard_slides = [
                                                [ 'src' => '/images/dashboard-overview.png',        'label' => 'Overview' ],
                                                [ 'src' => '/images/dashboard-products.png',        'label' => 'Products' ],
                                                [ 'src' => '/images/dashboard-quotes.png',          'label' => 'Quotes' ],
                                                [ 'src' => '/images/dashboard-orders.png',          'label' => 'Orders' ],
                                                [ 'src' => '/images/dashboard-customers.png',       'label' => 'Customers' ],
                                                [ 'src' => '/images/dashboard-analytics.png',       'label' => 'Analytics' ],
                                                [ 'src' => '/images/dashboard-chatbot-settings.png','label' => 'Chatbot Settings' ],
                                                [ 'src' => '/images/dashboard-team.png',            'label' => 'Team' ],
                                            ];

                                            foreach ( $dashboard_slides as $i => $slide ) : ?>
                                                <div class="demo-carousel__slide<?php echo $i === 0 ? ' demo-carousel__slide--active' : ''; ?>" data-index="<?php echo esc_attr( $i ); ?>" role="group" aria-label="<?php echo esc_attr( $slide['label'] ); ?> screenshot, slide <?php echo esc_attr( $i + 1 ); ?> of <?php echo count( $dashboard_slides ); ?>">
                                                    <img src="<?php echo esc_url( $slide['src'] ); ?>" alt="<?php echo esc_attr( $slide['label'] ); ?> dashboard screenshot" loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>" class="demo-carousel__img">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <button class="demo-carousel__nav demo-carousel__nav--prev" id="demo-carousel-prev" type="button" aria-label="Previous slide">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                                    </button>
                                    <button class="demo-carousel__nav demo-carousel__nav--next" id="demo-carousel-next" type="button" aria-label="Next slide">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                                    </button>

                                    <div class="demo-carousel__thumbs" role="tablist" aria-label="Go to slide">
                                        <?php foreach ( $dashboard_slides as $i => $slide ) : ?>
                                            <button class="demo-carousel__thumb<?php echo $i === 0 ? ' demo-carousel__thumb--active' : ''; ?>" type="button" role="tab" aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-label="Go to <?php echo esc_attr( $slide['label'] ); ?>" data-slide="<?php echo esc_attr( $i ); ?>">
                                                <?php echo esc_html( $slide['label'] ); ?>
                                            </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="demo-dashboard__cta">
                                    <a href="<?php echo esc_url( $atts['register_url'] ); ?>" class="chatsku-btn chatsku-btn--primary">
                                        Request Admin Demo
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
            </section>

            <section class="demo-mobile-section demo-show-mobile">
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

                    <div class="demo-widget-card demo-widget-card--mobile" id="demo-widget-card-mobile" style="margin-top: var(--space-6);">
                        <div class="demo-widget-spinner" id="demo-widget-spinner-mobile" aria-label="Loading widget" role="status">
                            <div class="demo-spinner"></div>
                            <span>Loading demo...</span>
                        </div>
                        <div id="chatsku-widget-mobile" style="width:100%; height:calc(100vh - 260px); min-height:400px; max-height:600px;"></div>
                    </div>

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
            </section>


   

        <style>
        .demo-hide-mobile { display: block; }
		.demo-show-mobile { display: none; }

		@media (max-width: 1023px) {
			.demo-hide-mobile { display: none; }
			.demo-show-mobile { display: block; }
		}

		.demo-two-col {
			display: grid;
			grid-template-columns: 0.7fr 1.3fr;
			gap: clamp(32px, 4vw, 64px);
			align-items: start;
		}

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

		.chatsku-welcome {
			width: 100%;
		}

		.demo-tip__icon--spelling { background: rgba(251, 191, 36, 0.15); color: #fbbf24; }
		.demo-tip__icon--mic { background: rgba(0, 201, 177, 0.15); color: var(--color-accent); }
		.demo-tip__icon--synonym { background: rgba(139, 92, 246, 0.15); color: #a78bfa; font-size: 16px; }

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

		.demo-tip__label em {
			font-style: italic;
			color: var(--color-accent);
		}

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

		.demo-tab:hover { color: var(--color-text-primary); }

		.demo-tab--active {
			background: rgba(0, 201, 177, 0.12);
			color: var(--color-accent);
		}

		.demo-tab-panel { display: none; }
		.demo-tab-panel--active { display: block; }

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

		.demo-widget-card {
			background: var(--color-bg-secondary);
			border: 1px solid var(--color-border);
			border-radius: 16px;
			overflow: hidden;
			position: relative;
		}

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

		@keyframes demo-spin {
			to { transform: rotate(360deg); }
		}

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

		.demo-carousel__slide--active { display: block; }

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

		.demo-dashboard__cta {
			display: flex;
			justify-content: center;
			padding: var(--space-5) 0 var(--space-2);
		}

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
        </style>

        <script>
        (function () {
            'use strict';

            var WIDGET_SRC = <?php echo wp_json_encode( $atts['widget_src'] ); ?>;
            var WIDGET_API_KEY = <?php echo wp_json_encode( $atts['widget_api_key'] ); ?>;
            var activeMode = 'inline';
            var bodySnapshot = null;
            var carouselIndex = 0;
            var carouselSlides = [];
            var carouselThumbs = [];

            function loadWidget(containerId, mode, spinnerElId) {
                var apis = [window.ChatSKU, window.chatsku, window.ImpelHub, window.impelhub];
                apis.forEach(function (api) {
                    if (api) {
                        if (typeof api.destroy === 'function') { try { api.destroy(); } catch(e) {} }
                        if (typeof api.unmount === 'function') { try { api.unmount(); } catch(e) {} }
                        if (typeof api.teardown === 'function') { try { api.teardown(); } catch(e) {} }
                    }
                });

                document.querySelectorAll('script[data-chatsku-widget]').forEach(function (s) {
                    s.parentNode.removeChild(s);
                });

                if (bodySnapshot) {
                    Array.from(document.body.children).forEach(function (el) {
                        if (!bodySnapshot.has(el)) {
                            el.parentNode && el.parentNode.removeChild(el);
                        }
                    });
                }

                var container = document.getElementById(containerId);
                if (container) container.innerHTML = '';

                var spinner = document.getElementById(spinnerElId);
                if (spinner) spinner.classList.remove('is-hidden');

                var script = document.createElement('script');
                script.src = WIDGET_SRC;
                script.setAttribute('data-api-key', WIDGET_API_KEY);
                script.setAttribute('data-embed', mode);
                script.setAttribute('data-container', containerId);
                script.setAttribute('data-chatsku-widget', '1');
                script.async = true;

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

            function initModeToggle() {
                var modeButtons = document.querySelectorAll('.demo-mode-btn');
                modeButtons.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        var mode = btn.getAttribute('data-mode');
                        if (mode === activeMode) return;
                        activeMode = mode;

                        modeButtons.forEach(function (b) {
                            b.classList.remove('demo-mode-btn--active');
                        });

                        btn.classList.add('demo-mode-btn--active');
                        loadWidget('chatsku-widget', activeMode, 'demo-widget-spinner');
                    });
                });
            }

            function initTabs() {
                var tabs = document.querySelectorAll('.demo-tab');
                var panels = document.querySelectorAll('.demo-tab-panel');

                tabs.forEach(function (tab) {
                    tab.addEventListener('click', function () {
                        var target = tab.getAttribute('data-tab');

                        tabs.forEach(function (t) {
                            t.classList.remove('demo-tab--active');
                            t.setAttribute('aria-selected', 'false');
                        });

                        tab.classList.add('demo-tab--active');
                        tab.setAttribute('aria-selected', 'true');

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

            function injectTextIntoWidget(query) {
                var containers = [
                    document.getElementById('chatsku-widget'),
                    document.getElementById('chatsku-widget-mobile'),
                    document
                ];

                var input = null;

                for (var i = 0; i < containers.length; i++) {
                    var root = containers[i];
                    if (!root) continue;

                    var candidate = root.querySelector('#ciq-input')
                        || root.querySelector('input[type="text"]')
                        || root.querySelector('textarea');

                    if (candidate) {
                        input = candidate;
                        break;
                    }

                    var iframes = root.querySelectorAll('iframe');
                    for (var j = 0; j < iframes.length; j++) {
                        try {
                            var iframeDoc = iframes[j].contentDocument || iframes[j].contentWindow.document;
                            candidate = iframeDoc.querySelector('#ciq-input')
                                || iframeDoc.querySelector('input[type="text"]')
                                || iframeDoc.querySelector('textarea');
                            if (candidate) {
                                input = candidate;
                                break;
                            }
                        } catch (e) {}
                    }

                    if (input) break;
                }

                if (!input) return;

                var nativeInputSetter = Object.getOwnPropertyDescriptor(window.HTMLInputElement.prototype, 'value')
                    || Object.getOwnPropertyDescriptor(window.HTMLTextAreaElement.prototype, 'value');

                if (nativeInputSetter && nativeInputSetter.set) {
                    nativeInputSetter.set.call(input, query);
                } else {
                    input.value = query;
                }

                input.dispatchEvent(new Event('input', { bubbles: true }));
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

            function injectImageIntoWidget(imgUrl, targetSuffix) {
                var containerId = (targetSuffix === 'mobile') ? 'chatsku-widget-mobile' : 'chatsku-widget';
                var container = document.getElementById(containerId) || document;

                fetch(imgUrl)
                    .then(function (res) { return res.blob(); })
                    .then(function (blob) {
                        var filename = imgUrl.split('/').pop() || 'image.png';
                        var file = new File([blob], filename, { type: blob.type || 'image/png' });
                        var fileInput = null;
                        var candidates = [container];
                        var iframes = container.querySelectorAll ? container.querySelectorAll('iframe') : [];

                        for (var i = 0; i < iframes.length; i++) {
                            try {
                                candidates.push(iframes[i].contentDocument || iframes[i].contentWindow.document);
                            } catch (e) {}
                        }

                        for (var k = 0; k < candidates.length; k++) {
                            var root = candidates[k];
                            var el = root.querySelector ? root.querySelector('input[type="file"]') : null;
                            if (el) {
                                fileInput = el;
                                break;
                            }
                        }

                        if (!fileInput) return;

                        var dt = new DataTransfer();
                        dt.items.add(file);
                        fileInput.files = dt.files;
                        fileInput.dispatchEvent(new Event('change', { bubbles: true }));
                        fileInput.dispatchEvent(new Event('input', { bubbles: true }));
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

            function goToSlide(index) {
                if (carouselSlides.length === 0) return;

                index = ((index % carouselSlides.length) + carouselSlides.length) % carouselSlides.length;
                carouselIndex = index;

                carouselSlides.forEach(function (slide, i) {
                    slide.classList.toggle('demo-carousel__slide--active', i === index);
                });

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

                carouselThumbs.forEach(function (thumb, i) {
                    thumb.addEventListener('click', function () {
                        goToSlide(i);
                    });
                });

                carousel.addEventListener('keydown', function (e) {
                    if (e.key === 'ArrowLeft') goToSlide(carouselIndex - 1);
                    if (e.key === 'ArrowRight') goToSlide(carouselIndex + 1);
                });
            }

            function init() {
                initTabs();
                initModeToggle();
                initTryItButtons();
                initImageButtons();
                initCarousel();

                bodySnapshot = new Set(Array.from(document.body.children));

                loadWidget('chatsku-widget', activeMode, 'demo-widget-spinner');

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
        <?php
        return ob_get_clean();
    }

    add_shortcode( 'chatsku_demo', 'chatsku_demo_shortcode' );
}

/**
 * Override the Calendly redirect URL to pass only the WPForms Entry ID (as a1).
 * Runs at priority 21 — just after the Calendly WPForms Redirect plugin stores
 * its transient (priority 20). We overwrite the transient with a minimal URL so
 * Calendly receives only a clean reference ID, while all calculator data remains
 * stored in the WPForms DB entry for the sales team to look up.
 */
add_action( 'wpforms_process_complete', 'chatsku_cwr_entry_id_only', 21, 4 );
function chatsku_cwr_entry_id_only( $fields, $entry, $form_data, $entry_id ) {
    // Only act on the Calculator Lead Capture form (ID 253)
    if ( (int) ( $form_data['id'] ?? 0 ) !== 253 ) return;

    // Read the one-time token the CWR plugin stored in the cookie (set at priority 20)
    $token = $_COOKIE['cwr_token'] ?? '';
    if ( ! $token ) return;

    // Get the base Calendly URL from the plugin's settings
    $opts     = get_option( 'cwr_settings', [] );
    $base_url = rtrim( $opts['calendly_url'] ?? '', '/' ) . '/';
    if ( ! $base_url || $base_url === '/' ) return;

    // Build a minimal URL: only the WPForms Entry ID as ?a1=XX
    $new_url = add_query_arg( 'a1', rawurlencode( (string) $entry_id ), $base_url );

    // Overwrite the transient — the browser JS reads this same key to get the redirect URL
    set_transient( 'cwr_redirect_' . sanitize_text_field( $token ), $new_url, 5 * MINUTE_IN_SECONDS );
}
