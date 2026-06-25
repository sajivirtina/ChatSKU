<?php
/**
 * Archive: Demos — public listing at /demos/.
 *
 * Shows an industry card for each published Industry post. Each card has:
 *  - Featured image (set on the Industry post)
 *  - Title (post title)
 *  - Description (ACF: industry_description)
 *  - One or more CTA links (ACF repeater: industry_cta_links)
 *
 * Individual demo pages (/demos/{slug}/) are still served by single-demo.php
 * and are unaffected by this template.
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

get_header();

$industries = new WP_Query( [
	'post_type'      => 'industry',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'no_found_rows'  => true,
] );
?>

<main id="main" class="chatsku-main demo-listing section-padding" role="main">
	<div class="container">

		<header class="demo-listing__head">
			<h1 class="demo-listing__title">Demos by Industry</h1>
			<p class="demo-listing__sub">Choose your industry to explore a live ChatSKU demo built for your catalog.</p>
		</header>

		<?php if ( $industries->have_posts() ) : ?>
		<div class="demo-listing__grid">
			<?php
			while ( $industries->have_posts() ) :
				$industries->the_post();
				$description = function_exists( 'get_field' ) ? get_field( 'industry_description' ) : '';
				$cta_links   = function_exists( 'get_field' ) ? get_field( 'industry_cta_links' )   : [];
			?>
			<article class="demo-card">
				<div class="demo-card__thumb" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'large', [ 'class' => 'demo-card__img' ] ); ?>
					<?php else : ?>
						<span class="demo-card__placeholder"><?php echo esc_html( get_the_title() ); ?></span>
					<?php endif; ?>
				</div>
				<div class="demo-card__body">
					<h2 class="demo-card__title"><?php the_title(); ?></h2>
					<?php if ( $description ) : ?>
						<p class="demo-card__summary"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $cta_links ) ) : ?>
						<div class="demo-card__ctas">
							<?php foreach ( $cta_links as $link ) :
								$label = $link['cta_label'] ?? '';
								$url   = $link['cta_url']   ?? '';
								if ( ! $label || ! $url ) continue;
							?>
								<a href="<?php echo esc_url( $url ); ?>" class="demo-card__cta"><?php echo esc_html( $label ); ?> &rarr;</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php else : ?>
			<p class="demo-listing__empty">No industries published yet.</p>
		<?php endif; ?>

	</div>
</main>

<style>
.demo-listing__head { text-align: center; margin-bottom: var(--space-10, 2.5rem); }
.demo-listing__title { font-size: clamp(1.75rem, 4vw, 2.5rem); font-weight: 800; color: var(--color-text-primary, #f8fafc); margin: 0 0 8px; }
.demo-listing__sub { color: var(--color-text-muted, #94a3b8); margin: 0; }
.demo-listing__grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 22px; }
.demo-card { background: var(--color-bg-secondary, #1e293b); border: 1px solid var(--color-border, rgba(255,255,255,0.08)); border-radius: 14px; overflow: hidden; display: flex; flex-direction: column; transition: border-color .15s, transform .12s; }
.demo-card:hover { border-color: var(--color-accent, #00C9B1); transform: translateY(-2px); }
.demo-card__thumb { display: block; aspect-ratio: 16 / 10; background: var(--color-bg-tertiary, #0f172a); overflow: hidden; }
.demo-card__img { width: 100%; height: 100%; object-fit: cover; display: block; }
.demo-card__placeholder { display: flex; align-items: center; justify-content: center; height: 100%; padding: 16px; text-align: center; font-weight: 700; color: var(--color-text-muted, #94a3b8); }
.demo-card__body { padding: 18px 20px; display: flex; flex-direction: column; gap: 8px; flex: 1; }
.demo-card__title { font-size: 1.05rem; font-weight: 700; color: var(--color-text-primary, #f8fafc); margin: 0; }
.demo-card__summary { font-size: 0.85rem; color: var(--color-text-muted, #94a3b8); margin: 0; line-height: 1.55; }
.demo-card__ctas { margin-top: auto; display: flex; flex-direction: column; gap: 6px; }
.demo-card__cta { align-self: flex-start; color: var(--color-accent, #00C9B1); font-size: 0.9rem; font-weight: 700; text-decoration: none; }
.demo-card__cta:hover { text-decoration: underline; }
.demo-listing__empty { text-align: center; color: var(--color-text-muted, #94a3b8); }
</style>

<?php get_footer(); ?>
