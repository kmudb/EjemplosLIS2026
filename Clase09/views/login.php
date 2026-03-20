<!DOCTYPE html>
<html>
<head>
    <title>Login MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height:100vh;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">Login</h3>

                    <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger text-center">
                            Usuario o contraseña incorrectos
                        </div>
                    <?php endif; ?>

                    <?php if(isset($_GET['mensaje'])): ?>
                        <div class="alert alert-success text-center">
                            Usuario registrado correctamente
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="../index.php">
                        <input type="hidden" name="accion" value="login">
                        <div class="mb-3">
                            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" name="password" id="password" class="form-control pe-5" placeholder="Contraseña" required>
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor:pointer"></i>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                    </form>

                    <a href="registrar.php" class="d-block text-center mt-3">Crear cuenta</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const toggle = document.getElementById("togglePassword");
const password = document.getElementById("password");
toggle.addEventListener("click", function() {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    this.classList.toggle("bi-eye");
    this.classList.toggle("bi-eye-slash");
});
</script>
</body>
</html>