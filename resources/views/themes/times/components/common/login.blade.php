<div id="loginModal" class="fixed inset-0 z-50 bg-black bg-opacity-60 hidden justify-center items-center">
    <div id="modalContent"
        class="login_content bg-white dark:bg-neutral-800 p-8 w-[360px] md:w-[400px] h-auto relative rounded-md border dark:border-neutral-700">
        <!-- Close Button -->
        <button id="closeModal"
            class="p-2 text-white bg-red-600 hover:bg-red-800 rounded-full w-8 h-8 flex items-center justify-center absolute top-1 right-1 transition_3 rtl:right-auto rtl:left-1">
            <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <path
                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                    fill="currentColor" />
            </svg>
        </button>
        <div class="h-auto">
            <h2 class="text-xl font-bold mb-4 text-neutral-800 dark:text-white text-center">
                {{ localize('login') }}
            </h2>
            <div class="space-y-3 mt-6">
                <a href="{{ route('connect-with-facebook') }}"
                    class="flex p-2 bg-social-facebook text-white gap-2 rounded-sm hover:bg-blue-700 transition_3">
                    <svg width="24" height="24" viewBox="0 0 14222 14222">
                        <circle cx="7111" cy="7112" r="7111" fill="#ffffff"></circle>
                        <path
                            d="M9879 9168l315-2056H8222V5778c0-562 275-1111 1159-1111h897V2917s-814-139-1592-139c-1624 0-2686 984-2686 2767v1567H4194v2056h1806v4969c362 57 733 86 1111 86s749-30 1111-86V9168z"
                            fill="#1877f2"></path>
                    </svg>
                    <span>{{ localize('connect_with_facebook') }}</span>
                </a>
                <a href="{{ route('connect-with-google') }}"
                    class="flex p-2 bg-neutral-100 dark:bg-neutral-300 text-neutral-800 gap-2 rounded-sm hover:bg-neutral-200 transition_3">
                    <svg width="24" height="24" viewBox="0 0 128 128">
                        <rect clip-rule="evenodd" fill="none" fill-rule="evenodd" height="128" width="128">
                        </rect>
                        <path clip-rule="evenodd"
                            d="M27.585,64c0-4.157,0.69-8.143,1.923-11.881L7.938,35.648    C3.734,44.183,1.366,53.801,1.366,64c0,10.191,2.366,19.802,6.563,28.332l21.558-16.503C28.266,72.108,27.585,68.137,27.585,64"
                            fill="#FBBC05" fill-rule="evenodd"></path>
                        <path clip-rule="evenodd"
                            d="M65.457,26.182c9.031,0,17.188,3.2,23.597,8.436L107.698,16    C96.337,6.109,81.771,0,65.457,0C40.129,0,18.361,14.484,7.938,35.648l21.569,16.471C34.477,37.033,48.644,26.182,65.457,26.182"
                            fill="#EA4335" fill-rule="evenodd"></path>
                        <path clip-rule="evenodd"
                            d="M65.457,101.818c-16.812,0-30.979-10.851-35.949-25.937    L7.938,92.349C18.361,113.516,40.129,128,65.457,128c15.632,0,30.557-5.551,41.758-15.951L86.741,96.221    C80.964,99.86,73.689,101.818,65.457,101.818"
                            fill="#34A853" fill-rule="evenodd"></path>
                        <path clip-rule="evenodd"
                            d="M126.634,64c0-3.782-0.583-7.855-1.457-11.636H65.457v24.727    h34.376c-1.719,8.431-6.397,14.912-13.092,19.13l20.474,15.828C118.981,101.129,126.634,84.861,126.634,64"
                            fill="#4285F4" fill-rule="evenodd"></path>
                    </svg>
                    <span>{{ localize('connect_with_google') }}</span>
                </a>
                <a href="{{ __url('registration') }}" class="text-neutral-600 dark:text-white underline">
                    {{ localize('or_register_with_email') }}
                </a>
                <div id="responseMessage" class="mt-4 text-sm"></div>
                <form id="loginForm">
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 text-sm text-neutral-800 dark:text-white" for="email">
                            {{ localize('email_address') }}
                        </label>
                        <input type="email" required placeholder="Enter your email address"
                            class="px-3 py-1.5 dark:bg-neutral-700 rounded-sm border dark:border-neutral-700 text-neutral-800 dark:text-white focus:placeholder:opacity-0 placeholder:transition-all duration-300 ease-in focus:border-red-500 placeholder:text-xs"
                            id="email" name="email" />
                    </div>
                    <div class="flex flex-col mb-4 relative">
                        <label class="mb-2 text-sm text-neutral-800 dark:text-white" for="password">

                        </label>
                        <input type="password" required placeholder="Enter your password"
                            class="px-3 py-1.5 dark:bg-neutral-700 rounded-sm border dark:border-neutral-700 text-neutral-800 dark:text-white focus:placeholder:opacity-0 placeholder:transition-all duration-300 ease-in focus:border-red-500 placeholder:text-xs"
                            id="password" name="password" />
                    </div>

                    <div class="flex justify-end mb-4">
                        <a class="text-red-700" href="{{ route('web.forgot.password') }}">{{ localize('forgot_password?') }}</a>
                    </div>

                    <button type="submit"
                        class="w-full text-center p-2 bg-brand-primary hover:bg-red-700 text-neutral-50 gap-2 rounded-sm transition_3">
                        {{ localize('login') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('custom-js')
    <script>
        const loginRoute = "{{ route('webuser.login') }}";
    </script>
    <script src="{{ asset('website/js/login.js?v=4') }}"></script>
@endpush
