<div class="flex gap-3">
    <a class="w-[26px] h-[26px] xl:w-[42px] xl:h-[42px] p-1 flex justify-center items-center text-white bg-sky-600 hover:bg-sky-500 transition-all duration-500 ease-in-out"
        href="javascript:void(0)" onclick="increaseFont()">
        <span>{{ localize('A') }}</span>+
    </a>
    <a class="w-[26px] h-[26px] xl:w-[42px] xl:h-[42px] p-1 flex justify-center items-center text-white bg-sky-600 hover:bg-sky-500 transition-all duration-500 ease-in-out"
        href="javascript:void(0)" onclick="decreaseFont()">
        <span>{{ localize('a') }}</span>-
    </a>
    <a href="javascript:void(0)" onclick="copyPageURL(this)"
        class="w-6 h-6 xl:w-10 xl:h-10 flex justify-center items-center group p-1 text-neutral-800 ring-1 ring-neutral-600 transition-all duration-500 ease-in-out hover:bg-neutral-600 hover:text-white">
        <div class="copy-icon hover:text-white dark:text-white">
            <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12.5 10.7875V0.9875L11.8875 0.375H3.925L3.3125 0.9875V3.4375H0.8625L0.25 4.05V13.85L0.8625 14.4625H8.825L9.4375 13.85V11.4H11.8875L12.5 10.7875ZM9.4375 10.175V4.05L8.825 3.4375H4.5375V1.6H11.275V10.175H9.4375ZM1.475 4.6625H8.2125V13.2375H1.475V4.6625Z"
                    fill="currentColor"></path>
            </svg>
        </div>
    </a>

    <a target="_blank"
        class="w-6 h-6 xl:w-10 xl:h-10  flex justify-center items-center group p-1 text-social-facebook ring-1 ring-social-facebook transition-all duration-500 ease-in-out hover:bg-social-facebook hover:text-white"
        href="javascript:void(0)"
        onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}', 'Share This Post', 'width=640,height=450'); return false">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M14 13.65H16.8571L18 9.25H14V7.05C14 5.917 14 4.85 16.2857 4.85H18V1.154C17.6274 1.1067 16.2206 1 14.7349 1C11.632 1 9.42857 2.8227 9.42857 6.17V9.25H6V13.65H9.42857V23H14V13.65Z"
                fill="currentColor" />
        </svg>
    </a>
    <a target="_blank"
        class="dark:bg-white dark:border-red w-6 h-6 xl:w-10 xl:h-10  flex justify-center items-center group p-1 text-black ring-1 ring-black transition-all duration-500 ease-in-out hover:bg-black hover:text-white"
        href="javascript:void(0)"
        onclick="window.open('https://twitter.com/share?url={{ url()->full() }}', 'Share This Post', 'width=640,height=450'); return false">
        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill='currentColor'
                d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
        </svg>
    </a>
    <a target="_blank"
        class="w-6 h-6 xl:w-10 xl:h-10  flex justify-center items-center group p-1 text-red-500 ring-1 ring-red-500 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-white"
        href="javascript:void(0)"
        onclick="window.open('http://pinterest.com/pin/create/button/?url={{ url()->full() }}&media={{ isset($newsDetail->photoLibrary->image_base_url) ? $newsDetail->photoLibrary->image_base_url : asset('/assets/details-lg-image.png') }}', 'Share This Post', 'width=640,height=450');return false">
        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
            <path fill='currentColor'
                d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z" />
        </svg>
    </a>
    <a target="_blank"
        class="w-6 h-6 xl:w-10 xl:h-10  flex justify-center items-center group p-1 text-social-linkedin ring-1 ring-social-linkedin transition-all duration-500 ease-in-out hover:bg-social-linkedin hover:text-white"
        href="javascript:void(0)"
        onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url={{ url()->full() }}', 'Share This Post', 'width=640,height=450');return false">
        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill='currentColor'
                d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z" />
        </svg>


    </a>

    <a target="_blank"
        class="w-6 h-6 xl:w-10 xl:h-10  flex justify-center items-center group p-1 text-green-600 ring-1 ring-green-600 transition-all duration-500 ease-in-out hover:bg-green-600 hover:text-white"
        href="https://api.whatsapp.com/send?text={{ url()->full() }}">
        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill='currentColor'
                d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
        </svg>
    </a>
</div>
