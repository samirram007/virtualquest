<ul class="nav">
    <li class="nav-item {{ $route == 'admin.home' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Home </span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.downline_report' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.downline_report') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Downline Report </span>
        </a>
    </li>
    {{-- <li class="nav-item {{ $route == 'admin.scheme_index' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.scheme_index') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Scheme </span>
        </a>
    </li> --}}
    <li class="border-top my-3"></li>
    <li class="nav-item {{ $route == 'admin.investment_index' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.investment_index') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Investment </span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.mps_index' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.mps_index') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">MPS </span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.pps_distribution' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.pps_distribution') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Generate Payout </span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.pps_distribution_log' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.pps_distribution_log') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Generate Payout Log</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.payment_request_process' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.payment_request_process') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Payment </span>
        </a>
    </li>
    <li class="border-top my-3"></li>
    <li class="nav-item {{ $route == 'admin.desk_query' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.desk_query') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Query </span>
        </a>
    </li>
    <li class="nav-item">


        <a class="nav-link" href="{{ route('admin.logout') }}">
            <i class="ti-power-off menu-icon"></i>

            <span class="menu-title">{{ __('Log Out') }}</span>
        </a>
        {{-- onclick="event.preventDefault(); this.closest('form').submit();">
    <form class="p-0 text-left" method="POST" action="{{ route('admin.logout') }}">
        @csrf
          </form> --}}


    </li>
</ul>
