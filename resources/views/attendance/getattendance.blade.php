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
                <span class="badge text-bg-danger">Terlambat!</span>
            @else
                <span class="badge text-bg-success">Tepat Waktu!</span>
            @endif
        </td>
    </tr>
@endforeach
