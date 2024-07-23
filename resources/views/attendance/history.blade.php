@extends('layouts.master')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">History</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="month" id="month" class="form-control">
                            <option value="">Month</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>
                                    {{ $namemonth[$i] }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="year" id="year" class="form-control">
                            <option value="">Year</option>
                            @php
                                $yearstart = 2023;
                                $yearnow = date('Y');
                            @endphp
                            @for ($year = $yearstart; $year <= $yearnow; $year++)
                                <option value="{{ $year }}" {{ date('Y') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" id="getdata">
                            <ion-icon name="search-outline"></ion-icon>Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" id="showhistory"></div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function(){
            $('#getdata').click(function(e){
                var month = $('#month').val();
                var year = $('#year').val();
                
                $.ajax({
                    type: 'POST',
                    url: '/gethistory',
                    data: {
                        _token: "{{csrf_token()}}",
                        month: month,
                        year: year
                    },
                    cache: false,
                    success: function(res) {
                        $('#showhistory').html(res);
                    }
                })
            })
        })
    </script>
@endpush
