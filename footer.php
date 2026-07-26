    <footer class="border-t border-slate-200 py-12 px-5 sm:px-8 bg-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2 text-xl font-extrabold">
                <span class="text-red-500">⚡</span>
                <span class="text-slate-800">Iron</span><span class="text-red-500">Fit</span>
            </div>
            <p class="text-slate-500 text-sm">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            </p>
            <div class="flex gap-6 text-sm text-slate-500">
                <a href="#" class="hover:text-red-500 transition-colors">Privacy</a>
                <a href="#" class="hover:text-red-500 transition-colors">Terms</a>
                <a href="#" class="hover:text-red-500 transition-colors">Cookies</a>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>