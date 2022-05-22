<nav class="sb-topnav1 navbar1 navbar-expand bg-def">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" style="color: white;" href="/">BPOM RI</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
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

            @if (Auth::user()->level == 3)
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fa fa-bell"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2">
                                {{session()->get('jumlah')}}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item border-radius-md"  href="#">
                                    <div class="d-flex">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New message</span> from Laur
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="#" class="ml-2">Lihat semua notifikasi <i class="fas fa-arrow-right"></i> </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            @elseif(Auth::user()->level == 2)
                {{-- pjt --}}
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fa fa-bell"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2">
                                99+
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item border-radius-md"  href="javascript:;">
                                    <div class="d-flex">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New message</span> from Laur
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item border-radius-md"  href="javascript:;">
                                    <div class="d-flex">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New message</span> from Laur
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="#" class="ml-2">Lihat semua notifikasi <i class="fas fa-arrow-right"></i> </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endif

        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
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
