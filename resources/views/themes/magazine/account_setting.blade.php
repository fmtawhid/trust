<x-web-layout>
    <section class="container mt-16 lg:my-6">
        <!-- Pagination -->
        <div class="dark:text-white bg-neutral-100 dark:bg-neutral-800 flex items-center p-2 gap-3">
            <ul class="flex gap-1 items-center">
                <li>
                    <a class="text-neutral-600 dark:text-white  capitalize transition_3 capitalize whitespace-nowrap"
                        href="{{ __url('/') }}">{{ localize('home') }}</a>
                </li>
                <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <li>
                    <a class="text-brand-primary capitalize transition_3 line-clamp-1"
                        href="{{ __url('account/settings') }}">{{ localize('account_settings') }}</a>
                </li>
            </ul>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 my-4 lg:my-10  2xl:gap-16 space-y-4 lg:space-y-0 lg:gap-4">
            <!-- left section -->
            <div class="lg:space-y-1 flex items-center gap-2 lg:block overflow-x-auto pb-2 lg:pb-0">
                <button type="button" data-tab="update_profile" class="tab_item profile_tab profile_tab_active">
                    {{ localize('update_profile') }}
                </button>
                <button type="button" data-tab="delete_account" class="tab_item profile_tab">
                    {{ localize('delete_account') }}
                </button>
            </div>

            {{-- right Tab content --}}
            <div class="col-span-4">
                @if ($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-400 text-red-700">
                        <strong class="font-bold">{{ localize('Whoops! Something went wrong.') }}</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-400 text-green-700">
                        <strong class="font-bold">{{ localize('success') }}!</strong>
                        <p class="mt-1 text-sm">{{ session('success') }}</p>
                    </div>
                @endif
                {{-- update profile --}}
                @include('themes.magazine.components.home.setting.update-profile')

                {{-- delete account --}}
                @include('themes.magazine.components.home.setting.delete-account')
            </div>
        </div>

    </section>
</x-web-layout>
