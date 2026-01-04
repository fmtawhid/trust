@extends('backend.layouts.app')
@section('title', localize('subscribers'))
@push('css')
@endpush
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('subscribers') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table_customize">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    <input type="hidden" id="get_data_table_id" value="subscribers-table">

@endsection
@push('js')

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
