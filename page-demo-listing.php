<?php
/**
 * Template Name: Demo Listing — Internal
 *
 * Internal/unlisted listing of every Demo. Each card links to the demo's landing
 * page (if set) or the demo page itself, and shows the raw demo URL for copying.
 * Keep this page unlisted (not in any menu). Marked noindex.
 *
 * @package ChatSKU
 */

add_filter( 'wp_robots', function ( $robots ) {
	$robots['noindex']  = true;
	$robots['nofollow'] = true;
	return $robots;
} );

get_header();

$demos = new WP_Query( [
	'post_type'      => 'demo',
	'posts_per_page' => -1,
	'orderby'        => 'title',
	'order'          => 'ASC',
	'no_found_rows'  => true,
] );
?>

<main id="main" class="chatsku-main demo-listing section-padding" role="main">
	<div class="container">

		<header class="demo-listing__head">
			<h1 class="demo-listing__title"><?php the_title(); ?></h1>
			<p class="demo-listing__sub">Internal list of all client demos. <?php echo (int) $demos->post_count; ?> total.</p>
		</header>

		<?php if ( $demos->have_posts() ) : ?>
		<div class="demo-listing__grid">
			<?php
			while ( $demos->have_posts() ) :
				$demos->the_post();
				$landing  = function_exists( 'get_field' ) ? get_field( 'landing_page_url' ) : '';
				$summary  = function_exists( 'get_field' ) ? get_field( 'demo_summary' ) : '';
				$demo_url = get_permalink();
				$cta_url  = $landing ?: $demo_url;
				$cta_txt  = $landing ? 'View landing page' : 'Open demo';
			?>
			<article class="demo-card">
				<a href="<?php echo esc_url( $cta_url ); ?>" class="demo-card__thumb" target="_blank" rel="noopener">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'chatsku-card', [ 'class' => 'demo-card__img' ] ); ?>
					<?php else : ?>
						<span class="demo-card__placeholder"><?php echo esc_html( get_the_title() ); ?></span>
					<?php endif; ?>
				</a>
				<div class="demo-card__body">
					<h2 class="demo-card__title"><?php the_title(); ?></h2>
					<?php if ( $summary ) : ?><p class="demo-card__summary"><?php echo esc_html( $summary ); ?></p><?php endif; ?>

					<a href="<?php echo esc_url( $cta_url ); ?>" class="demo-card__cta" target="_blank" rel="noopener">
						<?php echo esc_html( $cta_txt ); ?> &rarr;
					</a>

					<div class="demo-card__url" title="Demo page URL">
						<input type="text" readonly value="<?php echo esc_url( $demo_url ); ?>" onclick="this.select()" aria-label="Demo URL">
					</div>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
		<?php else : ?>
			<p class="demo-listing__empty">No demos yet. Create one under <strong>Demos &rarr; Add New</strong>.</p>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

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
.demo-card__cta { margin-top: auto; align-self: flex-start; color: var(--color-accent, #00C9B1); font-size: 0.85rem; font-weight: 700; text-decoration: none; }
.demo-card__cta:hover { text-decoration: underline; }
.demo-card__url input { width: 100%; background: var(--color-bg-tertiary, #0f172a); border: 1px solid var(--color-border, rgba(255,255,255,0.08)); border-radius: 6px; padding: 6px 8px; font-size: 11px; color: var(--color-text-muted, #94a3b8); font-family: var(--font-mono, monospace); }
.demo-listing__empty { text-align: center; color: var(--color-text-muted, #94a3b8); }
</style>

<?php get_footer(); ?>
