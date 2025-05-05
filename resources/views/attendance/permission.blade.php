@extends('layouts.master2')
@section('header')
    {{-- <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Permission</div>
        <div class="right"></div>
    </div> --}}
    <div class="header-large-title">
        <div class="row">
            <div class="col align-self-center">
                <a href="javascript:;" class="headerButton goBack text-center">
                    <ion-icon name="chevron-back-outline" style="font-size: 32px; color: white;"></ion-icon>
                </a>
            </div>
            <div class="col">
                <h1 class="title text-center" style="margin-left: -160px">Permission</h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 10px">
        <div class="col">
            @php
                $messagesuccess = Session::get('success');
                $messageerror = Session::get('error');
            @endphp
            @if (Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $messagesuccess }}
                </div>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $messageerror }}
                </div>
            @endif
        </div>
    </div>
    <div class="row mt-1">
        <div class="col">
            @foreach ($permission as $item)
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>{{ date('d-m-Y', strtotime($item->date)) }}
                                        ({{ $item->status == 's' ? 'Sakit' : 'Izin' }})
                                    </b><br>
                                    <small class="text-muted">{{ $item->description }}</small>
                                </div>
                                @if ($item->status_approved == 0)
                                    <span class="badge bg-warning">Waiting</span>
                                @elseif($item->status_approved == 1)
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($item->status_approved == 2)
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
    <div class="fab-button bottom-right" style="margin-bottom: 100px">
        <a href="/attendance/creatpermission" class="fab"><ion-icon name="add-outline"></ion-icon></a>
    </div>
@endsection
