<?php get_header(); ?>

<main id="main-content" class="pt-24 pb-16 px-5 sm:px-8 max-w-7xl mx-auto">
    <?php if (have_posts()) : ?>
        <div class="space-y-12">
            <?php while (have_posts()) : the_post(); ?>
                <article class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">
                        <a href="<?php the_permalink(); ?>" class="hover:text-red-500 transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="text-slate-600 text-sm mb-4">
                        <?php echo esc_html(get_the_date()); ?> &middot; <?php the_category(', '); ?>
                    </div>
                    <div class="text-slate-700 leading-relaxed">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="inline-block mt-4 text-red-500 font-semibold text-sm hover:text-red-600 transition-colors">
                        Read More →
                    </a>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="mt-12 text-center">
            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
            ));
            ?>
        </div>
    <?php else : ?>
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold text-slate-800 mb-4">No Posts Found</h2>
            <p class="text-slate-600">It looks like there's no content yet. Check back soon!</p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>