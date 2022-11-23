@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();

    $guard = 'user';
    if (str_contains($prefix, 'admin')) {
        $guard = 'admin';
    }
    //$user=Auth::guard()->user();
    // $user = DB::table($guard . 's')
    //     ->where('id', Auth::guard($guard)->user()->id)
    //     ->first();
@endphp

<nav class="sidebar sidebar-custom sidebar-offcanvas" id="sidebar">

    @if ($guard == 'admin')
        @include('layouts.partial._sidebar_admin')
    @else
        @include('layouts.partial._sidebar_user')
    @endif

</nav>
