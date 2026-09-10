<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Ganesh Restaurant</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #7B1113, #5a0d0f); min-height: 100vh; display: flex; align-items: center; }
        .login-card { max-width: 400px; margin: auto; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card login-card shadow-lg border-0">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" height="100" class="rounded-circle border border-warning border-2">
                    <h4 class="mt-3 mb-0">Admin Login</h4>
                    <p class="text-muted small">Ganesh The Family Restaurant</p>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn w-100 text-white" style="background:#7B1113;">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
