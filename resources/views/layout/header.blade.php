<nav class="sb-topnav1 navbar1 navbar-expand bg-def">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" style="color: white;" href="/">BPOM RI</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 my-2 my-md-0">
        <div class="input-group">
            <a class="navbar-brand ps-3" style="color: white;">
                @if (Auth::user()->level == 0)
                    {{ 'Admin' }}
                @elseif(Auth::user()->level == 4)
                    {{ 'Auditor' }}
                @elseif(Auth::user()->level == 5)
                    {{ 'inspektor' }}
                @else
                    {{ session('pabrik') }}
                @endif
                ({{ Auth::user()->nama }})
            </a>
        </div>
    </form>

    @if (Auth::user()->level == 3)
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2">
                        <?php
                        
                        $jum = \App\Models\notif::all()
                            ->where('id_pabrik', \Illuminate\Support\Facades\Auth::user()->pabrik)
                            ->where('notif_3', 1)
                            ->count();
                        $notif = \App\Models\notif::where('id_pabrik', \Illuminate\Support\Facades\Auth::user()->pabrik)
                            ->where('notif_3', 1)
                            ->limit(3)
                            ->orderBy('notif_waktu', 'desc')
                            ->get();
                        echo $jum;
                        ?>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @foreach ($notif as $isi)
                        <li>
                            <a class="dropdown-item border-radius-md" href="{{ route($isi['notif_link']) }}">
                                <div class="d-flex">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">{{ $isi['notif_laporan'] }}</span>
                                            Telah Diterima PJT
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse(date('Y-m-d H:i:s', strtotime($isi['updated_at'])))->locale('id')->diffForHumans() }}

                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                    @endforeach
                    @if ($jum != 0)
                        <li>
                            <div class="d-flex">
                                <div class="d-flex flex-column justify-content-center">
                                    <a href="/notif" class="ml-2">Lihat semua notifikasi <i
                                            class="fas fa-arrow-right"></i> </a>
                                </div>
                            </div>
                        </li>
                    @else
                        Tidak Ada Notifikasi
                    @endif
                </ul>
            </li>
        </ul>
    @elseif(Auth::user()->level == 2)
        {{-- pjt --}}
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2">
                        <?php
                        $jum = \App\Models\notif::all()
                            ->where('status', 0)
                            ->count();
                        $notif = \App\Models\notif::where('status', 0)
                            ->limit(3)
                            ->orderBy('notif_waktu', 'desc')
                            ->get();
                        echo $jum;
                        ?>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @foreach ($notif as $isi)
                        <li>
                            <a class="dropdown-item border-radius-md" href="{{ route($isi['notif_link']) }}">
                                <div class="d-flex">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">{{ $isi['notif_isi'] }}</span>
                                            {{ $isi['notif_laporan'] }}
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse(date('Y-m-d H:i:s', strtotime($isi['notif_waktu'])))->locale('id')->diffForHumans() }}

                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                    @endforeach
                    @if ($jum != 0)
                        <li>
                            <div class="d-flex">
                                <div class="d-flex flex-column justify-content-center">
                                    <a href="/notif" class="ml-2">Lihat semua notifikasi <i
                                            class="fas fa-arrow-right"></i> </a>
                                </div>
                            </div>
                        </li>
                    @else
                        Tidak Ada Notifikasi
                    @endif
                </ul>
            </li>
        </ul>
    @endif

    <ul
        @if (Auth::user()->level == 3 || Auth::user()->level == 2) class="navbar-nav mr-1" @else class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4" @endif>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                @if (Auth::user()->level == 2)
                    <li><a class="dropdown-item" href="/setting">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                @endif
                <li><a class="dropdown-item" href="/gantipassword">Ganti Pasword</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>

            </ul>
        </li>
    </ul>
</nav>
