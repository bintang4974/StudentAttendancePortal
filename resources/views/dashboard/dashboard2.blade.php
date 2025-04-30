@extends('layouts.master2')

@section('content')
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
@endsection
