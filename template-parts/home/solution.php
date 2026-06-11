<?php
/**
 * The Solution Section — Before / After comparison
 * Matches chatsku.com exactly
 *
 * @package ChatSKU
 */
?>
<section class="solution-section section-padding bg-secondary" aria-labelledby="solution-heading">
    <div class="container">

        <div class="solution-head reveal">
            <div class="solution-eyebrow">The Solution</div>
            <h2 id="solution-heading" class="section-head__title text-balance">
                What if your catalog could <em class="gradient-em">talk back?</em>
            </h2>
            <p class="section-head__subtitle">ChatSKU transforms your static catalog into a living, intelligent buying experience.</p>
        </div>

        <div class="solution-compare reveal">

            <!-- Before -->
            <div class="solution-col solution-col--before">
                <div class="solution-col__label solution-col__label--before">Before ChatSKU</div>
                <div class="solution-col__items">
                    <?php
                    $before = [
                        'Static PDF catalog, downloaded once',
                        'No product search or filtering',
                        'Quote requests via email, 2-day response',
                        'No visibility into buyer behavior',
                    ];
                    foreach ( $before as $item ) : ?>
                        <div class="solution-item solution-item--before">
                            <span class="solution-item__dot solution-item__dot--before"></span>
                            <span class="solution-item__text"><?php echo esc_html( $item ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- After -->
            <div class="solution-col solution-col--after">
                <div class="solution-col__label solution-col__label--after">After ChatSKU</div>
                <div class="solution-col__items">
                    <?php
                    $after = [
                        'AI chat knows every SKU, spec, and variant',
                        'Customers search and ask in natural language',
                        'Quotes built in conversation, ready instantly',
                        'Full analytics on buyer intent and behavior',
                    ];
                    foreach ( $after as $item ) : ?>
                        <div class="solution-item solution-item--after">
                            <span class="solution-item__dot solution-item__dot--after"></span>
                            <span class="solution-item__text"><?php echo esc_html( $item ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

    </div>
</section>

<style>
.solution-section { background: var(--color-bg-secondary); }
.solution-head { text-align: center; max-width: 720px; margin: 0 auto clamp(40px, 6vw, 64px); }
.solution-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 999px;
    border: 1px solid var(--color-border-accent);
    background: var(--color-accent-glow);
    font-size: 12px;
    font-weight: 600;
    color: var(--color-accent);
    margin-bottom: 16px;
}
.solution-head .gradient-em {
    font-style: normal;
    background: linear-gradient(135deg, var(--color-accent) 0%, #4eddcc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.solution-compare {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    max-width: 800px;
    margin: 0 auto;
    align-items: start;
}
.solution-col__label {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 16px;
}
.solution-col__label--before { color: #ef4444; }
.solution-col__label--after  { color: var(--color-accent); }
.solution-col__items { display: flex; flex-direction: column; gap: 10px; }
.solution-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid transparent;
}
.solution-item--before { background: rgba(239,68,68,0.05); border-color: rgba(239,68,68,0.1); }
.solution-item--after  { background: var(--color-accent-glow); border-color: var(--color-border-accent); }
.solution-item__dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    flex-shrink: 0;
}
.solution-item__dot--before { background: #ef4444; }
.solution-item__dot--after  { background: var(--color-accent); }
.solution-item__text { font-size: var(--font-size-sm); }
.solution-item--before .solution-item__text { color: var(--color-text-muted); }
.solution-item--after  .solution-item__text { color: var(--color-text-primary); }
@media (max-width: 640px) {
    .solution-compare { grid-template-columns: 1fr; gap: 32px; }
}
</style>
