<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="">
          <use xlink:href="{{asset('assets/brand/coreui.svg#full')}}"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="">
          <use xlink:href="{{asset('assets/brand/coreui.svg#signet')}}"></use>
        </svg>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="index.html">
            <svg class="nav-icon">
              <use xlink:href="{{asset('assets/vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
            </svg> Dashboard</a>
          </li>


          <li class="nav-item"><a class="nav-link" href="{{route('pelanggan.index')}}">
            <svg class="nav-icon">
              <use xlink:href="{{asset('assets/vendors/@coreui/icons/svg/free.svg#cil-group')}}"></use>
            </svg>Data Pelanggan</a>
          </li>

          <li class="nav-item"><a class="nav-link" href="{{ route('paket.index') }}">
            <svg class="nav-icon">
            <use xlink:href="{{asset('assets/vendors/@coreui/icons/svg/free.svg#cil-object-group')}}"></use>
            </svg>Data Paket</a>
          </li>

          <li class="nav-item"><a class="nav-link" href="{{ route('pesanan.index')}}">
            <svg class="nav-icon">
              <use xlink:href="{{asset('assets/vendors/@coreui/icons/svg/free.svg#cil-dollar')}}"></use>
            </svg>Transaksi</a>
          </li>


          <li class="nav-item"><a class="nav-link" href="{{ route('pesanan.index')}}">
            <svg class="nav-icon">
              <use xlink:href="{{asset('assets/vendors/@coreui/icons/svg/free.svg#cil-newspaper')}}"></use>
            </svg>Laporan</a>
          </li>
        
      

            <!-- <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
            </svg>Opsi Menu</a>
          <ul class="nav-group-items">
            <li class="nav-item"><a class="nav-link" href="{{ route('paket.index') }}"><span class="nav-icon"></span>Jenis Paket</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('jenisPembayaran.index')}}"><span class="nav-icon"></span>Jenis Pembayaran</a></li>
            <li class="nav-item"><a class="nav-link" href=""><span class="nav-icon"></span>Pembukuan</a></li>
          </ul>
        </li> -->
        
      
      </ul>
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>