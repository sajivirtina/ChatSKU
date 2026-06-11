<?php
/**
 * Features Page Template
 * Template Name: Features
 *
 * @package ChatSKU
 */

get_header();
?>

<main id="main" class="chatsku-main features-main">

    <!-- Page Header -->
    <section class="features-hero section-padding" style="padding-bottom: var(--space-12);">
        <div class="container text-center">

            <!-- Eyebrow badge -->
            <div class="features-hero__eyebrow reveal">
                <span class="features-eyebrow-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                    </svg>
                    Features
                </span>
            </div>

            <!-- H1 -->
            <h1 class="features-hero__title reveal reveal-delay-1">
                Everything you need to <em>sell smarter</em>
            </h1>

            <!-- Subtitle -->
            <p class="features-hero__subtitle reveal reveal-delay-2">
                Discover how ChatSKU turns your product catalog into an AI-powered sales assistant — ready in minutes, not months.
            </p>

        </div>
    </section>

    <!-- Features Widget Section -->
    <section class="features-widget-section">
        <div class="features-widget-wrap">
            <div class="features-widget-card">
                <div id="chatsku-features"></div>
            </div>
        </div>
    </section>

    <?php get_template_part( 'template-parts/global/cta-banner' ); ?>

</main>

<?php get_footer(); ?>

<style>
/* ── Features Hero ─────────────────────────────────────────────────── */
.features-hero__eyebrow {
    margin-bottom: var(--space-5);
}

.features-eyebrow-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(0, 201, 177, 0.12);
    border: 1px solid rgba(0, 201, 177, 0.3);
    color: var(--color-accent);
    font-family: var(--font-sans);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 999px;
}

.features-eyebrow-badge svg {
    flex-shrink: 0;
    color: var(--color-accent);
}

.features-hero__title {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 5vw, 3.25rem);
    font-weight: 800;
    color: var(--color-text-primary);
    letter-spacing: -0.03em;
    line-height: 1.15;
    margin: 0 0 var(--space-5);
}

.features-hero__title em {
    font-style: normal;
    background: linear-gradient(135deg, #00C9B1 0%, #00e5d0 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.features-hero__subtitle {
    font-family: var(--font-sans);
    font-size: clamp(1rem, 2vw, 1.2rem);
    color: var(--color-text-secondary);
    line-height: 1.7;
    max-width: 620px;
    margin: 0 auto;
}

/* ── Features Widget Section ───────────────────────────────────────── */
.features-widget-section {
    padding-bottom: var(--space-20);
}

/* Matches React: max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center */
.features-widget-wrap {
    max-width: 840px;
    margin-left: auto;
    margin-right: auto;
    padding-left: clamp(16px, 4vw, 32px);
    padding-right: clamp(16px, 4vw, 32px);
    display: flex;
    justify-content: center;
}

/* Matches React: rounded-2xl border border-border bg-card p-6 shadow-2xl glow-teal */
.features-widget-card {
    width: 100%;
    background: var(--color-bg-secondary);
    border: 1px solid var(--color-border);
    border-radius: 1rem;
    padding: 24px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
    position: relative;
    overflow: hidden;
    /* Teal glow outline — matches React glow-teal */
    box-shadow:
        0 25px 50px -12px rgba(0, 0, 0, 0.6),
        0 0 0 1px rgba(0, 201, 177, 0.2),
        0 0 40px rgba(0, 201, 177, 0.08);
}

.features-widget-card::before {
    content: '';
    position: absolute;
    top: -60px;
    left: 50%;
    transform: translateX(-50%);
    width: 500px;
    height: 160px;
    background: radial-gradient(ellipse at center, rgba(0, 201, 177, 0.07) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
}

#chatsku-features {
    position: relative;
    z-index: 1;
    min-height: 100px;
}
</style>

<script>
(function () {
    /**
     * Dynamically load the features widget script after the DOM is ready.
     * Using a self-invoking function to avoid polluting global scope.
     */
    function loadFeaturesWidget() {
        var script = document.createElement('script');
        script.src = 'https://app.chatsku.com/widget/features-widget.js';
        script.async = true;
        script.defer = true;
        document.body.appendChild(script);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadFeaturesWidget);
    } else {
        loadFeaturesWidget();
    }
})();
</script>
