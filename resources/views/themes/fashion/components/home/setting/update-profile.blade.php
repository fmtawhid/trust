<div data-tab="update_profile" class="opacity-100 visible transition-all duration-300 ease-in-out space-y-4">
    <form action="{{ route('account.setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Banner Upload Section -->
        <div class="relative mb-8">
            <!-- Preview -->
            <figure class="bg-neutral-100 dark:bg-neutral-800 w-full h-64 object-cover rounded-lg overflow-hidden">
                <img id="banner-preview" class="w-full h-full object-cover rounded-lg"
                    src="{{ $user->bg_image ? asset('storage/' . $user->bg_image) : asset('assets/profile-bg.png') }}"
                    alt="Banner Preview" />
            </figure>

            <!-- Upload Button -->
            <label
                class="absolute top-3 right-3 w-12 h-12 flex items-center justify-center bg-blue-600 text-white rounded-md cursor-pointer hover:bg-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-camera-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                    <path
                        d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
                </svg>
                <input type="file" name="banner" class="absolute inset-0 opacity-0 cursor-pointer"
                    accept=".png,.jpg,.jpeg,.webp,.gif" onchange="previewBanner(this)" />
            </label>

            <!-- Profile Upload Section -->
            <div class="bg-neutral-300 dark:bg-neutral-800 absolute -bottom-4 left-4 w-40 h-40 mx-auto rounded-full">
                <img id="profile-preview"
                    class="w-full h-full object-cover rounded-full border-4 border-white shadow-md"
                    src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/profile.png') }}"
                    alt="Profile Preview" />

                <!-- Upload Button -->
                <label
                    class="absolute bottom-0 right-0 w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full shadow-lg cursor-pointer hover:bg-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-camera-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                        <path
                            d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
                    </svg>
                    <input type="file" name="profile" class="absolute inset-0 opacity-0 cursor-pointer"
                        accept=".png,.jpg,.jpeg,.webp,.gif" onchange="previewProfile(this)" />
                </label>
            </div>
        </div>

        <!-- Name -->
        <div class="flex flex-col space-y-1">
            <label class="font-semibold text-neutral-600 dark:text-neutral-100 capitalize" for="user_name">
                {{ localize('User Name') }}
            </label>
            <input type="text" required placeholder="{{ localize('User name') }}"
                class="px-3 py-2 dark:bg-neutral-900 rounded-sm border dark:border-neutral-800 text-neutral-800 dark:text-white"
                id="user_name" name="user_name" value="{{ $user->name }}" />
        </div>

        <!-- Email -->
        <div class="flex flex-col space-y-1">
            <label class="font-semibold text-neutral-600 dark:text-neutral-100 capitalize" for="email">
                {{ localize('Email') }}
            </label>
            <input type="email" required placeholder="{{ localize('Enter your email') }}"
                class="px-3 py-2 dark:bg-neutral-900 rounded-sm border dark:border-neutral-800 text-neutral-800 dark:text-white"
                id="email" name="user_email" value="{{ $user->email }}" />
        </div>

        <!-- Password -->
        <div class="flex flex-col space-y-1">
            <label for="password" class="font-semibold text-neutral-600 dark:text-neutral-100 capitalize">
                {{ localize('Password') }}
            </label>
            <input type="password" id="password" name="password" placeholder="{{ localize('Password') }}"
                class="px-3 py-2 dark:bg-neutral-900 rounded-sm border dark:border-neutral-800 text-neutral-800 dark:text-white" />
        </div>

        <!-- Confirm Password -->
        <div class="flex flex-col space-y-1">
            <label for="password_confirmation"
                class="font-semibold text-neutral-600 dark:text-neutral-100 capitalize">{{ localize('Confirm Password') }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="{{ localize('Confirm password') }}"
                class="px-3 py-2 dark:bg-neutral-900 rounded-sm border dark:border-neutral-800 text-neutral-800 dark:text-white" />
        </div>

        <button type="submit"
            class="text-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white gap-2 rounded-sm transition capitalize mt-5">
            {{ localize('Save Changes') }}
        </button>
    </form>
</div>
