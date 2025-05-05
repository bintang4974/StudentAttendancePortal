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
                        Data Evidence
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form method="GET" class="mb-3">
                <label for="month">Filter by Month:</label>
                <input type="month" name="month" id="month" class="form-control" value="{{ $month }}">
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </form>

            @if ($evidences->isEmpty())
                <p class="text-muted">No evidence submitted this month.</p>
            @else
                <ul class="list-group">
                    @foreach ($evidences as $evidence)
                        <li class="list-group-item">
                            <strong>{{ $evidence->student->name }} –
                                {{ $evidence->created_at->format('d M Y, H:i') }}</strong><br>
                            <p>{{ $evidence->description }}</p>
                            @if ($evidence->file_path)
                                <a href="{{ Storage::url($evidence->file_path) }}" target="_blank">View Attachment</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
