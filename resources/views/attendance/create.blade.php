@extends('layouts.master')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Attendance</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection

<style>
    .webcam-capture,
    .webcam-capture video{
        display: inline-block;
        width: 100% !important;
        height: auto !important;
        margin: auto;
        border-radius: 15px;
    }
</style>

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            {{-- <input type="text" id="location"> --}}
            <div class="webcam-capture"></div>
        </div>

    </div>
@endsection

@push('myscript')
    <script>
        Webcam.set({
            height: 400,
            width: 640,
            image_format: 'jpeg',
            jpeg_quality: 80
        });

        Webcam.attach('.webcam-capture');

        // var location = document.getElementById('location');
        // if(navigator.geolocation){
        //     navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        // }

        // function successCallback(position){
        //     location.value = position.coords.latitude;
        // }
    </script>
@endpush
