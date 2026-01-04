<!-- Sidebar  -->
<nav class="sidebar sidebar-bunker">
    <div class="sidebar-header">
        <a href="{{ route('home') }}" class="sidebar-brand w-100">
            <img class="sidebar-logo sidebar_brand_icon w-100"
                src="{{ app_setting()->sidebar_logo ?? asset('assets/logo.png') }}" alt="{{ localize('logo') }}">
            <img class="collapsed-logo" src="{{ app_setting()->sidebar_collapsed_logo ?? asset('assets/mini-logo.png') }}"
                alt="{{ localize('logo') }}">
        </a>
    </div>
    <!--/.sidebar header-->
    <div class="sidebar-body">
        <div class="search sidebar-form">
            <div class="search__inner sidebar-search">
                <input id="search" type="text" class="form-control search__text" placeholder="Menu Search..."
                    autocomplete="off">
                {{-- <i class="typcn typcn-zoom-outline search__helper" data-sa-action="search-close"></i> --}}
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul class="metismenu">
                @can('read_dashboard')
                    <li class="{{ request()->is('admin/dashboard') ? 'mm-active' : '' }}">
                        <a href="{{ route('home') }}">
                            <i class="fa fa-home"></i>
                            <span>{{ localize('dashboard') }}</span>
                        </a>
                    </li>
                @endcan

                @can('read_theme')
                    <li class="{{ request()->is('admin/theme') ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.theme.index') }}">
                            <i class="fa fa-server"></i>
                            <span>{{ localize('theme') }}</span>
                        </a>
                    </li>
                @endcan

                @canany(['create_news', 'read_news'])
                    <li class="{{ request()->is('admin/news*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-th-list"></i>
                            <span> {{ localize_uc('post') }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/news*') ? 'mm-show' : '' }}">
                            @can('create_news')
                                <li
                                    class="{{ request()->routeIs('news.create') || request()->routeIs('news.edit') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('news.create') }}">{{ localize_uc('add_post') }}</a>
                                </li>
                            @endcan
                            @can('read_news')
                                <li class="{{ request()->routeIs('news.index') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('news.index') }}">{{ localize_uc('post_list') }}</a>
                                </li>
                            @endcan

                            @can('create_news')
                                <li class="{{ request()->routeIs('bulk.post.upload*') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('bulk.post.upload.index') }}">{{ localize_uc('bulk_post_upload') }}</a>
                                </li>
                            @endcan

                            @can('read_breaking_news')
                                <li class="{{ request()->routeIs('news.breaking-news.index') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('news.breaking-news.index') }}">{{ localize_uc('breaking_post') }}</a>
                                </li>
                            @endcan

                            @can('read_story')
                                <li class="{{ request()->is('admin/story') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('admin.story.index') }}">{{ localize('story_manage') }}</a>
                                </li>
                            @endcan

                            @can('read_comment')
                                <li class="{{ request()->routeIs('comments.comments_manage') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('comments.comments_manage') }}">{{ localize_uc('post_comments') }}</a>
                                </li>
                            @endcan

                            {{-- @can('read_post')
                                <li class="{{ request()->routeIs('news.post.*') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('news.post.create') }}">{{ localize_uc('photo_post') }}</a>
                                </li>
                            @endcan --}}

                            {{-- @can('read_positioning')
                                <li class="{{ request()->routeIs('news.position.index') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('news.position.index') }}">{{ localize_uc('positioning') }}</a>
                                </li>
                            @endcan --}}

                        </ul>
                    </li>
                @endcan

                @canany(['create_media_library', 'read_media_library'])
                    <li class="{{ request()->is('admin/photo-library*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-film"></i>
                            <span> {{ localize_uc('media_library') }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/photo-library*') ? 'mm-show' : '' }}">
                            @can('create_media_library')
                                <li class="{{ request()->routeIs('photo-library.create') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('photo-library.create') }}">{{ localize_uc('photo_upload') }}</a>
                                </li>
                            @endcan
                            @can('read_photo_list')
                                <li class="{{ request()->routeIs('photo-library.index') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('photo-library.index') }}">{{ localize_uc('photo_list') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @canany(['read_menu_setup'])
                    <li class="{{ request()->is('admin/menu*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fas fa-gift"></i>
                            <span> {{ localize_uc('menu') }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/menu*') ? 'mm-show' : '' }}">
                            @can('read_menu_setup')
                                <li class="{{ request()->routeIs('menu.index') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('menu.index') }}">{{ localize_uc('menu_list') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan


                <li class="{{ request()->is('admin/ai*') ? 'mm-active' : '' }}">
                    <a class="has-arrow material-ripple" href="#">
                        <i class="fas fa-brain"></i>
                        <span>{{ localize_uc('ai_writer') }}</span>
                    </a>
                    <ul class="nav-second-level {{ request()->is('admin/ai*') ? 'mm-show' : '' }}">
                        <li class="{{ request()->routeIs('ai.ai_settings*') ? 'mm-active' : '' }}">
                            <a class="dropdown-item"
                                href="{{ route('ai.ai_settings') }}">{{ localize_uc('ai_settings') }}</a>
                        </li>
                    </ul>
                </li>



                @can('read_category')
                    <li class="{{ request()->is('admin/category*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-tags"></i>
                            <span> {{ localize('categories') }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/category*') ? 'mm-show' : '' }}">
                            <li class="{{ request()->is('admin/category/list_of_categories') ? 'mm-active' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('category.index') }}">{{ ucwords(localize('category_list')) }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('read_archive_setting')
                    <li class="{{ request()->is('admin/archive*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-archive"></i>
                            <span> {{ ucwords(localize('archive')) }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/archive*') ? 'mm-show' : '' }}">
                            <li
                                class="{{ request()->is('admin/archive/maximum_archive_settings_view') ? 'mm-active' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('archive.index') }}">{{ ucwords(localize('archive_setting')) }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('read_advertise')
                    <li class="{{ request()->is('admin/advertise*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-volume-up"></i>
                            <span> {{ localize('advertisement') }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/advertise*') ? 'mm-show' : '' }}">
                            <li class="{{ request()->is('admin/advertise/view_ads') ? 'mm-active' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('advertise.index') }}">{{ ucwords(localize('advertisement_list')) }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('read_rss_feeds')
                    <li class="{{ request()->is('admin/rss_feeds*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-rss"></i>
                            <span> {{ ucwords(localize('rss_feeds')) }}</span>
                        </a>

                        @can('read_rss_sitemap_link')
                            <ul class="nav-second-level {{ request()->is('admin/rss_feeds*') ? 'mm-show' : '' }}">
                                <li class="{{ request()->is('admin/rss_feeds/rss-links') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('rss_feeds.index') }}">{{ localize('rss_links') }}</a>
                                </li>
                            </ul>
                        @endcan

                        @can('read_external_rss_feeds')
                            <ul class="nav-second-level {{ request()->is('admin/external_rss_feeds*') ? 'mm-show' : '' }}">
                                <li class="{{ request()->is('admin/rss_feeds/external-rss-feeds') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('rss_feeds.show') }}">{{ localize('external_rss_feeds') }}</a>
                                </li>
                            </ul>
                        @endcan
                    </li>
                @endcan


                @can('read_reporter')
                    <li class="{{ request()->is('admin/reporter*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-user"></i>
                            <span> {{ ucwords(localize('reporter')) }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/reporter*') ? 'mm-show' : '' }}">
                            <li class="{{ request()->is('admin/reporter/reporter-list') ? 'mm-active' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('reporter.index') }}">{{ ucwords(localize('reporter_list')) }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('read_opinion')
                    <li class="{{ request()->is('admin/opinion*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fas fa-comment-dots"></i>
                            <span> {{ localize('opinions') }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/opinion*') ? 'mm-show' : '' }}">
                            <li class="{{ request()->is('admin/opinion/opinion-list') ? 'mm-active' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('opinion.index') }}">{{ ucwords(localize('opinion_list')) }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('read_poll')
                    <li class="{{ request()->is('admin/poll*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fas fa-vote-yea"></i>
                            <span> {{ localize('polls') }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/poll*') ? 'mm-show' : '' }}">
                            <li class="{{ request()->is('admin/poll/poll-list') ? 'mm-active' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('poll.index') }}">{{ ucwords(localize('poll_list')) }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('read_video_news')
                    <li class="{{ request()->is('admin/videonews*') ? 'mm-active' : 'XXXX' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-video"></i>
                            <span> {{ ucwords(localize('video_post')) }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/videonews*') ? 'mm-show' : '' }}">
                            @can('create_video_news')
                                <li class="{{ request()->is('admin/videonews/create') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('videonews.create') }}">{{ ucwords(localize('add_video_post')) }}</a>
                                </li>
                            @endcan
                            @can('read_video_news_list')
                                <li class="{{ request()->is('admin/videonews/videonews-list') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('videonews.index') }}">{{ ucwords(localize('video_post_list')) }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('read_page')
                    <li class="{{ request()->is('admin/page*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-list"></i>
                            <span> {{ ucwords(localize('page')) }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/page*') ? 'mm-show' : '' }}">
                            @can('create_page')
                                <li class="{{ request()->is('admin/page/create-new-page') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('page.create') }}">{{ ucwords(localize('add_new_page')) }}</a>
                                </li>
                            @endcan
                            <li class="{{ request()->is('admin/page/pages') ? 'mm-active' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('page.index') }}">{{ ucwords(localize('page_list')) }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('read_seo')
                    <li class="{{ request()->is('admin/seo*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-random"></i>
                            <span> {{ strtoupper(ucwords(localize('seo'))) }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/seo*') ? 'mm-show' : '' }}">
                            @can('read_meta_setting')
                                <li class="{{ request()->is('admin/seo/meta-setting') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('seo.index') }}">{{ ucwords(localize('meta_setting')) }}</a>
                                </li>
                            @endcan

                            <li class="{{ request()->is('admin/seo/sitemap-links') ? 'mm-active' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('seo.sitemap_links') }}">{{ ucwords(localize('sitemap_links')) }}</a>
                            </li>

                            {{-- @can('read_social_site')
                                <li class="{{ request()->is('admin/seo/social-sites') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('seo.social_sites') }}">{{ ucwords(localize('social_site')) }}</a>
                                </li>
                            @endcan --}}
                            @can('read_social_link')
                                <li class="{{ request()->is('admin/seo/social-link') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('seo.social_link') }}">{{ ucwords(localize('social_link')) }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('read_auto_post_settings')
                    <li class="{{ request()->is('admin/autopost*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-share-alt"></i>
                            <span>{{ ucwords(localize('auto_post_settings')) }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/autopost*') ? 'mm-show' : '' }}">
                            @can('read_auto_posting_media')
                                <li class="{{ request()->is('admin/autopost/posting-media') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('autopost.index') }}">{{ ucwords(localize('social_media')) }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('read_web_setup')
                    <li class="{{ request()->is('admin/web-setup*') ? 'mm-active' : '' }}">
                        <a class="has-arrow material-ripple" href="#">
                            <i class="fa fa-gear"></i>
                            <span> {{ ucwords(localize('web_setup')) }}</span>
                        </a>
                        <ul class="nav-second-level {{ request()->is('admin/web-setup*') ? 'mm-show' : '' }}">
                            @can('read_setup_top_breaking_post')
                                <li class="{{ request()->is('admin/web-setup/setup-top-breaking') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('view_setup.index') }}">{{ ucwords(localize('setup_top_breaking_post')) }}</a>
                                </li>
                            @endcan
                            @can('read_home_page')
                                <li class="{{ request()->is('admin/web-setup/home-page-settings') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('view_setup.home_page_setup') }}">{{ ucwords(localize('home_page')) }}</a>
                                </li>
                            @endcan
                            @can('read_contact_page_setup')
                                <li class="{{ request()->is('admin/web-setup/contact-page-setup') ? 'mm-active' : '' }}">
                                    <a class="dropdown-item"
                                        href="{{ route('view_setup.contact_page_setup') }}">{{ ucwords(localize('contact_page_setup')) }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('read_setting')
                    <li
                        class="{{ (request()->is('admin/setting*') && !request()->is('admin/setting/subscriber-list')) || request()->is('admin/role*') || request()->is('admin/applications*') || request()->is('admin/currencies*') || request()->is('admin/mails*') || request()->is('admin/sms*') || request()->is('admin/password*') || request()->is('admin/user*') || request()->is('admin/localize*') || request()->is('admin/database-backup-reset*') || request()->is('admin/access-log*') || request()->is('admin/cookie-content*') ? 'mm-active' : '' }}">
                        @can('read_application')
                            <a href="{{ route('applications.application') }}">
                                <i class="fa fa-cogs"></i>
                                <span>{{ localize('settings') }}</span>
                            </a>
                        @endcan
                    </li>
                @endcan
                @can('read_setting')
                    <li class="{{ request()->is('admin/setting/subscriber-list') ? 'mm-active' : '' }}">
                        @can('read_application')
                            <a href="{{ route('subscriber.list') }}">
                                <i class="fa fa-users-cog"></i>
                                <span>{{ localize('subscribers') }}</span>
                            </a>
                        @endcan
                    </li>
                @endcan
                <!-- <li class="{{ request()->is('admin/update/guides') ? 'mm-active' : '' }}">
                    <a href="{{ route('update.guides') }}">
                        <i class="fa fa-warehouse"></i>
                        <span>Update Guides</span>
                    </a>
                </li> -->
            </ul>
        </nav>
    </div>
    <!-- sidebar-body -->
</nav>
