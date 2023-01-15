<footer class="d-none d-md-none d-lg-block">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></i> Copyright © {{date('Y')}} Virtual Existence.
        </span>
    </div>
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      {{-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Virtual</a></span> --}}
    </div>
  </footer>

  <footer class="  d-md-block  d-lg-none">

    <ul class="nav nav-pills flex-row justify-content-between">
        <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" href="{{ url('/') }}"><i
                    class="fas fa-home"></i></a>
        </li>

        <li class="nav-item">


        </li>
        <li class="nav-item">
            <button class="navbar-toggler navbar-toggler-right   align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu text-light icon-md"></span>
        </button>
            {{-- <a class="nav-link text-light" href="#" tabindex="-1"><i class="fas fa-bars"></i></a> --}}
        </li>
    </ul>




</footer>

<style>
    footer {
    color: #fff;
    background-color: #282f3a;
    padding: 0.4rem 10px;
    text-align: center;
    font-size: 0.9rem;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
    box-shadow: 1px -1px 6px 7px #dd93f31e;
    z-index: 1001;
    border-top: 2px solid #aa2adf;
    bottom: 0;
    position: fixed;
    width: 100%;
    height: 60px;
}
.nav-pills {
    border-bottom: 0;
    padding-bottom: 1rem;
}
footer .nav-pills .nav-link.active, footer .nav-pills .show>.nav-link {
    color: #fff;
    padding: 0.05rem 0.7rem;
    font-size: 1.5rem;
    background-color: #dfe7dc2d;
    border: 1px solid #dfe7dc2d;
}
</style>
