<x-web-layout>
    <section class="container mt-16 lg:my-6">
        <!-- Pagination -->
        <div class="dark:text-white bg-neutral-100 dark:bg-neutral-800 flex items-center p-2 gap-3">
            <ul class="flex gap-1 items-center">
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 capitalize whitespace-nowrap" href="/news365">Home</a>
                </li>
                    <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 capitalize whitespace-nowrap" href="/sports">Setting</a>
                </li>
                    <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                <li class="text-brand-primary capitalize line-clamp-1">Update Profile</li>
            </ul>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 my-4 lg:my-10  2xl:gap-16 space-y-4 lg:space-y-0 lg:gap-4">
                <!-- left section -->
                <div class="lg:space-y-1 flex items-center gap-2 lg:block overflow-x-auto pb-2 lg:pb-0">
                    <button type="button" data-tab="update_profile"
                        class="tab_item profile_tab profile_tab_active">
                        update profile
                    </button>
                    <button type="button" data-tab="change_password"
                        class="tab_item profile_tab">
                        change password
                    </button>
                    <button type="button" data-tab="delete_account"
                        class="tab_item profile_tab">
                        delete account
                    </button>
                </div>

                {{-- right Tab content --}}
                <div class="col-span-4">
                    {{-- update profile --}}
                    @include('themes.news.components.home.setting.update-profile')

                    {{-- change password --}}
                    @include('themes.news.components.home.setting.change-password')

                    {{-- delete account --}}
                    @include('themes.news.components.home.setting.delete-account')
                </div>
        </div>

    </section>
</x-web-layout>



