/* Nusa Determinan Cemerlang — Interactive & Motion Scripts */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var header = document.getElementById('siteHeader');
        var navToggle = document.getElementById('navToggle');
        var mainNav = document.getElementById('mainNav');
        var toTop = document.getElementById('toTop');
        var scrollProgress = document.getElementById('scrollProgress');
        var cursorGlow = document.getElementById('cursorGlow');

        // 1. Header shadow, scroll progress bar & back to top button
        function onScroll() {
            var scrollY = window.scrollY;
            var scrolled = scrollY > 8;

            if (header) {
                header.classList.toggle('is-scrolled', scrolled);
            }

            if (toTop) {
                toTop.classList.toggle('is-visible', scrollY > 420);
            }

            if (scrollProgress) {
                var docHeight = document.documentElement.scrollHeight - window.innerHeight;
                var pct = docHeight > 0 ? Math.min(100, Math.max(0, (scrollY / docHeight) * 100)) : 0;
                scrollProgress.style.width = pct + '%';
            }
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        // 2. Cursor ambient glow follower (desktop)
        if (cursorGlow && window.matchMedia('(pointer: fine)').matches) {
            window.addEventListener('mousemove', function (e) {
                cursorGlow.classList.add('is-active');
                cursorGlow.style.left = e.clientX + 'px';
                cursorGlow.style.top = e.clientY + 'px';
            }, { passive: true });
        }

        // 3. Mobile navigation
        if (navToggle && mainNav) {
            navToggle.addEventListener('click', function () {
                var open = mainNav.classList.toggle('is-open');
                navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            });

            mainNav.addEventListener('click', function (event) {
                if (event.target.tagName === 'A') {
                    mainNav.classList.remove('is-open');
                    navToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // 4. Back to top
        if (toTop) {
            toTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // 5. Dismissible alerts
        document.querySelectorAll('.alert-close').forEach(function (button) {
            button.addEventListener('click', function () {
                var alert = button.closest('.alert');
                if (alert) {
                    alert.remove();
                }
            });
        });

        // 6. Staggered Scroll Reveal Animations
        document.querySelectorAll('.stagger-grid').forEach(function (grid) {
            Array.from(grid.children).forEach(function (child, idx) {
                child.style.transitionDelay = (idx * 90) + 'ms';
            });
        });

        var revealElements = document.querySelectorAll('.reveal, .reveal-up, .reveal-scale, .info-card, .faq-item');
        revealElements.forEach(function (el) {
            if (!el.classList.contains('reveal') && !el.classList.contains('reveal-up') && !el.classList.contains('reveal-scale')) {
                el.classList.add('reveal');
            }
        });

        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal, .reveal-up, .reveal-scale').forEach(function (element) {
                observer.observe(element);
            });
        } else {
            document.querySelectorAll('.reveal, .reveal-up, .reveal-scale').forEach(function (element) {
                element.classList.add('is-revealed');
            });
        }

        // 7. Number Counter Animation for Stats
        if ('IntersectionObserver' in window) {
            var counterObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    var el = entry.target;
                    counterObserver.unobserve(el);

                    var raw = (el.textContent || '').trim();
                    var match = raw.match(/^(\d+)(.*)$/);
                    if (!match) return;

                    var target = parseInt(match[1], 10);
                    var suffix = match[2] || '';
                    if (isNaN(target) || target <= 0) return;

                    var duration = 1400;
                    var startTime = null;

                    function step(timestamp) {
                        if (!startTime) startTime = timestamp;
                        var progress = Math.min((timestamp - startTime) / duration, 1);
                        var eased = 1 - Math.pow(1 - progress, 3);
                        var current = Math.floor(eased * target);
                        el.textContent = current + suffix;
                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            el.textContent = target + suffix;
                        }
                    }

                    window.requestAnimationFrame(step);
                });
            }, { threshold: 0.4 });

            document.querySelectorAll('.counter-value, .counter-num').forEach(function (el) {
                counterObserver.observe(el);
            });
        }

        // 8. 3D Card Tilt Effect on Hover
        if (window.matchMedia('(pointer: fine)').matches) {
            document.querySelectorAll('.tilt-card').forEach(function (card) {
                card.addEventListener('mousemove', function (e) {
                    var rect = card.getBoundingClientRect();
                    var x = e.clientX - rect.left;
                    var y = e.clientY - rect.top;
                    var centerX = rect.width / 2;
                    var centerY = rect.height / 2;
                    var rotateX = ((y - centerY) / centerY) * -5;
                    var rotateY = ((x - centerX) / centerX) * 5;

                    card.style.transform = 'perspective(900px) rotateX(' + rotateX.toFixed(2) + 'deg) rotateY(' + rotateY.toFixed(2) + 'deg) translateY(-6px)';
                });

                card.addEventListener('mouseleave', function () {
                    card.style.transform = '';
                });
            });

            // 9. Magnetic Button Effect
            document.querySelectorAll('.magnetic-btn').forEach(function (btn) {
                btn.addEventListener('mousemove', function (e) {
                    var rect = btn.getBoundingClientRect();
                    var x = (e.clientX - rect.left - rect.width / 2) * 0.18;
                    var y = (e.clientY - rect.top - rect.height / 2) * 0.22;
                    btn.style.transform = 'translate(' + x.toFixed(1) + 'px, ' + y.toFixed(1) + 'px)';
                });

                btn.addEventListener('mouseleave', function () {
                    btn.style.transform = '';
                });
            });
        }
    });
})();
