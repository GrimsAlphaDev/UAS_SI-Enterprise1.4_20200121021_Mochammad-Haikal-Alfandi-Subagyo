@extends('../template/main')

@section('jumbotron', 'Absen')

@section('content')

    {{-- if there is error --}}
    @if ($errors->any())
        <div class="row">
            <div class="col">
                <div class="alert alert-danger alert-dismissible fade show">
                    <h3>Atention !</h3>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Success Notif --}}
    @if (session()->has('success'))
        <div class="row">
            <div class="col">
                <div class="alert alert-success alert-dismissible fade show">
                    <h3>Success !</h3>
                    <p>{{ session()->get('success') }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Error Notif --}}
    @if (session()->has('error'))
        <div class="row">
            <div class="col">
                <div class="alert alert-danger alert-dismissible fade show">
                    <h3>Gagal !</h3>
                    <p>{{ session()->get('error') }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Absen Mahasiswa</h4>
                    <p class="card-category">Daftar Matakuliah</p>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">
                            {{-- table --}}
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>SKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($matakuliahs as $matakuliah)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="getabsen/{{ $matakuliah->id }}" 
                                                    class="
                                                      text-primary
                                                    ">{{ $matakuliah->nama_matakuliah }}</a></td>
                                                <td>{{ $matakuliah->sks }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection
