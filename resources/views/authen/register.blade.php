<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- import bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <section class="vh-100" style="background-color: #2a5555;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-6 text-center">
                            <form action="/register" method="post">
                                @csrf

                                <input type="hidden" name="role" value="mahasiswa">
                                
                                <h3 class="mb-4">Sign Up</h3>
                                <div class="form-outline mb-4">
                                    {{-- Name --}}
                                    <input type="text" id="typeNameX-2"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name"
                                        placeholder="Nama Mahasiswa" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    {{-- Email --}}
                                    <input type="email" id="typeEmailX-2"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- make 2 column --}}
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h3 class="mb-2">
                                            {{-- password --}}
                                            <input type="password" id="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password"
                                                placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </h3>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <h3 class="mb-2">
                                            <div class="form-outline mb-4">
                                                {{-- retype Passowrd --}}
                                                <input type="password" id="password_confirmation"
                                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                    name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="Retype Password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </h3>
                                    </div>
                                </div>
                                {{-- end make 2 column --}}

                                <div class="form-outline mb-4">
                                    {{-- Selection Kelas --}}
                                    <select class="form-control form-control-lg @error('kelas') is-invalid @enderror"
                                        name="kelas" id="typeKelasX-2">
                                        <option value="">Pilih Kelas</option>
                                        <option value=1>X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>

                                {{-- Jenis Kelamin Select --}}
                                <div class="form-outline mb-4">
                                    <select class="form-control form-control-lg @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin" id="typeJKX-2">
                                        <option disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                               

                                {{-- signup button --}}
                                <button type="submit" class="btn btn-primary btn-lg btn-block mb-2">
                                    Sign Up
                                </button>

                                {{-- Aoredy have an account --}}
                                <p class="text-center mb-1">
                                    Already have an account ? <a href="{{ route('login') }}">Login</a>
                                </p>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
