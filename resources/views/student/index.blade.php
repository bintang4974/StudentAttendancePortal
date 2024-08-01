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
                        Data Mahasiswa
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
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
                    <a href="#" class="btn btn-primary" id="btnInputstudent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
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
                    <form action="/student" method="GET">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" name="name_student" id="name_student" class="form-control"
                                        placeholder="Nama Karyawan" value="{{ Request('name_student') }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <select name="name_dept" id="name_dept" class="form-select">
                                    <option value="">Department</option>
                                    @foreach ($department as $item)
                                        <option {{ Request('name_dept') == $item->name ? 'selected' : '' }}
                                            value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
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
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>ID Activity</th>
                                <th>NIM</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>University</th>
                                <th>Gender</th>
                                <th>Placement</th>
                                <th>Photo</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Mentor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student as $item)
                                @php
                                    $path = Storage::url('uploads/student/' . $item->photo);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration + $student->firstItem() - 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->activity_id }}</td>
                                    <td>{{ $item->nim }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->university }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->placement }}</td>
                                    <td>
                                        @if (empty($item->photo))
                                            <img src="{{ asset('logo/no_photo.png') }}" class="avatar">
                                        @else
                                            <img src="{{ url($path) }}" class="avatar">
                                        @endif
                                    </td>
                                    <td>{{ $item->name_department }}</td>
                                    <td>{{ $item->position->name }}</td>
                                    <td>{{ $item->mentor->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="edit btn btn-warning btn-sm"
                                                idmhs="{{ $item->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </a>
                                            <form action="/student/{{ $item->id }}/delete" method="post"
                                                style="margin-left: 5px;">
                                                @csrf
                                                <a class="btn btn-danger btn-sm delete-confirm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $student->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal modal-blur fade" id="modal-inputstudent" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/student/store" method="post" id="frmStudent" enctype="multipart/form-data">
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
                                        class="form-control" placeholder="Nama">
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
                                    <input type="text" value="" name="activity_id" id="activity_id"
                                        class="form-control" placeholder="ID Kegiatan">
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
                                    <input type="text" value="" name="nim" id="nim"
                                        class="form-control" placeholder="NIM">
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
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                            <path d="M3 7l9 6l9 -6" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" name="email" id="email"
                                        class="form-control" placeholder="email">
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
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-building">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 21l18 0" />
                                            <path d="M9 8l1 0" />
                                            <path d="M9 12l1 0" />
                                            <path d="M9 16l1 0" />
                                            <path d="M14 8l1 0" />
                                            <path d="M14 12l1 0" />
                                            <path d="M14 16l1 0" />
                                            <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" name="university" id="university"
                                        class="form-control" placeholder="university">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <select name="gender" id="gender" class="form-select">
                                    <option value="">Pilih Gender</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <textarea name="placement" id="placement" class="form-control" placeholder="placement"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="currentColor"
                                            class="icon icon-tabler icons-tabler-filled icon-tabler-polaroid">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9.199 9.623l.108 .098l3.986 3.986l.094 .083a1 1 0 0 0 1.403 -1.403l-.083 -.094l-.292 -.293l1.292 -1.293l.106 -.095c.457 -.38 .918 -.38 1.386 .011l.108 .098l4.502 4.503a4.003 4.003 0 0 1 -3.596 2.77l-.213 .006h-12a4.002 4.002 0 0 1 -3.809 -2.775l5.516 -5.518l.106 -.095c.457 -.38 .918 -.38 1.386 .011zm8.801 -7.623a4 4 0 0 1 3.995 3.8l.005 .2v6.585l-3.293 -3.292l-.15 -.137c-1.256 -1.095 -2.85 -1.097 -4.096 -.017l-.154 .14l-1.307 1.306l-2.293 -2.292l-.15 -.137c-1.256 -1.095 -2.85 -1.097 -4.096 -.017l-.154 .14l-4.307 4.306v-6.585a4 4 0 0 1 3.8 -3.995l.2 -.005h12zm-2.99 3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" />
                                            <path
                                                d="M8.01 20a1 1 0 0 1 .117 1.993l-.127 .007a1 1 0 0 1 -.117 -1.993l.127 -.007z" />
                                            <path
                                                d="M12.01 20a1 1 0 0 1 .117 1.993l-.127 .007a1 1 0 0 1 -.117 -1.993l.127 -.007z" />
                                            <path
                                                d="M16.01 20a1 1 0 0 1 .117 1.993l-.127 .007a1 1 0 0 1 -.117 -1.993l.127 -.007z" />
                                        </svg>
                                    </span>
                                    <input type="file" value="" name="photo" id="photo"
                                        class="form-control" placeholder="photo">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <select name="department_id" id="department_id" class="form-select">
                                    <option value="">Pilih Department</option>
                                    @foreach ($department as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <select name="position_id" id="position_id" class="form-select">
                                    <option value="">Pilih Posisi</option>
                                    @foreach ($position as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <select name="mentor_id" id="mentor_id" class="form-select">
                                    <option value="">Pilih Mentor</option>
                                    @foreach ($mentor as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
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
    <div class="modal modal-blur fade" id="modal-editstudent" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mahasiswa</h5>
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
            $('#btnInputstudent').click(function() {
                // alert("taek")
                $('#modal-inputstudent').modal('show')
            })

            // mengambil class edit button dengan idmhs
            $('.edit').click(function() {
                var idmhs = $(this).attr('idmhs')
                // alert(idmhs)
                $.ajax({
                    type: 'POST',
                    url: '/student/edit',
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        idmhs: idmhs
                    },
                    success: function(res) {
                        $('#loadeditform').html(res);
                    }
                })
                $('#modal-editstudent').modal('show')
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
                var activity_id = $('#activity_id').val();
                var nim = $('#nim').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var phone = $('#phone').val();
                var university = $('#university').val();
                var gender = $('#gender').val();
                var placement = $('#placement').val();
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
