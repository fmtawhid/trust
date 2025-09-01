<div class="flex gap-2 items-center">
    @if (auth()->guard('webuser')->check())
        <form method="POST" action="{{ route('webuser.logout') }}">
            @csrf
            <button type="submit"
                class="px-2 text-neutral-700 dark:text-white hover:text-brand-primary dark:hover:text-red-400 transition_3">
                Logout
            </button>
        </form>
    @else
        <!-- Login / Registration -->
        <div class="hidden lg:flex divide-x rtl:divide-x-reverse">
            <button type="button" id="openModal"
                class="px-2 text-neutral-700 dark:text-white hover:text-brand-primary dark:hover:text-red-400 transition_3">
                Login
            </button>
            <a href="/news365/registration"
                class="pl-2 rtl:pl-0 rtl:pr-2 text-neutral-700 dark:text-white hover:text-brand-primary dark:hover:text-red-400 transition_3">
                Registration
            </a>
        </div>
    @endif
</div>
