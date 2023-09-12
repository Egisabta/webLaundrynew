<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#full"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#signet"></use>
        </svg>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="index.html">
            <svg class="nav-icon">
              <use xlink:href="{{asset('assets/vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
            </svg> Dashboard</a></li>
        <li class="nav-title">Menu</li>
        <li class="nav-item"><a class="nav-link" href="{{route('pelanggan.index')}}">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
            </svg>Pelanggan</a>
          </li>

            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
            </svg>Pemesanan</a>
          <ul class="nav-group-items">
            <li class="nav-item"><a class="nav-link" href="{{ route('paket.index') }}"><span class="nav-icon"></span>Paket</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('pesanan.index')}}"><span class="nav-icon"></span>Pesanan</a></li>
            <li class="nav-item"><a class="nav-link" href="buttons/dropdowns.html"><span class="nav-icon"></span>Pembayaran</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('pelanggan.index')}}">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
            </svg>Pembukuan</a>
          </li>
      </ul>
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>