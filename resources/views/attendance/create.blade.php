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
    .webcam-capture video {
        display: inline-block;
        width: 100% !important;
        height: auto !important;
        margin: auto;
        border-radius: 15px;
    }

    #map {
        height: 200px;
    }
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <input type="hidden" id="location">
            <div class="webcam-capture"></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button id="takeattendance" class="btn btn-primary btn-block">
                <ion-icon name="camera-outline"></ion-icon>
                Absen Masuk
            </button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
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

        const x = document.getElementById("location");

        // function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        // }

        function showPosition(position) {
            x.value = position.coords.latitude + "," + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
        }

        $('#takeattendance').click(function(e) {
            Webcam.snap(function(uri) {
                image = uri;
            })
            var loc = $('#location').val();
            console.log('image: ', image)
            console.log('loc: ', loc)

            $.ajax({
                type: 'POST',
                url: '/attendance/store',
                data: {
                    _token: '{{ csrf_token() }}',
                    image: image,
                    lokasi: loc
                },
                cache: false,
                success: function(res) {
                    if (res == 0) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Matursuwon!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                        setTimeout("location.href='/dashboard'", 3000);
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal Absen!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    }
                }
            })
        })
    </script>
@endpush
