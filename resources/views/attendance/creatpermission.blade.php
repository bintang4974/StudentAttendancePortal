@extends('layouts.master')
@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .datepicker-modal {
            max-height: 430px !important;
        }

        .datepicker-date-display {
            background-color: #0f3a7e !important;
        }
    </style>
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Form Permission</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <form action="/attendance/storepermission" method="post" id="frmPermission">
                @csrf
                <div class="form-group">
                    <input type="text" id="date" name="date" class="form-control datepicker"
                        placeholder="Tanggal">
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control">
                        <option value="">Izin / Sakit</option>
                        <option value="i">Izin</option>
                        <option value="s">Sakit</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                        placeholder="Keterangan"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary w-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        var currYear = (new Date()).getFullYear();

        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd"
            })

            $("#date").change(function(e) {
                var date_permis = $(this).val();
                $.ajax({
                    type: 'post',
                    url: '/attendance/checkpermission',
                    data: {
                        _token: "{{ csrf_token() }}",
                        date: date_permis
                    },
                    cache: false,
                    success: function(res) {
                        // alert(res)
                        if (res == 1) {
                            Swal.fire({
                                title: 'Oops!',
                                text: 'Anda Sudah Melakukan Izin Pada Tanggal Tersebut!',
                                icon: 'warning'
                            }).then((res) => {
                                $("#date").val("");
                            })
                        }
                    }
                });
            })

            $('#frmPermission').submit(function() {
                var date = $('#date').val();
                var status = $('#status').val();
                var description = $('#description').val();

                if (date == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Tanggal Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    return false;
                } else if (status == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Status Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    return false;
                } else if (description == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Keterangan Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    return false;
                }
            })
        })
    </script>
@endpush
