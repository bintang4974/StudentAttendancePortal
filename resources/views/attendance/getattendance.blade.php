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
@foreach ($attendance as $item)
    @php
        $photo_in = Storage::url('uploads/absensi/' . $item->photo_in);
        $photo_out = Storage::url('uploads/absensi/' . $item->photo_out);
    @endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->activity_id }}</td>
        <td>{{ $item->name_student }}</td>
        <td>{{ $item->name_department }}</td>
        <td>{{ $item->time_in }}</td>
        <td><img src="{{ url($photo_in) }}" class="avatar"></td>
        <td>
            {!! $item->time_out != null ? $item->time_out : '<span class="badge text-bg-danger">Belum Absen!</span>' !!}
        </td>
        <td>
            @if ($item->time_out != null)
                <img src="{{ url($photo_out) }}" class="avatar">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-hourglass-high">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6.5 7h11" />
                    <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                    <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                </svg>
            @endif
        </td>
        <td>
            @if ($item->time_in > '08:00')
                @php
                    $late = selisih('08:00:00', $item->time_in);
                @endphp
                <span class="badge text-bg-danger">Terlambat! {{ $late }}</span>
            @else
                <span class="badge text-bg-success">Tepat Waktu!</span>
            @endif
        </td>
        <td>
            <a href="#" class="btn btn-primary showmap" id="{{ $item->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                    <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                </svg>
            </a>
        </td>
    </tr>
@endforeach

<script>
    $(function() {
        $('.showmap').click(function(e) {
            var id = $(this).attr('id')
            $.ajax({
                type: 'post',
                url: '/showmap',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                cache: false,
                success: function(res) {
                    $('#loadmap').html(res)
                }
            })
            $('#modal-showmap').modal('show')
        })
    })
</script>
