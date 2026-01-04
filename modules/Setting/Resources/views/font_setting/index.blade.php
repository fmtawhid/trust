@extends('setting::settings')
@section('title', localize('font_setting'))

@section('setting_content')
    <div class="body-content pt-0">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('font_manage') }}</h6>
                    </div>
                    <div class="text-end">
                        <div class="actions">
                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addNewFont"><i
                                    class="fa fa-plus-circle"></i>&nbsp;{{ localize('add_font') }}</a>
                            @include('setting::font_setting.font_create')
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- DataTable -->
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
