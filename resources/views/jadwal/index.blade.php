@extends('../template/main')

@section('jumbotron', 'Jadwal')

@section('content')

    <div class="row">
        <div class="col">
            {{-- table --}}
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Jadwal</h4>
                    <p class="card-category">
                    <p class="card-category">Berikut adalah data jadwal kuliah yang tersedia</p>
                    </p>
                </div>

                <div class="card-body">

                    <button type="button" class="btn btn-primary btn-round float-right" data-toggle="modal"
                        data-target="#addJadwal">
                        <i class="material-icons">add</i>
                        <span class="card-title text-white">Tambah Jadwal</span>
                    </button>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Jadwal</th>
                                    <th>Nama Matakuliah</th>
                                    <th>SKS</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $jadwal)
                                    <tr>
                                        <td>{{ $jadwals->firstItem() + $loop->index }}</td>
                                        <td><b>{{ $jadwal->jadwal }}</b></td>
                                        <td>{{ $jadwal->matakuliah->nama_matakuliah }}</td>
                                        <td>{{ $jadwal->matakuliah->sks }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editJadwal{{ $jadwal->id }}">
                                                edit
                                            </button>
                                            <form action="/jadwal/{{ $jadwal->id }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit"
                                                    onclick="return confirm('apakah yakin ingin menghapus jadwal {{ $jadwal->jadwal }} ? ')"
                                                    class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- paginator --}}
                            {{ $jadwals->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal for add jadwal --}}
    <div class="modal fade" id="addJadwal" tabindex="-1" role="dialog" aria-labelledby="addJadwal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJadwal">Tambah Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/jadwal" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="hari" class="mb-2">Hari</label>
                            {{-- selection --}}
                            <select required name="hari" id="hari" class="form-control text-dark">
                                <option disabled selected> -- Pilih Hari --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                            @error('hari')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_mulai" class="mb-2">Jam Mulai</label>
                            <input required type="time" class="form-control text-dark" id="jam_mulai" name="jam_mulai"
                                min="07:00" max="18:00" value="{{ old('jam_mulai') }}">
                            @error('jam_mulai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_selesai" class="mb-2">Jam Selesai</label>
                            <input required type="time" class="form-control text-dark" id="jam_selesai"
                                name="jam_selesai" min="07:00" max="18:00" value="{{ old('jam_selesai') }}">
                            @error('jam_selesai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="matakuliah_id">Matakuliah</label>
                            <select required class="form-control text-dark" id="matakuliah_id" name="matakuliah_id">
                                <option disabled selected>-- Pilih Matakuliah --</option>
                                @foreach ($matakuliahs as $matakuliah)
                                    <option value="{{ $matakuliah->id }}">{{ $matakuliah->nama_matakuliah }}</option>
                                @endforeach
                            </select>
                            @error('matakuliah_id')
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
    {{-- end modal for insert jadwal --}}

    {{-- modal for edit jadwal --}}
    @foreach ($jadwals as $jadwal)
        {{-- slice jadwal to hari and jam mulai and jam_akhir --}}
        @php
            $jadwal->jadwal = explode(' ', $jadwal->jadwal);
            $jadwal->hari = $jadwal->jadwal[0];
            $jadwal->hari = str_replace(',', '', $jadwal->hari);
            $jadwal->jam_mulai = $jadwal->jadwal[1];
            $jadwal->jam_selesai = $jadwal->jadwal[3];
            
        @endphp

        <div class="modal fade" id="editJadwal{{ $jadwal->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editJadwal{{ $jadwal->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJadwal{{ $jadwal->id }}">Edit Jadwal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/jadwal/{{ $jadwal->id }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="hari" class="mb-2">Hari</label>
                                {{-- selection --}}
                                <select required name="hari" id="hari" class="form-control text-dark">
                                    <option disabled selected> -- Pilih Hari --</option>
                                    <option value="Senin" {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>Selasa
                                    </option>
                                    <option value="Rabu" {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ $jadwal->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                </select>
                                @error('hari')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jam_mulai" class="mb-2">Jam Mulai</label>
                                <input required type="time" class="form-control text-dark" id="jam_mulai"
                                    name="jam_mulai" min="07:00" max="18:00" value="{{ $jadwal->jam_mulai }}">
                                @error('jam_mulai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jam_selesai" class="mb-2">Jam Selesai</label>
                                <input required type="time" class="form-control text-dark" id="jam_selesai"
                                    name="jam_selesai" min="07:00" max="18:00"
                                    value="{{ $jadwal->jam_selesai }}">
                                @error('jam_selesai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="matakuliah_id">Matakuliah</label>
                                <select required class="form-control text-dark" id="matakuliah_id" name="matakuliah_id">
                                    <option disabled selected>-- Pilih Matakuliah --</option>
                                    @foreach ($matkulselected as $select)
                                        @if ($select->nama_matakuliah == $jadwal->matakuliah->nama_matakuliah)
                                            <option value="{{ $select->id }}" selected>
                                                {{ $select->nama_matakuliah }}
                                            </option>
                                        @endif
                                    @endforeach
                                    @foreach ($matakuliahs as $matakuliah)
                                        <option value="{{ $matakuliah->id }}">
                                            {{ $matakuliah->nama_matakuliah }}</option>
                                    @endforeach
                                </select>
                                @error('matakuliah_id')
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
    {{-- end modal for edit jadwal --}}


@endsection
