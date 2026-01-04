<x-web-layout>
    <section class="container py-8 mx-auto flex justify-center items-start mt-6">
        <div
            class="bg-white dark:bg-neutral-800 p-4 md:p-6 w-full md:w-[400px] h-auto relative rounded-md border dark:border-neutral-700">

            <div class="h-auto">
                <h2 class="text-xl font-bold mb-4 text-neutral-800 dark:text-white text-center">
                    Registration
                </h2>
                <div class="space-y-3 mt-6">
                    <a href="https://varient.codingest.net/connect-with-facebook"
                        class="flex p-2 bg-social-facebook text-white gap-2 rounded-sm hover:bg-blue-700 transition_3">
                        <svg width="24" height="24" viewBox="0 0 14222 14222">
                            <circle cx="7111" cy="7112" r="7111" fill="#ffffff"></circle>
                            <path
                                d="M9879 9168l315-2056H8222V5778c0-562 275-1111 1159-1111h897V2917s-814-139-1592-139c-1624 0-2686 984-2686 2767v1567H4194v2056h1806v4969c362 57 733 86 1111 86s749-30 1111-86V9168z"
                                fill="#1877f2"></path>
                        </svg>
                        <span>Connect with Facebook</span>
                    </a>
                    <a href="https://varient.codingest.net/connect-with-google"
                        class="flex p-2 bg-neutral-100 dark:bg-neutral-300 text-neutral-800  gap-2 rounded-sm hover:bg-neutral-200 transition_3">
                        <svg width="24" height="24" viewBox="0 0 128 128">
                            <rect clip-rule="evenodd" fill="none" fill-rule="evenodd" height="128" width="128"></rect>
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
                        <span>Connect with Google</span>
                    </a>
                    <p class="text-neutral-600 dark:text-white">
                        Or register with email
                    </p>
                    <div class="flex flex-col">
                        <label class="mb-2 text-sm text-neutral-800 dark:text-white" for="user_name">
                            User Name
                        </label>
                        <input type="user_name" required placeholder="User name"
                            class="px-3 py-1.5 dark:bg-neutral-700 rounded-sm border dark:border-neutral-700 text-neutral-800 dark:text-white focus:placeholder:opacity-0 placeholder:transition-all duration-300 ease-in focus:border-red-500 placeholder:text-xs"
                            id="user_name" />
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 text-sm text-neutral-800 dark:text-white" for="email">
                            Email
                        </label>
                        <input type="email" required placeholder="Enter your email"
                            class="px-3 py-1.5 dark:bg-neutral-700 rounded-sm border dark:border-neutral-700 text-neutral-800 dark:text-white focus:placeholder:opacity-0 placeholder:transition-all duration-300 ease-in focus:border-red-500 placeholder:text-xs"
                            id="email" />
                    </div>
                    <div class="flex flex-col relative">
                        <label class="mb-2 text-sm text-neutral-800 dark:text-white" for="password">
                            Password
                        </label>
                        <input type="password" required placeholder="Password"
                            class="px-3 py-1.5 dark:bg-neutral-700 rounded-sm border dark:border-neutral-700 text-neutral-800 dark:text-white focus:placeholder:opacity-0 placeholder:transition-all duration-300 ease-in focus:border-red-500 placeholder:text-xs"
                            id="password" />
                    </div>
                    <div class="flex flex-col relative">
                        <label class="mb-2 text-sm text-neutral-800 dark:text-white" for="confirm_password">
                            Confirm Password
                        </label>
                        <input type="password" required placeholder="Confirm password"
                            class="px-3 py-1.5 dark:bg-neutral-700 rounded-sm border dark:border-neutral-700 text-neutral-800 dark:text-white focus:placeholder:opacity-0 placeholder:transition-all duration-300 ease-in focus:border-red-500 placeholder:text-xs"
                            id="confirm_password" />
                    </div>
                    <div class="flex items-start gap-1 relative">
                        <input type="checkbox"
                            class="accent-red-500 rounded-sm mt-1"
                            id="term_condition"
                            name="term_condition" />
                        <label class="mb-2 text-sm text-neutral-800 dark:text-white" for="confirm_password">
                            I have read and agree to the <a class="text-brand-primary font-semibold" href="/news365/terms-conditions">Terms & Conditions</a>
                        </label>
                    </div>

                    <button type="button"
                        class="w-full text-center p-2 bg-brand-primary hover:bg-red-700 text-neutral-50 gap-2 rounded-sm transition_3">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>

