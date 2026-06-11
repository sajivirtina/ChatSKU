<?php
/**
 * FAQ Page Template
 * Template Name: FAQ
 *
 * @package ChatSKU
 */

get_header();

$faq_data = [
    [
        'id'    => 'getting-started',
        'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
        'label' => 'Getting Started',
        'items' => [
            [
                'q' => 'What is ChatSKU?',
                'a' => 'ChatSKU is a B2B ChatCommerce plugin that adds AI-powered product search, chat, and quote request functionality to any website. Your customers can search your catalog, ask questions, and submit RFQs through a conversational interface — without you rebuilding your site.',
            ],
            [
                'q' => 'How does it work?',
                'a' => 'You upload your product catalog (via CSV, PDF, or manual entry), customize your widget\'s look and feel, then copy one line of embed code to your website. Your customers can immediately start searching products and submitting quote requests through the chat widget.',
            ],
            [
                'q' => 'How long does it take to set up?',
                'a' => 'Most businesses go live the same day. Uploading your catalog and configuring the widget typically takes a few hours. Embedding the code on your site takes minutes.',
            ],
            [
                'q' => 'Do I need a developer?',
                'a' => 'No. If you can paste a line of code into your website (similar to adding Google Analytics), you can install ChatSKU. We provide step-by-step instructions for every major platform.',
            ],
            [
                'q' => 'What platforms does ChatSKU work with?',
                'a' => 'Any website that allows custom HTML — WordPress, Shopify, Wix, Squarespace, Webflow, or your own custom-built site. If you can add a script tag, ChatSKU works.',
            ],
        ],
    ],
    [
        'id'    => 'product-catalog',
        'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"/><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>',
        'label' => 'Product &amp; Catalog',
        'items' => [
            [
                'q' => 'How do I add my products?',
                'a' => 'Three ways: upload a CSV file with flexible column mapping, upload a PDF catalog (we extract products automatically using AI), or add products manually through the dashboard.',
            ],
            [
                'q' => 'Does it support product variants?',
                'a' => 'Yes. ChatSKU automatically detects and groups variants (like sizes, colors, and materials) using smart SKU and name matching. Customers see variants in an expandable view within the chat.',
            ],
            [
                'q' => 'Can I include product images?',
                'a' => 'Yes. You can upload up to 10 images per product via drag-and-drop or import from URLs during CSV upload. Images are automatically optimized for fast loading.',
            ],
            [
                'q' => 'What if my catalog changes frequently?',
                'a' => 'You can update products anytime through the dashboard or re-upload a CSV. Changes are reflected in the widget immediately.',
            ],
            [
                'q' => 'What if my catalog isn\'t in a CSV or PDF?',
                'a' => 'No problem. We can work with whatever you have. If your products live in a PDF catalog, we extract them automatically using AI. If you have an HTML product listing or an online catalog with no cart, we can pull from that too. And if your products are managed in an existing eCommerce platform or ERP system, we can connect to your backend and sync your catalog directly. However your products are stored today, we\'ll get them into ChatSKU — that\'s part of our white glove service.',
            ],
        ],
    ],
    [
        'id'    => 'chat-widget',
        'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
        'label' => 'The Chat Widget',
        'items' => [
            [
                'q' => 'How smart is the AI chat?',
                'a' => 'The AI is trained on your specific catalog. It understands product names, SKUs, descriptions, brands, specs, and variants. Customers can search using natural language like "heavy-duty safety gloves in large" and get accurate results.',
            ],
            [
                'q' => 'Is it just a chatbot?',
                'a' => 'No. Unlike generic chatbots, ChatSKU is built specifically for B2B commerce. It knows your products, shows real product cards with images and pricing, and lets customers build and submit quotes directly in the conversation.',
            ],
            [
                'q' => 'Can I customize how the widget looks?',
                'a' => 'Yes. You can set your brand\'s primary color, greeting message, widget position, and placeholder text. The widget is designed to blend with your existing site.',
            ],
            [
                'q' => 'Does it work on mobile?',
                'a' => 'Yes. The widget is fully responsive and works on any screen size.',
            ],
            [
                'q' => 'What happens outside business hours?',
                'a' => 'The AI chat works 24/7. Customers can search products and submit quote requests at any time. You\'ll receive an email notification for every new quote.',
            ],
        ],
    ],
    [
        'id'    => 'quotes-orders',
        'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>',
        'label' => 'Quotes &amp; Orders',
        'items' => [
            [
                'q' => 'How does the quote process work?',
                'a' => 'Customers browse products through the AI chat, add items to their quote, and submit a request. The quote appears in your dashboard where you can review it, apply pricing or discounts, add notes, and send it back to the customer.',
            ],
            [
                'q' => 'Can I set different prices for different customers?',
                'a' => 'Yes. You can create customer groups and assign group-based discounts — either percentage or fixed amount — so your pricing tiers are applied automatically.',
            ],
            [
                'q' => 'Do customers need to create an account to submit a quote?',
                'a' => 'Customers provide their name, email, and company details when submitting a quote. They can optionally create an account to track their quote history and save their information for future requests.',
            ],
            [
                'q' => 'Can I export quotes?',
                'a' => 'Yes. Quotes can be exported to CSV for use in your existing accounting or ERP systems.',
            ],
        ],
    ],
    [
        'id'    => 'pricing-plans',
        'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>',
        'label' => 'Pricing &amp; Plans',
        'items' => [
            [
                'q' => 'How does pricing work?',
                'a' => 'Every plan is custom. We tailor pricing based on your catalog size, feature needs, and team requirements. Reach out to us and we\'ll put together a plan that fits.',
            ],
            [
                'q' => 'Is there a free trial?',
                'a' => 'Yes. We offer a free trial so you can experience ChatSKU with your own catalog before committing.',
            ],
            [
                'q' => 'Can I cancel anytime?',
                'a' => 'Yes. No long-term contracts or cancellation fees.',
            ],
        ],
    ],
    [
        'id'    => 'onboarding-support',
        'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="4.93" y1="4.93" x2="9.17" y2="9.17"/><line x1="14.83" y1="14.83" x2="19.07" y2="19.07"/><line x1="14.83" y1="9.17" x2="19.07" y2="4.93"/><line x1="14.83" y1="9.17" x2="18.36" y2="5.64"/><line x1="4.93" y1="19.07" x2="9.17" y2="14.83"/></svg>',
        'label' => 'Onboarding &amp; Support',
        'items' => [
            [
                'q' => 'Do you offer onboarding help?',
                'a' => 'Yes. We provide white glove onboarding for every customer. Our team will help you configure your widget, import your catalog, and get live on your site. You\'re never left figuring it out alone.',
            ],
            [
                'q' => 'Can you set everything up for me?',
                'a' => 'Absolutely. Our white glove service covers full setup — from catalog import and widget configuration to embedding on your site. Just hand us your catalog and we\'ll take care of the rest.',
            ],
            [
                'q' => 'How do I get help after launch?',
                'a' => 'Every customer gets direct access to our support team. We\'re here for troubleshooting, catalog updates, configuration changes, or anything else you need.',
            ],
            [
                'q' => 'What if I need a feature you don\'t have yet?',
                'a' => 'We\'re building ChatSKU based on real customer feedback. Reach out to us at hello@chatsku.com — we actively prioritize features based on what our users need.',
            ],
        ],
    ],
    [
        'id'    => 'security-privacy',
        'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'label' => 'Security &amp; Privacy',
        'items' => [
            [
                'q' => 'Is my data secure?',
                'a' => 'Yes. All data is encrypted in transit and at rest. We follow industry-standard security practices for data protection.',
            ],
            [
                'q' => 'Who owns my product data?',
                'a' => 'You do. Your product catalog, customer information, and quote data belong to you. We never sell or share your data with third parties.',
            ],
            [
                'q' => 'Is ChatSKU GDPR compliant?',
                'a' => 'Yes. We provide data processing agreements, support data deletion requests, and give you full control over your customer data.',
            ],
            [
                'q' => 'Is there spam protection on the widget?',
                'a' => 'Yes. The widget includes hCaptcha protection to prevent bot submissions and spam quote requests.',
            ],
        ],
    ],
];
?>

<main id="main" class="chatsku-main faq-main">

    <!-- ═══ HERO ════════════════════════════════════════════════════════════════ -->
    <section class="faq-hero section-padding">
        <div class="container text-center">

            <div class="faq-hero__eyebrow reveal">
                <span class="faq-eyebrow-badge">
                    <!-- help-circle icon -->
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    FAQ
                </span>
            </div>

            <h1 class="faq-hero__title reveal reveal-delay-1">
                Everything you need to know
            </h1>

            <p class="faq-hero__subtitle reveal reveal-delay-2">
                Can't find your answer? Email us at <a href="mailto:hello@chatsku.com" class="faq-hero__email-link">hello@chatsku.com</a>
            </p>

        </div>
    </section>

    <!-- ═══ BODY: SIDEBAR + ACCORDION ══════════════════════════════════════════ -->
    <section class="faq-body section-padding" style="padding-top: 0;" aria-label="FAQ content">
        <div class="faq-body__inner">

            <!-- LEFT: Sticky Sidebar -->
            <aside class="faq-sidebar" id="faq-sidebar" aria-label="FAQ categories">
                <nav class="faq-sidebar__nav">
                    <?php foreach ( $faq_data as $i => $cat ) : ?>
                        <button
                            type="button"
                            class="faq-sidebar__btn<?php echo $i === 0 ? ' is-active' : ''; ?>"
                            data-target="faq-section-<?php echo esc_attr( $cat['id'] ); ?>"
                            aria-label="Jump to <?php echo esc_attr( wp_strip_all_tags( $cat['label'] ) ); ?>"
                        >
                            <span class="faq-sidebar__btn-icon" aria-hidden="true"><?php echo $cat['icon']; ?></span>
                            <span class="faq-sidebar__btn-label"><?php echo $cat['label']; ?></span>
                        </button>
                    <?php endforeach; ?>
                </nav>
            </aside>

            <!-- RIGHT: Accordion Sections -->
            <div class="faq-content" id="faq-content">
                <?php foreach ( $faq_data as $cat ) : ?>
                    <section
                        id="faq-section-<?php echo esc_attr( $cat['id'] ); ?>"
                        class="faq-category"
                        data-category="<?php echo esc_attr( $cat['id'] ); ?>"
                        aria-labelledby="faq-cat-heading-<?php echo esc_attr( $cat['id'] ); ?>"
                    >

                        <h2 id="faq-cat-heading-<?php echo esc_attr( $cat['id'] ); ?>" class="faq-category__heading">
                            <span class="faq-category__heading-icon" aria-hidden="true"><?php echo $cat['icon']; ?></span>
                            <?php echo $cat['label']; ?>
                        </h2>

                        <div class="faq-accordion" role="list">
                            <?php foreach ( $cat['items'] as $j => $item ) :
                                $item_id = 'faq-item-' . $cat['id'] . '-' . $j;
                            ?>
                                <div class="faq-accordion__item" role="listitem">
                                    <button
                                        type="button"
                                        class="faq-accordion__trigger"
                                        aria-expanded="false"
                                        aria-controls="<?php echo esc_attr( $item_id ); ?>"
                                        id="<?php echo esc_attr( $item_id ); ?>-btn"
                                    >
                                        <span class="faq-accordion__question"><?php echo esc_html( $item['q'] ); ?></span>
                                        <span class="faq-accordion__chevron" aria-hidden="true">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="6 9 12 15 18 9"/>
                                            </svg>
                                        </span>
                                    </button>
                                    <div
                                        class="faq-accordion__body"
                                        id="<?php echo esc_attr( $item_id ); ?>"
                                        role="region"
                                        aria-labelledby="<?php echo esc_attr( $item_id ); ?>-btn"
                                        hidden
                                    >
                                        <p class="faq-accordion__answer"><?php echo esc_html( $item['a'] ); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </section>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <!-- ═══ BOTTOM CTA ══════════════════════════════════════════════════════════ -->
    <section class="faq-cta" aria-labelledby="faq-cta-heading">
        <div class="container text-center">

            <h2 id="faq-cta-heading" class="faq-cta__heading reveal">
                Still have questions?
            </h2>

            <p class="faq-cta__text reveal reveal-delay-1">
                Ask us below and we'll get back to you — usually within a few hours.
            </p>

            <!-- Question Box -->
            <div class="faq-question-box reveal reveal-delay-2">
                <form class="faq-question-box__form" id="faq-question-form" novalidate>
                    <label for="faq-question-textarea" class="screen-reader-text">Your question</label>
                    <textarea
                        id="faq-question-textarea"
                        class="faq-question-box__textarea"
                        name="question"
                        placeholder="Type your question here…"
                        maxlength="500"
                        rows="4"
                        aria-label="Your question"
                    ></textarea>
                    <div class="faq-question-box__footer">
                        <span class="faq-question-box__char-count" id="faq-char-count" aria-live="polite">0 / 500</span>
                        <button type="submit" class="chatsku-btn chatsku-btn--primary">
                            Send Question
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="faq-cta__divider reveal reveal-delay-3">
                <span>or</span>
            </div>

            <a href="/signup/" class="chatsku-btn chatsku-btn--primary faq-cta__getstarted reveal reveal-delay-3">
                Get Started Free
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="5" y1="12" x2="19" y2="12"/>
                    <polyline points="12 5 19 12 12 19"/>
                </svg>
            </a>

        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* ── FAQ Hero ────────────────────────────────────────────────────────────── */
.faq-hero {
    padding-bottom: var(--space-16);
}

.faq-hero__eyebrow {
    margin-bottom: var(--space-5);
}

.faq-eyebrow-badge {
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

.faq-eyebrow-badge svg {
    flex-shrink: 0;
    color: var(--color-accent);
}

.faq-hero__title {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(2rem, 5vw, 3.25rem);
    font-weight: 800;
    color: var(--color-text-primary, #f8fafc);
    letter-spacing: -0.03em;
    line-height: 1.15;
    margin: 0 0 var(--space-5);
}

.faq-hero__subtitle {
    font-family: var(--font-sans);
    font-size: clamp(1rem, 2vw, 1.125rem);
    color: var(--color-text-muted, #758AA3);
    line-height: 1.7;
    max-width: 560px;
    margin: 0 auto;
}

.faq-hero__email-link {
    color: var(--color-accent, #00C9B1);
    text-decoration: underline;
    text-underline-offset: 3px;
    transition: opacity 0.2s;
}

.faq-hero__email-link:hover {
    opacity: 0.8;
}

/* ── FAQ Body Layout ─────────────────────────────────────────────────────── */
.faq-body__inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 var(--space-6);
    display: flex;
    flex-direction: row;
    gap: 40px;
    align-items: flex-start;
}

/* ── FAQ Sidebar ─────────────────────────────────────────────────────────── */
.faq-sidebar {
    width: 224px;
    flex-shrink: 0;
    position: sticky;
    top: 96px;
}

.faq-sidebar__nav {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.faq-sidebar__btn {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 9px 12px;
    border-radius: 8px;
    border: none;
    background: transparent;
    color: var(--color-text-muted, #758AA3);
    font-family: var(--font-sans);
    font-size: 13.5px;
    font-weight: 500;
    cursor: pointer;
    text-align: left;
    transition: background 0.18s, color 0.18s;
}

.faq-sidebar__btn:hover {
    background: rgba(255, 255, 255, 0.05);
    color: var(--color-text-primary, #f8fafc);
}

.faq-sidebar__btn.is-active {
    background: rgba(0, 201, 177, 0.15);
    color: var(--color-accent, #00C9B1);
}

.faq-sidebar__btn-icon {
    display: flex;
    align-items: center;
    flex-shrink: 0;
}

.faq-sidebar__btn-icon svg {
    width: 16px;
    height: 16px;
}

/* ── FAQ Content ─────────────────────────────────────────────────────────── */
.faq-content {
    flex: 1;
    min-width: 0;
}

/* ── FAQ Category Section ────────────────────────────────────────────────── */
.faq-category {
    margin-bottom: var(--space-12);
    scroll-margin-top: 96px;
}

.faq-category:last-child {
    margin-bottom: 0;
}

.faq-category__heading {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--color-text-primary, #f8fafc);
    margin: 0 0 var(--space-5);
    padding-bottom: var(--space-4);
    border-bottom: 1px solid var(--color-border, rgba(255,255,255,0.08));
}

.faq-category__heading-icon {
    display: flex;
    align-items: center;
    color: var(--color-accent, #00C9B1);
    flex-shrink: 0;
}

.faq-category__heading-icon svg {
    width: 18px;
    height: 18px;
}

/* ── FAQ Accordion ───────────────────────────────────────────────────────── */
.faq-accordion {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.faq-accordion__item {
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 10px;
    overflow: hidden;
    transition: border-color 0.2s;
}

.faq-accordion__item:has(.faq-accordion__trigger[aria-expanded="true"]) {
    border-color: rgba(0, 201, 177, 0.25);
}

.faq-accordion__trigger {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--space-4);
    width: 100%;
    padding: 18px 20px;
    border: none;
    background: transparent;
    cursor: pointer;
    text-align: left;
}

.faq-accordion__trigger:hover {
    background: rgba(255, 255, 255, 0.03);
}

.faq-accordion__question {
    font-family: var(--font-sans);
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--color-text-primary, #f8fafc);
    line-height: 1.5;
}

.faq-accordion__chevron {
    display: flex;
    align-items: center;
    flex-shrink: 0;
    color: var(--color-text-muted, #758AA3);
    transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s;
}

.faq-accordion__trigger[aria-expanded="true"] .faq-accordion__chevron {
    transform: rotate(180deg);
    color: var(--color-accent, #00C9B1);
}

.faq-accordion__trigger[aria-expanded="true"] .faq-accordion__question {
    color: var(--color-accent, #00C9B1);
}

.faq-accordion__body {
    padding: 0 20px 18px 20px;
}

.faq-accordion__body[hidden] {
    display: none;
}

.faq-accordion__answer {
    font-family: var(--font-sans);
    font-size: 0.9375rem;
    color: var(--color-text-muted, #758AA3);
    line-height: 1.75;
    margin: 0;
}

/* ── FAQ CTA ─────────────────────────────────────────────────────────────── */
.faq-cta {
    border-top: 1px solid var(--color-border, rgba(255,255,255,0.08));
    background: rgba(30, 41, 59, 0.3);
    padding: var(--space-20) var(--space-6);
    margin-top: var(--space-16);
    text-align: center;
}

.faq-cta__heading {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    font-weight: 800;
    color: var(--color-text-primary, #f8fafc);
    letter-spacing: -0.03em;
    margin: 0 0 var(--space-4);
}

.faq-cta__text {
    font-size: 1.0625rem;
    color: var(--color-text-muted, #758AA3);
    margin: 0 0 var(--space-8);
    line-height: 1.6;
}

/* Question Box */
.faq-question-box {
    max-width: 560px;
    margin: 0 auto var(--space-6);
}

.faq-question-box__form {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
}

.faq-question-box__textarea {
    width: 100%;
    background: var(--color-bg-secondary, #1e293b);
    border: 1px solid var(--color-border, rgba(255,255,255,0.08));
    border-radius: 10px;
    color: var(--color-text-primary, #f8fafc);
    font-family: var(--font-sans);
    font-size: 0.9375rem;
    line-height: 1.6;
    padding: 14px 16px;
    resize: vertical;
    min-height: 100px;
    transition: border-color 0.2s;
    box-sizing: border-box;
}

.faq-question-box__textarea::placeholder {
    color: var(--color-text-muted, #758AA3);
}

.faq-question-box__textarea:focus {
    outline: none;
    border-color: rgba(0, 201, 177, 0.4);
}

.faq-question-box__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--space-4);
}

.faq-question-box__char-count {
    font-size: 12px;
    color: var(--color-text-muted, #758AA3);
}

/* CTA divider */
.faq-cta__divider {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    max-width: 320px;
    margin: 0 auto var(--space-6);
    color: var(--color-text-muted, #758AA3);
    font-size: 13px;
}

.faq-cta__divider::before,
.faq-cta__divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--color-border, rgba(255,255,255,0.08));
}

.faq-cta__getstarted {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

/* ── Mobile: hide sidebar ────────────────────────────────────────────────── */
@media (max-width: 768px) {
    .faq-body__inner {
        flex-direction: column;
        gap: var(--space-8);
    }

    .faq-sidebar {
        display: none;
    }

    .faq-body__inner {
        padding: 0 var(--space-4);
    }
}

@media (max-width: 480px) {
    .faq-question-box__footer {
        flex-direction: column;
        align-items: stretch;
    }

    .faq-question-box__char-count {
        text-align: right;
    }
}
</style>

<!-- Accordion, sidebar, and form handled by assets/js/accordion.js -->
