<x-web-layout>
@php
$locale = app()->getLocale();
@endphp
<div class="container mx-auto px-4 py-20">
    <div class="max-w-2xl mx-auto text-center space-y-6">
        <!-- 404 Header -->
        <div class="mb-8">
            <h1 class="text-6xl md:text-8xl font-bold text-red-600 mb-4">404</h1>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                {{ $locale === 'bn' ? 'পৃষ্ঠা পাওয়া যায়নি' : 'Page Not Found' }}
            </h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg">
                {{ $locale === 'bn' ? 'দুঃখিত, আপনি যে পৃষ্ঠাটি খুঁজছেন তা বিদ্যমান নেই।' : 'Sorry, the page you are looking for does not exist.' }}
            </p>
        </div>

        <!-- Helpful Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-8">
            <a href="{{ route('website.index') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                {{ $locale === 'bn' ? '🏠 হোম পেজে যান' : '🏠 Go to Home' }}
            </a>
            <a href="{{ route('website.search') }}"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                {{ $locale === 'bn' ? '🔍 খবর খুঁজুন' : '🔍 Search News' }}
            </a>
        </div>

        <!-- Popular Categories -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-8 my-8">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
                {{ $locale === 'bn' ? 'জনপ্রিয় বিভাগ' : 'Popular Categories' }}
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <a href="{{ __url('category') }}"
                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 font-medium">
                    {{ $locale === 'bn' ? '📰 সর্বশেষ খবর' : '📰 Breaking News' }}
                </a>
                <a href="{{ __url('videos') }}"
                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 font-medium">
                    {{ $locale === 'bn' ? '🎥 ভিডিও' : '🎥 Videos' }}
                </a>
                <a href="{{ __url('opinion') }}"
                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 font-medium">
                    {{ $locale === 'bn' ? '💬 মতামত' : '💬 Opinion' }}
                </a>
            </div>
        </div>

        <!-- Search Box -->
        <div class="my-8">
            <form method="GET" action="{{ route('website.search') }}" class="flex gap-2">
                <input type="text" name="q" placeholder="{{ $locale === 'bn' ? 'খবর খুঁজুন...' : 'Search news...' }}"
                    class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                    {{ $locale === 'bn' ? 'খুঁজুন' : 'Search' }}
                </button>
            </form>
        </div>

        <!-- Contact Support -->
        <div class="text-gray-600 dark:text-gray-400 mt-12 pt-8 border-t border-gray-300 dark:border-gray-700">
            <p>
                {{ $locale === 'bn' ? 'এখনও সাহায্য প্রয়োজন?' : 'Still need help?' }}
                <a href="mailto:support@trustnews.press"
                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 font-medium">
                    {{ $locale === 'bn' ? 'আমাদের সাথে যোগাযোগ করুন' : 'Contact us' }}
                </a>
            </p>
        </div>
    </div>
</div>
</x-web-layout>

