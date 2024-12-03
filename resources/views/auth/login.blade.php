<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #030712f2;
        }
        .login-container {
            margin-top: 100px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn-google {
            background-color: #db4437;
            color: #ffffff;
        }
        .btn-google:hover {
            background-color: #c23321;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="login-container">
                    <h2 class="text-center login-title">Iniciar Sesión</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf <!-- Protección CSRF -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                        <hr>
                        <a href="{{ route('register.form') }}" class="btn btn-primary w-100">Registrarse</a>
                    </form>
                    @if(session('error'))
                        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>