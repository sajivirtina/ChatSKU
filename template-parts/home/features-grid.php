<?php
/**
 * The Problem Section
 * 3-column grid of problem cards matching chatsku.com
 *
 * @package ChatSKU
 */

$data    = get_query_var( 'chatsku_features', [] );
$heading = $data['heading'] ?? "Your catalog shouldn't be a dead end.";
$subtitle = $data['subheading'] ?? "B2B buying is broken. Here's what your customers are dealing with right now.";

$problems = [
    [
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>',
        'text' => 'PDF catalogs get downloaded and forgotten. No engagement, no data, no conversions.',
    ],
    [
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
        'text' => 'Product pages with no cart, no chat, no way to buy. Just a phone number and a prayer.',
    ],
    [
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
        'text' => 'Every quote starts with an email chain, a spreadsheet, and a 48-hour wait.',
    ],
];
?>
<section class="problem-section section-padding" aria-labelledby="problem-heading">
    <div class="container">

        <div class="problem-head reveal">
            <div class="problem-eyebrow">The Problem</div>
            <h2 id="problem-heading" class="section-head__title text-balance">
                <?php echo wp_kses( $heading, [ 'em' => [], 'strong' => [] ] ); ?>
            </h2>
            <p class="section-head__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        </div>

        <div class="problem-grid">
            <?php foreach ( $problems as $i => $p ) : ?>
                <div class="problem-card reveal reveal-delay-<?php echo $i + 1; ?>">
                    <div class="problem-card__icon" aria-hidden="true">
                        <?php echo $p['icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                    </div>
                    <p class="problem-card__text"><?php echo esc_html( $p['text'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<style>
.problem-section { background: var(--color-bg-primary); }
.problem-head { max-width: 640px; margin-bottom: clamp(40px, 6vw, 56px); }
.problem-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 999px;
    border: 1px solid rgba(239,68,68,0.3);
    background: rgba(239,68,68,0.06);
    font-size: 12px;
    font-weight: 600;
    color: #ef4444;
    margin-bottom: 16px;
}
.problem-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}
.problem-card {
    display: flex;
    gap: 16px;
    align-items: flex-start;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid var(--color-border);
    background: var(--color-bg-card);
    transition: border-color var(--transition-base);
}
.problem-card:hover { border-color: rgba(0,201,177,0.3); }
.problem-card__icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(239,68,68,0.1);
    border-radius: 10px;
    color: #ef4444;
    padding: 8px;
}
.problem-card__icon svg { width: 100%; height: 100%; }
.problem-card__text { font-size: var(--font-size-sm); color: var(--color-text-muted); line-height: var(--line-height-base); margin: 0; }
@media (max-width: 768px) {
    .problem-grid { grid-template-columns: 1fr; }
}
@media (min-width: 600px) and (max-width: 768px) {
    .problem-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>
