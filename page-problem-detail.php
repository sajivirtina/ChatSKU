<?php
/**
 * Problem Detail Page Template
 * Template Name: Problem Detail
 *
 * @package ChatSKU
 */

$problems = [
    'response-gap' => [
        'name'             => 'The Response Gap',
        'severity'         => 'Critical',
        'severity_color'   => '#00C9B1',
        'financial_hook'   => 'Every unanswered inquiry is a closed deal. Just not yours.',
        'section2_headline' => "This isn't a staffing problem. It's a timing problem.",
        'section2_body'    => [
            "B2B websites were built to display products, not to sell them. Contact forms were added as an afterthought. No real-time response layer exists between the buyer's question and a human being available to answer it.",
            "When a buyer hits your site outside business hours, or during a busy stretch when no one is monitoring the inbox, there is nothing there to catch them. The lead is gone before it was ever created.",
        ],
        'scenario'         => "A buyer lands on the site, can't find what they need fast enough, and leaves without submitting anything. Invisible. No record. Or they push through, submit an RFQ, and wait three days in silence. Either way the competitor wins and the business may never know it happened.",
        'scenario_closing' => "Your competitor answered. You didn't know it happened.",
        'stats'            => [
            [ 'value' => '3 Days',  'label' => 'Average RFQ response time without automation' ],
            [ 'value' => '$0',      'label' => 'Revenue captured from after-hours inquiries' ],
            [ 'value' => '1 Hour',  'label' => 'Time before most buyers move on to a competitor' ],
        ],
        'solve_copy'       => "ChatSKU deploys a real-time AI assistant that sits directly on your product pages and responds to buyer questions instantly. It answers spec queries, confirms availability, surfaces alternatives, and routes qualified inquiries into a structured quote pipeline. No staffing required. No business hours limitation. Every visitor gets an immediate, informed response.",
        'sample_user'      => "Is the 316 stainless version available in 1/2 inch?",
        'sample_bot'       => "Yes. SKU SS316-050 is in stock with a 3-day lead time. Want me to start a quote?",
        'short_name'       => 'the response gap',
    ],
    'passive-catalog' => [
        'name'             => 'The Passive Catalog Problem',
        'severity'         => 'Critical',
        'severity_color'   => '#00C9B1',
        'financial_hook'   => "Your catalog works 9 to 5. Your buyers don't.",
        'section2_headline' => "This isn't a staffing problem. It's a catalog infrastructure problem.",
        'section2_body'    => [
            "Product catalogs were designed by operations and engineering teams to document products, not by sales teams to convert buyers. The goal was completeness and accuracy. A PDF or static HTML page was the logical output of that mindset.",
            "No search by spec. No stock confirmation. No interactive path to a quote. Hiring a night-shift rep doesn't fix a dead PDF. The problem is structural.",
        ],
        'scenario'         => "A buyer arrives at 9pm needing specs, MOQ, and lead time confirmation. The catalog is either a PDF they have to dig through or a static HTML page with no interaction. No chat. No self-serve path. No staff online. The catalog cannot respond. Buyer leaves.",
        'scenario_closing' => "Your competitor answered. You didn't know it happened.",
        'stats'            => [
            [ 'value' => '60%+',   'label' => 'Of B2B research happens outside business hours' ],
            [ 'value' => '0',      'label' => 'Self-serve paths on a typical PDF catalog' ],
            [ 'value' => '1 Line', 'label' => 'Of code is all it takes to change this with ChatSKU' ],
        ],
        'solve_copy'       => "ChatSKU transforms your static catalog into an interactive buying experience. Buyers can search by spec, ask natural-language questions, get instant stock and lead time answers, and submit quotes without ever leaving the page. Your catalog becomes a 24/7 sales channel that works while your team sleeps.",
        'sample_user'      => "What's the MOQ on your brass fittings?",
        'sample_bot'       => "Standard MOQ is 100 units. For orders over 500, volume pricing applies. Want me to pull a quote?",
        'short_name'       => "a catalog that can't sell",
    ],
    'human-bottleneck' => [
        'name'             => 'The Human Bottleneck',
        'severity'         => 'High',
        'severity_color'   => '#f97316',
        'financial_hook'   => 'Your best reps are doing work a system should handle.',
        'section2_headline' => "Every spec question a rep answers is a deal they aren't closing.",
        'section2_body'    => [
            "When no self-serve layer exists on the website, every buyer question gets routed through the same human channel regardless of complexity or value. There is no triage. No automation. No way to separate a \$50 reorder question from a \$50,000 new account inquiry.",
            "Everything lands on the same rep. The result is expensive human capital systematically misallocated to low-value work while high-value opportunities sit unworked.",
        ],
        'scenario'         => "Sales reps spend the majority of their day fielding repetitive product questions: stock levels, lead times, finish options, MOQs. Buyers have no self-serve path and no choice but to call or email a human. High-value rep time is consumed by low-value lookups while actual deals sit unworked.",
        'scenario_closing' => "Your competitor answered. You didn't know it happened.",
        'stats'            => [
            [ 'value' => 'Hours', 'label' => 'Lost daily per rep to repetitive spec queries' ],
            [ 'value' => '0',     'label' => 'Deals worked while reps answer catalog questions' ],
            [ 'value' => '80%',   'label' => 'Of routine inquiries ChatSKU handles automatically' ],
        ],
        'solve_copy'       => "ChatSKU handles the repetitive, spec-level inquiries that consume your reps' days. Stock checks, lead times, material options, and MOQ lookups are answered instantly by AI. Your reps only see qualified, high-value inquiries that are ready for human attention. The result is more deals worked per rep, per day.",
        'sample_user'      => "What's the lead time on galvanized channel strut?",
        'sample_bot'       => "Standard lead time is 5 business days. Expedited available for orders placed before 2pm. Want pricing?",
        'short_name'       => 'rep time on the wrong work',
    ],
    'black-hole-pipeline' => [
        'name'             => 'The Black Hole Pipeline',
        'severity'         => 'High',
        'severity_color'   => '#f97316',
        'financial_hook'   => "If it isn't tracked, it isn't revenue. It's a guess.",
        'section2_headline' => "Your pipeline exists in people's heads and inboxes.",
        'section2_body'    => [
            "Inquiry channels were never unified into a single system. Email, phone, and contact forms each deposit leads into different places owned by different people. Without a structured intake process, the pipeline has no single source of truth.",
            "It exists as a collection of individual memories, inboxes, and spreadsheets that no one fully owns or can see completely. Sales managers have no visibility into inquiry volume, quote stage, or potential revenue value.",
        ],
        'scenario'         => "Inquiries arrive through scattered channels, get missed, buried, or assigned informally. No tracking. No follow-up. No audit trail. Sales managers have no visibility into inquiry volume, quote stage, or potential revenue value. The pipeline exists only in people's heads and inboxes.",
        'scenario_closing' => "Your competitor answered. You didn't know it happened.",
        'stats'            => [
            [ 'value' => 'Scattered', 'label' => 'Inquiries across email, phone, and forms with no single owner' ],
            [ 'value' => '0',         'label' => 'Management visibility into quote status or pipeline value' ],
            [ 'value' => '100%',      'label' => 'Of ChatSKU inquiries captured into a structured dashboard' ],
        ],
        'solve_copy'       => "Every conversation ChatSKU handles is captured, structured, and surfaced in a unified dashboard. Inquiry source, product interest, buyer intent signals, and quote status are all visible in one place. Sales managers see the full pipeline for the first time. Nothing gets lost, buried, or forgotten.",
        'sample_user'      => "I need a quote on 200 units of the titanium hex bolts.",
        'sample_bot'       => "Confirmed. I've started a quote for 200x TI-HEX-025. Your rep will have it ready within the hour. Anything else?",
        'short_name'       => "pipeline you can't see",
    ],
    'complex-configuration' => [
        'name'             => 'The Complex Configuration Problem',
        'severity'         => 'High',
        'severity_color'   => '#f97316',
        'financial_hook'   => 'Your highest-value orders are the ones your site handles worst.',
        'section2_headline' => "The bigger the order, the harder it is for your site to respond.",
        'section2_body'    => [
            "B2B product catalogs were architected for browsing and reference, not for real-time configuration. The underlying product data exists but was never structured to support multi-attribute queries.",
            "No interface was ever built to let a buyer combine finish, size, quantity, lead time, and pricing tier into a single question and get a single coherent answer. These are often the highest-value orders in the pipeline. Losing them is disproportionately costly.",
        ],
        'scenario'         => "A buyer asks: Do you have the 3/8 inch zinc-plated version, qty 500, net-30 terms, 5-day lead time? A static site returns nothing. A contact form sends an email into a queue. The buyer needed an answer in the moment. They don't get one, and they move on.",
        'scenario_closing' => "Your competitor answered. You didn't know it happened.",
        'stats'            => [
            [ 'value' => 'Multi-attribute', 'label' => 'Queries represent the highest order values in your pipeline' ],
            [ 'value' => '$0',              'label' => 'Returned by a static site on a complex spec question' ],
            [ 'value' => '1 Conversation',  'label' => 'Is all ChatSKU needs to match specs, surface alternatives, and route to a quote' ],
        ],
        'solve_copy'       => "ChatSKU understands multi-attribute queries natively. A buyer can ask about finish, size, quantity, terms, and lead time in a single message and get a coherent, accurate response. The AI matches against your full catalog data, surfaces exact SKUs or alternatives, and routes complex inquiries directly into a quote workflow.",
        'sample_user'      => 'Do you have 3/8" zinc-plated bolts, qty 500, net-30?',
        'sample_bot'       => "Yes. SKU ZB-375-500 is in stock. Lead time 4 days. Want me to start a quote?",
        'short_name'       => 'complex queries falling through',
    ],
    'headcount-ceiling' => [
        'name'             => 'The Headcount Ceiling',
        'severity'         => 'Medium-High',
        'severity_color'   => '#eab308',
        'financial_hook'   => "You're scaling payroll when you should be scaling revenue.",
        'section2_headline' => "Responsiveness was never decoupled from headcount. It needs to be.",
        'section2_body'    => [
            "Customer responsiveness is entirely dependent on human staffing levels because no technology layer was ever inserted between buyer demand and human fulfillment of that demand. Every unit of growth in inquiry volume maps directly to a unit of growth in staffing need.",
            "Each new rep is a fixed cost, a training investment, and a capacity constraint. The business cannot scale its responsiveness without scaling its payroll. That ceiling gets more expensive to ignore the longer it persists.",
        ],
        'scenario'         => "As inquiry volume grows, the only solution today is adding inside sales or support staff. Each new rep is a fixed cost, a training investment, and a ramp period. The business cannot scale its responsiveness without scaling its payroll.",
        'scenario_closing' => "Your competitor answered. You didn't know it happened.",
        'stats'            => [
            [ 'value' => '1 to 1',    'label' => 'Every inquiry volume increase requires a headcount increase today' ],
            [ 'value' => 'Months',    'label' => 'To hire, onboard, and ramp a new inside sales rep' ],
            [ 'value' => 'Same Cost', 'label' => 'ChatSKU handles 10 or 10,000 simultaneous conversations' ],
        ],
        'solve_copy'       => "ChatSKU breaks the link between inquiry volume and headcount. The AI handles unlimited simultaneous conversations at a fixed cost. As your business grows, your responsiveness scales automatically without adding staff. Your team focuses on closing, not answering. Growth becomes a revenue event, not a hiring event.",
        'sample_user'      => "Can you handle bulk inquiries during trade show season?",
        'sample_bot'       => "Absolutely. I handle unlimited simultaneous conversations. Your team focuses on closing while I handle the intake.",
        'short_name'       => 'growth capped by headcount',
    ],
];

/* ── Determine which problem to show ───────────────────────────── */
$queried = get_queried_object();
$slug    = isset( $queried->post_name ) ? $queried->post_name : '';

if ( ! isset( $problems[ $slug ] ) ) {
    wp_redirect( home_url( '/problems/' ) );
    exit;
}

$p = $problems[ $slug ];

get_header();
?>

<main id="main" class="chatsku-main problem-detail-main">

    <!-- ── 1. HERO ───────────────────────────────────────────────── -->
    <section class="pd-hero" aria-labelledby="pd-title">
        <div class="container pd-hero__inner">

            <!-- Breadcrumb -->
            <nav class="pd-breadcrumb reveal" aria-label="Breadcrumb">
                <a href="/problems/" class="pd-breadcrumb__link">Problems</a>
                <span class="pd-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
                <span class="pd-breadcrumb__current"><?php echo esc_html( $p['name'] ); ?></span>
            </nav>

            <!-- Severity badge -->
            <div class="pd-severity reveal reveal-delay-1">
                <span
                    class="pd-severity__dot"
                    style="background: <?php echo esc_attr( $p['severity_color'] ); ?>;"
                    aria-hidden="true"
                ></span>
                <span
                    class="pd-severity__label"
                    style="color: <?php echo esc_attr( $p['severity_color'] ); ?>;"
                >
                    <?php echo esc_html( $p['severity'] ); ?>
                </span>
            </div>

            <!-- H1 -->
            <h1 id="pd-title" class="pd-hero__title reveal reveal-delay-2">
                <?php echo esc_html( $p['name'] ); ?>
            </h1>

            <!-- Financial hook -->
            <p class="pd-hero__hook reveal reveal-delay-3">
                <?php echo esc_html( $p['financial_hook'] ); ?>
            </p>

        </div>
    </section>

    <!-- ── 2. WHAT'S ACTUALLY HAPPENING ─────────────────────────── -->
    <section class="pd-section pd-section--secondary" aria-labelledby="pd-whats-happening">
        <div class="container pd-section__inner">
            <h2 id="pd-whats-happening" class="pd-section__headline reveal">
                <?php echo esc_html( $p['section2_headline'] ); ?>
            </h2>
            <?php foreach ( $p['section2_body'] as $para ) : ?>
                <p class="pd-section__body reveal reveal-delay-1">
                    <?php echo esc_html( $para ); ?>
                </p>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ── 3. A REAL BUYER. A REAL MOMENT ───────────────────────── -->
    <section class="pd-section pd-section--scenario" aria-labelledby="pd-scenario-label">
        <div class="container pd-section__inner">
            <p id="pd-scenario-label" class="pd-section__eyebrow reveal">THE PROBLEM</p>
            <blockquote class="pd-blockquote reveal reveal-delay-1">
                <?php echo esc_html( $p['scenario'] ); ?>
            </blockquote>
            <p class="pd-scenario__closing reveal reveal-delay-2">
                <?php echo esc_html( $p['scenario_closing'] ); ?>
            </p>
        </div>
    </section>

    <!-- ── 4. WHAT THIS COSTS ────────────────────────────────────── -->
    <section class="pd-section pd-section--secondary pd-section--cost" aria-labelledby="pd-cost-label">
        <div class="container pd-section__inner">
            <p id="pd-cost-label" class="pd-section__eyebrow reveal">THE COST</p>
            <div class="pd-stats-row">
                <?php foreach ( $p['stats'] as $stat ) : ?>
                    <div class="pd-stat reveal reveal-delay-1">
                        <span class="pd-stat__value"><?php echo esc_html( $stat['value'] ); ?></span>
                        <span class="pd-stat__label"><?php echo esc_html( $stat['label'] ); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── 5. THE FIX ────────────────────────────────────────────── -->
    <section class="pd-section pd-section--fix" aria-labelledby="pd-fix-title">
        <div class="container pd-section__inner">
            <p class="pd-section__eyebrow reveal">THE FIX</p>
            <h2 id="pd-fix-title" class="pd-fix__title reveal reveal-delay-1">
                One deployment. Problem closed.
            </h2>
            <p class="pd-fix__body reveal reveal-delay-2">
                <?php echo esc_html( $p['solve_copy'] ); ?>
            </p>

            <!-- Mock chat widget -->
            <div class="pd-chat reveal reveal-delay-3" role="presentation" aria-label="Sample conversation">
                <div class="pd-chat__header" aria-hidden="true">
                    <span class="pd-chat__dot"></span>
                    <span class="pd-chat__dot"></span>
                    <span class="pd-chat__dot"></span>
                    <span class="pd-chat__brand">ChatSKU</span>
                </div>
                <div class="pd-chat__messages">
                    <!-- User bubble (right-aligned) -->
                    <div class="pd-chat__row pd-chat__row--user">
                        <div class="pd-chat__bubble pd-chat__bubble--user">
                            <?php echo esc_html( $p['sample_user'] ); ?>
                        </div>
                    </div>
                    <!-- Bot bubble (left-aligned) -->
                    <div class="pd-chat__row pd-chat__row--bot">
                        <div class="pd-chat__bubble pd-chat__bubble--bot">
                            <?php echo esc_html( $p['sample_bot'] ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 6. BOTTOM CTA ─────────────────────────────────────────── -->
    <section class="pd-cta" aria-labelledby="pd-cta-title">
        <div class="container pd-cta__inner text-center">
            <h2 id="pd-cta-title" class="pd-cta__title reveal">
                Stop losing revenue to <?php echo esc_html( $p['short_name'] ); ?>.
            </h2>
            <p class="pd-cta__subtitle reveal reveal-delay-1">
                See ChatSKU close this gap live, on a real catalog.
            </p>
            <div class="pd-cta__actions reveal reveal-delay-2">
                <a href="/demo/" class="chatsku-btn chatsku-btn--primary chatsku-btn--lg">
                    See ChatSKU Live &rarr;
                </a>
                <a href="/signup/" class="chatsku-btn chatsku-btn--outline chatsku-btn--lg">
                    Start Free &rarr;
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* ── Hero ───────────────────────────────────────────────────────── */
.pd-hero {
    padding-top: 7rem;    /* pt-28 */
    padding-bottom: 3rem; /* pb-12 */
}

.pd-hero__inner {
    max-width: 56rem;
    margin-left: auto;
    margin-right: auto;
}

.pd-breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    font-size: 0.875rem;
}

.pd-breadcrumb__link {
    color: var(--color-text-muted);
    text-decoration: none;
    transition: color 0.15s;
}

.pd-breadcrumb__link:hover {
    color: var(--color-accent);
}

.pd-breadcrumb__sep {
    color: var(--color-text-muted);
    opacity: 0.5;
}

.pd-breadcrumb__current {
    color: var(--color-text-muted);
}

.pd-severity {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.pd-severity__dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.pd-severity__label {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.pd-hero__title {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 5vw, 3.25rem);
    font-weight: 800;
    color: var(--color-text-primary);
    letter-spacing: -0.03em;
    line-height: 1.15;
    margin: 0 0 1.25rem;
}

.pd-hero__hook {
    font-size: 1.3rem;
    color: var(--color-text-muted);
    line-height: 1.6;
    margin: 0;
    font-weight: 400;
}

/* ── Shared Section Shell ───────────────────────────────────────── */
.pd-section {
    padding-top: 4rem;
    padding-bottom: 4rem;
}

.pd-section--secondary {
    background: var(--color-bg-secondary);
}

.pd-section__inner {
    max-width: 56rem;
    margin-left: auto;
    margin-right: auto;
}

.pd-section__eyebrow {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--color-accent);
    margin: 0 0 1.25rem;
}

.pd-section__headline {
    font-family: var(--font-heading);
    font-size: clamp(1.5rem, 3vw, 2.125rem);
    font-weight: 800;
    color: var(--color-text-primary);
    letter-spacing: -0.025em;
    line-height: 1.25;
    margin: 0 0 1.5rem;
}

.pd-section__body {
    font-size: 1.0625rem;
    color: var(--color-text-muted);
    line-height: 1.75;
    margin: 0 0 1.25rem;
}

.pd-section__body:last-child {
    margin-bottom: 0;
}

/* ── Scenario / Blockquote ──────────────────────────────────────── */
.pd-blockquote {
    font-size: 1.125rem;
    color: var(--color-text-muted);
    line-height: 1.75;
    border-left: 3px solid var(--color-accent);
    padding-left: 1.5rem;
    margin: 0 0 1.5rem;
    font-style: normal;
}

.pd-scenario__closing {
    font-size: 1rem;
    font-weight: 700;
    font-style: italic;
    color: var(--color-text-primary);
    margin: 0;
}

/* ── Stats ──────────────────────────────────────────────────────── */
.pd-stats-row {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1.5rem;
    margin-top: 1.25rem;
}

@media (min-width: 640px) {
    .pd-stats-row {
        grid-template-columns: repeat(3, 1fr);
    }
}

.pd-stat {
    background: var(--color-bg-primary);
    border: 1px solid var(--color-border);
    border-radius: 0.75rem;
    padding: 1.5rem 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    text-align: center;
}

.pd-stat__value {
    font-family: var(--font-heading);
    font-size: clamp(1.375rem, 3vw, 1.875rem);
    font-weight: 800;
    color: var(--color-accent);
    line-height: 1.1;
}

.pd-stat__label {
    font-size: 0.8125rem;
    color: var(--color-text-muted);
    line-height: 1.5;
}

/* ── Fix Section ────────────────────────────────────────────────── */
.pd-fix__title {
    font-family: var(--font-heading);
    font-size: clamp(1.5rem, 3vw, 2.125rem);
    font-weight: 800;
    color: var(--color-text-primary);
    letter-spacing: -0.025em;
    line-height: 1.25;
    margin: 0 0 1.25rem;
}

.pd-fix__body {
    font-size: 1.0625rem;
    color: var(--color-text-muted);
    line-height: 1.75;
    margin: 0 0 2.5rem;
}

/* ── Mock Chat Widget ───────────────────────────────────────────── */
.pd-chat {
    background: var(--color-bg-secondary);
    border: 1px solid var(--color-border);
    border-radius: 1rem;
    overflow: hidden;
    max-width: 480px;
}

.pd-chat__header {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.875rem 1.25rem;
    background: rgba(255, 255, 255, 0.03);
    border-bottom: 1px solid var(--color-border);
}

.pd-chat__dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--color-border);
}

.pd-chat__dot:first-child  { background: #ff5f57; }
.pd-chat__dot:nth-child(2) { background: #febc2e; }
.pd-chat__dot:nth-child(3) { background: #28c840; }

.pd-chat__brand {
    margin-left: auto;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--color-text-muted);
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

.pd-chat__messages {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 0.875rem;
}

.pd-chat__row {
    display: flex;
}

.pd-chat__row--user {
    justify-content: flex-end;
}

.pd-chat__row--bot {
    justify-content: flex-start;
}

.pd-chat__bubble {
    max-width: 85%;
    padding: 0.75rem 1rem;
    border-radius: 1rem;
    font-size: 0.9375rem;
    line-height: 1.55;
}

.pd-chat__bubble--user {
    background: #1e293b;
    color: var(--color-text-primary);
    border-bottom-right-radius: 0.25rem;
}

.pd-chat__bubble--bot {
    background: rgba(0, 201, 177, 0.06);
    border: 1px solid rgba(0, 201, 177, 0.25);
    color: var(--color-text-primary);
    border-bottom-left-radius: 0.25rem;
}

/* ── Bottom CTA ─────────────────────────────────────────────────── */
.pd-cta {
    padding-top: 5rem;
    padding-bottom: 5rem;
    border-top: 1px solid var(--color-border);
    background: rgba(0, 201, 177, 0.04);
}

.pd-cta__inner {
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
}

.pd-cta__title {
    font-family: var(--font-heading);
    font-size: clamp(1.625rem, 3.5vw, 2.25rem);
    font-weight: 800;
    color: var(--color-text-primary);
    letter-spacing: -0.025em;
    line-height: 1.2;
    margin: 0 0 1rem;
}

.pd-cta__subtitle {
    font-size: 1.0625rem;
    color: var(--color-text-muted);
    line-height: 1.65;
    margin: 0 0 2.5rem;
}

.pd-cta__actions {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
}

/* Outline button variant (if not defined globally) */
.chatsku-btn--outline {
    background: transparent;
    border: 1.5px solid var(--color-accent);
    color: var(--color-accent);
}

.chatsku-btn--outline:hover {
    background: rgba(0, 201, 177, 0.08);
}
</style>
