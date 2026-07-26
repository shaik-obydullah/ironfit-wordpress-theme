<?php get_header(); ?>

    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-[9999] focus:bg-red-500 focus:text-white focus:px-4 focus:py-2 focus:rounded-lg focus:font-semibold focus:text-sm">Skip to content</a>

    <main id="main-content">

    <!-- ===== HERO SLIDER ===== -->
    <?php
    $hero_slides = new WP_Query(array(
        'post_type'      => 'ironfit_hero_slide',
        'posts_per_page' => 10,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ));
    $has_slides = $hero_slides->have_posts();
    ?>

    <?php if ($has_slides) : ?>
    <section class="hero-slider" id="heroSlider" aria-live="polite" aria-roledescription="carousel">
        <?php $slide_index = 0; ?>
        <?php while ($hero_slides->have_posts()) : $hero_slides->the_post();
            $bg_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            if (!$bg_url) continue;
            $subtitle    = get_post_meta(get_the_ID(), 'ifc_slide_subtitle', true);
            $description = get_post_meta(get_the_ID(), 'ifc_slide_description', true);
            $btn_text    = get_post_meta(get_the_ID(), 'ifc_slide_btn_text', true);
            $btn_url     = get_post_meta(get_the_ID(), 'ifc_slide_btn_url', true) ?: '#contact';
            $btn2_text   = get_post_meta(get_the_ID(), 'ifc_slide_btn2_text', true);
            $btn2_url    = get_post_meta(get_the_ID(), 'ifc_slide_btn2_url', true) ?: '#about';
        ?>
        <div class="hero-slider__slide<?php echo $slide_index === 0 ? ' hero-slider__slide--active' : ''; ?>" data-slide="<?php echo esc_attr($slide_index); ?>">
            <div class="hero-slider__bg" style="background-image: url('<?php echo esc_url($bg_url); ?>');"></div>
            <div class="hero-slider__content">
                <div class="max-w-7xl mx-auto px-5 sm:px-8 py-12 w-full">
                    <div class="max-w-2xl">
                        <?php if ($subtitle) : ?>
                            <span class="section-badge mb-5"><?php echo esc_html($subtitle); ?></span>
                        <?php endif; ?>
                        <h1 class="hero-title text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black leading-[1.1] text-white">
                            <?php echo esc_html(get_the_title()); ?>
                        </h1>
                        <?php if ($description) : ?>
                            <p class="text-slate-200 text-base sm:text-lg mt-6 max-w-lg leading-relaxed">
                                <?php echo esc_html($description); ?>
                            </p>
                        <?php endif; ?>
                        <div class="flex flex-wrap gap-4 mt-8">
                            <?php if ($btn_text) : ?>
                                <a href="<?php echo esc_url($btn_url); ?>" class="btn-primary text-white px-8 py-3.5 rounded-full font-semibold text-sm shadow-md shadow-red-200">
                                    <i class="fas fa-bolt mr-2"></i> <?php echo esc_html($btn_text); ?>
                                </a>
                            <?php endif; ?>
                            <?php if ($btn2_text) : ?>
                                <a href="<?php echo esc_url($btn2_url); ?>" class="btn-outline-light px-8 py-3.5 rounded-full font-semibold text-sm">
                                    <?php echo esc_html($btn2_text); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $slide_index++; ?>
        <?php endwhile; wp_reset_postdata(); ?>

        <button class="hero-slider__arrow hero-slider__arrow--prev" id="heroSliderPrev" aria-label="Previous slide">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="hero-slider__arrow hero-slider__arrow--next" id="heroSliderNext" aria-label="Next slide">
            <i class="fas fa-chevron-right"></i>
        </button>

        <div class="hero-slider__dots" id="heroSliderDots" role="group" aria-label="Slide navigation">
            <?php for ($i = 0; $i < $slide_index; $i++) : ?>
                <button class="hero-slider__dot<?php echo $i === 0 ? ' hero-slider__dot--active' : ''; ?>" data-slide="<?php echo esc_attr($i); ?>" role="button" aria-label="Go to slide <?php echo esc_attr($i + 1); ?>"<?php echo $i === 0 ? ' aria-pressed="true"' : ' aria-pressed="false"'; ?>></button>
            <?php endfor; ?>
        </div>
    </section>

    <?php else : ?>
    <!-- Fallback static hero when no slides are published -->
    <section class="hero-gradient-light min-h-screen flex items-center pt-20 relative overflow-hidden">
        <div class="absolute top-20 right-10 w-72 h-72 bg-red-200/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-96 h-96 bg-red-300/10 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-5 sm:px-8 py-12 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="section-badge mb-5">🔥 TRANSFORM YOUR BODY</span>
                    <h1 class="hero-title text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black leading-[1.1] text-slate-800">
                        Build <br />
                        <span class="text-red-500 accent-glow">Strength</span> &amp;
                        <span class="text-red-500 accent-glow">Confidence</span>
                    </h1>
                    <p class="text-slate-600 text-base sm:text-lg mt-6 max-w-lg leading-relaxed">
                        <?php echo esc_html(get_option('ifc_hero_subtitle', 'Personalized training programs designed to push your limits, crush your goals, and unlock the athlete within. No shortcuts. Just results.')); ?>
                    </p>
                    <div class="flex flex-wrap gap-4 mt-8">
                        <a href="#contact" class="btn-primary text-white px-8 py-3.5 rounded-full font-semibold text-sm shadow-md shadow-red-200">
                            <i class="fas fa-bolt mr-2"></i> Start Today
                        </a>
                        <a href="#about" class="btn-outline-light px-8 py-3.5 rounded-full font-semibold text-sm">
                            Learn More
                        </a>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-10 pt-8 border-t border-slate-200">
                        <div>
                            <div class="stat-number"><?php echo esc_html(get_option('ifc_about_stat1_number', '500+')); ?></div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mt-1"><?php echo esc_html(get_option('ifc_about_stat1_label', 'Clients')); ?></p>
                        </div>
                        <div>
                            <div class="stat-number"><?php echo esc_html(get_option('ifc_about_stat2_number', '97%')); ?></div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mt-1"><?php echo esc_html(get_option('ifc_about_stat2_label', 'Success Rate')); ?></p>
                        </div>
                        <div>
                            <div class="stat-number"><?php echo esc_html(get_option('ifc_about_stat3_number', '8yr')); ?></div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mt-1"><?php echo esc_html(get_option('ifc_about_stat3_label', 'Experience')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="relative flex justify-center">
                    <div class="relative w-full max-w-md aspect-[3/4] rounded-3xl overflow-hidden border border-slate-200 bg-gradient-to-b from-red-50 to-white flex items-end justify-center p-6 shadow-xl shadow-slate-200/50">
                        <div class="absolute -inset-4 border border-red-200/50 rounded-3xl"></div>
                        <div class="absolute -inset-8 border border-red-100/30 rounded-3xl"></div>
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <div class="w-36 h-36 rounded-full bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center border-2 border-red-200 shadow-lg shadow-red-200/30 mb-4">
                                <span class="text-6xl">🏋️</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800"><?php echo esc_html(get_option('ifc_about_coach_name', 'Alex Rivera')); ?></h3>
                            <p class="text-sm text-red-500 font-medium"><?php echo esc_html(get_option('ifc_about_coach_title', 'Certified Personal Trainer')); ?></p>
                            <div class="flex gap-3 mt-3 text-slate-500 text-xs">
                                <span><i class="fas fa-check-circle text-red-500 mr-1"></i> NSCA</span>
                                <span><i class="fas fa-check-circle text-red-500 mr-1"></i> ACE</span>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <span class="px-3 py-1 bg-slate-100 rounded-full text-xs text-slate-600 border border-slate-200">🏆 Strength</span>
                                <span class="px-3 py-1 bg-slate-100 rounded-full text-xs text-slate-600 border border-slate-200">🧘 Mobility</span>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 bg-white border border-slate-200 rounded-2xl px-5 py-3 shadow-lg hidden sm:block">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-500 text-sm font-black">★</div>
                            <div>
                                <p class="text-slate-800 font-bold text-sm"><?php echo esc_html(get_option('ifc_about_rating', '4.9 / 5.0')); ?></p>
                                <p class="text-slate-500 text-xs"><?php echo esc_html(get_option('ifc_about_rating_source', 'from 200+ reviews')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ===== ABOUT ===== -->
    <section id="about" class="py-24 px-5 sm:px-8 max-w-7xl mx-auto">
        <?php
        $about_text1 = get_option('ifc_about_text1', "I'm Alex — a certified personal trainer with 8+ years of experience helping everyday people achieve extraordinary transformations. My approach blends science-backed programming with real-world accountability.");
        $about_text2 = get_option('ifc_about_text2', "Whether you're a beginner or a seasoned athlete, I meet you where you are and take you where you want to go. No judgment. Just progress.");
        $coach_name = get_option('ifc_about_coach_name', 'Alex Rivera');
        $coach_title = get_option('ifc_about_coach_title', 'Certified Personal Trainer');
        $certs_raw = get_option('ifc_about_certs', "Certified Personal Trainer\nNSCA — CPT\nNutrition Specialist\nPrecision Nutrition Level 1\nBehavioral Coach\nMindset & habit formation\n200+ Transformations\nReal people, real results");
        $specialties_raw = get_option('ifc_about_specialties', "Goal-Oriented\nEvery session has purpose\nData-Driven\nTrack & optimize your progress\nHolistic\nMindset + nutrition + movement\nAccountability\nI show up. You show up.");
        $about_years = get_option('ifc_about_stat3_number', '8yr');
        $cert_lines = array_filter(explode("\n", $certs_raw));
        $spec_lines = array_filter(explode("\n", $specialties_raw));
        $spec_icons = array('🎯', '📊', '❤️', '🤝');
        ?>
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div>
                <span class="section-badge mb-4">👋 ABOUT ME</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-800 leading-tight">
                    More Than a Trainer.<br />
                    <span class="text-red-500">Your Partner in Progress.</span>
                </h2>
                <p class="text-slate-600 mt-5 leading-relaxed">
                    <?php echo esc_html($about_text1); ?>
                </p>
                <p class="text-slate-600 mt-3 leading-relaxed">
                    <?php echo esc_html($about_text2); ?>
                </p>

                <div class="grid grid-cols-2 gap-4 mt-8">
                    <?php for ($i = 0; $i < count($spec_lines); $i += 2) :
                        $title = $spec_lines[$i] ?? '';
                        $desc = $spec_lines[$i + 1] ?? '';
                        $icon = $spec_icons[($i / 2) % count($spec_icons)];
                    ?>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <div class="text-red-500 text-2xl mb-1"><?php echo esc_html($icon); ?></div>
                        <h4 class="text-slate-800 font-semibold text-sm"><?php echo esc_html($title); ?></h4>
                        <p class="text-slate-500 text-xs"><?php echo esc_html($desc); ?></p>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="relative">
                <div class="bg-gradient-to-br from-red-50 to-white rounded-3xl p-1 border border-slate-200 shadow-md">
                    <div class="bg-white rounded-3xl p-8 space-y-4">
                        <?php for ($i = 0; $i < count($cert_lines); $i += 2) :
                            $title = $cert_lines[$i] ?? '';
                            $sub = $cert_lines[$i + 1] ?? '';
                            $emojis = array('🏅', '📖', '🧠', '🏆');
                            $emoji = $emojis[($i / 2) % count($emojis)];
                        ?>
                        <div class="flex items-center gap-4 border-b border-slate-200 pb-4">
                            <span class="text-3xl"><?php echo esc_html($emoji); ?></span>
                            <div>
                                <p class="text-slate-800 font-semibold"><?php echo esc_html($title); ?></p>
                                <p class="text-slate-500 text-sm"><?php echo esc_html($sub); ?></p>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="absolute -top-4 -right-4 bg-red-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg shadow-red-200">
                    ⚡ <?php echo esc_html($about_years); ?> Years
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SERVICES ===== -->
    <section id="services" class="py-24 px-5 sm:px-8 bg-slate-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="section-badge mb-4">💪 SERVICES</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-800">
                    Training <span class="text-red-500">That Fits You</span>
                </h2>
                <p class="text-slate-600 mt-3 max-w-2xl mx-auto">
                    Every program is custom-built for your body, goals, and lifestyle. Here's what I offer.
                </p>
            </div>

            <?php
            $services = new WP_Query(array(
                'post_type'      => 'ironfit_service',
                'posts_per_page' => 12,
                'post_status'    => 'publish',
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));
            if ($services->have_posts()) :
            ?>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php while ($services->have_posts()) : $services->the_post();
                    $icon = get_post_meta(get_the_ID(), 'ifc_service_icon', true);
                ?>
                <div class="card-hover bg-white p-6 rounded-2xl border border-slate-200 text-center shadow-sm">
                    <div class="service-icon-light mx-auto"><?php echo $icon ? esc_html($icon) : '🏋️'; ?></div>
                    <h3 class="text-slate-800 font-bold text-lg mt-4"><?php echo esc_html(get_the_title()); ?></h3>
                    <p class="text-slate-600 text-sm mt-2 leading-relaxed"><?php echo esc_html(get_the_excerpt()); ?></p>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ===== TESTIMONIALS ===== -->
    <section id="testimonials" class="py-24 px-5 sm:px-8 max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="section-badge mb-4">⭐ TESTIMONIALS</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-800">
                Real Stories. <span class="text-red-500">Real Results.</span>
            </h2>
        </div>

        <?php
        $testimonials = new WP_Query(array(
            'post_type'      => 'ironfit_testimonial',
            'posts_per_page' => 9,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ));
        if ($testimonials->have_posts()) :
        ?>
        <div class="grid md:grid-cols-3 gap-6">
            <?php while ($testimonials->have_posts()) : $testimonials->the_post();
                $quote  = get_post_meta(get_the_ID(), 'ifc_testimonial_quote', true);
                $role   = get_post_meta(get_the_ID(), 'ifc_testimonial_role', true);
                $rating = get_post_meta(get_the_ID(), 'ifc_testimonial_rating', true);
                $result = get_post_meta(get_the_ID(), 'ifc_testimonial_result', true);
                $stars  = max(1, min(5, intval($rating)));
                $name   = get_the_title();
                $initials = strtoupper(substr($name, 0, 1) . (strpos($name, ' ') !== false ? substr($name, strpos($name, ' ') + 1, 1) : ''));
            ?>
            <div class="testimonial-card p-6 rounded-2xl">
                <div class="flex text-red-500 text-sm mb-3"><?php echo str_repeat('★', $stars) . str_repeat('☆', 5 - $stars); ?></div>
                <?php if ($quote) : ?>
                    <p class="text-slate-700 text-sm leading-relaxed">"<?php echo esc_html($quote); ?>"</p>
                <?php endif; ?>
                <div class="flex items-center gap-3 mt-5 pt-4 border-t border-slate-200">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-sm"><?php echo esc_html($initials); ?></div>
                    <div>
                        <p class="text-slate-800 font-semibold text-sm"><?php echo esc_html(get_the_title()); ?></p>
                        <p class="text-slate-500 text-xs"><?php echo esc_html($result ?: $role); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>
    </section>

    <!-- ===== PRICING ===== -->
    <section id="pricing" class="py-24 px-5 sm:px-8 bg-slate-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="section-badge mb-4">💰 PRICING</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-800">
                    Invest in <span class="text-red-500">Yourself</span>
                </h2>
                <p class="text-slate-600 mt-3 max-w-2xl mx-auto">
                    Flexible plans to fit your goals and budget. No hidden fees. Cancel anytime.
                </p>
            </div>

            <?php
            $pricing = new WP_Query(array(
                'post_type'      => 'ironfit_pricing',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));
            if ($pricing->have_posts()) :
            ?>
            <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <?php while ($pricing->have_posts()) : $pricing->the_post();
                    $price    = get_post_meta(get_the_ID(), 'ifc_pricing_price', true);
                    $period   = get_post_meta(get_the_ID(), 'ifc_pricing_period', true);
                    $features = get_post_meta(get_the_ID(), 'ifc_pricing_features', true);
                    $popular  = get_post_meta(get_the_ID(), 'ifc_pricing_popular', true);
                    $btn_text = get_post_meta(get_the_ID(), 'ifc_pricing_btn_text', true) ?: 'Get Started';
                    $plan_name = get_the_title();
                    $feature_list = array_filter(explode("\n", $features));
                    $card_class = $popular ? 'pricing-card popular p-8 rounded-2xl text-center relative shadow-md' : 'pricing-card p-8 rounded-2xl text-center shadow-sm';
                ?>
                <div class="<?php echo esc_attr($card_class); ?>">
                    <?php if ($popular) : ?>
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-red-500 text-white text-xs font-bold px-4 py-1 rounded-full shadow-sm shadow-red-200">MOST POPULAR</span>
                    <?php endif; ?>
                    <h3 class="text-slate-800 font-bold text-lg"><?php echo esc_html($plan_name); ?></h3>
                    <div class="mt-4">
                        <span class="text-4xl font-black text-slate-800"><?php echo esc_html($price); ?></span>
                        <?php if ($period) : ?>
                            <span class="text-slate-500 text-sm"><?php echo esc_html($period); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($feature_list)) : ?>
                    <ul class="mt-6 space-y-3 text-sm text-slate-600 text-left">
                        <?php foreach ($feature_list as $feature) : ?>
                            <li><i class="fas fa-check text-red-500 mr-2"></i> <?php echo esc_html(trim($feature)); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <a href="#contact" class="block mt-8 py-3 rounded-full <?php echo $popular ? 'bg-red-500 text-white font-semibold text-sm hover:bg-red-600 transition-all shadow-md shadow-red-200' : 'border border-slate-300 text-slate-700 font-semibold text-sm hover:bg-red-500 hover:text-white hover:border-red-500 transition-all'; ?>">
                        <?php echo $popular ? '<i class="fas fa-bolt mr-2"></i> ' : ''; ?><?php echo esc_html($btn_text); ?>
                    </a>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ===== CONTACT / BOOK ===== -->
    <section id="contact" class="py-24 px-5 sm:px-8 max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div>
                <span class="section-badge mb-4">📅 BOOK A SESSION</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-800 leading-tight">
                    Ready to <span class="text-red-500">Transform?</span>
                </h2>
                <p class="text-slate-600 mt-4 leading-relaxed">
                    Fill out the form and I'll get back to you within 24 hours. Let's build a plan that works for you — no pressure, just progress.
                </p>

                <div class="mt-8 space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-500 text-lg">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Email</p>
                            <p class="text-slate-800 font-medium"><?php echo esc_html(get_option('ifc_contact_email', 'alex@ironfit.coach')); ?></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-500 text-lg">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Phone</p>
                            <p class="text-slate-800 font-medium"><?php echo esc_html(get_option('ifc_contact_phone', '+1 (555) 123-4567')); ?></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-500 text-lg">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Location</p>
                            <p class="text-slate-800 font-medium"><?php echo esc_html(get_option('ifc_contact_location', 'Online & In-Person (NYC)')); ?></p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 mt-8">
                    <a href="<?php echo esc_url(get_option('ifc_social_instagram', '#')); ?>" class="social-icon-light"><i class="fab fa-instagram"></i></a>
                    <a href="<?php echo esc_url(get_option('ifc_social_youtube', '#')); ?>" class="social-icon-light"><i class="fab fa-youtube"></i></a>
                    <a href="<?php echo esc_url(get_option('ifc_social_tiktok', '#')); ?>" class="social-icon-light"><i class="fab fa-tiktok"></i></a>
                    <a href="<?php echo esc_url(get_option('ifc_social_linkedin', '#')); ?>" class="social-icon-light"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-md">
                <form id="bookingForm" class="space-y-5 relative" novalidate>
                    <div>
                        <label for="booking-name" class="text-sm font-medium text-slate-700 block mb-1.5">Full Name</label>
                        <input type="text" id="booking-name" name="name" required placeholder="Your name" class="input-field-light w-full px-4 py-3 rounded-xl text-sm" />
                    </div>
                    <div>
                        <label for="booking-email" class="text-sm font-medium text-slate-700 block mb-1.5">Email Address</label>
                        <input type="email" id="booking-email" name="email" required placeholder="you@example.com" class="input-field-light w-full px-4 py-3 rounded-xl text-sm" />
                    </div>
                    <div>
                        <label for="booking-phone" class="text-sm font-medium text-slate-700 block mb-1.5">Phone</label>
                        <input type="tel" id="booking-phone" name="phone" placeholder="+1 (555) 123-4567" class="input-field-light w-full px-4 py-3 rounded-xl text-sm" />
                    </div>
                    <div>
                        <label for="booking-goal" class="text-sm font-medium text-slate-700 block mb-1.5">Goal</label>
                        <select id="booking-goal" name="goal" class="input-field-light w-full px-4 py-3 rounded-xl text-sm appearance-none">
                            <option value="" class="bg-white">Select your primary goal</option>
                            <option value="weight-loss">Weight Loss</option>
                            <option value="muscle-gain">Muscle Gain</option>
                            <option value="strength">Strength &amp; Performance</option>
                            <option value="mobility">Mobility &amp; Recovery</option>
                            <option value="general">General Fitness</option>
                        </select>
                    </div>
                    <div>
                        <label for="booking-message" class="text-sm font-medium text-slate-700 block mb-1.5">Message</label>
                        <textarea id="booking-message" name="message" rows="3" placeholder="Tell me about your goals..." class="input-field-light w-full px-4 py-3 rounded-xl text-sm resize-none"></textarea>
                    </div>
                    <div class="absolute -left-[9999px]" aria-hidden="true">
                        <label for="booking-website">Website</label>
                        <input type="text" id="booking-website" name="website" tabindex="-1" autocomplete="off" />
                    </div>
                    <div id="bookingMsg" class="hidden text-sm text-center py-2 rounded-lg"></div>
                    <button type="submit" id="bookingBtn" class="btn-primary w-full text-white py-3.5 rounded-xl font-semibold text-sm shadow-md shadow-red-200">
                        <i class="fas fa-paper-plane mr-2"></i> Send Message
                    </button>
                    <p class="text-slate-500 text-xs text-center mt-3">
                        I'll reply within 24h. No spam, ever.
                    </p>
                </form>
            </div>
        </div>
    </section>

    </main>

<?php get_footer(); ?>