
@extends('../template/main')

@section('jumbotron', 'Mahasiswa')


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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Table Mahasiswa</h4>
                    <p class="card-category">
                    <p class="card-category">Berikut adalah data mahasiswa yang tersedia</p>
                    </p>
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
                                            {{ $mahasiswas->firstItem() + $loop->index }}
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
                                            {{-- edit mahasiswa with modal --}}
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editMahasiswa{{ $mhs->id }}">
                                                edit
                                            </button>
                                            {{-- delete mahasiswa --}}
                                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    onclick="return confirm('apakah yakin ingin menghapus data {{ $mhs->nama_mahasiswa }} ? ')"
                                                    class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- paginator --}}
                        {{ $mahasiswas->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- modal for insert new mahasiswa --}}
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
                            <input required type="text" class="form-control text-dark" id="nama_mahasiswa" name="nama_mahasiswa"
                                value="{{ old('nama_mahasiswa') }}">
                            @error('nama_mahasiswa')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea required name="alamat" id="alamat" class="form-control text-dark">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_tlp">No Telepon</label>
                            <input required type="text" class="form-control text-dark" id="no_tlp" name="no_tlp"
                                value="{{ old('no_tlp') }}">
                            @error('no_tlp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input required type="email" class="form-control text-dark" id="email" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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

    {{-- modal for edit mahasiswa --}}
    @foreach ($mahasiswas as $mhs)
        <div class="modal fade" id="editMahasiswa{{ $mhs->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editMahasiswa{{ $mhs->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMahasiswa{{ $mhs->id }}">Edit Mahasiswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/mahasiswa/{{ $mhs->id }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                                <input required type="text" class="form-control text-dark" id="nama_mahasiswa"
                                    name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $mhs->nama_mahasiswa) }}">
                                @error('nama_mahasiswa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea required name="alamat" id="alamat" class="form-control text-dark">{{ old('alamat', $mhs->alamat) }}</textarea>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_tlp">No Telepon</label>
                                <input required type="text" class="form-control text-dark" id="no_tlp" name="no_tlp"
                                    value="{{ old('no_tlp', $mhs->no_tlp) }}">
                                @error('no_tlp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input required type="email" class="form-control text-dark" id="email" name="email"
                                    value="{{ old('email', $mhs->email) }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
    @endforeach
    {{-- end modal for edit mahasiswa --}}

@endsection
