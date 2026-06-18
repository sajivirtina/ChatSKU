<?php
/**
 * Home — Trust / Credibility Section
 * "Backed by 14 years of B2B commerce experience" + stats strip + 3 cards.
 *
 * Data via get_query_var( 'chatsku_trust' ); falls back to mockup copy.
 *
 * @package ChatSKU
 */

$data    = get_query_var( 'chatsku_trust', [] );
$eyebrow = $data['eyebrow'] ?? 'Why suppliers trust ChatSKU';
$heading = $data['heading'] ?? 'Backed by 14 years of B2B commerce experience';
$intro   = $data['intro']   ?? "ChatSKU isn't a generic chatbot. It comes from Virtina — the team that has built and run commerce for thousands of manufacturers, distributors, and wholesalers.";

$stats = $data['stats'] ?? [];
if ( empty( $stats ) ) {
    $stats = [
        [ 'stat_value' => '2,000+',  'stat_label' => 'B2B & B2C businesses served by the Virtina team' ],
        [ 'stat_value' => '14 yrs',  'stat_label' => 'Building eCommerce for manufacturers & distributors' ],
        [ 'stat_value' => '24/7',    'stat_label' => 'Buyer coverage, every minute of every day' ],
        [ 'stat_value' => '< 1 Day', 'stat_label' => 'Average time to go live' ],
    ];
}

$cards = $data['cards'] ?? [];
if ( empty( $cards ) ) {
    $cards = [
        [
            'card_title' => 'A proven commerce team — not a side project',
            'card_body'  => 'ChatSKU is built by Virtina, the agency that has run B2B and B2C commerce for over 2,000 businesses across 14 years. The same team that knows your catalog quirks builds your assistant.',
        ],
        [
            'card_title' => 'Built for how distributors actually sell',
            'card_body'  => 'Tiered pricing, customer groups, RFQs, bulk quotes, and spec-heavy products are first-class — not afterthoughts. The assistant speaks the language your buyers already use.',
        ],
        [
            'card_title' => 'Live in days, with us doing the heavy lifting',
            'card_body'  => 'We ingest your existing PDF, Excel, or store catalog and configure the assistant for you. You review, approve, and drop in one line of code. No migration, no rebuild.',
        ],
    ];
}
?>
<section class="home-trust section-padding" aria-labelledby="home-trust-heading">
    <div class="container">

        <div class="section-head reveal">
            <?php if ( $eyebrow ) : ?>
                <span class="home-trust__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>
            <h2 id="home-trust-heading" class="section-head__title">
                <?php echo wp_kses( $heading, [ 'em' => [], 'strong' => [] ] ); ?>
            </h2>
            <?php if ( $intro ) : ?>
                <p class="section-head__subtitle home-trust__intro"><?php echo esc_html( $intro ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( ! empty( $stats ) ) : ?>
            <div class="home-trust__stats reveal">
                <?php foreach ( $stats as $stat ) : ?>
                    <div class="ht-stat">
                        <div class="ht-stat__value"><?php echo esc_html( $stat['stat_value'] ?? '' ); ?></div>
                        <div class="ht-stat__label"><?php echo esc_html( $stat['stat_label'] ?? '' ); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $cards ) ) : ?>
            <div class="home-trust__cards">
                <?php foreach ( $cards as $i => $card ) :
                    $delay = 'reveal-delay-' . min( $i + 1, 4 );
                ?>
                    <div class="ht-card reveal <?php echo esc_attr( $delay ); ?>">
                        <h3 class="ht-card__title"><?php echo esc_html( $card['card_title'] ?? '' ); ?></h3>
                        <p class="ht-card__body"><?php echo esc_html( $card['card_body'] ?? '' ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<style>
.home-trust { background: var(--color-bg-primary); }
.home-trust__eyebrow {
    display: inline-block;
    font-size: var(--font-size-sm);
    font-weight: 600;
    color: var(--color-accent);
    background: var(--color-accent-glow);
    border: 1px solid var(--color-border-accent);
    border-radius: var(--radius-full);
    padding: 4px 14px;
    margin-bottom: var(--space-4);
}
.home-trust__intro { max-width: 720px; margin-left: auto; margin-right: auto; }
.home-trust__stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    margin-top: var(--space-12);
    background: var(--color-bg-card);
}
.ht-stat { padding: 26px 22px; border-left: 1px solid var(--color-border); }
.ht-stat:first-child { border-left: none; }
.ht-stat__value { font-size: 2rem; font-weight: 800; color: var(--color-accent); letter-spacing: -0.02em; line-height: 1; }
.ht-stat__label { font-size: 12.5px; color: var(--color-text-muted); margin-top: 8px; line-height: 1.5; }
.home-trust__cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 20px;
}
.ht-card { padding: 24px; border-radius: var(--radius-xl); border: 1px solid var(--color-border); background: var(--color-bg-card); }
.ht-card__title { font-size: var(--font-size-lg); font-weight: 700; color: var(--color-text-primary); margin: 0 0 10px; line-height: var(--line-height-tight); }
.ht-card__body { font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 0; line-height: var(--line-height-base); }
@media (max-width: 860px) {
    .home-trust__stats { grid-template-columns: repeat(2, 1fr); }
    .ht-stat:nth-child(3) { border-left: none; }
    .ht-stat { border-top: 1px solid var(--color-border); }
    .ht-stat:nth-child(1), .ht-stat:nth-child(2) { border-top: none; }
    .home-trust__cards { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
    .home-trust__stats { grid-template-columns: 1fr; }
    .ht-stat { border-left: none; border-top: 1px solid var(--color-border); }
    .ht-stat:first-child { border-top: none; }
}
</style>
