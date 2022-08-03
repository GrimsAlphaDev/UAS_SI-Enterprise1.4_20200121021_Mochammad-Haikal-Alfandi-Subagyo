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
                <div class="card-header card-header-success p-1">
                    <img src="{{ url('assets/img/stockimage/student.jpg') }}" alt="Students" class="w-100" style="height: 185px;">
                </div>
                <div class="card-body">
                    <h4 class="card-title">Mahasiswa</h4>
                    <p class="card-category">
                        <a class="text-success" href="/mahasiswa">Pergi Ke Page Mahasiswa</a>
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
                <div class="card-header card-header-warning p-1">
                    <img src="{{ url('assets/img/stockimage/books.jpg') }}" alt="books" class="w-100">
                </div>
                <div class="card-body">
                    <h4 class="card-title">Matakuliah</h4>
                    <p class="card-category">
                        <a class="text-warning" href=""> Pergi Ke Page Matakuliah</a>
                    </p>
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
                <div class="card-header card-header-danger p-1">
                    <img src="{{ url('assets/img/stockimage/time.jpg') }}" alt="time" class="w-100">
                </div>
                <div class="card-body">
                    <h4 class="card-title">Jadwal</h4>
                    <a class="text-danger" href=""> Pergi Ke Page Jadwal</a>
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
