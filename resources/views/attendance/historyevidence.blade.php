@extends('layouts.master2')

@section('header')
    <div class="header-large-title">
        <div class="row">
            <div class="col align-self-center">
                <a href="javascript:;" class="headerButton goBack text-center">
                    <ion-icon name="chevron-back-outline" style="font-size: 32px; color: white;"></ion-icon>
                </a>
            </div>
            <div class="col">
                <h1 class="title text-center" style="margin-left: -160px">Evidence</h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <form method="GET" class="mb-3 mt-2">
            <label for="month">Filter by Month:</label>
            <input type="month" name="month" id="month" class="form-control" value="{{ $month }}">
            <button type="submit" class="btn btn-primary mt-2">Filter</button>
        </form>
    </div>

    @if ($evidences->isEmpty())
        <p class="text-muted">No evidence found for selected month.</p>
    @else
        <ul class="list-group">
            @foreach ($evidences as $evidence)
                <li class="list-group-item">
                    <strong>{{ $evidence->created_at->format('d M Y, H:i') }}</strong><br>
                    <span>{{ $evidence->description }}</span><br>
                    @if ($evidence->file_path)
                        <a href="{{ Storage::url($evidence->file_path) }}" target="_blank">View File</a>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@endsection
