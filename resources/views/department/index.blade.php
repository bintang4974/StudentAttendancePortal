@extends('layouts.admin.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Data Department
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @if (Session::get('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if (Session::get('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ Session::get('error') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" class="btn btn-primary" id="btnInputDepartment">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16v6" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                        </svg>
                                        Tambah
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <form action="/department" method="GET">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <input type="text" name="name_dept" id="name_dept"
                                                        class="form-control" placeholder="Nama Karyawan"
                                                        value="{{ Request('name_dept') }}">
                                                </div>
                                            </div>
                                            
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                            <path d="M21 21l-6 -6" />
                                                        </svg>
                                                        Search
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Head Department</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal modal-blur fade" id="modal-inputdepartment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/department/store" method="post" id="frmDepartment">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="" name="name" id="name"
                                        class="form-control" placeholder="Name Department">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-apps">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path
                                                d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path
                                                d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M14 7l6 0" />
                                            <path d="M17 4l0 6" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" name="head_department" id="head_department"
                                        class="form-control" placeholder="Head Department">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" name="phone" id="phone"
                                        class="form-control" placeholder="phone">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal modal-blur fade" id="modal-editdepartment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $('#btnInputDepartment').click(function() {
                // alert("taek")
                $('#modal-inputdepartment').modal('show')
            })

            // mengambil class edit button dengan idmhs
            $('.edit').click(function() {
                var iddept = $(this).attr('iddept')
                // alert(iddept)
                $.ajax({
                    type: 'POST',
                    url: '/department/edit',
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        iddept: iddept
                    },
                    success: function(res) {
                        $('#loadeditform').html(res);
                    }
                })
                $('#modal-editdepartment').modal('show')
            })

            $('.delete-confirm').click(function(e) {
                var form = $(this).closest('form')
                e.preventDefault()
                Swal.fire({
                    title: "Apakah anda yakin menghapus data ini?",
                    text: "Tekan OK untuk menghapus data",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "OK!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit()
                        Swal.fire({
                            title: "Deleted!",
                            text: "Data berhasil dihapus",
                            icon: "success"
                        });
                    }
                });
            })

            $('#frmStudent').submit(function() {
                var name = $('#name').val();
                var nim = $('#nim').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var phone = $('#phone').val();
                var university = $('#university').val();
                var gender = $('#gender').val();
                var city = $('#city').val();
                var address = $('#address').val();
                var photo = $('#photo').val();
                var department_id = $('#frmStudent').find('#department_id').val();
                var mentor_id = $('#mentor_id').val();

                if (name == '') {
                    // alert('name harus diisi')
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Name harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                } else if (nim == '') {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'NIM harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                } else if (email == '') {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'email harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                } else if (password == '') {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'password harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                } else if (phone == '') {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'phone harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                } else if (university == '') {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'university harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                } else if (gender == '') {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'gender harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                } else if (city == '') {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'city harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                } else if (address == '') {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'address harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                } else if (department_id == '') {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'department_id harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                } else if (mentor_id == '') {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'mentor_id harus diisi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        $('#name').focus();
                    })
                    return false
                }
            })
        })
    </script>
@endpush
