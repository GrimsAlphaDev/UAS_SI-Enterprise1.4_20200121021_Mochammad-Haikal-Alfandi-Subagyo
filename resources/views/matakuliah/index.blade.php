@extends('../template/main')

@section('jumbotron', 'Mata Kuliah')

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
                    <h4 class="card-title">Data Mata Kuliah</h4>
                    <p class="card-category">Berikut adalah data mata kuliah yang tersedia</p>
                </div>
                <div class="card-body">

                    <button type="button" class="btn btn-primary btn-round float-right" data-toggle="modal"
                        data-target="#addMatakuliah">
                        <i class="material-icons">add</i>
                        <span class="card-title text-white">Tambah Matakuliah</span>
                    </button>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matakuliahs as $matakuliah)
                                    <tr>
                                        <td>{{ $matakuliahs->firstItem() + $loop->index }}</td>
                                        <td>{{ $matakuliah->nama_matakuliah }}</td>
                                        <td>{{ $matakuliah->sks }}</td>
                                        <td>
                                            {{-- edit matakuliah with modal --}}
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editMatakuliah{{ $matakuliah->id }}">
                                                Edit
                                            </button>
                                            {{-- delete matakuliah --}}
                                            <form action="/matakuliah/{{ $matakuliah->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('apakah yakin ingin mengapus data {{ $matakuliah->nama_matakuliah }} ?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- paginator --}}
                        {{ $matakuliahs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Add Matakuliah --}}
    <div class="modal fade" id="addMatakuliah" tabindex="-1" role="dialog" aria-labelledby="addMatakuliahLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMatakuliahLabel">Tambah Matakuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/matakuliah" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama_matakuliah">Nama Mata Kuliah</label>
                            <input required type="text" class="form-control text-dark" id="nama_matakuliah" name="nama_matakuliah"
                                value="{{ old('nama_matakuliah') }}">
                            @error('nama_matakuliah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sks">SKS</label>
                            <input required type="number" class="form-control text-dark" id="sks" name="sks"
                                value="{{ old('sks') }}">
                            @error('sks')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Add matakuliah Modal --}}

    {{-- Modal Edit Matakuliah --}}
    @foreach ($matakuliahs as $matakuliah)
        <div class="modal fade" id="editMatakuliah{{ $matakuliah->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editMatakuliahLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMatakuliahLabel">Edit Matakuliah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/matakuliah/{{ $matakuliah->id }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="nama_matakuliah">Nama Mata Kuliah</label>
                                <input required type="text" class="form-control text-dark" id="nama_matakuliah"
                                    name="nama_matakuliah" value="{{ $matakuliah->nama_matakuliah }}">
                                @error('nama_matakuliah')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sks">SKS</label>
                                <input required type="number" class="form-control text-dark" id="sks" name="sks"
                                    value="{{ $matakuliah->sks }}">
                                @error('sks')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- End of Edit matakuliah Modal --}}
@endsection
