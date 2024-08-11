<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Recap Presensi Keseluruhan Mahasiswa MSIB</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A3 with landscape mode -->
    <style>
        @page {
            size: A4 landscape;
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
            margin-top: 10px;
            border-collapse: collapse;
            table-layout: auto;
            overflow: hidden;
        }

        .tableattendance tr th {
            border: 1px solid #000;
            padding: 8px;
            background-color: #dbdbdb;
            font-size: 10px;
        }

        .tableattendance td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 10px;
            word-wrap: break-word;
        }

        .tableattendance td {
            font-size: 12px;
        }

        .photo {
            width: 40px;
            height: 30px;
        }

        /* Print-specific styling */
        @media print {
            body {
                margin: 0;
            }

            .tableattendance th,
            .tableattendance td {
                padding: 5px;
                font-size: 9px;
            }
        }
    </style>
</head>

<body class="A3 landscape">
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

        <table class="tableattendance">
            <tr>
                <th rowspan="2">ID Activity</th>
                <th rowspan="2">Nama Mahasiswa</th>
                <th colspan="31">Tanggal</th>
                <th rowspan="2">Total Hadir</th>
                <th rowspan="2">Total Terlambat</th>
            </tr>
            <tr>
                <?php for ($i=1; $i <=31 ; $i++) { ?>
                <th>{{ $i }}</th>
                <?php } ?>
            </tr>
            @foreach ($recap as $item)
            <tr>
                <td>{{ $item->activity_id }}</td>
                <td>{{ $item->student_name }}</td>
                <?php
                    $totalhadir = 0;
                    $totalterlambat = 0;
                    for ($i=1; $i <= 31; $i++) {
                        $tgl = "tgl_" . $i;
                        if(empty($item->$tgl)){
                            $hadir = ['',''];
                            $totalhadir += 0;
                        }else{
                            $hadir = explode('-', $item->$tgl);
                            $totalhadir += 1;
                            if($hadir[0] > '08:00:00'){
                                $totalterlambat += 1;
                            }
                        }
                    ?>
                <td>
                    <span style="color: {{ $hadir[0] > '08:00:00' ? 'red' : '' }}">{{ $hadir[0] }}</span><br>
                    <span style="color: {{ $hadir[1] < '16:00:00' ? 'red' : '' }}">{{ $hadir[1] }}</span>
                </td>
                <?php } ?>
                <td>{{ $totalhadir }}</td>
                <td>{{ $totalterlambat }}</td>
            </tr>
            @endforeach
        </table>

        <table width="100%" style="margin-top: 50px;">
            <tr>
                <td></td>
                <td style="text-align: center">Surabaya, {{ date('d-m-Y') }}</td>
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
