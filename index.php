<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
            <?php endif; ?>

            <div>
                <?php the_excerpt(); ?>
            </div>
        </article>
    <?php endwhile; ?>

    <?php the_posts_pagination(); ?>

<?php else : ?>
    <p>No posts found.</p>
<?php endif; ?>

<?php get_footer(); ?>