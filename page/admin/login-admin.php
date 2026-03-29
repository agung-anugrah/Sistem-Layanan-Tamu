<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="../../css/style-login-admin.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card login-card shadow p-4">
        <!-- Title -->
        <div class="text-center mb-4">
            <h4 class="fw-bold ">Sistem Layanan Tamu</h4>
            <p class="text-muted">Sihlakan Melakukan Login Untuk Masuk</p>
        </div>
        
        <form action="../../crud/login.php" method="POST">
            <div class="mb-3 position-relative">
                <img src="../../icon/id-card.png" alt="" class="icon">
                <input 
                    type="text" 
                    name="username" 
                    class="form-control" 
                    placeholder="Username" 
                    required>
            </div>
            <div class="mb-3 position-relative">
                <img src="../../icon/locked-computer.png" alt="" class="icon">
                <input 
                    type="password" 
                    name="password" 
                    class="form-control" 
                    placeholder="Password" 
                    required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success btn-login w-100" name="simpan">Masuk</button>    
            </div>
        </form>
        <a class="btn btn-danger btn-login w-100" href="../../">kembali</a>

    </div>
</div>

</body>
</html>