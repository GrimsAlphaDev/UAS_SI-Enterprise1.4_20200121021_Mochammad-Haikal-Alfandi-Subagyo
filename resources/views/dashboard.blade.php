@extends('template/main')

@section('jumbotron', 'Dashboard')

@section('content')
    <div class="row mb-2">
        <div class="col">
                <h2 class="text-white">Welcome, {{ Auth::user()->name }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-12">
            <div class="card card-chart">
                <div class="card-header card-header-success">
                    <div class="ct-chart" id="dailySalesChart"></div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Daily Sales</h4>
                    <p class="card-category">
                        <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span>
                        increase in today sales.
                    </p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> updated 4 minutes ago
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card card-chart">
                <div class="card-header card-header-warning">
                    <div class="ct-chart" id="websiteViewsChart"></div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Email Subscriptions</h4>
                    <p class="card-category">Last Campaign Performance</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> campaign sent 2 days ago
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card card-chart">
                <div class="card-header card-header-danger">
                    <div class="ct-chart" id="completedTasksChart"></div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Completed Tasks</h4>
                    <p class="card-category">Last Campaign Performance</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> campaign sent 2 days ago
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
