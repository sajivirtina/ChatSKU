<?php
/**
 * Default Page Template
 *
 * @package ChatSKU
 */

get_header();
?>

<main id="main" class="chatsku-main default-page-main">

    <section class="page-hero section-padding" style="padding-bottom: var(--space-8);">
        <div class="container container--narrow">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h1 class="section-head__title" style="text-align: left;"><?php the_title(); ?></h1>
                <div class="entry-content page-content" style="margin-top: var(--space-8);">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
