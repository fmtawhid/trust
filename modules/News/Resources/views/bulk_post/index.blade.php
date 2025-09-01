@extends('backend.layouts.app')
@section('title', localize('bulk_post_upload'))
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')

    @if (session('downloadLink'))
        <div class="mt-3 mb-3 alert alert-danger fade show" role="alert">
            Some rows were skipped due to missing required fields.
            <a href="{{ session('downloadLink') }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                Download Skipped CSV
            </a>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('bulk_post_upload') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-5">
                    <form action="{{ route('bulk.post.upload.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">{{ localize('upload_csv_file') }}</label>
                            <input type="file" class="form-control" id="upload_file" name="upload_file" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ localize('upload') }}</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <h4 class="text-capitalize">{{ localize('help_guide') }}</h4>
                    <p>These documents can assist you in generating your CSV file.</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-secondary btn-lg" data-bs-toggle="modal"
                            data-bs-target="#csvInstructionModal">
                            📘 Instructions
                        </button>
                        <button class="btn btn-outline-primary btn-lg" data-bs-toggle="modal"
                            data-bs-target="#essentialIdentifierModal">
                            🈯 Essential Identifier List
                        </button>
                        <a href="{{ asset('backend/docs/bulk_post_template.csv') }}" class="btn btn-outline-success btn-lg"
                            download="bulk_post_template.csv" target="_blank">
                            📄 Download Template CSV File
                        </a>
                        <a href="{{ asset('backend/docs/bulk_post_sample.csv') }}" class="btn btn-outline-info btn-lg"
                            download="bulk_post_sample.csv" target="_blank">
                            📊 Download Sample CSV File
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="csvInstructionModal" tabindex="-1" aria-labelledby="csvInstructionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="csvInstructionModalLabel"> Instructions </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Follow these steps to create your CSV file:</p>
                            <ol>
                                <li>Download the template CSV file provided below.</li>
                                <li>Fill in the required fields as per the instructions.</li>
                                <li>Ensure that all mandatory fields are completed.</li>
                                <li>Save the file in CSV format.</li>
                                <li>Upload the completed CSV file using the form below.</li>
                            </ol>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Field</th>
                                            <th>Description</th>
                                            <th>Example</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>language_id</td>
                                            <td><strong>Required</strong><br>Data Type: Integer</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>category_id</td>
                                            <td><strong>Required</strong><br>Data Type: Integer</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>sub_category_id</td>
                                            <td><strong>Optional</strong> <span class="fs-12">(The sub_category_id must be
                                                    provided when a
                                                    category_id is set, and it must correspond to a subcategory of the
                                                    selected
                                                    category.)</span><br>Data Type: Integer</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>category_position</td>
                                            <td><strong>Optional</strong> <span class="fs-12">(The category_position must
                                                    be an integer ranging from <b>1</b> to <b>16</b>.)</span><br>Data Type:
                                                Integer
                                            </td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>home_position</td>
                                            <td><strong>Optional</strong> <span class="fs-12">(The home_position must
                                                    be an integer ranging from <b>1</b> to <b>7</b>.)</span><br>Data Type:
                                                Integer
                                            </td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>publish_date</td>
                                            <td><strong>Required</strong><br>Data Type: Date</td>
                                            <td>2025-07-24</td>
                                        </tr>
                                        <tr>
                                            <td>short_head</td>
                                            <td><strong>Optional</strong><br>Data Type: String</td>
                                            <td>This is post short head</td>
                                        </tr>
                                        <tr>
                                            <td>head_line</td>
                                            <td><strong>Required</strong><br>Data Type: String</td>
                                            <td>This is post head line</td>
                                        </tr>
                                        <tr>
                                            <td>details_post</td>
                                            <td><strong>Required</strong><br>Data Type: String</td>
                                            <td>This is post details</td>
                                        </tr>
                                        <tr>
                                            <td>image</td>
                                            <td><strong>Optional</strong> <span class="fs-12">(In your application,
                                                    navigate to Media Library > Photo List, copy the Image name, and use it
                                                    here.)</span><br>Data Type: String
                                            </td>
                                            <td>zh9QfWdcS6Lz46jAhu7dvaXCuEjtwXmJlIqGF3Zw.jpg</td>
                                        </tr>
                                        <tr>
                                            <td>image_alt</td>
                                            <td><strong>Optional</strong><br>Data Type: String
                                            </td>
                                            <td>Image alt text</td>
                                        </tr>
                                        <tr>
                                            <td>image_title</td>
                                            <td><strong>Optional</strong><br>Data Type: String
                                            </td>
                                            <td>Image title</td>
                                        </tr>
                                        <tr>
                                            <td>custom_url</td>
                                            <td><strong>Optional</strong> <span class="fs-12">(This field will be
                                                    auto-generated if no value is entered.)</span><br>Data Type: String
                                            </td>
                                            <td>test-custom-url</td>
                                        </tr>
                                        <tr>
                                            <td>seo_title</td>
                                            <td><strong>Optional</strong><br>Data Type: String</td>
                                            <td>Test seo title</td>
                                        </tr>
                                        <tr>
                                            <td>reporter_id</td>
                                            <td><strong>Required</strong><br>Data Type: Integer</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>reporter_message</td>
                                            <td><strong>Optional</strong><br>Data Type: String</td>
                                            <td>Test reporter message</td>
                                        </tr>
                                        <tr>
                                            <td>video_url</td>
                                            <td><strong>Optional</strong><br>Data Type: String</td>
                                            <td>https://example.com/video.mp4</td>
                                        </tr>
                                        <tr>
                                            <td>reference</td>
                                            <td><strong>Optional</strong><br>Data Type: String</td>
                                            <td>Test reference</td>
                                        </tr>
                                        <tr>
                                            <td>post_tag</td>
                                            <td><strong>Optional</strong><br>Data Type: String</td>
                                            <td>Tag,Tag2,Tag3</td>
                                        </tr>
                                        <tr>
                                            <td>meta_keyword</td>
                                            <td><strong>Optional</strong><br>Data Type: String</td>
                                            <td>Keyword1,Keyword2</td>
                                        </tr>
                                        <tr>
                                            <td>meta_description</td>
                                            <td><strong>Optional</strong><br>Data Type: String</td>
                                            <td>This is meta description</td>
                                        </tr>
                                        <tr>
                                            <td>latest_post</td>
                                            <td><strong>Optional</strong><br>Data Type: Boolean</td>
                                            <td><b>0</b> or <b>1</b></td>
                                        </tr>
                                        <tr>
                                            <td>breaking_post</td>
                                            <td><strong>Optional</strong><br>Data Type: Boolean</td>
                                            <td><b>0</b> or <b>1</b></td>
                                        </tr>
                                        <tr>
                                            <td>feature_post</td>
                                            <td><strong>Optional</strong><br>Data Type: Boolean</td>
                                            <td><b>0</b> or <b>1</b></td>
                                        </tr>
                                        <tr>
                                            <td>recommanded_post</td>
                                            <td><strong>Optional</strong><br>Data Type: Boolean</td>
                                            <td><b>0</b> or <b>1</b></td>
                                        </tr>
                                        <tr>
                                            <td>status</td>
                                            <td><strong>Optional</strong><br>Data Type: Boolean</td>
                                            <td><b>0</b> or <b>1</b></td>
                                        </tr>
                                        <tr>
                                            <td>schema_setup</td>
                                            <td><strong>Optional</strong><br>Data Type: Boolean</td>
                                            <td><b>0</b> or <b>1</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p>Make sure to follow the instructions carefully to avoid any errors during the upload
                                    process.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="essentialIdentifierModal" tabindex="-1" aria-labelledby="essentialIdentifierModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="essentialIdentifierModalLabel"> Essential Identifiers </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>These identifiers are essential for the bulk post upload process:</p>
                            <ul>
                                <li><strong>language_id</strong> The ID of the language in which the post is written.</li>
                                <li><strong>category_id</strong> The ID of the category to which the post belongs.</li>
                                <li><strong>reporter_id</strong> The ID of the reporter associated with the post.</li>
                            </ul>
                            <p>Ensure that you use the correct IDs for the language, category, and reporter to avoid any
                                issues during the upload process.</p>
                            <p>The data format below is: <strong>ID &ndash; Name</strong></p>
                        </div>
                        <div class="col-md-5">
                            <strong>Reporter List</strong>
                            <ul>
                                @foreach ($reporters as $reporter)
                                    <li>{{ $reporter->id }} - {{ $reporter->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-7">
                            <strong>Category List</strong><br>
                            @foreach ($languages as $language)
                                <ul>
                                    <li>{{ $language->id }} - {{ $language->langname }}</li>
                                    <ul>
                                        @foreach ($language->category as $category)
                                            <li>{{ $category->id }} - {{ $category->category_name }}</li>
                                            @if ($category->children->isNotEmpty())
                                                <ul>
                                                    @foreach ($category->children as $child)
                                                        <li>{{ $child->id }} - {{ $child->category_name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </ul>
                                </ul>
                            @endforeach
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    @endsection
