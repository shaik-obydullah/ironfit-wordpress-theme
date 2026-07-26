<?php get_header(); ?>

<main id="main-content" class="pt-24 pb-16 px-5 sm:px-8 max-w-4xl mx-auto">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <header class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold text-slate-800 leading-tight">
                    <?php echo esc_html(get_the_title()); ?>
                </h1>
                <div class="text-slate-500 text-sm mt-3">
                    <?php echo esc_html(get_the_date()); ?> &middot; <?php the_category(', '); ?>
                </div>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="mt-6 rounded-2xl overflow-hidden border border-slate-200">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-auto', 'loading' => 'lazy')); ?>
                    </div>
                <?php endif; ?>
            </header>

            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed">
                <?php the_content(); ?>
            </div>

            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            if ($prev || $next) : ?>
            <nav class="mt-12 pt-8 border-t border-slate-200 flex justify-between gap-4">
                <?php if ($prev) : ?>
                    <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="text-sm text-slate-600 hover:text-red-500 transition-colors">
                        &larr; <?php echo esc_html(get_the_title($prev)); ?>
                    </a>
                <?php else : ?>
                    <span></span>
                <?php endif; ?>
                <?php if ($next) : ?>
                    <a href="<?php echo esc_url(get_permalink($next)); ?>" class="text-sm text-slate-600 hover:text-red-500 transition-colors text-right">
                        <?php echo esc_html(get_the_title($next)); ?> &rarr;
                    </a>
                <?php endif; ?>
            </nav>
            <?php endif; ?>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
