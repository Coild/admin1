<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion bg-def" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <a @if(Request::is('dashboard')) id='side_aktif' @endif class="nav-link collapsed" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    DASHBOARD
                </a>

                <a @if(Request::is('pabrik')) id='side_aktif' @endif  class="nav-link collapsed" href="pabrik">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    TAMBAH PABRIK
                </a>

                <a @if(Request::is('audit')) id='side_aktif' @endif class="nav-link collapsed" href="audit">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    TAMBAH AUDITOR
                </a>

                <a @if(Request::is('update-protap')) id='side_aktif' @endif  class="nav-link collapsed" href="update-protap">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    UPDATE PROTAP
                </a>

                <a @if(Request::is('logPemilik')) id='side_aktif' @endif class="nav-link collapsed" href="logPemilik">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    LOG
                </a>

            </div>
        </div>

    </nav>
</div>
