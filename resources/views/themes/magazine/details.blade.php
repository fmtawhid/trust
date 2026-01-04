<x-web-layout>
    <!-- Pagination -->
    <section class="container mt-2">
        <div class="bg-neutral-100 dark:text-white dark:bg-neutral-800 flex items-center p-2 gap-3">
            <ul class="flex gap-1 items-center">
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 capitalize whitespace-nowrap"
                        href="{{ __url('/') }}">{{ localize('home') }}</a>
                </li>
                @if ($newsDetail->category)
                <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 capitalize whitespace-nowrap"
                        href="{{ __url($newsDetail->category->slug) }}">{{ $newsDetail->category->category_name ?? '' }}</a>
                </li>
                @endif

                @if ($newsDetail->subCategory)
                <svg width="12" height="14" viewBox="0 0 12 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 capitalize whitespace-nowrap"
                        href="{{ __url($newsDetail->subCategory->slug) }}">{{ $newsDetail->subCategory->category_name ?? '' }}</a>
                </li>
                @endif

                <svg width="12" height="14" viewBox="0 0 12 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <li class="text-brand-primary line-clamp-1">{{ $newsDetail->title }}</li>
            </ul>
        </div>
    </section>

    <!-- Details Page News (right side news sticky) Start -->

    <section class="container mt-2 pb-8 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 4xl:grid-cols-4 gap-4">
        <!-- Left section news -->
        <section class="lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">
            <!-- heading -->
            {{-- old code  --}}
            {{-- <div class=""> 
                 <div class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center bg-brand-primary clip-hex-right"
                    {!! bgColorStyle($newsDetail->category->color_code) !!}>
                    {{ Str::upper($newsDetail->category->category_name) }}

            </div> --}}

            {{-- new code and perfectly working --}}

            <div class="xl:mt-0 lg:mt-6 md:mt-8 sm:mt-10 mt-12">
                <div
                    class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center bg-brand-primary clip-hex-right"
                    {!! bgColorStyle($newsDetail->category->color_code) !!}>
                    {{ Str::upper($newsDetail->category->category_name) }}
                </div>
            </div>


            {{-- new code  and perfectly working end  --}}

            @if ($newsDetail->stitle)
            <h2 class="dark:text-white mt-2">{{ $newsDetail->stitle }}</h2>
            @endif
            <h1 class="dark:text-white text-2xl lg:text-3xl my-2 font-semibold">
                {{ $newsDetail->title }}
            </h1>
            <div class="flex md:items-center justify-between flex-col md:flex-row gap-4 mt-2">

                <div class="dark:text-white capitalize flex items-center gap-1 text-sm">

                    <span>{{ $newsDetail->postByUser->full_name ?? localize('unknown') }}</span>
                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                    </svg>
                    <span>{{ news_publish_date_format($newsDetail->created_at) }}</span>
                    <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                    </svg>
                    <span>{{ $newsDetail->comments_count }}</span>
                </div>

                <!-- Social section -->

                @include ('themes.magazine.components.common.social-section')

                {{-- ***************working  code start for print ******************* --}}

                <script>
                    function printNews() {
                        const title = document.querySelector('h1').innerText;

                        // Try multiple image sources
                        let imageUrl = '';
                        const imageElement = document.querySelector('figure.printable-image img') ||
                            document.querySelector('figure.mb-8 img') ||
                            document.querySelector('figure img') ||
                            document.querySelector('.printable-image img');

                        if (imageElement) {
                            imageUrl = imageElement.src;
                        }


                        const reporterName = `{!! $newsDetail->postByUser->full_name ?? localize('unknown') !!}`;
                        const publishDate = `{!! news_publish_date_format($newsDetail->created_at) !!}`;
                        const comments = `{{ $newsDetail->comments_count }}`;

                        const logoUrl = `{{ asset('assets/trust-news-press.svg') }}`;
                        const content = document.getElementById('news-content').innerHTML;

                        const printWindow = window.open('', '_blank', 'width=800,height=600');
                        printWindow.document.write(`
        <!DOCTYPE html>
        <html lang="{{ app()->getLocale() }}">
        <head>
            <meta charset="UTF-8">
            <title>${title}</title>
            <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&display=swap" rel="stylesheet">
            <style>
        body { 
    font-family: 'Hind Siliguri', Arial, sans-serif; 
    padding: 15mm; 
    margin: 0;
}
.header { 
    text-align: center; 
    margin-bottom: 10px; 
    border-bottom: 2px solid #333; 
    padding-bottom: 5px;
    line-height: 1;  /* ADD THIS - reduces line spacing */
}
    .wrapper{
     margin-bottom: 2rem;
    }
.logo { 
    max-width: 800px; 
    margin-left:auto;
    margin-right:auto;
    margin-top:10px; 
    display: block; 
    padding: 0;
    margin-bottom: 0;  
}
.meta { 
    font-size:18px;
    text-align: center; 
    font-weight: 500; 
    margin-top: 10px; 
    padding: 0;
    line-height: 1;  
    transform: translateY(-5px);  
}
h1 { 
    text-align: center; 
    margin-bottom: 15px; 
    margin-top: 10px;
}
img { 
    max-width: 100%; 
    height: auto; 
    margin-bottom: 10px; 
    display: block;
}
            </style>
        </head>
        <body>
            <div class="header">
                <img src="${logoUrl}" alt="Logo" class="logo" onerror="this.style.display='none'">
               
                <div class="meta">
                    <span>${reporterName}</span>
                    <span>${publishDate}</span> 
                    
                </div>
                
            </div>
            <h1>${title}</h1>
            ${imageUrl ? `<img src="${imageUrl}" alt="News Image">` : ''}
            <div>${content}</div>
                
            
        </body>
        </html>
    `);

                        printWindow.document.close();
                        setTimeout(() => {
                            printWindow.print();
                            setTimeout(() => printWindow.close(), 1000);
                        }, 1000);
                    }
                </script>


                {{--************************ working  code end for print*******************  --}}
            </div>
            </div>



            {{-- download button  code start   --}}

            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
            <script>
                // Toaster Function (Top Right Corner)
                function showToaster(message, duration = 3000) {
                    const toaster = document.createElement('div');
                    toaster.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #4CAF50;
        color: white;
        padding: 16px 24px;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        font-family: Arial, sans-serif;
        font-size: 14px;
        z-index: 9999;
        animation: slideIn 0.3s ease-in-out;
    `;
                    toaster.textContent = message;
                    document.body.appendChild(toaster);

                    // Add animation (slide from right)
                    const style = document.createElement('style');
                    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
                    if (!document.querySelector('style[data-toaster]')) {
                        style.setAttribute('data-toaster', 'true');
                        document.head.appendChild(style);
                    }

                    // Auto hide
                    setTimeout(() => {
                        toaster.style.animation = 'slideOut 0.3s ease-in-out';
                        setTimeout(() => {
                            document.body.removeChild(toaster);
                        }, 300);
                    }, duration);
                }

                function downloadSocialCard() {

                    // Show toaster when download starts
                    showToaster('⏳ Download in progress...');

                    const title = document.querySelector('h1').innerText;
                    const newsId = "{{ $newsDetail->id }}";


                    let imageUrl = '';
                    const imageElement = document.querySelector('figure.printable-image img') ||
                        document.querySelector('figure.mb-8 img') ||
                        document.querySelector('figure img') ||
                        document.querySelector('.printable-image img');

                    if (imageElement) {
                        imageUrl = imageElement.src;
                    }

                    const logoUrl = `{{ asset('assets/logo4.png') }}`;
                    const siteName = `{{ config('app.name', 'News Site') }}`;
                    const websiteUrl = window.location.origin;


                    const cardContainer = document.createElement('div');
                    cardContainer.style.position = 'fixed';
                    cardContainer.style.left = '-9999px';
                    cardContainer.style.top = '0';
                    document.body.appendChild(cardContainer);

                    cardContainer.innerHTML = `
  <div id="social-card" 
    style="max-width: 800px; width: 100%; font-family:'Hind Siliguri', Arial, sans-serif; margin: 0 auto; display: flex; flex-direction: column;">

    <!-- Image Section -->
    <div style="position: relative; border: 6px solid #000; overflow: hidden;">
        <img src="${imageUrl}" 
             style="width: 100%; height: auto; max-height: 460px; object-fit: contain; display: block;" 
             crossorigin="anonymous">
    </div>
    
    <!-- Headline + Comment -->
    <div style="background: #003366; padding: 18px 20px 10px; color: white; text-align: center;">
       <h1 style="font-size: clamp(16px, 3vw, 24px); font-weight: bold; margin: 0 0 8px 0; line-height: 1.3;">
            ${title
              .replace(/</g, '&lt;')
              .replace(/>/g, '&gt;')
              .split(' ')
              .slice(0, 7)
              .join(' ')}${title.split(' ').length > 7 ? '…' : ''}
        </h1>
        <p style="font-size: clamp(13px, 2.2vw, 18px); margin: 0 0 6px; font-weight: 500;">
            &gt;&gt; বিস্তারিত সংবাদ কমেন্ট সেকশনে দেখুন &lt;&lt;
        </p>
    </div>

    <!-- Social Media Links -->
   
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <div style="background: #003366; padding: 10px 15px 15px; display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 16px;">
    
        <!-- Facebook -->
        <div style="display: flex; align-items: center; gap:; color: white;">
            <i class="fab fa-facebook-f" style="font-size: 16px;"></i>
            <span style="font-size: 14px; font-weight: 500;">/trustnewspressbd</span>
        </div>

 <!-- YouTube -->
    <div style="display:flex; align-items: center; gap:3px; color: white; ">
        <i class="fab fa-youtube" style="font-size: 16px; "></i>
        <span style="font-size: 14px; font-weight: 500;">/trustnews-bd</span>
    </div>

        <!-- Website -->
        <div style="display: flex; align-items: center; gap:3px; color: white;">
            <i class="fa-solid fa-globe" style="font-size: 16px;"></i>
            <span style="font-size: 14px; font-weight: 500;">/trustnews.press</span>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600&display=swap');
        #social-card { font-family: 'Hind Siliguri', sans-serif !important; }
    </style>
  </div>
`;



                    const images = cardContainer.querySelectorAll('img');
                    let loadedImages = 0;
                    const totalImages = images.length;

                    const checkImagesLoaded = () => {
                        loadedImages++;
                        if (loadedImages === totalImages) {
                            generateImage();
                        }
                    };

                    images.forEach(img => {
                        if (img.complete) {
                            checkImagesLoaded();
                        } else {
                            img.onload = checkImagesLoaded;
                            img.onerror = checkImagesLoaded;
                        }
                    });


                    if (totalImages === 0) {
                        generateImage();
                    }



                    function generateImage() {
                        const card = document.getElementById('social-card');

                        html2canvas(card, {
                            scale: 2,
                            useCORS: true,
                            allowTaint: true,
                            backgroundColor: '#ffffff'
                        }).then(canvas => {

                            canvas.toBlob(blob => {
                                const url = URL.createObjectURL(blob);
                                const a = document.createElement('a');
                                a.href = url;


                                a.download = `${newsId}.png`;

                                document.body.appendChild(a);
                                a.click();
                                document.body.removeChild(a);
                                URL.revokeObjectURL(url);

                                // Show success toaster
                                showToaster('✓ Download completed successfully!', 3000);

                                document.body.removeChild(cardContainer);
                            });
                        });
                    }

                }
            </script>


            {{-- download button code  end  --}}

            <!-- News Details -->
            <div class="dark:text-white mt-6">

                {{-- @php
    $raw = $newsDetail->photoLibrary->large_image ?? null; // e.g. "large_xxx.webp" or "uploads/photo-library/large_xxx.webp"
    $src = asset('assets/news-details-view.png');

    if ($raw) {
        // normalize
        $img = ltrim(str_replace(['public/', 'storage/'], '', (string) $raw), '/');

        // ensure prefix
        if (! \Illuminate\Support\Str::startsWith($img, 'uploads/photo-library/')) {
            $img = 'uploads/photo-library/' . $img;
        }

        // (dev-only) existence check
        // if (app()->isLocal() && ! file_exists(public_path($img))) dump('MISSING FILE: '.public_path($img));

        $src = asset($img);
    }
@endphp --}}
                {{-- <figure class="mb-8"> --}}
                {{-- original code  --}}

                {{-- <img class="w-full max-h-[550px]"
                            src="{{ isset($newsDetail->photoLibrary->large_image) ? asset('storage/' . $newsDetail->photoLibrary->large_image) : asset('/assets/news-details-view.png') }}"
                alt="{{ $newsDetail->image_alt }}" /> --}}



                {{-- changing the path  but code is not working testing code one--}}

                {{-- <img class="w-full max-h-[550px]"
     src="{{ $newsDetail->photoLibrary && $newsDetail->photoLibrary->large_image
         ? asset('storage/'.$newsDetail->photoLibrary->large_image)
         : asset('assets/news-details-view.png') }}"
                alt="{{ $newsDetail->image_alt ?? 'News Image' }}" /> --}}


                {{-- testing code 2  --}}

                {{-- <figure class="mb-8">
  <img class="w-full max-h-[550px]" src="{{ $src }}" alt="{{ $newsDetail->image_alt ?? 'News Image' }}">
                <figcaption class="mt-2 text-sm text-gray-500 dark:text-gray-400 italic text-center">
                    {{ $newsDetail->image_title }}
                </figcaption>
                </figure> --}}






                {{-- old woking  code  for news details image  --}}


                <!-- @php
                $defaultImage = asset('assets/news-details-view.png');
                $largeImage = $newsDetail->photoLibrary->large_image ?? null;

                if ($largeImage) {
                $imagePath = ltrim(str_replace(['public/', 'storage/'], '', $largeImage), '/');
                if (!\Illuminate\Support\Str::startsWith($imagePath, 'uploads/photo-library')) {
                $imagePath = 'uploads/photo-library/' . $imagePath;
                }
                $src = asset($imagePath);
                } else {
                $src = $defaultImage;
                }

                $headline = $newsDetail->title ?? '';
                $headlineWords = explode(' ', strip_tags($headline));
                $shortHeadline = implode(' ', array_slice($headlineWords, 0, 6));
                if (count($headlineWords) > 6) {
                $shortHeadline .= '…';
                }
                @endphp -->

                <figure class="mb-8 relative w-full max-h-[550px] overflow-hidden border-8 border-black bg-gray-200">

                    <div class="absolute inset-0 bg-yellow-100 opacity-20 z-0"></div>

                    <img class="w-full h-auto max-h-[550px] object-contain block relative z-1"
                        src="{{ $src }}"
                        alt="{{ $newsDetail->image_alt ?? 'News Image' }}">



                    <!-- old code  -->
                    <!-- <div class="absolute bottom-0 left-0 w-full bg-blue-900 px- py-3 text-white text-center z-10">
                        <h1 class="text-lg md:text-2xl font-bold leading-snug">
                            {{ $shortHeadline }}
                        </h1>
                    </div> -->

                    <!-- saikot code  -->
                    <!-- <div class="absolute bottom-0 left-0 w-full bg-blue-900 
                        px-2 py-1 sm:px-3 sm:py-2 md:px-4 md:py-3 
                        text-white text-center z-10">
                        <h1 class="text-xs sm:text-sm md:text-lg lg:text-xl xl:text-2xl 2xl:text-3xl font-bold leading-snug">
                            {{ $shortHeadline }}
                        </h1>
                    </div> -->

                    <!-- new code  --> `
                    <div class="absolute bottom-0 left-0 w-full 
                        bg-blue-900 md:bg-blue-800 lg:bg-blue-700 
                        px-2 py-1 sm:px-3 sm:py-2 md:px-4 md:py-3 
                        text-white md:text-gray-100 lg:text-yellow-100 
                        text-center z-10">

                        <h1 class="text-xs sm:text-sm md:text-lg lg:text-3xl xl:text-3xl 2xl:text-4xl 
                        font-bold leading-snug">
                            {{ $shortHeadline }}
                        </h1>
                    </div>


                </figure>

                <figcaption class="mt-2 text-sm text-gray-500 dark:text-gray-400 italic text-center">
                    {{ $newsDetail->image_title }}
                </figcaption>

                {{-- new code testing one end  --}}


                {{-- old working code for news details image end  --}}


                {{-- new code with for news details image  start --}}
                {{-- @php
    $defaultImage = asset('assets/news-details-view.png');
    $largeImage   = $newsDetail->photoLibrary->large_image ?? null;

    if ($largeImage) {
        $imagePath = ltrim(str_replace(['public/', 'storage/'], '', $largeImage), '/');
        if (!\Illuminate\Support\Str::startsWith($imagePath, 'uploads/photo-library')) {
            $imagePath = 'uploads/photo-library/' . $imagePath;
        }
        $src = asset($imagePath);
    } else {
        $src = $defaultImage;
    }

   
    // $headline = \Illuminate\Support\Str::words($newsDetail->title, 6, '...');
    $headline = $newsDetail->title;
@endphp


<div style="position: relative; max-width: 800px; margin: 0 auto;  overflow: hidden;">
  
    <img src="{{ $src }}" alt="News Image"
                style="width: 100%; height: auto; max-height: 500px; object-fit: cover; display: block;">

                
                    <div style="position: absolute; top: 10px; right: 10px; z-index: 10; padding: 6px; border-radius: 6px;">
                    <img src="{{ asset('assets/trust-news-press.svg') }}" alt="Logo"
                        style="width: 120px; height: auto; display: block;">
            </div>


            <div style="position: absolute; bottom: 0; left: 0; width: 100%; background: #003366; color: #fff; text-align: center; padding: 12px 10px; font-family: 'Hind Siliguri', sans-serif;">
                <h3 style="margin: 0; font-size: clamp(16px, 2vw, 22px); line-height: 1.4; font-weight: 600;">
                    {{ $headline }}
                </h3>
            </div>
            </div>


            <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&display=swap" rel="stylesheet">
            --}}


            {{-- new code with for news details image  end --}}




            <div id="news-content" class="text-base prose-content" style="margin-top:1rem">

                {!! $newsDetail->news ?? 'null' !!}

            </div>

            {{-- News Post Video Url --}}
            @if ($newsDetail->videos)
            @php
            $videoData = manageVideoUrl($newsDetail->videos);
            @endphp

            @if ($videoData['type'] === 'video')
            <video controls class="w-full h-auto aspect-video"
                @if($videoData['thumb']) poster="{{ $videoData['thumb'] }}" @endif>
                <source src="{{ $videoData['src'] }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            @elseif ($videoData['type'] === 'iframe')
            <div x-data="{ showPlayer: false }" class="relative aspect-video mt-4">
                {{-- Thumbnail --}}
                <template x-if="!showPlayer">
                    <div class="absolute inset-0 cursor-pointer" @click="showPlayer = true">
                        <img src="{{ $videoData['thumb'] ?? asset('images/default-thumbnail.jpg') }}"
                            class="w-full h-full object-cover shadow-md">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="white">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                </template>

                {{-- iFrame --}}
                <template x-if="showPlayer">
                    <iframe class="absolute top-0 left-0 w-full h-full"
                        src="{{ $videoData['src'] }}{{ Str::contains($videoData['src'], '?') ? '&' : '?' }}autoplay=1"
                        frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                    </iframe>
                </template>
            </div>
            @endif
            @endif

            {{-- Post Tag --}}
            @if ($newsDetail->postTags->count() > 0)
            <div class="bg-white rounded-md shadow-sm p-3 mt-4 border border-gray-200">
                <h2 class="font-bold text-gray-800 mb-2">{{ localize('tags') }}</h2>

                <div class="flex flex-wrap gap-2">
                    @foreach ($newsDetail->postTags as $postTag)
                    <span class="inline-block text-neutral-700 bg-gray-100 px-3 py-1 rounded capitalize">
                        {{ $postTag->tag }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            </div>

        </section>

        <!-- Right section news -->
        <section>
            <div class="space-y-6 sticky top-16">
                <!-- Popular post -->
                @include('themes.magazine.components.common.popular-post')

                <!-- Ads section -->
                <figure class="">
                    @if ($ad = get_advertisements(3, 1))
                    {!! $ad->embed_code !!}
                    @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic.png') }}"
                        alt="" />
                    @endif
                </figure>

            </div>
        </section>

    </section>

    <section class="container mt-2 pb-8 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 4xl:grid-cols-4 gap-4">
        <!-- Left section news -->
        <section class="lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">

            <!-- add section -->
            <figure class="mt-6">
                @if ($ad = get_advertisements(3, 3))
                {!! $ad->embed_code !!}
                @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                    alt="" />
                @endif
            </figure>

            <!-- Article-slider -->
            @include ('themes.magazine.components.slider.article-slider')

            <!-- Single Comment 1 -->
            @if (app_setting()->show_reporter_message == 1)
            <section class="flex gap-4 my-8">
                <div>
                    <figure class="md:w-24 md:h-24 w-16 h-16 rounded-full overflow-hidden">
                        <img class="w-full h-full object-cover"
                            src="{{ $newsDetail->reporterBy->photo ? asset('storage/' . $newsDetail->reporterBy->photo) : asset('assets/opinion-avatar.png') }}"
                            alt="" />
                    </figure>
                </div>
                <div class="space-y-6">
                    <div class="space-y-3 dark:text-white">
                        <div class='flex gap-2 items-center justify-between'>
                            <h2 class="capitalize">
                                <strong>{{ $newsDetail->reporterBy->name . ' ' . $newsDetail->reporterBy->nick_name }}</strong>
                            </h2>
                        </div>
                        <p class="text-neutral-500 dark:text-white line-clamp-3 capitalize">
                            {{ $newsDetail->reporter_message ?? null }}
                        </p>
                    </div>
                </div>
            </section>
            @endif



            <!-- Related post Section -->
            @if ($sectionSixNews->isNotEmpty())
            @include ('themes.magazine.components.common.related-post')
            @endif

            <!-- Comment Section -->
            <input type="hidden" form="comment-form" name="news_comment_type" value="news">

            @if (app_setting()->web_user_can_comment == 1)
            @include ('themes.magazine.components.details.comment-section')
            @endif

        </section>

        <!-- Right section news -->
        <section class="md:w-1/2 lg:w-auto">
            <div class="space-y-6 sticky top-16">
                <!-- Top Week -->
                @include('themes.magazine.components.common.recommended-top-week-post')
                <!-- Voting poll -->
                @if ($votingPoll)
                @include('themes.magazine.components.common.voting-poll')
                @endif

                <!-- Ads section -->
                <figure class="">
                    @if ($ad = get_advertisements(3, 4))
                    {!! $ad->embed_code !!}
                    @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-medium.png') }}"
                        alt="" />
                    @endif
                </figure>
            </div>
        </section>


    </section>

    <!-- Details Page News (right side news sticky) End -->

</x-web-layout>