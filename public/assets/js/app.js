/* Nusa Determinan Cemerlang — Public scripts */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var header = document.getElementById('siteHeader');
        var navToggle = document.getElementById('navToggle');
        var mainNav = document.getElementById('mainNav');
        var toTop = document.getElementById('toTop');

        // Header shadow on scroll + back to top button
        function onScroll() {
            var scrolled = window.scrollY > 8;

            if (header) {
                header.classList.toggle('is-scrolled', scrolled);
            }

            if (toTop) {
                toTop.classList.toggle('is-visible', window.scrollY > 420);
            }
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        // Mobile navigation
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

        // Back to top
        if (toTop) {
            toTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Dismissible alerts
        document.querySelectorAll('.alert-close').forEach(function (button) {
            button.addEventListener('click', function () {
                var alert = button.closest('.alert');

                if (alert) {
                    alert.remove();
                }
            });
        });

        // Reveal cards on scroll
        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'none';
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });

            document.querySelectorAll('.reveal').forEach(function (element) {
                element.style.opacity = '0';
                element.style.transform = 'translateY(18px)';
                element.style.transition = 'opacity .5s ease, transform .5s ease';
                observer.observe(element);
            });
        }
    });
})();
