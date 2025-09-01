@extends('backend.layouts.app')
@section('title', localize('polls'))
@push('css')
    <link href="{{ asset('backend/assets/plugins/Bootstrap-5-Tag-Input/tagsinput.css') }}" rel="stylesheet">
@endpush
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('polls') }}</h6>
                </div>
                <div class="text-end">
                    <div class="actions">
                        @can('create_poll')
                            <a href="#" class="btn btn-success btn-sm" onclick="addPollDetails()">
                                <i class="fa fa-plus-circle"></i>&nbsp;{{ localize('new_poll') }}
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table_customize">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="opinionDetailsModal" aria-labelledby="opinionDetailsModalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="opinionDetailsModalModalLabel"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal">×</button>
                </div>
                <form id="opinionDetailsModalForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger-soft me-2"
                            data-bs-dismiss="modal">{{ localize('close') }}</button>
                        <button type="submit" class="btn btn-success me-2"></i>{{ localize('save') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <input type="hidden" id="poll_create" value="{{ route('poll.create') }}">
        <input type="hidden" id="poll_store" value="{{ route('poll.store') }}">
        <input type="hidden" id="lang_add_poll" value="{{ ucwords(localize('add_poll')) }}">

        <input type="hidden" id="poll_edit" value="{{ route('poll.edit', ':poll') }}">
        <input type="hidden" id="poll_update" value="{{ route('poll.update', ':poll') }}">
        <input type="hidden" id="lang_update_poll" value="{{ ucwords(localize('update_poll')) }}">

        <input type="hidden" id="get_data_table_id" value="poll-table">

    </div>

    <!-- Result Modal -->
    <div class="modal fade" id="pollResultModal" aria-labelledby="pollResultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pollResultModalLabel">{{ localize('poll_result') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">×</button>
                </div>
                <div class="result-modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger-soft me-2" data-bs-dismiss="modal">{{ localize('close') }}</button>
                </div>
            </div>
        </div>

        <input type="hidden" id="poll_result" value="{{ route('poll.result', ':poll') }}">
    </div>

@endsection
@push('js')

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script src="{{ module_asset('Poll/js/poll.js') }}"></script>

@endpush
