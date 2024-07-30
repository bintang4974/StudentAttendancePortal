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
                                            <td>{{ $loop->iteration }}</td>
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
                                            <td>{{ $item->department->name }}</td>
                                            <td>{{ $item->mentor->name }}</td>
                                            <td>{{ $item->mentor_id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $student->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
