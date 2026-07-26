<?php get_header(); ?>

<main id="main-content" class="pt-24 pb-16 px-5 sm:px-8 max-w-4xl mx-auto">
    <header class="mb-10">
        <h1 class="text-3xl font-bold text-slate-800">
            Search Results for: <span class="text-red-500"><?php echo esc_html(get_search_query()); ?></span>
        </h1>
    </header>

    <?php if (have_posts()) : ?>
        <div class="space-y-8">
            <?php while (have_posts()) : the_post(); ?>
                <article class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-800 mb-2">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="hover:text-red-500 transition-colors">
                            <?php echo esc_html(get_the_title()); ?>
                        </a>
                    </h2>
                    <div class="text-slate-500 text-sm mb-3">
                        <?php echo esc_html(get_the_date()); ?> &middot; <?php the_category(', '); ?>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        <?php echo esc_html(get_the_excerpt()); ?>
                    </p>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="mt-12 text-center">
            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '&larr; Previous',
                'next_text' => 'Next &rarr;',
            ));
            ?>
        </div>
    <?php else : ?>
        <div class="text-center py-20">
            <div class="text-5xl mb-4">🔍</div>
            <h2 class="text-2xl font-bold text-slate-800 mb-3">No Results Found</h2>
            <p class="text-slate-600 mb-6">Sorry, nothing matched your search. Try different keywords.</p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
