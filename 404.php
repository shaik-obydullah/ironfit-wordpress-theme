<?php get_header(); ?>

<main id="main-content" class="pt-24 pb-16 px-5 sm:px-8 max-w-4xl mx-auto text-center">
    <div class="py-20">
        <div class="text-7xl font-black text-red-500 mb-4">404</div>
        <h1 class="text-3xl font-bold text-slate-800 mb-4">Page Not Found</h1>
        <p class="text-slate-600 mb-8 max-w-md mx-auto">
            The page you're looking for doesn't exist or has been moved. Let's get you back on track.
        </p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary inline-block text-white px-8 py-3.5 rounded-full font-semibold text-sm shadow-md shadow-red-200">
            <i class="fas fa-home mr-2"></i> Back to Home
        </a>
    </div>
</main>

<?php get_footer(); ?>
