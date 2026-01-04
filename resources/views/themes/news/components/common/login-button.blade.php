@php
    $user = Auth::guard('webuser')->user();
    $name = $user->name ?? 'Unknown User';
    $initials = collect(explode(' ', $name))->map(fn($n) => strtoupper(substr($n, 0, 1)))->implode('');
    $initials = substr($initials, 0, 2);
    $hasImage = !empty($user->avatar);
@endphp


<div class="hidden lg:block">
    @if (Auth::guard('webuser')->check())
        <!-- User profile -->
        <div class="relative">
            <button type="button" class="profile_toggle flex items-center gap-2">
                <figure
                    class="w-12 h-12 lg:w-9 lg:h-9 bg-neutral-100 dark:bg-neutral-600 flex_center rounded-md lg:rounded-full overflow-hidden relative border dark:border-neutral-800">
                    @if ($hasImage)
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $user->avatar) }}"
                            alt="user profile image" />
                    @else
                        <span
                            class="text-neutral-700 dark:text-white text-sm font-semibold w-full h-full flex items-center justify-center">
                            {{ $initials }}
                        </span>
                    @endif
                </figure>
                <p class="text-neutral-700 dark:text-white text-sm capitalize">
                    {{ $name }}
                </p>
                <div class="w-2 h-2 border-neutral-700 dark:border-neutral-50 border-t border-r rotate-[135deg]"></div>
            </button>
            <ul
                class="opacity-0 scale-95 translate-y-2 origin-top bg-white dark:bg-neutral-700 absolute top-11 right-0 z-20 rounded shadow-lg min-w-44 overflow-hidden divide-y divide-cyan-800/20 dark:divide-neutral-500 border border-neutral-200 dark:border-neutral-500 transition_3 hidden">
                <li>
                    <a href="{{ __url('account/settings') }}"
                        class="p-2 capitalize dark:text-white hover:text-cyan-600 dark:hover:text-cyan-600 hover:bg-neutral-200 dark:hover:bg-black flex items-center gap-2 transition_3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            viewBox="0 0 256 256">
                            <path
                                d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Zm88-29.84q.06-2.16,0-4.32l14.92-18.64a8,8,0,0,0,1.48-7.06,107.21,107.21,0,0,0-10.88-26.25,8,8,0,0,0-6-3.93l-23.72-2.64q-1.48-1.56-3-3L186,40.54a8,8,0,0,0-3.94-6,107.71,107.71,0,0,0-26.25-10.87,8,8,0,0,0-7.06,1.49L130.16,40Q128,40,125.84,40L107.2,25.11a8,8,0,0,0-7.06-1.48A107.6,107.6,0,0,0,73.89,34.51a8,8,0,0,0-3.93,6L67.32,64.27q-1.56,1.49-3,3L40.54,70a8,8,0,0,0-6,3.94,107.71,107.71,0,0,0-10.87,26.25,8,8,0,0,0,1.49,7.06L40,125.84Q40,128,40,130.16L25.11,148.8a8,8,0,0,0-1.48,7.06,107.21,107.21,0,0,0,10.88,26.25,8,8,0,0,0,6,3.93l23.72,2.64q1.49,1.56,3,3L70,215.46a8,8,0,0,0,3.94,6,107.71,107.71,0,0,0,26.25,10.87,8,8,0,0,0,7.06-1.49L125.84,216q2.16.06,4.32,0l18.64,14.92a8,8,0,0,0,7.06,1.48,107.21,107.21,0,0,0,26.25-10.88,8,8,0,0,0,3.93-6l2.64-23.72q1.56-1.48,3-3L215.46,186a8,8,0,0,0,6-3.94,107.71,107.71,0,0,0,10.87-26.25,8,8,0,0,0-1.49-7.06Zm-16.1-6.5a73.93,73.93,0,0,1,0,8.68,8,8,0,0,0,1.74,5.48l14.19,17.73a91.57,91.57,0,0,1-6.23,15L187,173.11a8,8,0,0,0-5.1,2.64,74.11,74.11,0,0,1-6.14,6.14,8,8,0,0,0-2.64,5.1l-2.51,22.58a91.32,91.32,0,0,1-15,6.23l-17.74-14.19a8,8,0,0,0-5-1.75h-.48a73.93,73.93,0,0,1-8.68,0,8,8,0,0,0-5.48,1.74L100.45,215.8a91.57,91.57,0,0,1-15-6.23L82.89,187a8,8,0,0,0-2.64-5.1,74.11,74.11,0,0,1-6.14-6.14,8,8,0,0,0-5.1-2.64L46.43,170.6a91.32,91.32,0,0,1-6.23-15l14.19-17.74a8,8,0,0,0,1.74-5.48,73.93,73.93,0,0,1,0-8.68,8,8,0,0,0-1.74-5.48L40.2,100.45a91.57,91.57,0,0,1,6.23-15L69,82.89a8,8,0,0,0,5.1-2.64,74.11,74.11,0,0,1,6.14-6.14A8,8,0,0,0,82.89,69L85.4,46.43a91.32,91.32,0,0,1,15-6.23l17.74,14.19a8,8,0,0,0,5.48,1.74,73.93,73.93,0,0,1,8.68,0,8,8,0,0,0,5.48-1.74L155.55,40.2a91.57,91.57,0,0,1,15,6.23L173.11,69a8,8,0,0,0,2.64,5.1,74.11,74.11,0,0,1,6.14,6.14,8,8,0,0,0,5.1,2.64l22.58,2.51a91.32,91.32,0,0,1,6.23,15l-14.19,17.74A8,8,0,0,0,199.87,123.66Z">
                            </path>
                        </svg>
                        <span class="text-nowrap">{{ localize('account_settings') }}</span>
                    </a>
                </li>
                <li>
                    <form class="" method="POST" action="{{ __url('web/user/logout') }}">
                        @csrf
                        <button type="submit"
                            class="p-2 w-full capitalize dark:text-white hover:text-cyan-600 dark:hover:text-cyan-600 hover:bg-neutral-200 dark:hover:bg-black flex items-center gap-2 transition_3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                viewBox="0 0 256 256">
                                <path fill="currentColor"
                                    d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z">
                                </path>
                            </svg>
                            <span class="text-nowrap">{{ localize('logout') }}</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    @else
        <!-- Login / Registration -->
        <div class="flex divide-x rtl:divide-x-reverse">
            <button type="button" id="openModal"
                class="px-2 text-neutral-700 dark:text-white hover:text-brand-primary dark:hover:text-red-400 transition_3">
                {{ localize('login') }}
            </button>
            <a href="{{ __url('registration') }}"
                class="pl-2 rtl:pl-0 rtl:pr-2 text-neutral-700 dark:text-white hover:text-brand-primary dark:hover:text-red-400 transition_3">
                {{ localize('registration') }}
            </a>
        </div>
    @endif
</div>
