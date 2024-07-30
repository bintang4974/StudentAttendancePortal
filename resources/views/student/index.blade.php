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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="/student" method="GET">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" name="name_student" id="name_student"
                                                        class="form-control" placeholder="Nama Karyawan"
                                                        value="{{ Request('name_student') }}">
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
                                                <th>NIM</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>University</th>
                                                <th>Gender</th>
                                                <th>City</th>
                                                <th>Address</th>
                                                <th>Photo</th>
                                                <th>Department</th>
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
                                                    <td>{{ $item->nim }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td>{{ $item->university }}</td>
                                                    <td>{{ $item->gender }}</td>
                                                    <td>{{ $item->city }}</td>
                                                    <td>{{ $item->address }}</td>
                                                    <td>
                                                        @if (empty($item->photo))
                                                            <img src="{{ asset('logo/no_photo.png') }}" class="avatar">
                                                        @else
                                                            <img src="{{ url($path) }}" class="avatar">
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->name_department }}</td>
                                                    <td>{{ $item->mentor->name }}</td>
                                                    <td>{{ $item->mentor_id }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $student->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
