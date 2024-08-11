<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
                <img src="{{ asset('tabler/static/logo.svg') }}" width="110" height="32" alt="Tabler"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">

            <div class="d-none d-md-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                        style="background-image: url({{ asset('tabler/static/avatars/000m.jpg') }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::guard('user')->user()->name }}</div>
                        <div class="mt-1 small text-secondary">Administrator</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="./settings.html" class="dropdown-item">Settings</a>
                    <a href="/processlogoutadmin" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->is('panel/dashboardadmin') ? 'active' : '' }}">
                        <a class="nav-link" href="/panel/dashboardadmin">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Home
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is(['student', 'department']) ? 'show' : '' }}"
                            href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                            aria-expanded="{{ request()->is(['student', 'department']) ? 'true' : '' }}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                    <path d="M12 12l8 -4.5" />
                                    <path d="M12 12l0 9" />
                                    <path d="M12 12l-8 -4.5" />
                                    <path d="M16 5.25l-8 4.5" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Data Master
                            </span>
                        </a>
                        <div class="dropdown-menu {{ request()->is(['student', 'department']) ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ request()->is(['student']) ? 'active' : '' }}"
                                        href="/student">
                                        Data Mahasiswa
                                    </a>
                                    <a class="dropdown-item {{ request()->is(['department']) ? 'active' : '' }}"
                                        href="/department">
                                        Data Department
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->is('attendance/monitoring') ? 'active' : '' }}">
                        <a class="nav-link" href="/attendance/monitoring">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-desktop-analytics">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                                    <path d="M7 20h10" />
                                    <path d="M9 16v4" />
                                    <path d="M15 16v4" />
                                    <path d="M9 12v-4" />
                                    <path d="M12 12v-1" />
                                    <path d="M15 12v-2" />
                                    <path d="M12 12v-1" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Monitoring Attendance
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('attendance/izinsakit') ? 'active' : '' }}">
                        <a class="nav-link" href="/attendance/izinsakit">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-desktop-analytics">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                                    <path d="M7 20h10" />
                                    <path d="M9 16v4" />
                                    <path d="M15 16v4" />
                                    <path d="M9 12v-4" />
                                    <path d="M12 12v-1" />
                                    <path d="M15 12v-2" />
                                    <path d="M12 12v-1" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Data Izin/Sakit
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is(['attendance/report', 'attendance/recap']) ? 'show' : '' }}"
                            href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            role="button"
                            aria-expanded="{{ request()->is(['attendance/report', 'attendance/recap']) ? 'true' : '' }}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-book-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z" />
                                    <path d="M19 16h-12a2 2 0 0 0 -2 2" />
                                    <path d="M9 8h6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Report
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ request()->is(['attendance/report', 'attendance/recap']) ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ request()->is(['attendance/report']) ? 'active' : '' }}"
                                        href="/attendance/report">
                                        Report Presensi
                                    </a>
                                    <a class="dropdown-item {{ request()->is(['attendance/recap']) ? 'active' : '' }}"
                                        href="/attendance/recap">
                                        Recap Presensi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
