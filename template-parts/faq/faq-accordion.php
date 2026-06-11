<?php
/**
 * FAQ Accordion Output
 *
 * @package ChatSKU
 */

$categories = get_query_var( 'chatsku_faq_categories', [] );
if ( empty( $categories ) ) return;

$has_multiple = count( $categories ) > 1;
?>

<?php if ( $has_multiple ) : ?>
    <!-- Category tab filters -->
    <div class="faq-categories__tabs" role="tablist" aria-label="FAQ Categories">
        <?php foreach ( $categories as $i => $cat ) :
            $cat_name = $cat['category_name'] ?? 'Category ' . ( $i + 1 );
            $slug     = sanitize_title( $cat_name );
        ?>
            <button
                class="faq-category-tab<?php echo $i === 0 ? ' is-active' : ''; ?>"
                data-category="<?php echo esc_attr( $slug ); ?>"
                role="tab"
                aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
            >
                <?php echo esc_html( $cat_name ); ?>
            </button>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php foreach ( $categories as $i => $cat ) :
    $cat_name = $cat['category_name'] ?? '';
    $items    = $cat['category_items'] ?? [];
    $slug     = sanitize_title( $cat_name );
    $visible  = $i === 0 || ! $has_multiple;
?>
    <div
        class="faq-category<?php echo $visible ? ' is-visible' : ''; ?>"
        data-category="<?php echo esc_attr( $slug ); ?>"
        role="tabpanel"
    >
        <?php if ( $has_multiple && $cat_name ) : ?>
            <h2 class="faq-category__heading"><?php echo esc_html( $cat_name ); ?></h2>
        <?php endif; ?>

        <?php if ( ! empty( $items ) ) : ?>
            <div class="faq-accordion" aria-label="<?php echo esc_attr( $cat_name ); ?> FAQ">
                <?php foreach ( $items as $j => $item ) :
                    $question = $item['question'] ?? '';
                    $answer   = $item['answer']   ?? '';
                    $item_id  = 'faq-' . $i . '-' . $j;
                    $is_first = $i === 0 && $j === 0;
                ?>
                    <div class="faq-item<?php echo $is_first ? ' is-open' : ''; ?>" id="<?php echo esc_attr( $item_id ); ?>">
                        <button
                            class="faq-item__trigger"
                            aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                            aria-controls="<?php echo esc_attr( $item_id . '-body' ); ?>"
                        >
                            <span class="faq-item__question"><?php echo esc_html( $question ); ?></span>
                            <span class="faq-item__icon" aria-hidden="true">
                                <!-- Plus icon — rotates to X when open -->
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                    <line x1="12" y1="5" x2="12" y2="19"/>
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                </svg>
                            </span>
                        </button>
                        <div class="faq-item__body" id="<?php echo esc_attr( $item_id . '-body' ); ?>" role="region">
                            <div class="faq-item__body-inner">
                                <div class="faq-item__answer entry-content">
                                    <?php echo wp_kses_post( $answer ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
