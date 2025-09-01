<div class="row ps-4 pe-4">
    <div class="col-md-12">

        <div class="row mt-3">
            <h4 class="card-title fw-bold">{{ $poll->question }}</h4>
            <p class="mt-2">{{ localize('total_votes') }}:<strong> {{ $totalVotes }}</strong></p>
        </div>

        <div class="row mt-3">
            
            @foreach ($poll->options as $option)
                @php
                    $percentage = $totalVotes > 0 ? ($option->total_vote / $totalVotes) * 100 : 0;
                @endphp

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>{{ $option->name }}</span>
                        <span>{{ number_format($percentage, 2) }}%</span>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $option->total_vote }}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>