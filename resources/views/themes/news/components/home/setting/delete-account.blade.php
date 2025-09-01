<div data-tab="delete_account" class="opacity-0 hidden transition-all duration-300 ease-in-out space-y-4">
    <form action="{{ route('account.setting.delete') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="flex flex-col space-y-1 mb-2">
            <label for="account_password"
                class="font-semibold text-neutral-600 dark:text-neutral-100 capitalize">{{ localize('Password') }}</label>
            <input required type="password" id="account_password" name="account_password"
                placeholder="{{ localize('Password') }}"
                class="px-3 py-2 dark:bg-neutral-900 rounded-sm border dark:border-neutral-800 text-neutral-800 dark:text-white focus:placeholder:opacity-0 placeholder:transition-all duration-300 ease-in focus:border-red-500 dark:focus:border-red-500/30 placeholder:capitalize" />
        </div>

        <div class="flex items-start gap-1 relative">
            <input type="checkbox" class="accent-red-500 rounded-sm mt-1" id="term_condition" name="term_condition"
                required />
            <label class="mb-2 text-neutral-800 dark:text-white" for="term_condition">
                {{ localize('Please note that deleting your account is a permanent action. This will result in the removal of all
                                associated data, including your comments, avatar, and profile settings.
                                Are you sure you want to proceed with deleting your account?') }}
            </label>
        </div>
        <button type="submit"
            class="text-center px-6 py-2 bg-red-600 hover:bg-red-700 text-neutral-50 gap-2 rounded-sm transition_3 capitalize">
            {{ localize('Delete Account') }}
        </button>
    </form>
</div>
