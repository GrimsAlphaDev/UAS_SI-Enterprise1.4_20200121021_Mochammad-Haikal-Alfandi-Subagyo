@extends('../template/main')

@section('jumbotron', 'Mahasiswa')

@section('navbarsearch')
    <form class="navbar-form">
        <div class="input-group no-border">
            <input type="text" value="" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-default btn-round btn-just-icon">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
            </button>
        </div>
    </form>
@endsection

@section('content')

    {{-- if there is error --}}
    @if ($errors->any())
        <div class="row">
            <div class="col">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Table Mahasiswa</h4>
                </div>

                <div class="card-body">

                    <button type="button" class="btn btn-primary btn-round float-right" data-toggle="modal"
                        data-target="#addMahasiswa">
                        <i class="material-icons">add</i>
                        <span class="card-title text-white">Tambah Mahasiswa</span>
                    </button>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    No
                                </th>
                                <th>
                                    Nama Mahasiswa
                                </th>
                                <th>
                                    Alamat
                                </th>
                                <th>
                                    No Telepon
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswas as $mhs)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $mhs->nama_mahasiswa }}
                                        </td>
                                        <td>
                                            {{ $mhs->alamat }}
                                        </td>
                                        <td>
                                            {{ $mhs->no_tlp }}
                                        </td>
                                        <td>
                                            {{ $mhs->email }}
                                        </td>
                                        <td>
                                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- modal --}}
    <div class="modal fade" id="addMahasiswa" tabindex="-1" role="dialog" aria-labelledby="addMahasiswa"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMahasiswa">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/mahasiswa" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_mahasiswa">Nama Mahasiswa</label>
                            <input type="text" class="form-control text-dark" id="nama_mahasiswa" name="nama_mahasiswa"
                                value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control text-dark">{{ old('alamat') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="no_tlp">No Telepon</label>
                            <input type="text" class="form-control text-dark" id="no_tlp" name="no_tlp"
                                value="{{ old('no_tlp') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control text-dark" id="email" name="email"
                                value="{{ old('email') }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}

@endsection
