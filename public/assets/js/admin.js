/* Nusa Determinan Cemerlang — Admin scripts */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var sidebar = document.getElementById('adminSidebar');
        var toggle = document.getElementById('sidebarToggle');

        if (sidebar && toggle) {
            toggle.addEventListener('click', function () {
                sidebar.classList.toggle('is-open');
            });

            document.addEventListener('click', function (event) {
                if (
                    sidebar.classList.contains('is-open') &&
                    !sidebar.contains(event.target) &&
                    !toggle.contains(event.target)
                ) {
                    sidebar.classList.remove('is-open');
                }
            });
        }

        // Konfirmasi sebelum menghapus data
        document.querySelectorAll('form[data-confirm]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!window.confirm(form.dataset.confirm)) {
                    event.preventDefault();
                }
            });
        });

        // Tutup notifikasi
        document.querySelectorAll('.alert-close').forEach(function (button) {
            button.addEventListener('click', function () {
                var alert = button.closest('.alert');

                if (alert) {
                    alert.remove();
                }
            });
        });

        // Slug otomatis dari judul/nama
        document.querySelectorAll('[data-slug-source]').forEach(function (input) {
            var target = document.querySelector(input.dataset.slugSource);

            if (target && !target.value) {
                input.addEventListener('input', function () {
                    target.value = input.value
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .trim()
                        .replace(/\s+/g, '-');
                });
            }
        });
    });
})();
