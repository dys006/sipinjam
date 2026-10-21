<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun | SiPinjam</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center min-vh-100">
    <main class="container py-4" style="max-width: 460px">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h4 text-center mb-4">Daftar Akun Mahasiswa</h1>
                <form action="{{ route('daftar') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{
old('name') }}"
                            class="form-control @error('name') is-invalid
@enderror">
                        @error('name') <div class="invalid-feedback">{{ $message
}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" id="nim" name="nim" value="{{ old('nim')
}}"
                            class="form-control @error('nim') is-invalid
@enderror">
                        @error('nim') <div class="invalid-feedback">{{ $message
}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{
old('email') }}"
                            class="form-control @error('email') is-invalid
@enderror">
                        @error('email') <div class="invalid-feedback">{{ $message
}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid
@enderror">
                        @error('password') <div class="invalid-feedback">{{ $message
}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Ulangi
                            Password</label>
                        <input type="password" id="password_confirmation"
                            name="password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary w100">Daftar</button>
                </form>
                <p class="text-center mt-3 mb-0">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                </p>
            </div>
        </div>
    </main>
</body>

</html>
