<?php
/**
 * Problems Page Template
 *
 * @package ChatSKU
 */

get_header();

$problems = [
    [
        'slug'       => 'response-gap',
        'name'       => 'The Response Gap',
        'severity'   => 'Critical',
        'sev_color'  => '#00C9B1',
        'cost_line'  => 'Buyers who don\'t get an instant answer don\'t wait. They go to your competitor.',
        'occurrence' => 'Happens daily, across every product page, every weekend, every holiday.',
    ],
    [
        'slug'       => 'passive-catalog',
        'name'       => 'The Passive Catalog Problem',
        'severity'   => 'Critical',
        'sev_color'  => '#00C9B1',
        'cost_line'  => 'A PDF catalog cannot sell. It can only inform, and only during business hours.',
        'occurrence' => 'The default state for most manufacturers, distributors, and wholesalers.',
    ],
    [
        'slug'       => 'human-bottleneck',
        'name'       => 'The Human Bottleneck',
        'severity'   => 'High',
        'sev_color'  => '#f97316',
        'cost_line'  => 'Your reps are answering spec questions when they should be closing deals.',
        'occurrence' => 'Universal across any business with a complex catalog and no self-serve layer.',
    ],
    [
        'slug'       => 'black-hole-pipeline',
        'name'       => 'The Black Hole Pipeline',
        'severity'   => 'High',
        'sev_color'  => '#f97316',
        'cost_line'  => 'Inquiries that aren\'t tracked don\'t get followed up. Revenue evaporates silently.',
        'occurrence' => 'Endemic to teams without a CRM or built around email and spreadsheets.',
    ],
    [
        'slug'       => 'complex-configuration',
        'name'       => 'The Complex Configuration Problem',
        'severity'   => 'High',
        'sev_color'  => '#f97316',
        'cost_line'  => 'The queries hardest to handle are attached to your largest order values.',
        'occurrence' => 'Concentrated in industrial, hardware, and specialty manufacturing categories.',
    ],
    [
        'slug'       => 'headcount-ceiling',
        'name'       => 'The Headcount Ceiling',
        'severity'   => 'Medium-High',
        'sev_color'  => '#eab308',
        'cost_line'  => 'You cannot grow responsiveness without growing payroll. That\'s a structural trap.',
        'occurrence' => 'Most acute during growth phases and seasonal demand spikes.',
    ],
];
?>

<main id="main" class="chatsku-main problems-main">

    <!-- ── Page Header ───────────────────────────────────────────── -->
    <section class="problems-hero" aria-labelledby="problems-title">
        <div class="container problems-hero__inner">
            <h1 id="problems-title" class="problems-hero__title reveal">
                Your B2B website is losing revenue in 6 specific ways.
            </h1>
            <p class="problems-hero__subtitle reveal reveal-delay-1">
                Most manufacturers and distributors don't know how much because the losses are invisible. Here's exactly where it's happening.
            </p>
        </div>
    </section>

    <!-- ── Problem Cards Grid ────────────────────────────────────── -->
    <section class="problems-grid-section" aria-label="Problem areas">
        <div class="container">
            <div class="problems-grid">
                <?php foreach ( $problems as $problem ) : ?>
                    <article
                        class="problem-card reveal"
                        style="--card-accent: <?php echo esc_attr( $problem['sev_color'] ); ?>;"
                    >
                        <div class="problem-card__severity">
                            <span
                                class="problem-card__dot"
                                style="background: <?php echo esc_attr( $problem['sev_color'] ); ?>;"
                                aria-hidden="true"
                            ></span>
                            <span
                                class="problem-card__severity-label"
                                style="color: <?php echo esc_attr( $problem['sev_color'] ); ?>;"
                            >
                                <?php echo esc_html( $problem['severity'] ); ?>
                            </span>
                        </div>

                        <h3 class="problem-card__name">
                            <?php echo esc_html( $problem['name'] ); ?>
                        </h3>

                        <p class="problem-card__cost">
                            <?php echo esc_html( $problem['cost_line'] ); ?>
                        </p>

                        <p class="problem-card__occurrence">
                            <?php echo esc_html( $problem['occurrence'] ); ?>
                        </p>

                        <a
                            href="<?php echo esc_url( '/problems/' . $problem['slug'] . '/' ); ?>"
                            class="problem-card__link"
                            aria-label="<?php echo esc_attr( 'See how ' . $problem['name'] . ' is costing you' ); ?>"
                        >
                            See How It&#8217;s Costing You &rarr;
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── Bottom CTA ────────────────────────────────────────────── -->
    <section class="problems-cta" aria-labelledby="problems-cta-title">
        <div class="container problems-cta__inner text-center">
            <h2 id="problems-cta-title" class="problems-cta__title reveal">
                See ChatSKU close every one of these gaps, live.
            </h2>
            <p class="problems-cta__subtitle reveal reveal-delay-1">
                No slides. No sales call. Just the product working on a real catalog.
            </p>
            <a href="/demo/" class="chatsku-btn chatsku-btn--primary chatsku-btn--lg reveal reveal-delay-2">
                Try Live Demo &rarr;
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* ── Problems Hero ──────────────────────────────────────────────── */
.problems-hero {
    padding-top: 7rem;   /* pt-28 */
    padding-bottom: 4rem; /* pb-16 */
}

.problems-hero__inner {
    max-width: 80rem; /* max-w-7xl */
    margin-left: auto;
    margin-right: auto;
}

.problems-hero__title {
    font-family: var(--font-heading);
    font-size: clamp(1.875rem, 4.5vw, 3rem);
    font-weight: 800;
    color: var(--color-text-primary);
    letter-spacing: -0.03em;
    line-height: 1.15;
    margin: 0 0 1.25rem;
    max-width: 56rem;
}

.problems-hero__subtitle {
    font-size: clamp(1rem, 2vw, 1.2rem);
    color: var(--color-text-muted);
    line-height: 1.7;
    max-width: 52rem;
    margin: 0;
}

/* ── Problems Grid Section ──────────────────────────────────────── */
.problems-grid-section {
    padding-top: 3rem;
    padding-bottom: 5rem;
}

.problems-grid {
    max-width: 80rem;
    margin-left: auto;
    margin-right: auto;
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

@media (min-width: 768px) {
    .problems-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* ── Problem Card ───────────────────────────────────────────────── */
.problem-card {
    background: var(--color-bg-secondary);
    border: 1px solid var(--color-border);
    border-left: 3px solid var(--card-accent, #00C9B1);
    border-radius: 0.75rem;
    padding: 1.75rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.problem-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
}

.problem-card__severity {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.problem-card__dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.problem-card__severity-label {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.problem-card__name {
    font-family: var(--font-heading);
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--color-text-primary);
    margin: 0;
    line-height: 1.3;
}

.problem-card__cost {
    font-size: 0.9375rem;
    color: var(--color-text-muted);
    line-height: 1.6;
    margin: 0;
}

.problem-card__occurrence {
    font-size: 0.8125rem;
    color: var(--color-text-muted);
    opacity: 0.75;
    line-height: 1.5;
    margin: 0;
}

.problem-card__link {
    display: inline-block;
    margin-top: auto;
    padding-top: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--color-accent);
    text-decoration: none;
    transition: opacity 0.15s ease;
}

.problem-card__link:hover {
    opacity: 0.8;
    text-decoration: underline;
}

/* ── Bottom CTA ─────────────────────────────────────────────────── */
.problems-cta {
    padding-top: 5rem;
    padding-bottom: 5rem;
    background: rgba(0, 201, 177, 0.04);
    border-top: 1px solid var(--color-border);
}

.problems-cta__inner {
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
}

.problems-cta__title {
    font-family: var(--font-heading);
    font-size: clamp(1.625rem, 3.5vw, 2.25rem);
    font-weight: 800;
    color: var(--color-text-primary);
    letter-spacing: -0.025em;
    line-height: 1.2;
    margin: 0 0 1rem;
}

.problems-cta__subtitle {
    font-size: 1.0625rem;
    color: var(--color-text-muted);
    line-height: 1.65;
    margin: 0 0 2.5rem;
}
</style>
