@extends('backend.layouts.app')
@section('title', 'Update Guides')
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')

    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">Update Guides</h6>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8">
                    <div class="alert alert-info mb-4">
                        <strong>How to Update:</strong> This documentation provides step-by-step instructions on how to
                        update your application to the latest version. The update process is straightforward and easy to
                        follow.
                    </div>
                    <div class="alert alert-warning mb-4">
                        <strong>Important:</strong> If you have missed an update or multiple updates, you must update your
                        site version by version manually. <br>
                        <b>Please do not skip any version.</b><br>
                        <em>Example:</em> If your application is on <b>v7.0.0</b> and you want to update to <b>v7.1.2</b>,
                        you must update to <b>v7.1</b>, then <b>v7.1.1</b>, and finally <b>v7.1.2</b>.
                    </div>
                    <div class="alert alert-danger mb-4">
                        <strong>Important!</strong> Please note that you may lose any custom work you have done on the code
                        if you update your script. Contact your developer to update your application without losing any
                        custom
                        features.
                    </div>
                    <h5 class="mb-3">Update Instructions</h5>
                    <ul>
                        <li>First, download the latest version from your <strong>CodeCanyon <a
                                    class="text-decoration-underline" href="https://codecanyon.net/downloads"
                                    target="_blank">Downloads</a></strong> page.</li>
                        <li>Backup your database and all application files before proceeding.</li>
                        <li>
                            After downloading from CodeCanyon, unzip the package on your local PC and navigate to
                            <code>storage/app/versions</code>
                            There you will find multiple version zip files. Choose the zip file for the version you want to
                            update to, upload it to your main project root folder, and unzip/extract it. This will
                            automatically
                            replace all necessary files. Once the process is finished, you can delete the zip file.
                        </li>
                        <li>
                            Now hit the URL <code>yourdomain/latest/update</code> to migrate databases.<br>
                            If you face any issues with the URL, please run all migrations manually.
                        </li>
                        <li>
                            Or run all required commands manually in your server terminal:<br>
                            <code>php artisan migrate</code><br>
                            Clear the application cache: <code>php artisan cache:clear</code> &amp; <code>php artisan
                                optimize:clear</code><br>
                            <code>composer update</code><br>
                            <small>
                                <strong>Note:</strong> Run <code>composer update</code> in your project root directory. This
                                command will update all PHP dependencies as defined in your <code>composer.json</code> file.
                                Make sure Composer is installed on your server. If you encounter any issues, check for
                                permission errors or missing PHP
                        <li>Review your configuration settings and update them as needed.</li>
                        <li>
                            <strong>Successfully Completed:</strong> Once you have finished all the above steps, your
                            website update process is complete. Your application should now be running the latest version.
                        </li>
                    </ul>
                    <hr>
                    <div class="accordion mt-4" id="changelogAccordion">
                        {{-- Version 7.0.2 --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-702">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-702" aria-expanded="true" aria-controls="collapse-702">
                                    <h6 class="mb-0">Version: <span class="badge bg-success">v7.0.2</span></h6>
                                </button>
                            </h2>
                            <div id="collapse-702" class="accordion-collapse collapse show" aria-labelledby="heading-702" data-bs-parent="#changelogAccordion">
                                <div class="accordion-body">
                                    <h6>Changelog:</h6>
                                    <ul>
                                        <li>Integrated Google reCAPTCHA v3 in user registration for enhanced security.</li>
                                        <li>Added support for running the application in single-language mode.</li>
                                        <li>Fixed several bugs in both the website and backend system.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Version 7.0.1 --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-701">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-701" aria-expanded="false" aria-controls="collapse-701">
                                    <h6 class="mb-0">Version: <span class="badge bg-primary">v7.0.1</span></h6>
                                </button>
                            </h2>
                            <div id="collapse-701" class="accordion-collapse collapse" aria-labelledby="heading-701" data-bs-parent="#changelogAccordion">
                                <div class="accordion-body">
                                    <h6>Changelog:</h6>
                                    <ul>
                                        <li>Added new modules for social media auto posting (Facebook, Twitter).</li>
                                        <li>Implemented cookie accept policy for enhanced user privacy.</li>
                                        <li>Introduced bulk post upload functionality.</li>
                                        <li>Updated and improved guides section.</li>
                                        <li>Resolved language slug bug issue.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    @endsection
