<?php
/**
 * Pricing Plans Output
 *
 * @package ChatSKU
 */

$plans = get_query_var( 'chatsku_plans', [] );
if ( empty( $plans ) ) return;

foreach ( $plans as $i => $plan ) :
    $featured    = ! empty( $plan['plan_featured'] );
    $badge       = $plan['plan_badge']         ?? '';
    $name        = $plan['plan_name']           ?? 'Plan';
    $price_mo    = $plan['plan_price_monthly']  ?? 0;
    $price_an    = $plan['plan_price_annual']   ?? 0;
    $suffix      = $plan['plan_price_suffix']   ?? '/month';
    $desc        = $plan['plan_description']    ?? '';
    $cta_text    = $plan['plan_cta_text']       ?? 'Get Started';
    $cta_url     = $plan['plan_cta_url']        ?? '#';
    $features    = $plan['plan_features']       ?? [];
    $card_class  = 'pricing-card reveal' . ( $featured ? ' pricing-card--featured' : '' );
?>
    <div class="<?php echo esc_attr( $card_class ); ?>">

        <?php if ( $badge ) : ?>
            <span class="pricing-card__badge"><?php echo esc_html( $badge ); ?></span>
        <?php endif; ?>

        <p class="pricing-card__name"><?php echo esc_html( $name ); ?></p>

        <div class="pricing-card__price">
            <span
                class="pricing-card__amount"
                data-monthly="<?php echo esc_attr( $price_mo ); ?>"
                data-annual="<?php echo esc_attr( $price_an ); ?>"
            ><?php echo intval( $price_mo ) === 0 ? 'Free' : esc_html( $price_mo ); ?></span>
            <?php if ( intval( $price_mo ) > 0 ) : ?>
                <span class="pricing-card__suffix"><?php echo esc_html( $suffix ); ?></span>
            <?php endif; ?>
        </div>

        <?php if ( $desc ) : ?>
            <p class="pricing-card__description"><?php echo esc_html( $desc ); ?></p>
        <?php endif; ?>

        <?php if ( ! empty( $features ) ) : ?>
            <ul class="pricing-card__features">
                <?php foreach ( $features as $feature ) :
                    $available    = ! empty( $feature['feature_available'] );
                    $feature_class = 'pricing-card__feature' . ( ! $available ? ' pricing-card__feature--unavailable' : '' );
                ?>
                    <li class="<?php echo esc_attr( $feature_class ); ?>">
                        <?php if ( $available ) : ?>
                            <!-- Check icon -->
                            <svg class="pricing-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-label="Included">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        <?php else : ?>
                            <!-- X icon -->
                            <svg class="pricing-card__cross" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-label="Not included">
                                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        <?php endif; ?>
                        <?php echo esc_html( $feature['feature_text'] ?? '' ); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="pricing-card__cta">
            <a
                href="<?php echo esc_url( $cta_url ); ?>"
                class="chatsku-btn <?php echo $featured ? 'chatsku-btn--primary' : 'chatsku-btn--secondary'; ?> chatsku-btn--full"
            >
                <?php echo esc_html( $cta_text ); ?>
            </a>
        </div>

    </div><!-- .pricing-card -->
<?php endforeach; ?>
