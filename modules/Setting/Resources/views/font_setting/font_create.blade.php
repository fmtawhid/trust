<!-- Modal -->
<div class="modal fade" id="addNewFont" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ localize('add_font') }}
                </h5>
                <div class="text-end">
                    <div class="actions">
                        <a href="https://fonts.google.com/" class="btn btn-link btn-sm" target="_blank"><i
                                class="fa fa-plus-circle"></i>&nbsp;{{ localize('google_fonts') }}</a>
                    </div>
                </div>
            </div>
            <form id="newFontForm" action="{{ route('admin.font.settings.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <label for="font_name"
                                    class="col-form-label col-md-2 fw-semibold">{{ localize('font_name') }}<span
                                        class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="font_name" name="font_name"
                                        value="{{ old('font_name') }}" placeholder="(E.g: Noto Serif Bengali)" required>
                                    <span class="text-danger error_font_name"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <label for="source_url"
                                    class="col-form-label col-md-2 fw-semibold">{{ localize('source_url') }}<span
                                        class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <textarea class="form-control" rows="4" name="source_url" id="source_url"
                                        placeholder="(E.g: https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&display=swap)"
                                        required></textarea>
                                    <span class="text-danger error_source_url"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <label for="font_family"
                                    class="col-form-label col-md-2 fw-semibold">{{ localize('font_family') }}<span
                                        class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="font_family" name="font_family"
                                        value="{{ old('font_family') }}"
                                        placeholder='(E.g: "Noto Serif Bengali", serif)' required>
                                    <span class="text-danger error_font_family"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">{{ localize('close') }}</button>
                    <button class="btn btn-primary" type="submit">{{ localize('save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
