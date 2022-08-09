@extends('../template/main')

@section('jumbotron', 'Absen Mahasiswa')

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
                    <h4 class="card-title">Absen Mata Kuliah <b>{{ $matakuliah->nama_matakuliah }}</b></h4>
                    <p class="card-category">Absen Mahasiswa</p>
                </div>

                <div class="card-body">

                    {{-- insert new absen using modal --}}
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#absenModal">
                        <i class="material-icons">add</i>
                        <span>Absen</span>
                    </button>

                    {{-- back button --}}
                    <a href="{{ url('/absen') }}" class="btn btn-danger float-right mr-2">
                        <i class="material-icons">arrow_back</i>
                        <span>Kembali</span>
                    </a>


                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Waktu Absen</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absens as $absen) 
                                    <tr>
                                        <td>{{ $absens->firstItem() + $loop->index }}</td>
                                        <td>{{ $absen->mahasiswa->nama_mahasiswa }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($absen->waktu_absen)) }}</td>
                                        <td>{{ $absen->keterangan }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{-- paginator --}}
                        {{ $absens->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- insert new absen using modal --}}
    <div class="modal fade" id="absenModal" tabindex="-1" role="dialog" aria-labelledby="absenModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="absenModalLabel">Absen Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('absen.store') }}" method="POST">
                        @csrf

                        <input required type="hidden" name="matakuliah_id" value="{{ $matakuliah->id }}">

                        <div class="form-group">
                            <label for="mahasiswa_id">Nama Mahasiswa</label>
                            <select name="mahasiswa_id" id="mahasiswa_id" class="form-control text-dark">
                                <option selected disabled>-- Pilih Mahasiswa --</option>
                                @foreach ($mahasiswas as $mahasiswa)
                                        
                                    <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nama_mahasiswa }}</option>
                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <select name="keterangan" id="keterangan" class="form-control text-dark">
                                <option selected disabled>-- Pilih Keterangan --</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Tidak Hadir">Tidak Hadir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="waktu_absen">Waktu Absen</label>
                            <input required type="datetime-local" name="waktu_absen" id="waktu_absen" class="form-control text-dark">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons">save</i>
                                <span>Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
