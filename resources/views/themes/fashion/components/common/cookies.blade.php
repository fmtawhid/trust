<section 
    class="cookies_section bg-neutral-100 fixed left-0 bottom-0 z-20 w-full shadow-inner shadow-black/5"
    x-cloak
    id="cookie-banner">
    <div class="space-y-4 xl:grid items-center grid-cols-7 gap-12 p-6 md:mx-2 lg:mx-12 4xl:container 4xl:mx-auto">
        <div class="col-span-5">
            <h1 class="text-lg font-semibold">{{ $cookieInfo->alert_title }}</h1>
            <p>{{ $cookieInfo->alert_content }}</p>
            @if ($cookieInfo->page_title)
                <a href="{{ $cookieInfo->page_url }}" class="capitalize underline text-blue-500">{{ $cookieInfo->page_title }}</a>
            @endif
        </div>
        <div class="col-span-2 flex justify-end items-center gap-2">
            <button type="button"
                id="cookie-customise-btn"
                data-role="customise"
                class="capitalize text-xs px-4 py-3 text-white hover:text-red-800 bg-red-600 hover:bg-red-600/10 border border-red-600 transition_5">
                {{ localize('customise') }}
            </button>

            <button type="button"
                id="cookie-reject-btn"
                data-role="reject"
                class="capitalize text-xs px-4 py-3 text-white hover:text-red-800 bg-red-600 hover:bg-red-600/10 border border-red-600 transition_5">
                {{ localize('reject_all') }}
            </button>

            <button type="button"
                id="cookie-accept-btn"
                data-role="accept"
                class="capitalize text-xs px-4 py-3 text-white hover:text-red-800 bg-red-600 hover:bg-red-600/10 border border-red-600 transition_5">
                {{ localize('accept_all') }}
            </button>
        </div>
    </div>
</section>

<div id="cookie-preferences-modal" class="fixed inset-0 z-30 bg-black/50 hidden">
    <div class="bg-white p-6 max-w-md mx-auto mt-24 rounded shadow-lg space-y-4">
        <h2 class="text-lg font-semibold">{{ localize('manage_cookie_preferences') }}</h2>
        <form id="cookie-preferences-form">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="essential" checked disabled />
                <span>{{ localize('essential_cookies_(always_active)') }}</span>
            </label>
            <label class="flex items-center gap-2">
                <input type="checkbox" name="analytics" />
                <span>{{ localize('analytics_cookies_(e.g.,_google_analytics)') }}</span>
            </label>
            <label class="flex items-center gap-2">
                <input type="checkbox" name="marketing" />
                <span>{{ localize('marketing_cookies') }}</span>
            </label>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="cookie-save-preferences"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    {{ localize('save_preferences') }}
                </button>
                <button type="button" id="cookie-cancel-preferences"
                    class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                    {{ localize('cancel') }}
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const banner = document.getElementById('cookie-banner');
        const acceptBtn = document.getElementById('cookie-accept-btn');
        const rejectBtn = document.getElementById('cookie-reject-btn');
        const customiseBtn = document.getElementById('cookie-customise-btn');
        const preferencesModal = document.getElementById('cookie-preferences-modal');
        const savePrefsBtn = document.getElementById('cookie-save-preferences');
        const cancelPrefsBtn = document.getElementById('cookie-cancel-preferences');

        const COOKIE_NAME = 'cookie_consent_status';
        const GA_ID = '{{ app()->environment("production") && isset($metaInfo->google_analytics) ? $metaInfo->google_analytics : '' }}';
        const duration = '{{ $cookieInfo->cookie_duration }}';

        function setCookie(name, value, days) {
            const expires = new Date(Date.now() + days * 864e5).toUTCString();
            document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=/';
        }

        function getCookie(name) {
            return document.cookie.split('; ').reduce((r, v) => {
                const parts = v.split('=');
                return parts[0] === name ? decodeURIComponent(parts[1]) : r;
            }, '');
        }

        function enableTrackingScripts() {
            if (!GA_ID) return;
            const script = document.createElement('script');
            script.src = 'https://www.googletagmanager.com/gtag/js?id=' + GA_ID;
            script.async = true;
            document.head.appendChild(script);

            window.dataLayer = window.dataLayer || [];
            function gtag(){ dataLayer.push(arguments); }
            window.gtag = gtag;

            gtag('js', new Date());
            gtag('config', GA_ID);
        }

        const consent = getCookie(COOKIE_NAME);
        if (!consent) {
            banner.removeAttribute('x-cloak');
        } else {
            try {
                const parsed = JSON.parse(consent);
                if (parsed.analytics) {
                    enableTrackingScripts();
                }
            } catch {
                if (consent === 'accepted') enableTrackingScripts();
            }
        }

        acceptBtn.addEventListener('click', function () {
            const settings = { essential: true, analytics: true, marketing: true };
            setCookie(COOKIE_NAME, JSON.stringify(settings), duration);
            enableTrackingScripts();
            banner.style.display = 'none';
        });

        rejectBtn.addEventListener('click', function () {
            const settings = { essential: true, analytics: false, marketing: false };
            setCookie(COOKIE_NAME, JSON.stringify(settings), duration);
            banner.style.display = 'none';
        });

        customiseBtn.addEventListener('click', function () {
            preferencesModal.classList.remove('hidden');
        });

        cancelPrefsBtn.addEventListener('click', function () {
            preferencesModal.classList.add('hidden');
        });

        savePrefsBtn.addEventListener('click', function () {
            const form = document.getElementById('cookie-preferences-form');
            const settings = {
                essential: true,
                analytics: form.analytics.checked,
                marketing: form.marketing.checked
            };
            setCookie(COOKIE_NAME, JSON.stringify(settings), duration);
            if (settings.analytics) enableTrackingScripts();
            banner.style.display = 'none';
            preferencesModal.classList.add('hidden');
        });
    });
</script>
