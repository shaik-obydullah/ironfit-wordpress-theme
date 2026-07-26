<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-white text-slate-700 antialiased'); ?>>
<?php wp_body_open(); ?>

    <nav class="fixed top-0 left-0 w-full z-50 nav-blur-light transition-all duration-300">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 flex items-center justify-between h-16 md:h-20">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-2 text-2xl font-extrabold tracking-tight">
                <span class="text-red-500">⚡</span>
                <span class="text-slate-800">Iron</span><span class="text-red-500">Fit</span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-700">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'flex items-center gap-8',
                        'fallback_cb'    => false,
                    ));
                } else {
                    echo '<a href="#" class="hover:text-red-500 transition-colors">Home</a>';
                    echo '<a href="#about" class="hover:text-red-500 transition-colors">About</a>';
                    echo '<a href="#services" class="hover:text-red-500 transition-colors">Services</a>';
                    echo '<a href="#testimonials" class="hover:text-red-500 transition-colors">Testimonials</a>';
                    echo '<a href="#pricing" class="hover:text-red-500 transition-colors">Pricing</a>';
                }
                ?>
                <a href="#contact" class="btn-primary text-white px-5 py-2.5 rounded-full text-sm font-semibold shadow-sm shadow-red-200">
                    Book a Session
                </a>
            </div>

            <button id="menuToggle" class="md:hidden text-slate-600 text-2xl focus:outline-none" aria-expanded="false" aria-controls="mobileMenu" aria-label="Toggle navigation menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div id="mobileMenu" class="md:hidden hidden px-5 pb-5 space-y-3 text-sm font-medium bg-white border-t border-slate-200">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'space-y-3',
                    'fallback_cb'    => false,
                ));
            } else {
                echo '<a href="#" class="block hover:text-red-500 transition-colors py-2 text-slate-700">Home</a>';
                echo '<a href="#about" class="block hover:text-red-500 transition-colors py-2 text-slate-700">About</a>';
                echo '<a href="#services" class="block hover:text-red-500 transition-colors py-2 text-slate-700">Services</a>';
                echo '<a href="#testimonials" class="block hover:text-red-500 transition-colors py-2 text-slate-700">Testimonials</a>';
                echo '<a href="#pricing" class="block hover:text-red-500 transition-colors py-2 text-slate-700">Pricing</a>';
            }
            ?>
            <a href="#contact" class="block btn-primary text-white text-center px-5 py-2.5 rounded-full font-semibold">Book a Session</a>
        </div>
    </nav>