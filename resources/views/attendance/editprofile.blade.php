@extends('layouts.master')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Edit Profile</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 4rem;">
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
    <form action="/attendance/{{ $student->id }}/updateprofile" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" value="{{ $student->name }}" name="name"
                        placeholder="Name" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" value="{{ $student->email }}" name="email"
                        placeholder="Email" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" value="{{ $student->phone }}" name="phone"
                        placeholder="Phone" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                </div>
            </div>
            <div class="custom-file-upload" id="fileUpload1">
                <input type="file" name="photo" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                <label for="fileuploadInput">
                    <span>
                        <strong>
                            <ion-icon name="cloud-upload-outline" role="img" class="md hydrated"
                                aria-label="cloud upload outline"></ion-icon>
                            <i>Tap to Upload</i>
                        </strong>
                    </span>
                </label>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <button type="submit" class="btn btn-primary btn-block">
                        <ion-icon name="refresh-outline"></ion-icon>
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="row" style="margin-bottom: 2rem;">
        <div class="col mb-5 text-center">
            <a href="/processlogout" class="btn btn-danger w-50 btn-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                    <path d="M9 12h12l-3 -3" />
                    <path d="M18 15l3 -3" />
                </svg>
                Logout
            </a>
        </div>
    </div>
@endsection
