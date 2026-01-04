<section class="my-8">
    <div class="mb-6 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700">
        <h1 class="text-brand-primary text-lg font-semibold uppercase">
            {{ $approvedCommentsCount }} {{ localize('comments') }}
        </h1>
    </div>

    @if ($comments->isNotEmpty())
        @foreach ($comments as $comment)
            <!-- Single Comment 1 -->
            <section class="flex items-start gap-4 mb-4">
                <div>
                    <figure class="w-14 h-14 rounded-full overflow-hidden">
                        <img class="w-full h-full object-cover"
                            src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('assets/default.jpg') }}"
                            alt="" />
                    </figure>
                </div>
                <div class="w-full">
                    <div data-comment class="">
                        <div class=" dark:text-white">
                            <h2 class="mb-3">
                                <strong class="mr-3">{{ $comment->user->name }}</strong>
                                {{ $comment->created_at->format('F d, Y h:i A') }}
                            </h2>

                            <!-- Replay Message -->
                            <p class="text-neutral-500 dark:text-white pb-1">
                                {{ $comment->comment }}
                            </p>
                            <!-- Replay button -->
                            <div class="flex justify-end items-end mb-2">
                                @if (!auth()->guard('webuser')->check())
                                    <button type="button"
                                        class="loginReplyRequiredBtn text-neutral-600 dark:text-white dark:hover:text-brand-primary hover:text-brand-primary flex items-center transition-all duration-300 ease-in-out">
                                        <span class="text-sm font-bold lowercase">{{ localize('replay') }}</span>
                                        <svg class="rtl:scale-x-[-1]" xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="20" viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
                                                fill="currentColor" />
                                        </svg>
                                    </button>
                                @else
                                    <button type="button" data-comment-id="{{ $comment->id }}"
                                        class="reply-btn text-neutral-600 dark:text-white dark:hover:text-brand-primary hover:text-brand-primary flex items-center transition-all duration-300 ease-in-out">
                                        <span class="text-sm font-bold lowercase">{{ localize('replay') }}</span>
                                        <svg class="rtl:scale-x-[-1]" xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="20" viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
                                                fill="currentColor" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                            {{-- @if ($comment->replies->isNotEmpty()) --}}
                                <hr class="border-neutral-300 dark:border-neutral-700" />
                            {{-- @endif --}}
                        </div>

                        @foreach ($comment->replies as $reply)
                            <!-- inner 1 -->
                            <div class="flex gap-4 dark:text-white mt-4">
                                <div>
                                    <figure class="w-14 h-14 rounded-full overflow-hidden">
                                        <img class="w-full h-full object-cover"
                                            src="{{ $reply->user->avatar ? asset('storage/' . $reply->user->avatar) : asset('assets/default.jpg') }}"
                                            alt="" />
                                    </figure>
                                </div>

                                <div class="w-full">
                                    <h2 class="dark:text-white mb-3">
                                        <strong class="mr-3">{{ $reply->user->name }}</strong>
                                        {{ $reply->created_at->format('F d, Y h:i A') }}
                                    </h2>

                                    <!-- Replay Message -->
                                    <p class="text-neutral-500 dark:text-white pb-4">
                                        {{ $reply->reply }}
                                    </p>

                                    <hr class="border-neutral-300 dark:border-neutral-700" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    <!-- Repeat for each comment -->
    <section class="bg-neutral-100 dark:bg-neutral-800 p-6 mt-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-400 text-red-700">
                <strong class="font-bold">{{ localize('Whoops!_something_went_wrong') }}</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-400 text-green-700">
                <strong class="font-bold">{{ localize('success!') }}</strong>
                <p class="mt-1 text-sm">{{ session('success') }}</p>
            </div>
        @endif
        <form action="{{ route('user.news.comments.store') }}" method="POST" id="comment-form" class="space-y-3">
            @csrf
            <input type="hidden" name="news_id" value="{{ $currentNewsId }}">
            <textarea class="p-3 w-full rounded-md dark:text-white dark:bg-neutral-900" name="comment" rows="2" id=""
                placeholder="Share your thoughts..."></textarea>
            @if (!auth()->guard('webuser')->check())
                <button type="button" id="loginRequiredBtn"
                    class="px-6 py-3 bg-neutral-800 dark:bg-neutral-900 hover:bg-neutral-600 dark:hover:bg-neutral-700 transition_3 text-white rounded-md uppercase">
                    {{ localize('post_comments') }}
                </button>
            @else
                <button type="submit"
                    class="px-6 py-3 bg-neutral-800 dark:bg-neutral-900 hover:bg-neutral-600 dark:hover:bg-neutral-700 transition_3 text-white rounded-md uppercase">
                    {{ localize('post_comments') }}
                </button>
            @endif
        </form>
    </section>
</section>

<!-- Global Reply Box (Initially Hidden) -->
<section id="globalReplyBox" class="mt-6">
    <div class="p-3 bg-neutral-100 dark:bg-neutral-800 mb-2">
        <div class="flex justify-end items-center mb-4">
            <button id="cancelReply" type="button"
                class="capitalize text-red-500 dark:text-white dark:hover:text-red-600 hover:text-red-600 underline select-none transition_3">
                {{ localize('cancel_replay') }}
            </button>
        </div>
        <form action="{{ route('user.news.reply.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="hidden" name="comment_id" id="commentId">
            <textarea class="p-3 w-full rounded-md dark:text-white dark:bg-neutral-900" name="commentReply" rows="2"
                id="commentReply" placeholder="Comment"></textarea>
            <button type="submit"
                class="px-6 py-3 bg-neutral-800 dark:bg-neutral-900 hover:bg-neutral-600 dark:hover:bg-neutral-700 transition_3 text-white rounded-md uppercase">
                {{ localize('post_comments') }}
            </button>
        </form>
    </div>
</section>

<script>
    const globalReplyBox = document.getElementById("globalReplyBox");
    const cancelReply = document.getElementById("cancelReply");

    // Initially hidden
    globalReplyBox.classList.remove("show");

    // Reply button click
    document.querySelectorAll(".reply-btn").forEach(button => {
        button.addEventListener("click", (e) => {
            let commentId = e.currentTarget.getAttribute("data-comment-id");
            $("#commentId").val(commentId);
            const commentBox = e.target.closest("[data-comment]");
            commentBox.after(globalReplyBox);

            void globalReplyBox.offsetWidth;

            globalReplyBox.classList.add("show");
        });
    });

    // Cancel reply click
    cancelReply.addEventListener("click", () => {
        globalReplyBox.classList.remove("show");
    });
</script>
