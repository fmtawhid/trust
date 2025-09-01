@extends('setting::settings')
@section('title', localize('backup_reset'))
@push('css')
    <link rel="stylesheet" href="{{ module_asset('Setting/css/database-backup-modal.css') }}">
@endpush
@section('setting_content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')

    <div class="card mb-4 border">
        <div class="card-header py-3">
            <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('database_backup') }}</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12 d-flex gap-2">
                    @can('create_factory_reset')
                        <button type="button" id="database_backup_button"
                            class="btn btn-success">{{ localize('backup_database') }}</button>
                        <form id="database_backup" action="{{ route('backup.create') }}" method="POST">
                            @csrf
                        </form>

                        <button id="openImportModalBtn" class="btn btn-primary capitalize">{{ localize('import_demo_data') }}</button>
                    @endcan
                </div>
                
                <div class="col-md-12 mt-5">
                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped table-hover" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th>{{ localize('sl') }}</th>
                                    <th>{{ localize('name') }}</th>
                                    <th>{{ localize('disk') }}</th>
                                    <th>{{ localize('size') }}</th>
                                    <th>{{ localize('last_modified') }}</th>
                                    <th>{{ localize('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $si = 1;
                                @endphp
                                @foreach ($disks as $disk)
                                    @foreach ($disk as $key => $file)
                                        <tr>
                                            <td>{{ $si }} </td>
                                            <td>{{ $file['name'] }}</td>
                                            <td>{{ $file['disk'] }}</td>
                                            <td>{{ size_convert($file['size']) }}</td>
                                            <td>{{ $file['last_modified'] }}</td>
                                            <td>

                                                <a href="{{ route('backup.download', ['disk' => $file['disk'], 'url' => $file['url']]) }}"
                                                    target="_blank" class="btn btn-success-soft btn-sm" title="Download">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger-soft btn-sm delete-confirm"
                                                    data-bs-toggle="tooltip" title="Delete"
                                                    data-route="{{ route('backup.delete', ['disk' => $file['disk'], 'url' => $file['url']]) }}"
                                                    data-csrf="{{ csrf_token() }}"><i class="fa fa-trash"></i>
                                                </a>
                                                @include('setting::backup.modal')
                                            </td>
                                        </tr>

                                        @php
                                            $si++;
                                        @endphp
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Database Reset -->
    <div class="modal fade" id="passwordEnter" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="passwordEnterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="factory_reset" action="{{ route('backup.factory_reset') }}" method="POST">
                    @csrf

                    <div class="modal-body p-4">
                        <label for="password1" class="form-label">{{ localize('enter_your_password') }}</label>
                        <input type="password" class="form-control" id="password1"
                            placeholder="{{ localize('enter_password') }}">
                        <span class="text-danger" id="passwordError"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ localize('close') }}</button>
                        @can('create_factory_reset')
                            <button type="button" class="btn btn-success submit_button">{{ localize('confirm') }}</button>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Database Import Password Check -->
    <div class="modal fade" id="passwordEnterForImportDatabase" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="forImportDatabase" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="password_check" action="{{ route('backup.password_check') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <label for="password2" class="form-label">{{ localize('enter_your_password') }}</label>
                        <input type="password" class="form-control" id="password2"
                            placeholder="{{ localize('enter_password') }}">
                        <span class="text-danger" id="passwordErrorForImportDatabase"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ localize('close') }}</button>
                        @can('create_factory_reset')
                            <button type="button" class="btn btn-success submit_button"
                                onclick="passwordCheckButton()">{{ localize('confirm') }}</button>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="database_backup_modal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-lg">
                <div class="modal-body">
                    <div class='loading-wrapper'>
                        <div class="processing">{{ localize('backup_processing') }}
                            <svg>
                                <rect x="1" y="1"></rect>
                            </svg>
                        </div>
                    </div>
                    <p class="processing-p">{{ localize('backup_processing_note') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="database_import_modal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-lg">
                <div class="modal-body">
                    <div class='loading-wrapper'>
                        <div class="processing">{{ localize('import_processing') }}
                            <svg>
                                <rect x="1" y="1"></rect>
                            </svg>
                        </div>
                    </div>
                    <p class="processing-p">{{ localize('import_processing_note') }}</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="importDemoModal" tabindex="-1" aria-labelledby="importDemoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importDemoModalLabel">{{ localize('import_demo_data') }}</h5>
                <button type="button" class="btn-close" id="modalCloseBtnTop" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="alert alert-info mt-3" role="alert" id="backendCredentialsInfo">
                    <strong>{{ localize('note') }}:</strong> {{ localize('after_demo_import_your_backend_login_credentials_will_change_to') }}:<br>
                    <strong>{{ localize('user') }}:</strong> admin@bdtask.com<br>
                    <strong>{{ localize('password') }}:</strong> 123456
                </div>

                <div class="progress mb-3">
                <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
                <div id="progressLog" style="height: 200px; overflow-y: auto; background: #f8f9fa; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                <p class="text-muted">Press "Start Import" to begin...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button id="startImportBtn" type="button" class="btn btn-success capitalize">{{ localize('start_import') }}</button>
                <button id="cancelImportBtn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ localize('close') }}</button>
                <div id="afterCompleteBtns" class="d-none ms-auto">
                <button id="visitSiteBtn" type="button" class="btn btn-primary capitalize">{{ localize('visit_site') }}</button>
                <button id="modalCloseBtn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ localize('close') }}</button>
                </div>
            </div>
            </div>
        </div>
    </div>


@endsection
@push('js')
    <script src="{{ module_asset('Setting/js/backup_reset.js?v_' . date('h_i')) }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openModalBtn = document.getElementById('openImportModalBtn');
        const importModal = new bootstrap.Modal(document.getElementById('importDemoModal'));
        const progressLog = document.getElementById('progressLog');
        const startImportBtn = document.getElementById('startImportBtn');
        const cancelImportBtn = document.getElementById('cancelImportBtn');
        const afterCompleteBtns = document.getElementById('afterCompleteBtns');
        const visitSiteBtn = document.getElementById('visitSiteBtn');
        const modalCloseBtn = document.getElementById('modalCloseBtn');
        const modalCloseBtnTop = document.getElementById('modalCloseBtnTop');
        const progressBar = document.getElementById('progressBar');

        const steps = [
            "🚀 Starting demo data restoration process...",
            "🔄 Seeding demo database tables...",
            "✅ Database seeding completed.",
            "📂 Copying asset folders...",
            "✅ Folder copied: images",
            "✅ Folder copied: videonews",
            "✅ Folder copied: opinion",
            "✅ Folder copied: ad_image",
            "🔁 Refreshing symbolic storage link...",
            "🔗 Storage link refreshed.",
            "🎉 Demo restoration process complete!"
        ];

        openModalBtn.addEventListener('click', () => {
            Swal.fire({
                title: 'Are you sure?',
                html: `
                <p><strong>Importing demo data will <u>delete your existing data permanently</u>.</strong></p>
                <p>This action cannot be undone!</p>
                <p>After import, your backend login credentials will be:</p>
                <ul style="text-align: left; margin-top: 10px;">
                    <li><strong>User:</strong> admin@bdtask.com</li>
                    <li><strong>Password:</strong> 123456</li>
                </ul>
                <p>Do you want to proceed?</p>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Start Import!',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    resetModal();
                    importModal.show();
                }
            });
        });

        function appendLog(message, type = 'dark') {
            const p = document.createElement('p');
            p.classList.add('mb-1', `text-${type}`);
            p.textContent = message;
            progressLog.appendChild(p);
            progressLog.scrollTop = progressLog.scrollHeight;
        }

        function resetModal() {
            progressLog.innerHTML = '<p class="text-muted">Press "Start Import" to begin...</p>';
            progressBar.style.width = '0%';
            progressBar.textContent = '0%';
            startImportBtn.disabled = false;
            cancelImportBtn.disabled = false;
            afterCompleteBtns.classList.add('d-none');
            startImportBtn.classList.remove('d-none');
            cancelImportBtn.classList.remove('d-none');
        }

        async function runSteps() {
            const totalSteps = steps.length;
            for (let i = 0; i < totalSteps; i++) {
                const msg = steps[i];
                let type = 'dark';
                if (msg.includes('❌')) type = 'danger';
                else if (msg.includes('✅') || msg.includes('🎉')) type = 'success';

                appendLog(msg, type);

                const percent = Math.round(((i + 1) / totalSteps) * 100);
                progressBar.style.width = percent + '%';
                progressBar.textContent = percent + '%';

                await new Promise(resolve => setTimeout(resolve, 700)); // Wait 700ms between steps
            }
        }

        startImportBtn.addEventListener('click', async () => {
            startImportBtn.disabled = true;
            cancelImportBtn.disabled = true;
            progressLog.innerHTML = '';
            progressBar.style.width = '0%';
            progressBar.textContent = '0%';

            // First show progress steps visually
            await runSteps();

            // Then call the actual restore API
            appendLog('⏳ Calling server to restore demo data...', 'info');

            fetch('{{ route("backup.demo.restore.ajax") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data.messages)) {
                    data.messages.forEach(msg => {
                        let type = 'dark';
                        if (msg.includes('❌')) type = 'danger';
                        else if (msg.includes('✅') || msg.includes('🎉')) type = 'success';
                        appendLog(msg, type);
                    });
                }
                appendLog('🎉 Demo restoration complete!', 'success');

                // Show after complete buttons & hide start/cancel
                afterCompleteBtns.classList.remove('d-none');
                startImportBtn.classList.add('d-none');
                cancelImportBtn.classList.add('d-none');
            })
            .catch(err => {
                appendLog('❌ Error occurred while restoring demo.', 'danger');
                startImportBtn.disabled = false;
                cancelImportBtn.disabled = false;
                console.error(err);
            });
        });

        visitSiteBtn.addEventListener('click', () => {
            window.open('{{ url('/') }}', '_blank');
        });

        modalCloseBtn.addEventListener('click', resetModal);
        modalCloseBtnTop.addEventListener('click', resetModal);
    });

</script>
@endpush
