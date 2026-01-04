@extends('backend.layouts.app')
@section('title', localize('photo_library'))
@push('css')
@endpush
@section('content')
@include('backend.layouts.common.validation')
@include('backend.layouts.common.message')
<div class="card mb-4">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('photo_library') }}</h6>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table_customize">
            {{ $dataTable->table() }}
        </div>
    </div>

</div>

@endsection
@push('js')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script>
    function fallbackCopyTextToClipboard(inputElement, btn, originalHtml) {
        inputElement.select();
        inputElement.setSelectionRange(0, 99999);

        try {
            const successful = document.execCommand('copy');
            if (successful) {
                btn.innerHTML = '<i class="fa fa-check"></i> Copied!';
                setTimeout(() => btn.innerHTML = originalHtml, 1200);
            } else {
                alert("কপি করা যায়নি! ব্রাউজারে অনুমতি দিন।");
                btn.innerHTML = originalHtml;
            }
        } catch (err) {
            console.error('Fallback copy failed:', err);
            btn.innerHTML = originalHtml;
        }
    }


    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.copy-btn');
        if (btn) {
            const targetId = btn.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const originalHtml = btn.innerHTML;

            if (input) {

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(input.value)
                        .then(() => {
                            btn.innerHTML = '<i class="fa fa-check"></i> Copied!';
                            setTimeout(() => btn.innerHTML = originalHtml, 1200);
                        })
                        .catch(err => {
                            console.error("Clipboard API failed, trying fallback.", err);

                            fallbackCopyTextToClipboard(input, btn, originalHtml);
                        });
                } else {

                    fallbackCopyTextToClipboard(input, btn, originalHtml);
                }
            }
        }
    });
</script>
@endpush