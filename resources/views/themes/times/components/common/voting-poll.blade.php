 @if ($votingPoll)
     <div class="space-y-3 md:border dark:border-neutral-800 md:p-2 md:rounded-md shadow-sm">
         <h2 class="@if (!$themeSettings->background_color || mode()) bg-neutral-900 @endif @if (!$themeSettings->text_color || mode()) text-white @endif p-2 uppercase mb-2"
             style="@if (!mode() && $themeSettings->background_color) background-color: {{ $themeSettings->background_color }}; @endif @if (!mode() && $themeSettings->text_color) color: {{ $themeSettings->text_color }}; @endif">
             {{ localize('voting_poll') }}
         </h2>
         <form class="p-3 pt-1.5 space-y-2 dark:text-white">
             <!-- {{-- Voting Question --}} -->
             <p class="font-bold text-lg">{{ $votingPoll->question }}</p>
             <input type="hidden" name="poll_id" id="poll_id" value="{{ $votingPoll->id }}">

             <!-- {{-- Voting Question/Ans --}} -->
             <section class="space-y-2 votiong_question">

                 @foreach ($votingPoll->options as $option)
                     <div>
                         <input class="accent-red-500" type="radio" id="voting_{{ $option->id }}" name="voting"
                             value="{{ $option->id }}" />
                         <label class="cursor-pointer" for="voting_{{ $option->id }}">{{ $option->name }}</label>
                     </div>
                 @endforeach

                 <!--  {{-- button section --}} -->
                 <div class="space-x-2">

                     @if ($votingPoll->vote_permission == 0)
                         <button type="button" id="btn_vote"
                             class="bg-neutral-900 dark:bg-neutral-700 hover:bg-neutral-600 dark:hover:bg-neutral-600 text-white px-6 py-1.5 rounded-md transition_3">
                             {{ localize('vote') }}
                         </button>
                     @elseif($votingPoll->vote_permission == 1)
                         @if (auth()->guard('webuser')->check())
                             <button type="button" id="btn_vote"
                                 class="bg-neutral-900 dark:bg-neutral-700 hover:bg-neutral-600 dark:hover:bg-neutral-600 text-white px-6 py-1.5 rounded-md transition_3">
                                 {{ localize('vote') }}
                             </button>
                         @elseif(app_setting()->web_user_can_login == 1)
                             <button type="button"
                                 class="loginReplyRequiredBtn bg-red-500 dark:bg-neutral-700 hover:bg-neutral-600 dark:hover:bg-neutral-600 text-white px-6 py-1.5 rounded-md transition_3">
                                 {{ localize('login') }}
                             </button>
                         @endif

                     @endif

                     <button type="button"
                         class="btn_result dark:text-white text-lg p-1.5 hover:text-brand-primary dark:hover:text-brand-primary transition_3">
                         {{ localize('view_result') }}
                     </button>
                 </div>
                 <div id="voteMessage"
                     class="hidden transition-opacity duration-500 opacity-100 px-4 py-1 mb-4 rounded text-white bg-red-600">
                 </div>

             </section>

             <!-- {{-- Voting Result show --}} -->
             <section class="voting_result_section hidden">
                 <p id="totalVotes" class="text-center text-lg font-semibold text-gray-700 dark:text-white"></p>
                 <div class="py-2 space-y-3">

                 </div>
                 <button type="button"
                     class="btn_option dark:text-white text-lg p-1.5 hover:text-brand-primary dark:hover:text-brand-primary font-semibold transition_3">
                     {{ localize('view_option') }}
                 </button>
             </section>

         </form>
     </div>
 @endif
