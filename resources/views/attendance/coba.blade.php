<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Dashboard</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
    <style>
        .header-large-title {
            padding: 1.5rem;
            background: linear-gradient(45deg, #1171ba, #37db63);
            color: white;
            border-radius: 0 0 25px 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .user-card {
            background: white;
            border-radius: 15px;
            padding: 1rem;
            margin: -2rem 1rem 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-card img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1rem;
            margin: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
            padding: 0.5rem;
        }

        .stat-item ion-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .attendance-card {
            background: white;
            border-radius: 15px;
            padding: 1rem;
            margin: 1rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .attendance-button {
            padding: 1rem;
            border-radius: 12px;
            text-align: center;
            color: white;
            font-weight: bold;
        }

        .check-in {
            background: linear-gradient(45deg, #37db63, #28a745);
        }

        .check-out {
            background: linear-gradient(45deg, #dc3545, #ba113b);
        }

        .bottom-menu {
            background: white;
            border-radius: 20px;
            padding: 0.2rem 1rem;
            position: fixed;
            bottom: 0.8rem;
            left: 50%;
            transform: translateX(-50%);
            width: 95%;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0.3rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            z-index: 1000;
        }

        .menu-item {
            margin-top: 0.5rem;
            text-align: center;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .menu-item:active {
            transform: scale(0.95);
            background: rgba(0, 0, 0, 0.05);
        }

        .menu-item ion-icon {
            font-size: 1.3rem;
            margin-bottom: 0.2rem;
            color: #666;
            transition: color 0.3s ease;
        }

        .menu-item.active ion-icon {
            color: #1e74fd;
        }

        .menu-item span {
            display: block;
            font-size: 0.7rem;
            color: #666;
            margin-top: 1px;
        }

        .menu-item.active span {
            color: #1e74fd;
            font-weight: 500;
        }

        .menu-item ion-icon {
            font-size: 1.3rem;
            margin-bottom: 0.2rem;
        }
    </style>
</head>

<body style="background-color: #f5f5f5;">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- Header -->
    <div class="header-large-title">
        <h1 class="title mb-3">Welcome Back</h1>
        {{-- <h4 class="subtitle">{{ Auth::guard('student')->user()->name }}</h4> --}}
    </div>

    <!-- User Card -->
    <div class="user-card">
        @if (!empty(Auth::guard('student')->user()->photo))
            @php
                $path = Storage::url('uploads/student/' . Auth::guard('student')->user()->photo);
            @endphp
            <img src="{{ $path }}" alt="avatar">
        @else
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar">
        @endif
        <div>
            <h2 style="margin: 0;">{{ Auth::guard('student')->user()->name }}</h2>
            <p style="margin: 0; color: #666;">Programmer</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-card">
        <h3 style="margin-bottom: 1rem;">Attendance Overview</h3>
        <div class="stats-grid">
            <div class="stat-item">
                <ion-icon name="accessibility-outline" style="color: #1171ba;"></ion-icon>
                <p>{{ $recapAttendance->jmlhadir }}</p>
                <small>Present</small>
            </div>
            <div class="stat-item">
                <ion-icon name="newspaper-outline" style="color: #fca903;"></ion-icon>
                <p>
                    @if ($recappermission->amountpermis == null)
                        0
                    @else
                        {{ $recappermission->amountpermis }}
                    @endif
                </p>
                <small>Permission</small>
            </div>
            <div class="stat-item">
                <ion-icon name="medkit-outline" style="color: #37db63;"></ion-icon>
                <p>
                    @if ($recappermission->amountsick == null)
                        0
                    @else
                        {{ $recappermission->amountsick }}
                    @endif
                </p>
                <small>Sick</small>
            </div>
            <div class="stat-item">
                <ion-icon name="alarm-outline" style="color: #ba113b;"></ion-icon>
                <p>{{ $recapAttendance->jmlterlambat }}</p>
                <small>Late</small>
            </div>
        </div>
    </div>

    <!-- Attendance Buttons -->
    <div class="attendance-card">
        <div class="attendance-button check-in">
            <ion-icon name="log-in-outline"></ion-icon>
            <p>Check In</p>
            <small>{{ $attendanceToday != null ? $attendanceToday->time_in : 'Not yet' }}</small>
        </div>
        <div class="attendance-button check-out">
            <ion-icon name="log-out-outline"></ion-icon>
            <p>Check Out</p>
            <small>{{ $attendanceToday != null && $attendanceToday->time_out != null ? $attendanceToday->time_out : 'Not yet' }}</small>
        </div>
    </div>

    <div class="tab-content mt-2" style="margin-bottom:100px;">
        <div class="tab-pane fade show active" id="home" role="tabpanel">
            <ul class="listview image-listview">
                @foreach ($historyThisMonth as $history)
                    @php
                        $path = Storage::url('uploads/absensi/' . $history->photo_in);
                    @endphp
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="finger-print-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>{{ date('d-m-Y', strtotime($history->date)) }}</div>
                                <span class="badge badge-success">{{ $history->time_in }}</span>
                                {{-- <span
                                    class="badge badge-danger">{{ $attendanceToday != null && $attendanceToday->time_out != null ? $history->time_out : 'Belum Absen' }}</span> --}}
                                <span class="badge badge-danger">{{ $history->time_out }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel">
            <ul class="listview image-listview">
                @foreach ($leaderboard as $leaderboard)
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>
                                    <b>{{ $leaderboard->name }}</b><br>
                                    <small class="text-mute">Divisi</small>
                                </div>
                                <span class="badge {{ $leaderboard->time_in < '08:00' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $leaderboard->time_in }}
                                </span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    @include('layouts.navBottom')

    <!-- Scripts -->
    @include('layouts.script')
    @stack('myscript')

</body>

</html>
