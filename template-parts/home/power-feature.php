<?php
/**
 * Power Feature Section — Customer Groups / Pricing
 * Matches chatsku.com "Your customers. Your pricing. Your rules."
 *
 * @package ChatSKU
 */

$data    = get_query_var( 'chatsku_power', [] );
$heading = $data['heading']    ?? 'Your customers. Your pricing. <em>Your rules.</em>';
$sub     = $data['subheading'] ?? 'Import your existing customer list, organize them into groups, and set custom pricing — all from your dashboard.';
?>
<section class="power-section section-padding bg-secondary" aria-labelledby="power-heading">
    <div class="container">
        <div class="power-inner">

            <!-- Left: text + check items -->
            <div class="power-content reveal">
                <div class="power-eyebrow">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    Power Feature
                </div>
                <h2 id="power-heading" class="power-heading">
                    <?php echo wp_kses( $heading, [ 'em' => [], 'strong' => [] ] ); ?>
                </h2>
                <p class="power-subtitle"><?php echo esc_html( $sub ); ?></p>

                <div class="power-checks">
                    <?php
                    $checks = [
                        'Import your customer list via CSV — name, email, phone',
                        'Organize buyers into custom groups',
                        'Set group-specific pricing and discounts per product',
                    ];
                    foreach ( $checks as $check ) : ?>
                        <div class="power-check">
                            <svg class="power-check__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                            <span><?php echo esc_html( $check ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Right: Customer Groups UI mockup -->
            <div class="power-visual reveal reveal-delay-2">
                <div class="cg-mockup">
                    <div class="cg-mockup__header">Customer Groups</div>
                    <div class="cg-mockup__body">
                        <?php
                        $groups = [
                            [ 'name' => 'Gold Tier',    'members' => '42 customers',  'discount' => '15% off' ],
                            [ 'name' => 'Wholesale',    'members' => '128 customers', 'discount' => '25% off' ],
                            [ 'name' => 'VIP Partners', 'members' => '7 customers',   'discount' => '30% off' ],
                        ];
                        foreach ( $groups as $group ) : ?>
                            <div class="cg-mockup__row">
                                <div>
                                    <p class="cg-mockup__name"><?php echo esc_html( $group['name'] ); ?></p>
                                    <p class="cg-mockup__meta"><?php echo esc_html( $group['members'] ); ?></p>
                                </div>
                                <span class="cg-badge"><?php echo esc_html( $group['discount'] ); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="cg-mockup__footer">+ Import Customers via CSV</div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.power-section { background: var(--color-bg-secondary); }
.power-inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: clamp(40px, 6vw, 80px);
    align-items: center;
}
.power-eyebrow {
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
.power-heading {
    font-family: var(--font-heading);
    font-size: clamp(var(--font-size-3xl), 4vw, var(--font-size-5xl));
    font-weight: 700;
    color: var(--color-text-primary);
    line-height: var(--line-height-tight);
    margin: 0 0 var(--space-5) 0;
}
.power-heading em {
    font-style: normal;
    background: linear-gradient(135deg, var(--color-accent) 0%, #4eddcc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.power-subtitle {
    font-size: var(--font-size-lg);
    color: var(--color-text-muted);
    margin: 0 0 var(--space-8) 0;
    line-height: var(--line-height-base);
}
.power-checks { display: flex; flex-direction: column; gap: var(--space-4); }
.power-check { display: flex; align-items: flex-start; gap: 12px; color: var(--color-text-primary); font-size: var(--font-size-sm); }
.power-check__icon { color: var(--color-accent); flex-shrink: 0; margin-top: 1px; }
/* Customer Groups Mockup */
.cg-mockup {
    background: #1a2538;
    border: 1px solid var(--color-border);
    border-radius: 16px;
    overflow: hidden;
    max-width: 420px;
    margin-left: auto;
    box-shadow: var(--shadow-xl);
}
.cg-mockup__header {
    padding: 14px 20px;
    background: #131e30;
    border-bottom: 1px solid var(--color-border);
    font-size: 13px;
    font-weight: 700;
    color: var(--color-text-primary);
}
.cg-mockup__body {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.cg-mockup__row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--color-border);
    border-radius: 10px;
}
.cg-mockup__name { font-size: 13px; font-weight: 600; color: var(--color-text-primary); margin: 0; }
.cg-mockup__meta { font-size: 11px; color: var(--color-text-muted); margin: 0; }
.cg-badge {
    padding: 4px 10px;
    background: var(--color-accent-glow);
    border: 1px solid var(--color-border-accent);
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    color: var(--color-accent);
}
.cg-mockup__footer {
    padding: 12px 20px;
    border-top: 1px solid var(--color-border);
    font-size: 12px;
    color: var(--color-accent);
    text-align: center;
    cursor: pointer;
}
@media (max-width: 900px) {
    .power-inner { grid-template-columns: 1fr; }
    .cg-mockup { max-width: 100%; margin: 0 auto; }
}
</style>
