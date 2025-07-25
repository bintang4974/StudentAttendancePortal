@extends('layouts.master2')
@section('header')
    <div class="header-large-title">
        <div class="row">
            <div class="col align-self-center">
                <a href="javascript:;" class="headerButton goBack text-center">
                    <ion-icon name="chevron-back-outline" style="font-size: 32px; color: white;"></ion-icon>
                </a>
            </div>
            <div class="col">
                <h1 class="title text-center" style="margin-left: -160px">History</h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- <div class="row" style="margin-top: 20px">
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="month" id="month" class="form-control">
                            <option value="">Month</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>
                                    {{ $namemonth[$i] }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="year" id="year" class="form-control">
                            <option value="">Year</option>
                            @php
                                $yearstart = 2023;
                                $yearnow = date('Y');
                            @endphp
                            @for ($year = $yearstart; $year <= $yearnow; $year++)
                                <option value="{{ $year }}" {{ date('Y') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" id="getdata">
                            <ion-icon name="search-outline"></ion-icon>Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" id="showhistory"></div>
    </div> --}}

    <form method="GET" action="{{ route('attendance.history') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <select name="month" class="form-control">
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="year" class="form-control">
                    @foreach (range(date('Y') - 2, date('Y')) as $y)
                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    {{-- <p>Total Hadir: <strong>{{ $hadir }}</strong></p>
    <p>Total Tidak Hadir: <strong>{{ $tidakHadir }}</strong></p>
    <p>Persentase Kehadiran: <strong>{{ $persentase }}%</strong></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->time_in ?? '-' }}</td>
                    <td>{{ $attendance->time_out ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}

    <p>Total Hadir: <strong>{{ $hadir }}</strong></p>
    <p>Total Izin: <strong>{{ $izin }}</strong></p>
    <p>Total Sakit: <strong>{{ $sakit }}</strong></p>
    <p>Total Tidak Hadir: <strong>{{ $tidakHadir }}</strong></p>
    <p>Persentase Kehadiran: <strong>{{ $persentase }}%</strong></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($history as $row)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($row['date'])->format('d-m-Y') }}</td>
                    <td>
                        @if ($row['type'] === 'Hadir')
                            <span class="badge bg-success">Hadir</span>
                        @elseif ($row['type'] === 'Izin')
                            <span class="badge bg-warning">Izin</span>
                        @elseif ($row['type'] === 'Sakit')
                            <span class="badge bg-warning">Sakit</span>
                        @else
                            <span class="badge bg-danger">Tidak Hadir</span>
                        @endif
                    </td>
                    <td>{{ $row['description'] ?? '-' }}</td>
                    <td>{{ $row['time_in'] ?? '-' }}</td>
                    <td>{{ $row['time_out'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('myscript')
    <script>
        $(function() {
            $('#getdata').click(function(e) {
                var month = $('#month').val();
                var year = $('#year').val();

                $.ajax({
                    type: 'POST',
                    url: '/gethistory',
                    data: {
                        _token: "{{ csrf_token() }}",
                        month: month,
                        year: year
                    },
                    cache: false,
                    success: function(res) {
                        $('#showhistory').html(res);
                    }
                })
            })
        })
    </script>
@endpush
