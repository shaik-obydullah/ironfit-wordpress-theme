document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    /* ============================================================
       1. Mobile Navigation
       ============================================================ */
    var toggle = document.getElementById('menuToggle');
    var menu = document.getElementById('mobileMenu');

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            menu.classList.toggle('hidden');
            var icon = toggle.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
            var expanded = !menu.classList.contains('hidden');
            toggle.setAttribute('aria-expanded', expanded);
        });

        document.querySelectorAll('#mobileMenu a').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.add('hidden');
                var icon = toggle.querySelector('i');
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-times');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    /* ============================================================
       2. Hero Slider
       ============================================================ */
    initHeroSlider({
        sliderId: 'heroSlider',
        slideSelector: '.hero-slider__slide',
        dotSelector: '.hero-slider__dot',
        prevBtnId: 'heroSliderPrev',
        nextBtnId: 'heroSliderNext',
        autoplayDelay: 6000,
    });

    function initHeroSlider(cfg) {
        var container = document.getElementById(cfg.sliderId);
        if (!container) return;

        var slides = container.querySelectorAll(cfg.slideSelector);
        var dots = container.querySelectorAll(cfg.dotSelector);
        var prevBtn = cfg.prevBtnId ? document.getElementById(cfg.prevBtnId) : null;
        var nextBtn = cfg.nextBtnId ? document.getElementById(cfg.nextBtnId) : null;

        if (!slides.length) return;

        var current = 0;
        var timer = null;

        function goTo(idx) {
            slides.forEach(function (s) { s.classList.remove('hero-slider__slide--active'); });
            dots.forEach(function (d) {
                d.classList.remove('hero-slider__dot--active');
                d.setAttribute('aria-pressed', 'false');
            });
            slides[idx].classList.add('hero-slider__slide--active');
            if (dots[idx]) {
                dots[idx].classList.add('hero-slider__dot--active');
                dots[idx].setAttribute('aria-pressed', 'true');
            }
            current = idx;
        }

        function next() { goTo((current + 1) % slides.length); }
        function prev() { goTo((current - 1 + slides.length) % slides.length); }

        function startAuto() { stopAuto(); timer = setInterval(next, cfg.autoplayDelay); }
        function stopAuto() { clearInterval(timer); timer = null; }

        if (nextBtn) nextBtn.addEventListener('click', function () { next(); startAuto(); });
        if (prevBtn) prevBtn.addEventListener('click', function () { prev(); startAuto(); });

        dots.forEach(function (dot) {
            dot.addEventListener('click', function () {
                var idx = parseInt(this.getAttribute('data-slide'), 10);
                if (!isNaN(idx)) { goTo(idx); startAuto(); }
            });
        });

        container.addEventListener('mouseenter', stopAuto);
        container.addEventListener('mouseleave', startAuto);

        var touchX = 0;
        container.addEventListener('touchstart', function (e) {
            touchX = e.changedTouches[0].screenX;
            stopAuto();
        }, { passive: true });

        container.addEventListener('touchend', function (e) {
            var diff = touchX - e.changedTouches[0].screenX;
            if (Math.abs(diff) > 40) { diff > 0 ? next() : prev(); }
            startAuto();
        });

        startAuto();
    }

    /* ============================================================
       3. Booking Form AJAX
       ============================================================ */
    var bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var btn = document.getElementById('bookingBtn');
            var msg = document.getElementById('bookingMsg');
            var fd = new FormData(bookingForm);
            fd.append('action', 'ifc_submit_booking');
            fd.append('nonce', ironfitAjax.nonce);

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sending...';
            msg.classList.add('hidden');

            fetch(ironfitAjax.url, { method: 'POST', body: fd })
                .then(function (r) { return r.json(); })
                .then(function (res) {
                    msg.classList.remove('hidden');
                    if (res.success) {
                        msg.className = 'text-sm text-center py-2 rounded-lg bg-green-50 text-green-700 border border-green-200';
                        msg.textContent = res.data.message;
                        bookingForm.reset();
                    } else {
                        msg.className = 'text-sm text-center py-2 rounded-lg bg-red-50 text-red-700 border border-red-200';
                        msg.textContent = res.data.message || 'Something went wrong. Please try again.';
                    }
                })
                .catch(function () {
                    msg.classList.remove('hidden');
                    msg.className = 'text-sm text-center py-2 rounded-lg bg-red-50 text-red-700 border border-red-200';
                    msg.textContent = 'Network error. Please try again.';
                })
                .finally(function () {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Send Message';
                });
        });
    }
});
