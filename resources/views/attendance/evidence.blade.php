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
    <div class="container mt-2">
        <form action="{{ route('store.evidence') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group mt-2">
                <label>Upload File (optional)</label>
                <input type="file" name="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Submit Evidence</button>
        </form>
    </div>
@endsection
