const voteBtn = document.getElementById('btn_vote');
if (voteBtn) {
    voteBtn.addEventListener('click', function () {
        const selected = document.querySelector('input[name="voting"]:checked');
        const pollId = document.getElementById('poll_id').value;
        const voteMessage = document.getElementById('voteMessage');
        const token = $('input[name="_token"]').val();

        if (!selected) {
            voteMessage.textContent = 'Please select an option.';
            voteMessage.classList.remove('hidden');

            setTimeout(() => {
                voteMessage.classList.add('hidden');
            }, 3000);

            return;
        }

        fetch(ajaxPollVoteUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                poll_id: pollId,
                option_id: selected.value
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'error') {
                voteMessage.textContent = data.message;
                voteMessage.classList.remove('hidden');

                setTimeout(() => {
                    voteMessage.classList.add('hidden');
                }, 3000);

            } else if (data.status === 'success') {
                loadPollResult(pollId);
            }
        });
    });
}

function loadPollResult(pollId) {
    const url = ajaxPollResultUrl.replace('__POLL_ID__', pollId);
    let total = 0;

    fetch(url)
        .then(res => res.json())
        .then(data => {
            const resultContainer = document.querySelector('.voting_result_section');
            const html = data.results.map(option => {
                return `
                    <div class="skills_bar">
                        <h4 class="text-base mb-2">${option.name}</h4>
                        <div class="progress_line relative w-full h-2 bg-black dark:bg-neutral-500 rounded-xl">
                            <span
                                class="skills_bar_valu absolute rounded-xl h-full bg-red-600 before:absolute before:content-[''] before:-top-[12px] before:right-0 before:border-[12px] before:border-transparent before:border-r-0 before:border-b-0 before:border-t-neutral-800 z-10"
                                data-percentage="${option.percentage}%">

                                <span class="absolute bg-neutral-800 text-white px-2 py-1 rounded-md text-xs -top-8 right-0">${option.percentage}%</span>
                            </span>
                        </div>
                    </div>
                `;

            }).join('');

            resultContainer.querySelector('.py-2.space-y-3').innerHTML = html;
            document.getElementById('totalVotes').textContent = `Total vote: ${data.totalVotes}`;

            const percentages = document.querySelectorAll('.skills_bar_valu');
            percentages.forEach(el => {
                const val = el.getAttribute('data-percentage');
                el.style.width = val;
                total += parseFloat(val);
            });

            // toggle UI
            document.querySelector('.votiong_question').classList.add('hidden');
            resultContainer.classList.remove('hidden');
        });
}

// Toggle manually (if user just clicks "View Result")
const btn_result = document.querySelector('.btn_result');
if (btn_result) {
    btn_result.addEventListener('click', function () {
        const pollId = document.getElementById('poll_id').value;
        loadPollResult(pollId);
    });
}

const btn_option = document.querySelector('.btn_option');
if (btn_option) {
    btn_option.addEventListener('click', function () {
        document.querySelector('.voting_result_section').classList.add('hidden');
        document.querySelector('.votiong_question').classList.remove('hidden');
    });
}