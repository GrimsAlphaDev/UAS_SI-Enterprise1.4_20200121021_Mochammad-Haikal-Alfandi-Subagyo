@extends('../template/main')

@section('jumbotron', 'Kontrak Matakuliah')

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
                    <h4 class="card-title">Kontrak Matakuliah</h4>
                    <p class="card-category">Daftar Kontrak Matakuliah</p>
                </div>
                <div class="card-body">

                    <button type="button" class="btn btn-primary btn-round float-right" data-toggle="modal"
                        data-target="#addKontrak">
                        <i class="material-icons">add</i>
                        <span class="card-title text-white">Tambah Kontrak Matakuliah</span>
                    </button>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class=" text-primary">
                                <th>
                                    No
                                </th>
                                <th>
                                    Nama Mahasiswa
                                </th>
                                <th>
                                    Alamat Mahasiswa
                                </th>
                                <th>
                                    No Telp Mahasiswa
                                </th>
                                <th>
                                    Email Mahasiswa
                                </th>
                                <th>
                                    Semester
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($kontrak_matakuliahs as $k)
                                    <tr>
                                        <td>
                                            {{ $kontrak_matakuliahs->firstItem() + $loop->index }}
                                        </td>
                                        <td>
                                            {{ $k->mahasiswa->nama_mahasiswa }}
                                        </td>
                                        <td>
                                            {{ $k->mahasiswa->alamat }}
                                        </td>
                                        <td>
                                            {{ $k->mahasiswa->no_tlp }}
                                        </td>
                                        <td>
                                            {{ $k->mahasiswa->email }}
                                        </td>
                                        <td>
                                            {{ $k->semester->semester }}
                                        </td>
                                        <td>
                                            {{-- edit kontrak with modal --}}
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editKontrak{{ $k->id }}">
                                                edit
                                            </button>
                                            {{-- delete kontrak --}}
                                            <form action="/kontrak/{{ $k->id }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name = "id" value="{{ $k->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('apakah yakin ingin mengapus data {{ $k->mahasiswa->nama_mahasiswa }} ?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- paginator --}}
                        {{ $kontrak_matakuliahs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- add kontrak with modal --}}
    <div class="modal fade" id="addKontrak" tabindex="-1" role="dialog" aria-labelledby="addKontrakLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKontrakLabel">Tambah Kontrak Matakuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kontrak.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="mahasiswa">Mahasiswa</label>
                            <select required name="mahasiswa_id" id="mahasiswa" class="form-control text-dark">
                                <option disabled selected> -- Pilih Mahasiswa -- </option>
                                @foreach ($mahasiswafresh as $mahasiswa)
                                    <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nama_mahasiswa }}</option>
                                @endforeach
                            </select>
                            @error('mahasiswa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select required name="semester_id" id="semester" class="form-control text-dark">
                                <option disabled selected> -- Pilih Semester -- </option>
                                @foreach ($semesters as $s)
                                    <option value="{{ $s->id }}">{{ $s->semester }}</option>
                                @endforeach
                            </select>
                            @error('semester')
                                <span class="text-danger">{{ $message }}</span>
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
    {{-- end of modal for insert kontrak --}}

    {{-- edit kontrak with modal --}}
    @foreach ($kontrak_matakuliahs as $kontrak)
        <div class="modal fade" id="editKontrak{{ $kontrak->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editKontrakLabel{{ $kontrak->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editKontrakLabel{{ $kontrak->id }}">Edit Kontrak Matakuliah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/kontrak/{{ $kontrak->id }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name = "id" value="{{ $kontrak->id }}">

                            <div class="form-group">
                                <label for="mahasiswa">Mahasiswa</label>
                                <select required name="mahasiswa_id" id="mahasiswa" class="form-control text-dark">
                                    <option disabled selected> -- Pilih Mahasiswa -- </option>
                                    @foreach ($mahasiswas as $mahasiswa)
                                        @if ($mahasiswa->id == $kontrak->mahasiswa_id)
                                           <option value="{{ $mahasiswa->id }}" selected>{{ $mahasiswa->nama_mahasiswa }}</option>
                                        @endif
                                    @endforeach
                                    @foreach ($mahasiswafresh as $mahasiswa)
                                        <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nama_mahasiswa }}</option>
                                    @endforeach

                                </select>
                                @error('mahasiswa')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label
                                    for="semester
                                {{ $kontrak->semester_id }}">Semester</label>
                                <select required name="semester_id" id="semester" class="form-control text-dark">
                                    <option disabled selected> -- Pilih Semester -- </option>
                                    @foreach ($semesters as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $kontrak->semester_id == $s->id ? 'selected' : '' }}>
                                            {{ $s->semester }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('semester')
                                    <span class="text-danger">{{ $message }}</span>
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
    {{-- end of modal for edit kontrak --}}


@endsection
