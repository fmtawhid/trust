@extends('backend.layouts.app')
@section('title', localize('maximum_archive_settings'))
@push('css')
@endpush
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('maximum_archive_settings') }}</h6>
                </div>
                <div class="text-end">
                    <div class="actions">
                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#instructionModal"><i class="fa fa-question-circle"></i></a>
                        @can('create_archive_setting')
                            <a href="#" class="btn btn-success btn-sm" onclick="addArchiveDetails()"><i
                                    class="fa fa-plus-circle"></i>&nbsp;{{ localize('add_new_category') }}</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="archiveDataUpdate" action="{{ route('archive.save_max_archive_settings') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="table_customize">

                    {{ $dataTable->table() }}

                </div>

                <br>
                <div class="text-end">
                    <button type="submit" id="submitBtnArchive"
                        class="btn btn-success me-2"></i>{{ localize('update') }}</button>
                </div>
            </form>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModalToArchiveNews" role="dialog" aria-labelledby="exampleModalLabel4"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title font-weight-600" id="myModalLabel">{{ localize('archive_news') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">

                    <div class="archive_status d-none">
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <i class="fa fa-check fa-2x text-left"></i>
                        </div>
                    </div>

                    <br>

                    <span id="processing"></span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped archive_process"
                            role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-lg a margin-top10"
                        id="start_archive">{{ localize('start_archive') }}</button>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger-soft me-2"
                        data-bs-dismiss="modal">{{ localize('close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="projectDetailsModal" aria-labelledby="archiveDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveDetailsModalLabel"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal">×</button>
                </div>
                <form id="projectDetailsForm" method="POST" enctype="multipart/form-data">
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


        <input type="hidden" id="archive_create" value="{{ route('archive.create') }}">
        <input type="hidden" id="archive_store" value="{{ route('archive.store') }}">
        <input type="hidden" id="lang_add_archive" value="{{ ucwords(localize('add_archive')) }}">
        <input type="hidden" id="lang_archive_news" value="{{ ucwords(localize('archive_news')) }}">

        <input type="hidden" id="archive_newses_by_category"
            value="{{ route('archive.archive_newses_by_category', ':cat_id_available') }}">

        <input type="hidden" id="get_data_table_id" value="archive-table">

    </div>

    <div class="modal fade" id="instructionModal" aria-labelledby="instructionModalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="instructionModalModalLabel">Important Notice: Archive Settings
                        Instructions</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <p><strong>Please read the following instructions carefully. Misunderstanding these settings may result
                            in all your news being archived permanently.
                        </strong></p>
                    <ul>
                        <li>
                            <p>When news is archived, it is moved from the <strong>Newspaper</strong> page to the
                                <strong>Archive</strong> page and <strong>cannot be
                                    restored.</strong>
                            </p>
                        </li>
                        <li>
                            <p><strong>Maximum News</strong>: This value determines the number of news items to keep active.
                                If set to 0, <strong>all
                                    news in the category will be archived.</strong></p>
                        </li>
                        <li>
                            <p><strong>Available for Archive</strong>: Only news in this column can be archived.</p>
                        </li>
                        <li>
                            <p>After setting a value in <strong>Maximum News</strong>, you <strong>must click the Update
                                    button</strong> to apply changes.</p>
                        </li>
                        <li>
                            <p>The total number of archive items will be calculated as:
                                <strong>Total News – Maximum News = Available for Archive</strong>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger-soft me-2"
                        data-bs-dismiss="modal">{{ localize('close') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script src="{{ module_asset('Archive/js/archive.js') }}"></script>
@endpush
