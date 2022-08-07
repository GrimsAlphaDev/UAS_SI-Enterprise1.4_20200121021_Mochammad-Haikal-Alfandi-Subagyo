@extends('../template/main')

@section('jumbotron', 'Semester')

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
                    <h4 class="card-title">Data Semester</h4>
                    <p class="card-category">Berikut adalah data semester yang tersedia</p>
                </div>
                <div class="card-body">

                    <button type="button" class="btn btn-primary btn-round float-right" data-toggle="modal"
                        data-target="#addSemester">
                        <i class="material-icons">add</i>
                        <span class="card-title text-white">Tambah Semester</span>
                    </button>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semesters as $semester)
                                    <tr>
                                        <td>{{ $semesters->firstItem() + $loop->index }}</td>
                                        <td>Semester {{ $semester->semester }}</td>
                                        <td>
                                            {{-- edit semester with modal --}}
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editSemester{{ $semester->id }}">
                                                Edit
                                            </button>
                                            {{-- delete Semester --}}
                                            <form action="/semester/{{ $semester->id }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('apakah yakin ingin mengapus Semester {{ $semester->semester }} ?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- paginator --}}
                        {{ $semesters->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- add semester with modal --}}
    <div class="modal fade" id="addSemester" tabindex="-1" role="dialog" aria-labelledby="addSemester"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSemester">Tambah Semester</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/semester" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input required type="number" class="form-control text-dark" id="semester" name="semester"
                                value="{{ old('semester') }}">
                            @error('semester')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end of add semester modal --}}

    {{-- edit semester with modal --}}
    @foreach ($semesters as $semester)
        <div class="modal fade" id="editSemester{{ $semester->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editSemester{{ $semester->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSemester{{ $semester->id }}">Edit Semester</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/semester/{{ $semester->id }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input required type="number" class="form-control text-dark" id="semester" name="semester"
                                    value="{{ old('semester',$semester->semester) }}">
                                @error('semester')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end of edit semester modal --}}
@endsection
