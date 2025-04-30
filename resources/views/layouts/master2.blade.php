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

    @yield('header')

    @yield('content')

    @include('layouts.navBottom')

    <!-- Scripts -->
    @include('layouts.script')
    @stack('myscript')

</body>

</html>
