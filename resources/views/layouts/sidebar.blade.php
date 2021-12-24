<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>

            @can('dashboard.index')
                <li class="sidebar-item {{ isActive('dashboard') }}">
                    <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>
            @endcan

            @php
                $allowed_setting_permission = [
                    'setting.permission.index',
                    'setting.permission.role',
                    'setting.permission.profile',
                ]
            @endphp
            @if(auth()->user()->hasAnyPermission($allowed_setting_permission))
                <li class="sidebar-item {{ isActive('setting') }}">
                    <a class="sidebar-link" href="{{ route('setting.permission.index') }}">
                        <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Setting</span>
                    </a>
                </li>
            @endif

            <li class="sidebar-header">
                Multi Level
            </li>
            
            <li class="sidebar-item">
                <a data-target="#ui" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Level 1</span>
                </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-alerts.html">Level 2</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-buttons.html">Level 2</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-cards.html">Level 2</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-general.html">Level 2</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-grid.html">Level 2</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-modals.html">Level 2</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-typography.html">Level 2</a></li>
                </ul>
            </li>
        </ul>


    </div>
</nav>
