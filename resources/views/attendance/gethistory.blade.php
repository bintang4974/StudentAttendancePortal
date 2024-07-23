@if ($history->isEmpty())
    <div class="alert alert-danger">Data Absen Belum Ada Pada Bulan Ini</div>
@endif
@foreach ($history as $item)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $path = Storage::url('uploads/absensi/' . $item->photo_in);
                @endphp
                <img src="{{ url($path) }}" alt="image" class="image">
                <div class="in">
                    <div>
                        <b>{{ date('d-m-Y', strtotime($item->date)) }}</b><br>
                        {{-- <small class="text-mute">Divisi</small> --}}
                    </div>
                    <span class="badge {{ $item->time_in < '08:00' ? 'bg-success' : 'bg-danger' }}">
                        {{ $item->time_in }}
                    </span>
                    <span class="badge badge-info">{{ $item->time_out }}</span>
                </div>
            </div>
        </li>
    </ul>
@endforeach
