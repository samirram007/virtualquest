@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();



$guard='user';
if (str_contains($prefix, 'admin')) {
    $guard = 'admin';
}

@endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent justify-content-between">
<div class="title text-light">MPS</div>
    <div class="btn-group">
        <button type="button" class="btn btn-outline-info"><a class="text-light" href="{{ route('admin.mps') }}">New <span class="sr-only">(current)</span></a></button>
        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('admin.mps_all') }}">All</a>
            <a class="dropdown-item" href="{{ route('admin.mps_index') }}">Acknowledged</a>
          <a class="dropdown-item" href="{{ route('admin.mps_pending') }}">Pending <span class="sr-only">(current)</span></a>

          {{-- <a class="dropdown-item" href="{{ route('admin.mps_rejected') }}">REJECTED</a> --}}
          {{-- <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a> --}}
        </div>
      </div>

    {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
    {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ $route == 'admin.mps_index' ? 'active' : '' }} ">
          <a class="nav-link" href="{{ route('admin.mps_index') }}">mpss <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ $route == 'admin.mps' ? 'active' : '' }} ">
          <a class="nav-link" href="{{ route('admin.mps') }}">New <span class="sr-only">(current)</span></a>
        </li>



      </ul> --}}
      {{-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> --}}
    </div>
  </nav>

