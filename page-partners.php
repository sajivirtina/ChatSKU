<?php
/**
 * Partners Page Template
 *
 * @package ChatSKU
 */

get_header();
?>

<main id="main" class="chatsku-main partners-main">

    <!-- ── Hero ──────────────────────────────────────────────────── -->
    <section class="partners-hero" aria-labelledby="partners-title">
        <div class="partners-hero__dots" aria-hidden="true"></div>
        <div class="container partners-hero__inner text-center">

            <!-- Eyebrow pill -->
            <div class="partners-hero__eyebrow reveal">
                <span class="partners-eyebrow-badge">Partner Program</span>
            </div>

            <!-- H1 -->
            <h1 id="partners-title" class="partners-hero__title reveal reveal-delay-1">
                Grow With ChatSKU
            </h1>

            <!-- Subtitle -->
            <p class="partners-hero__subtitle reveal reveal-delay-2">
                We have two ways to partner with us &mdash; pick the one that fits how you work.
            </p>

        </div>
    </section>

    <!-- ── Two Cards Grid ────────────────────────────────────────── -->
    <section class="partners-cards-section" aria-label="Partnership options">
        <div class="container">
            <div class="partners-cards-grid">

                <!-- ── Agency Partner Card ── -->
                <article class="partner-card partner-card--agency reveal" id="agency-partner">
                    <!-- Icon -->
                    <div class="partner-card__icon" aria-hidden="true">
                        <!-- Briefcase icon -->
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                    </div>

                    <!-- For label -->
                    <p class="partner-card__for-label">FOR AGENCIES</p>

                    <!-- Title -->
                    <h2 class="partner-card__title">Agency Partner</h2>

                    <!-- Description -->
                    <p class="partner-card__description">
                        You work with B2B manufacturers, distributors, or wholesalers. Recommend ChatSKU to your clients, support their onboarding, and build a meaningful new revenue stream for your agency.
                    </p>

                    <!-- Feature list -->
                    <ul class="partner-card__features" aria-label="Agency partner benefits">
                        <li class="partner-card__feature">
                            <span class="partner-card__check" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Dedicated partner manager
                        </li>
                        <li class="partner-card__feature">
                            <span class="partner-card__check" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Co-branded sales materials
                        </li>
                        <li class="partner-card__feature">
                            <span class="partner-card__check" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Priority client onboarding support
                        </li>
                        <li class="partner-card__feature">
                            <span class="partner-card__check" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Recurring revenue as clients stay active
                        </li>
                        <li class="partner-card__feature">
                            <span class="partner-card__check" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Quarterly business reviews <span class="partner-card__feature-note">(Preferred+)</span>
                        </li>
                    </ul>

                    <!-- CTA -->
                    <a href="/partners/agency/" class="chatsku-btn chatsku-btn--primary partner-card__cta">
                        Apply as an Agency Partner &rarr;
                    </a>
                </article>

                <!-- ── Affiliate Partner Card ── -->
                <article class="partner-card partner-card--affiliate reveal reveal-delay-1" id="affiliate-partner">
                    <!-- Icon -->
                    <div class="partner-card__icon" aria-hidden="true">
                        <!-- Megaphone icon -->
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 11l19-9-9 19-2-8-8-2z"/>
                        </svg>
                    </div>

                    <!-- For label -->
                    <p class="partner-card__for-label">FOR CREATORS &amp; CONSULTANTS</p>

                    <!-- Title -->
                    <h2 class="partner-card__title">Affiliate Partner</h2>

                    <!-- Description -->
                    <p class="partner-card__description">
                        You have an audience of B2B buyers, procurement professionals, or industrial business owners. Share ChatSKU with your followers and earn every time your referral becomes a customer.
                    </p>

                    <!-- Feature list -->
                    <ul class="partner-card__features" aria-label="Affiliate partner benefits">
                        <li class="partner-card__feature">
                            <span class="partner-card__check" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Get your unique referral link instantly
                        </li>
                        <li class="partner-card__feature">
                            <span class="partner-card__check" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Promote to your audience your way
                        </li>
                        <li class="partner-card__feature">
                            <span class="partner-card__check" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            No client management required
                        </li>
                        <li class="partner-card__feature">
                            <span class="partner-card__check" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Real-time referral dashboard
                        </li>
                        <li class="partner-card__feature">
                            <span class="partner-card__check" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Ready-to-use promotional assets
                        </li>
                    </ul>

                    <!-- CTA -->
                    <a href="/partners/affiliate/" class="chatsku-btn chatsku-btn--outline-accent partner-card__cta">
                        Join the Affiliate Program &rarr;
                    </a>
                </article>

            </div>
        </div>
    </section>

    <!-- ── Not Sure Section ──────────────────────────────────────── -->
    <section class="partners-notsure" aria-labelledby="partners-notsure-title">
        <div class="container partners-notsure__inner text-center">
            <h3 id="partners-notsure-title" class="partners-notsure__title reveal">
                Not sure which fits you?
            </h3>
            <p class="partners-notsure__body reveal reveal-delay-1">
                If you actively manage B2B client relationships and want to bring ChatSKU into your service offering, you&rsquo;re an Agency Partner. If you have an audience you want to share ChatSKU with, you&rsquo;re an Affiliate.
            </p>
            <p class="partners-notsure__contact reveal reveal-delay-2">
                <a href="mailto:partners@chatsku.com" class="partners-notsure__contact-link">
                    Questions? Reach out to our partnerships team &rarr;
                </a>
            </p>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* ── Partners Page Base ─────────────────────────────────────────── */
.partners-main {
    background: #0D1117;
    color: #E2E8F0;
}

/* ── Hero ───────────────────────────────────────────────────────── */
.partners-hero {
    position: relative;
    padding-top: 7rem;    /* pt-28 */
    padding-bottom: 3rem; /* pb-12 */
    overflow: hidden;
}

/* Subtle dot pattern */
.partners-hero__dots {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(0, 201, 177, 0.04) 1px, transparent 1px);
    background-size: 24px 24px;
    pointer-events: none;
}

.partners-hero__inner {
    position: relative;
    z-index: 1;
    max-width: 720px;
    margin-left: auto;
    margin-right: auto;
}

.partners-hero__eyebrow {
    margin-bottom: 1.25rem;
}

.partners-eyebrow-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(0, 201, 177, 0.1);
    border: 1px solid rgba(0, 201, 177, 0.3);
    color: #00C9B1;
    font-size: 0.8125rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    padding: 5px 14px;
    border-radius: 999px;
}

.partners-hero__title {
    font-family: var(--font-heading);
    font-size: clamp(2.25rem, 5vw, 3.5rem);
    font-weight: 800;
    color: #ffffff;
    letter-spacing: -0.03em;
    line-height: 1.12;
    margin: 0 0 1.125rem;
}

.partners-hero__subtitle {
    font-size: clamp(1rem, 2vw, 1.175rem);
    color: #758AA3;
    line-height: 1.7;
    margin: 0;
}

/* ── Cards Section ──────────────────────────────────────────────── */
.partners-cards-section {
    padding-top: 3.5rem;
    padding-bottom: 5rem;
}

.partners-cards-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
}

@media (min-width: 768px) {
    .partners-cards-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* ── Partner Card ───────────────────────────────────────────────── */
.partner-card {
    background: #1e293b;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1rem;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1.125rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.partner-card:hover {
    border-color: rgba(0, 201, 177, 0.4);
    box-shadow: 0 0 32px rgba(0, 201, 177, 0.08);
}

.partner-card__icon {
    width: 52px;
    height: 52px;
    background: rgba(0, 201, 177, 0.1);
    border: 1px solid rgba(0, 201, 177, 0.2);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #00C9B1;
    flex-shrink: 0;
}

.partner-card__for-label {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #00C9B1;
    margin: 0;
}

.partner-card__title {
    font-family: var(--font-heading);
    font-size: 1.5rem;
    font-weight: 800;
    color: #ffffff;
    letter-spacing: -0.02em;
    line-height: 1.2;
    margin: 0;
}

.partner-card__description {
    font-size: 0.9375rem;
    color: #94A3B8;
    line-height: 1.7;
    margin: 0;
}

/* Feature list */
.partner-card__features {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
    flex: 1;
}

.partner-card__feature {
    display: flex;
    align-items: flex-start;
    gap: 0.625rem;
    font-size: 0.9rem;
    color: #CBD5E1;
    line-height: 1.5;
}

.partner-card__check {
    width: 20px;
    height: 20px;
    background: rgba(0, 201, 177, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #00C9B1;
    flex-shrink: 0;
    margin-top: 0.1rem;
}

.partner-card__feature-note {
    color: #758AA3;
    font-size: 0.8125rem;
}

/* CTA button full-width */
.partner-card__cta {
    display: block;
    width: 100%;
    text-align: center;
    margin-top: auto;
}

/* Outline accent button */
.chatsku-btn--outline-accent {
    background: transparent;
    border: 1.5px solid #00C9B1;
    color: #00C9B1;
}

.chatsku-btn--outline-accent:hover {
    background: rgba(0, 201, 177, 0.08);
}

/* ── Not Sure Section ───────────────────────────────────────────── */
.partners-notsure {
    padding-top: 4.5rem;
    padding-bottom: 5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    background: rgba(0, 201, 177, 0.02);
}

.partners-notsure__inner {
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
}

.partners-notsure__title {
    font-family: var(--font-heading);
    font-size: clamp(1.375rem, 2.5vw, 1.875rem);
    font-weight: 800;
    color: #ffffff;
    letter-spacing: -0.02em;
    line-height: 1.25;
    margin: 0 0 1.25rem;
}

.partners-notsure__body {
    font-size: 1rem;
    color: #758AA3;
    line-height: 1.75;
    margin: 0 0 1.5rem;
}

.partners-notsure__contact {
    margin: 0;
}

.partners-notsure__contact-link {
    font-size: 0.9375rem;
    font-weight: 600;
    color: #00C9B1;
    text-decoration: none;
    transition: opacity 0.15s;
}

.partners-notsure__contact-link:hover {
    opacity: 0.8;
    text-decoration: underline;
}
</style>
