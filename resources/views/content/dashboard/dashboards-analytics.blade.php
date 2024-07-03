@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-12 col-2 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success"
                                class="rounded">
                        </div>
                    </div>
                    <span>Total Transaction</span>
                    <h3 class="card-title text-nowrap mb-1">{{ $total_prodcut }}</h3>
                    <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i> +28.42%</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-2 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                class="rounded">
                        </div>
                    </div>
                    <span>Total Transaction</span>
                    <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                    <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i> +28.42%</small>
                </div>
            </div>
        </div>
    </div>
@endsection
