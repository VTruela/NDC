/* Nusa Determinan Cemerlang — tombol mata pada kolom password */
(function () {
    'use strict';

    var ICON_EYE = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' +
        '<path d="M2 12s3.6-6.5 10-6.5S22 12 22 12s-3.6 6.5-10 6.5S2 12 2 12z"/>' +
        '<circle cx="12" cy="12" r="3"/></svg>';

    var ICON_EYE_OFF = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' +
        '<path d="M9.9 5.7A9.9 9.9 0 0 1 12 5.5c6.4 0 10 6.5 10 6.5a17.9 17.9 0 0 1-3.2 4"/>' +
        '<path d="M6.2 7.1A17.7 17.7 0 0 0 2 12s3.6 6.5 10 6.5c1.6 0 3-.4 4.2-1"/>' +
        '<path d="M3 3l18 18"/>' +
        '<path d="M10.6 10.7a2 2 0 0 0 2.8 2.8"/></svg>';

    function decorate(input) {
        if (input.dataset.passwordToggle === 'ready' || input.disabled) {
            return;
        }

        input.dataset.passwordToggle = 'ready';

        var wrap = document.createElement('span');
        wrap.className = 'password-wrap';
        input.parentNode.insertBefore(wrap, input);
        wrap.appendChild(input);

        var button = document.createElement('button');
        button.type = 'button';
        button.className = 'password-toggle';
        button.innerHTML = ICON_EYE;
        button.setAttribute('aria-label', 'Tampilkan password');
        button.setAttribute('aria-pressed', 'false');
        button.title = 'Tampilkan password';

        button.addEventListener('click', function () {
            var show = input.type === 'password';

            input.type = show ? 'text' : 'password';
            button.innerHTML = show ? ICON_EYE_OFF : ICON_EYE;
            button.classList.toggle('is-active', show);
            button.setAttribute('aria-pressed', show ? 'true' : 'false');

            var text = show ? 'Sembunyikan password' : 'Tampilkan password';
            button.setAttribute('aria-label', text);
            button.title = text;

            input.focus();
        });

        wrap.appendChild(button);
    }

    function init() {
        document.querySelectorAll('input[type="password"]').forEach(decorate);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
