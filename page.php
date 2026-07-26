<?php get_header(); ?>

<main id="main-content" class="pt-24 pb-16 px-5 sm:px-8 max-w-4xl mx-auto">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <header class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold text-slate-800 leading-tight">
                    <?php echo esc_html(get_the_title()); ?>
                </h1>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-8 rounded-2xl overflow-hidden border border-slate-200">
                    <?php the_post_thumbnail('large', array('class' => 'w-full h-auto', 'loading' => 'lazy')); ?>
                </div>
            <?php endif; ?>

            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed">
                <?php the_content(); ?>
            </div>
        </article>

        <?php if (comments_open() || get_comments_number()) : ?>
            <div class="mt-12">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
