@extends('backend.layouts.app')
@section('title', localize('opinions'))
@push('css')
    
@endpush
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('opinions') }}</h6>
                </div>
                <div class="text-end">
                    <div class="actions">
                        @can('create_opinion')
                            <a href="{{ route('opinion.create') }}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus-circle"></i>&nbsp;{{ localize('add_new_opinion') }}
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

    <input type="hidden" id="get_data_table_id" value="opinion-table">

@endsection
@push('js')

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script src="{{ module_asset('Opinion/js/opinion_list.js') }}"></script>
    
@endpush
