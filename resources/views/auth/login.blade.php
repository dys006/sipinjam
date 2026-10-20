<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #97cbe7;
        }
        .card-custom {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            max-width: 420px;
            width: 100%;
        }
        .btn-primary-custom {
            background-color: #0d6efd;
            border: none;
            padding: 10px;
            font-weight: 500;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-3">

    <div class="card card-custom p-4 bg-white">
        <div class="card-body">
            <h3 class="fw-bold text-center mb-1">Masuk</h3>
            <p class="text-muted text-center small mb-4">Silakan masuk ke akun Anda</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary small fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white text-muted border-end-0">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-secondary small fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white text-muted border-end-0">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label text-secondary small" for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-primary-custom rounded-2 mb-4">Masuk</button>

                <p class="text-center small text-muted mb-0">
                    Belum punya akun? <a href="{{ url('/daftar') }}" class="text-decoration-none text-primary fw-semibold">Daftar di sini</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>