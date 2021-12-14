
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="{{ url('/') }}" class="navbar-brand" >
                <small class="text-primary font-weight-bold" style="font-weight: 600">

                    <span class="blue">
                        <i class="fa fa-flag"></i>
                        Sky Permission
                    </span>
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">






                <li class="light-10 dropdown-modal"

                    @if(strlen(optional(auth()->user())->name) >= 10)
                        style="width: 350x"
                    @endif
                >
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle dark">
                        <img class="nav-user-photo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxE7BxYQbhQRiq0kYHfcek5o7o4Y77qCgKlHRnGFSMkpjelv9k0ALIXKQxCao7clIh5QQ&usqp=CAU" alt="User Photo" />

                        <span class="user-info">
                            <small>Welcome,</small>
                            {{ optional(auth()->user())->name }}
                        </span>

                        <i class="ace-icon dark fa fa-caret-down"></i>
                    </a>



                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">


                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
