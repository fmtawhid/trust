@extends('setting::settings')
@section('title', localize('language_list'))
@section('setting_content')
    <div class="body-content pt-0">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('language_list') }}</h6>
                            </div>
                            <div class="text-end">
                                @can('read_add_language')
                                    <div class="actions">
                                        @can('create_language_list')
                                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#addLanguage"><i
                                                    class="fa-sharp fa-solid fa-circle-plus"></i>&nbsp;{{ localize('Add Language') }}</a>
                                            @include('localize::lang.languageAdd')
                                        @endcan
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example"
                                class="table display table-bordered table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th width="10%">Sl</th>
                                        <th width="20%">{{ localize('name') }}</th>
                                        <th width="20%">{{ localize('code') }}</th>
                                        <th width="10%">{{ localize('status') }}</th>
                                        <th width="10%">{{ localize('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($languageList as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $data->langname }}</td>
                                            <td>{{ $data->value }}</td>
                                            <td>
                                                @if (app_setting()->language_id != $data->id)
                                                    @if ($data->status === 1)
                                                        <a href="javascript:void(0)" 
                                                            class="btn btn-sm btn-success update-language-status"
                                                            data-bs-toggle="tooltip" 
                                                            title="Update"
                                                            data-route="{{ route('setting.language.langUpdate', $data->id) }}"
                                                            data-csrf="{{ csrf_token() }}">
                                                            <i class="hvr-buzz-out far fa-check-circle"></i>
                                                        </a>

                                                    @else
                                                        <a href="javascript:void(0)" 
                                                            class="btn btn-sm btn-danger update-language-status"
                                                            data-bs-toggle="tooltip" 
                                                            title="Update"
                                                            data-route="{{ route('setting.language.langUpdate', $data->id) }}"
                                                            data-csrf="{{ csrf_token() }}">
                                                            <i class="hvr-buzz-out far fa-times-circle"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    <span class="btn btn-sm btn-success-soft cursor-default">
                                                        <i class="hvr-buzz-out far fa-check-circle"></i> 
                                                        {{ localize('default') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a title="Edit"
                                                    href="{{ route('setting.language.languageStringValueindex', $data->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    {{ localize('String') }} <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $languageList->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ module_asset('Localize/js/lang.js') }}"></script>
@endpush
