


<div id="sidebar" class="sidebar responsive ace-save-state main-sidebar">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>


    <ul class="nav nav-list">
        <li>
            <a href="{{ url('/') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>


        {{-- @if (hasAnyPermission(['permission.accesses.create', 'permission.permitted.users', 'database.backup', 'attendance.devices.index'], $slugs)) --}}

        <li class="{{ request()->is('setting/permission-access/create') ? 'active' : '' }}">
            <a href="{{ route('permission-access.create') }}">
                <i class="menu-icon fa fa-caret-right"></i>
                Permission Access
            </a>
            <b class="arrow"></b>
        </li>


        <li class="{{ request()->is('setting/view-permitted-users') ? 'active' : '' }}">
            <a href="{{ route('permitted.users') }}">
                <i class="menu-icon fa fa-caret-right"></i>
                Permitted Users
            </a>
            <b class="arrow"></b>
        </li>





        <!-- Permission Setup -->
        @if(auth()->id() == 1)
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-magic"></i>
                    <span class="menu-text">Setup</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    <li>
                        <a href="{{ route('modules.index') }}">
                            Modules
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li>
                        <a href="{{ route('submodules.index') }}">
                            Submodules
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li>
                        <a href="{{ route('permission-groups.index') }}">
                            Permission Group
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
        @endif


        {{-- @endif --}}
    </ul>

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>

