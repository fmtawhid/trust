<div class="card col-md-12 col-lg-2 setting_sidebar p-3">
    <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
        @can('read_software_setup')
            <li class="nav-item" role="presentation">
                <button class="nav-link w-100 px-2 collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseSoftSetup" aria-expanded="false" aria-controls="collapseSoftSetup">
                    <span>{{ localize('software_setup') }}</span><i class="ti-angle-up"></i>
                </button>
                <div class="collapse {{ request()->routeIs('applications.application') || request()->routeIs('social_api_keys.*') || request()->routeIs('app.index') || request()->routeIs('product.setting.product') || request()->routeIs('purchase.setting.purchase') || request()->routeIs('sale.terms.list') || request()->routeIs('sale.terms.add') || request()->routeIs('currencies.index') || request()->routeIs('currencies.create') || request()->routeIs('currencies.edit') || request()->routeIs('mails.index') || request()->routeIs('sms.index') || request()->routeIs('invoice.setting.index') || request()->routeIs('user-types.index') || request()->routeIs('password-settings.index') || request()->routeIs('tax-setup.index') || request()->routeIs('space-credential.index') ? 'show' : '' }}"
                    id="collapseSoftSetup">
                    <div class="card card-body pe-0 py-1 shadow-none">
                        <ul class="nav flex-column" role="tablist">

                            @can('read_application')
                                <li class="nav-item"><a
                                        class="nav-link w-100 {{ request()->routeIs('applications.application') ? 'active' : '' }}"
                                        href="{{ route('applications.application') }}">{{ localize('application') }}</a></li>
                            @endcan

                            @can('read_application')
                                <li class="nav-item"><a
                                        class="nav-link w-100 {{ request()->routeIs('social_api_keys.*') ? 'active' : '' }}"
                                        href="{{ route('social_api_keys.index') }}">{{ localize('social_api_setup') }}</a>
                                </li>
                            @endcan

                            @can('read_mail_setup')
                                <li class="nav-item"><a
                                        class="nav-link w-100 {{ request()->routeIs('mails.index') ? 'active' : '' }}"
                                        href="{{ route('mails.index') }}">{{ localize('mail_setup') }}</a></li>
                            @endcan
                            @can('read_mail_setup')
                                <li class="nav-item"><a
                                        class="nav-link w-100 {{ request()->routeIs('space-credential.index') ? 'active' : '' }}"
                                        href="{{ route('space-credential.index') }}">{{ localize('space_credential') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </div>
            </li>
        @endcan

        @can('read_user_management')
            <li class="nav-item" role="presentation">
                <button class="nav-link w-100 px-2 collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseUserManagement" aria-expanded="false" aria-controls="collapseUserManagement">
                    <span>{{ localize('user_management') }}</span><i class="ti-angle-up"></i>
                </button>
                <div class="collapse {{ request()->routeIs('role.user.list') || request()->routeIs('role.list') || request()->routeIs('role.edit') || request()->routeIs('role.add') || request()->routeIs('role.permission.list') || request()->routeIs('role.menu.list') ? 'show' : '' }}"
                    id="collapseUserManagement">
                    <div class="card card-body pe-0 py-1 shadow-none">
                        <ul class="nav flex-column" role="tablist">
                            @can('read_role_list')
                                <li class="nav-item"><a
                                        class="nav-link w-100 {{ request()->routeIs('role.list') || request()->routeIs('role.add') || request()->routeIs('role.edit') ? 'active' : '' }}"
                                        href="{{ route('role.list') }}">{{ localize('role_list') }}</a></li>
                            @endcan

                            @can('read_user_list')
                                <li class="nav-item">
                                    <a class="nav-link w-100 {{ request()->routeIs('role.user.list') ? 'active' : '' }}"
                                        href="{{ route('role.user.list') }}">{{ localize('user_list') }}</a>

                                </li>
                            @endcan
                        </ul>
                    </div>
                </div>
            </li>
        @endcan

        <li class="nav-item" role="presentation">
            <button class="nav-link w-100 px-2 collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFontSettings" aria-expanded="false" aria-controls="collapseFontSettings">
                <span>{{ localize('font_settings') }}</span><i class="ti-angle-up"></i>
            </button>
            <div class="collapse {{ request()->routeIs('admin.font.settings.*') || request()->routeIs('admin.font.site.setup.*') ? 'show' : '' }}"
                id="collapseFontSettings">
                <div class="card card-body pe-0 py-1 shadow-none">
                    <ul class="nav flex-column" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link w-100 {{ request()->routeIs('admin.font.settings.*') ? 'active' : '' }}"
                                href="{{ route('admin.font.settings.index') }}">{{ localize('font_manage') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link w-100 {{ request()->routeIs('admin.font.site.setup.*') ? 'active' : '' }}"
                                href="{{ route('admin.font.site.setup.index') }}">{{ localize('setup_font') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

        @can('read_language')
            @can('read_language_list')
                <li class="nav-item">
                    <a class="nav-link px-2 w-100 {{ request()->routeIs('setting.language.languagelist') || request()->routeIs('setting.language.languageStringValueindex') ? 'active' : '' }}"
                        href="{{ route('setting.language.languagelist') }}">{{ localize('language_setup') }}</a>
                </li>
            @endcan
        @endcan

        @can('read_backup_and_reset')
            <li class="nav-item">
                <a class="nav-link px-2 w-100 {{ request()->routeIs('backup.index') ? 'active' : '' }}"
                    href="{{ route('backup.index') }}">{{ localize('backup_reset') }}</a>
            </li>
        @endcan

        @can('read_access_log')
            <li class="nav-item">
                <a class="nav-link px-2 w-100 {{ request()->routeIs('activity_log') ? 'active' : '' }}"
                    href="{{ route('activity_log') }}">{{ localize('access_log') }}</a>
            </li>
        @endcan

        @can('read_cookie_content')
            <li class="nav-item">
                <a class="nav-link px-2 w-100 {{ request()->routeIs('cookie.content') ? 'active' : '' }}"
                    href="{{ route('cookie.content') }}">{{ localize('cookie_content') }}</a>
            </li>
        @endcan

        @can('read_google_recaptcha')
            <li class="nav-item">
                <a class="nav-link px-2 w-100 {{ request()->routeIs('google.recaptcha') ? 'active' : '' }}"
                    href="{{ route('google.recaptcha') }}">{{ localize('google_recaptcha') }}</a>
            </li>
        @endcan

    </ul>
</div>
