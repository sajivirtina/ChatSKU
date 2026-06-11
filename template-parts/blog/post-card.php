<?php
/**
 * Blog Post Card
 *
 * @package ChatSKU
 */

$categories    = get_the_category();
$first_cat     = ! empty( $categories ) ? $categories[0] : null;
$reading_time  = chatsku_reading_time( get_the_ID() );
$hero_image    = chatsku_field( 'post_hero_image' );
$has_thumbnail = has_post_thumbnail();
?>
<article class="post-card reveal" <?php post_class(); ?>>

    <!-- Thumbnail -->
    <a href="<?php the_permalink(); ?>" class="post-card__thumbnail-link" tabindex="-1" aria-hidden="true">
        <?php if ( $hero_image && is_array( $hero_image ) ) : ?>
            <img src="<?php echo esc_url( $hero_image['url'] ); ?>" alt="<?php echo esc_attr( $hero_image['alt'] ?: get_the_title() ); ?>" class="post-card__thumbnail" loading="lazy">
        <?php elseif ( $has_thumbnail ) : ?>
            <?php the_post_thumbnail( 'chatsku-card', [ 'class' => 'post-card__thumbnail' ] ); ?>
        <?php else : ?>
            <div class="post-card__thumbnail--placeholder" aria-hidden="true">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
        <?php endif; ?>
    </a>

    <div class="post-card__body">
        <!-- Meta -->
        <div class="post-card__meta">
            <?php if ( $first_cat ) : ?>
                <a class="post-card__category" href="<?php echo esc_url( get_category_link( $first_cat->term_id ) ); ?>">
                    <?php echo esc_html( $first_cat->name ); ?>
                </a>
                <span>·</span>
            <?php endif; ?>
            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                <?php echo esc_html( get_the_date() ); ?>
            </time>
            <span>·</span>
            <span><?php echo esc_html( $reading_time ); ?> min read</span>
        </div>

        <!-- Title -->
        <h2 class="post-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <!-- Excerpt -->
        <p class="post-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>

        <!-- Read more -->
        <a href="<?php the_permalink(); ?>" class="post-card__read-more">
            Read more →
        </a>
    </div>

</article>
