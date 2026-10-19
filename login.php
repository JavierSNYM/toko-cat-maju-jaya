<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - PT Maju Jaya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
    <div class="login-container">
        <form method="post" class="login-form">
            <h2>PT Maju Jaya</h2>
            <p>Sistem Informasi Karyawan</p>
            
            <?php if(isset($error)) : ?>
                <div class="alert-error">Username atau Password salah!</div>
            <?php endif; ?>

            <div class="input-group">
                <label for="username" style="display: block; text-align: left; margin-bottom: 5px; color: #2c3e50;">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
            </div>

            <div class="input-group">
                <label for="password" style="display: block; text-align: left; margin-bottom: 5px; color: #2c3e50;">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
            </div>

            <button type="submit" name="login" class="btn-login">Masuk ke Sistem</button>
        </form>
    </div>
</body>
</html>