<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            font-weight: bold;
        }

        .tabledatastudent {
            margin-top: 40px;
        }

        .tabledatastudent td {
            padding: 5px;
        }

        .tableattendance {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tableattendance tr th {
            border: 1px solid #000;
            padding: 8px;
            background-color: #dbdbdb;
        }

        .tableattendance td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 12px;
        }

        .photo {
            width: 40px;
            height: 30px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">
    @php
        function selisih($jam_masuk, $jam_keluar)
        {
            [$h, $m, $s] = explode(':', $jam_masuk);
            $dtAwal = mktime($h, $m, $s, '1', '1', '1');
            [$h, $m, $s] = explode(':', $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, '1', '1', '1');
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode('.', $totalmenit / 60);
            $sisamenit = $totalmenit / 60 - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ':' . round($sisamenit2);
        }
    @endphp

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <table style="width: 100%">
            <tr>
                <td style="width: 30px"><img src="{{ asset('logo/dinkop.png') }}" width="120" height="120"></td>
                <td>
                    <span id="title">
                        LAPORAN PRESENSI MAHASISWA<br>
                        PERIODE {{ strtoupper($namemonth[$month]) }} {{ $year }}<br>
                        Dinas Koperasi Usaha Kecil dan Menengah dan Perdagangan Kota
                    </span><br>
                    <span><i>Jl. Tunjungan No.1 - 3, Genteng, Kec. Genteng, Surabaya</i></span>
                </td>
            </tr>
        </table>
        <table class="tabledatastudent">
            <tr>
                <td rowspan="7">
                    @php
                        $path = Storage::url('uploads/student/' . $student->photo);
                    @endphp
                    <img src="{{ $path }}" width="120" height="150">
                </td>
            </tr>
            <tr>
                <td>ID Aktivitas</td>
                <td>:</td>
                <td>{{ $student->activity_id }}</td>
            </tr>
            <tr>
                <td>Nama Mahasiswa</td>
                <td>:</td>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <td>University</td>
                <td>:</td>
                <td>{{ $student->university }}</td>
            </tr>
            <tr>
                <td>Bidang</td>
                <td>:</td>
                <td>{{ $student->department_name }}</td>
            </tr>
            <tr>
                <td>Posisi</td>
                <td>:</td>
                <td>{{ $student->position_name }}</td>
            </tr>
            <tr>
                <td>Placement</td>
                <td>:</td>
                <td>{{ $student->placement }}</td>
            </tr>
        </table>
        <table class="tableattendance">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>ID Activity</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Keterangan</th>
                <th>Jumlah Jam</th>
            </tr>
            @foreach ($attendance as $item)
                @php
                    $late = selisih('08:00:00', $item->time_in);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                    <td>{{ $item->activity_id }}</td>
                    <td>{{ $item->time_in }}</td>
                    <td>{{ $item->time_out != null ? $item->time_out : 'Belum Absen!' }}</td>
                    <td>
                        @if ($item->time_in > '08:00')
                            Terlambat! {{ $late }}
                        @else
                            Tepat Waktu!
                        @endif
                    </td>
                    <td>
                        @if ($item->time_out != null)
                            @php
                                $jmljamkerja = selisih($item->time_in, $item->time_out);
                            @endphp
                        @else
                            @php
                                $jmljamkerja = 0;
                            @endphp
                        @endif
                        {{ $jmljamkerja }}
                    </td>
                </tr>
            @endforeach
        </table>

        <table width="100%" style="margin-top: 50px;">
            <tr>
                <td colspan="2" style="text-align: right">Surabaya, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; height:100px; vertical-align:bottom">
                    <u>Bintang Ramadhan</u><br>
                    <i><b>HRD Manager</b></i>
                </td>
                <td style="text-align: center; height:100px; vertical-align:bottom">
                    <u>Bintang Ramadhan</u><br>
                    <i><b>HRD Manager</b></i>
                </td>
            </tr>
        </table>
    </section>

</body>

</html>
