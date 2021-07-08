<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('profile_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/profile-types*") ? "c-show" : "" }} {{ request()->is("admin/profile-pages*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-address-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.profile.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('profile_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.profile-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/profile-types") || request()->is("admin/profile-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.profileType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('profile_page_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.profile-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/profile-pages") || request()->is("admin/profile-pages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.profilePage.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('contact_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/contact-icons*") ? "c-show" : "" }} {{ request()->is("admin/contact-details*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-headset c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contact.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('contact_icon_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contact-icons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contact-icons") || request()->is("admin/contact-icons/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactIcon.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contact_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contact-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contact-details") || request()->is("admin/contact-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactDetail.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('umkm_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.umkms.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/umkms") || request()->is("admin/umkms/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.umkm.title') }}
                </a>
            </li>
        @endcan
        @can('organization_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.organizations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/organizations") || request()->is("admin/organizations/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-people-carry c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.organization.title') }}
                </a>
            </li>
        @endcan
        @can('news_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/categories*") ? "c-show" : "" }} {{ request()->is("admin/tags*") ? "c-show" : "" }} {{ request()->is("admin/news-pages*") ? "c-show" : "" }} {{ request()->is("admin/comments*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-map c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.news.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/categories") || request()->is("admin/categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.category.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tags") || request()->is("admin/tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('news_page_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.news-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/news-pages") || request()->is("admin/news-pages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.newsPage.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('comment_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.comments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/comments") || request()->is("admin/comments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.comment.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('agenda_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.agendas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/agendas") || request()->is("admin/agendas/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-tasks c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.agenda.title') }}
                </a>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>