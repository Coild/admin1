<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion bg-def" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <a @if(Request::is('dashboard')) id='side_aktif' @endif  class="nav-link collapsed"  href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    DASHBOARD
                </a>

                <a @if(Request::is('laporan')) id='side_aktif' @endif
                class="nav-link" href="{{ route('laporans') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Laporan
                </a>

                <a @if(Request::is('karyawan')) id='side_aktif' @endif class="nav-link collapsed" href="karyawan">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    KELOLA USER
                </a>

                {{-- <a    class="nav-link collapsed" href="aplicant">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    DAFTAR APLIKAN
                </a> --}}

                <a @if(Request::is('bos_audit')) id='side_aktif' @endif class="nav-link collapsed" href="bos_audit">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    DAFTAR AUDIT
                </a>

                <a @if(Request::is('logAdmin')) id='side_aktif' @endif  class="nav-link collapsed" href="logAdmin">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    LOG
                </a>

            </div>
        </div>

    </nav>
</div>
