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
            <span class="menu-title">VPS </span>
        </a>
    </li>
    <li class="d-none nav-item {{ $route == 'admin.ppsx_index' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.ppsx_index') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">PPS NEXT</span>
        </a>
    </li>
    <li class="d-none nav-item {{ $route == 'admin.mps_index' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.mps_index') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">MPS24 </span>
        </a>
    </li>
    <li class="d-none nav-item {{ $route == 'admin.mps36_index' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.mps36_index') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">MPS36 </span>
        </a>
    </li>
    <li class="d-none nav-item {{ $route == 'admin.mps48_index' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.mps48_index') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">MPS48 </span>
        </a>
    </li>
    <li class="d-none nav-item {{ $route == 'admin.mps60_index' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.mps60_index') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">MPS60 </span>
        </a>
    </li>
    <li class="nav-item">

        <ul class="nav ">

            <div>Generation </div>
            <li class="nav-item {{ $route == 'admin.pps_distribution' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.pps_distribution') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Generate Payout </span>
                </a>
            </li>
            <li class="nav-item {{ $route == 'admin.pps_distribution_log' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.pps_distribution_log') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Generate 100 Payout Log</span>
                </a>
            </li>
            <li class=" d-none nav-item {{ $route == 'admin.ppsx_distribution' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.ppsx_distribution') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Generate Payout PPSX </span>
                </a>
            </li>
            <li class="d-none nav-item {{ $route == 'admin.ppsx_distribution_log' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.ppsx_distribution_log') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Generate Payout PPSX Log</span>
                </a>
            </li>
            {{-- <li class="nav-item {{ $route == 'admin.pps_distribution_log' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.pps_distribution_log',200) }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Generate 200 Payout Log</span>
                </a>
            </li>
            <li class="nav-item {{ $route == 'admin.pps_distribution_log' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.pps_distribution_log',300) }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Generate 300 Payout Log</span>
                </a>
            </li> --}}
            <li class="d-none nav-item {{ $route == 'admin.mps24_distribution' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.mps24_distribution') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Generate Mps24 Payout </span>
                </a>
            </li>
            <li class="d-none nav-item {{ $route == 'admin.mps24_distribution_log' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.mps24_distribution_log') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Generate Mps24 Payout Log</span>
                </a>
            </li>
        </ul>
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
