<ul class="nav">
    <li class="nav-item {{ $route == 'home' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Home </span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'joining_request' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('joining_request') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Joining Request </span>
        </a>
    </li>
    <li class="border-top my-3"></li>
    <li class="nav-item {{ $route == 'profile' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Profile </span>
        </a>
    </li>
    <li class="d-none nav-item {{ $route == 'passbook' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('passbook') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Passbook </span>
        </a>
    </li>
    <li class="nav ">

        <div>Investment </div>

        <ul class="nav-item">
            <li class="nav-item {{ $route == 'self_report' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('self_report') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">VPS </span>
                </a>
            </li>
            {{-- <li class="nav-item {{ $route == 'ppsx.index' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('ppsx.index') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">PPS NEXT </span>
                </a>
            </li>
            <li class="nav-item {{ $route == 'mpx.index' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('mps.index') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">MPS24 </span>
                </a>
            </li>
            <li class="nav-item {{ $route == 'mpx36.index' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('mps36.index') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">MPS36 </span>
                </a>
            </li>
            <li class="nav-item {{ $route == 'mpx48.index' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('mps48.index') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">MPS48 </span>
                </a>
            </li>
            <li class="nav-item {{ $route == 'mpx60.index' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('mps60.index') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">MPS60 </span>
                </a>
            </li> --}}
        </ul>
    </li>

    <li class="nav-item {{ $route == 'my_team' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('my_team') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Team Report </span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'user.tree_view' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('user.tree_view') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Tree View</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'downline_report' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('downline_report') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Investment Report </span>
        </a>
    </li>
{{--    <li class="nav-item {{ $route == 'mps_downline_report' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('mps_downline_report') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">MPS Report </span>
        </a>
    </li> --}}
    <li class="nav ">

        <div>Wallet </div>

        <ul class="nav-item">
            <li class="nav-item {{ $route == 'main_wallet' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('main_wallet') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Main Wallet</span>
                </a>
            </li>
            <li class="nav-item {{ $route == 'referral_benefit_report' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('referral_benefit_report') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">RLD Wallet</span>
                </a>
            </li>
            <li class="nav-item {{ $route == 'pps_staking_report' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('pps_staking_report') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">VPS Wallet</span>
                </a>
            </li>
            <li class="nav-item {{ $route == 'pps_level_report' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('pps_level_report') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">VPS Level Wallet</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item {{ $route == 'profile' ? 'active' : '' }} ">
        <a href="javascript:" class="nav-link" data-toggle="modal" data-target="#resetPasscodeCenter">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Reset Passcode</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'self_investment.pay' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('self_investment.pay') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Investment Update</span>
        </a>
    </li>
    {{-- <li class=" nav-item {{ $route == 'wallet' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('wallet') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Main Wallet</span>
        </a>
    </li>
    <li class=" nav-item {{ $route == 'payment_request' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('payment_request') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Withdrawal</span>
        </a>
    </li> --}}
    <li class="nav-item {{ $route == 'token_application.create' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('token_application.create') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Token Application</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'profile' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Trading</span>
        </a>
    </li>



    <li class="border-top my-3"></li>
    <li class="nav-item">


        <a class="nav-link" href="{{ route('logout') }}">
            <i class="ti-power-off menu-icon"></i>

            <span class="menu-title">{{ __('Log Out') }}</span>
        </a>
        {{-- onclick="event.preventDefault(); this.closest('form').submit();">
    <form class="p-0 text-left" method="POST" action="{{ route('admin.logout') }}">
        @csrf
          </form> --}}


    </li>
</ul>
