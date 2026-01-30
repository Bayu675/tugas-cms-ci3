<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Musik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="width: 400px;">
        <h3 class="text-center mb-4">Daftar Akun</h3>
        
        <?php if(validation_errors()): ?>
            <div class="alert alert-danger"><?= validation_errors(); ?></div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/register/proses'); ?>" method="post">
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email (Gmail)</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
        </form>
        <div class="text-center mt-3">
            <small>Sudah punya akun? <a href="<?= base_url('index.php/login'); ?>">Login disini</a></small>
        </div>
    </div>
</body>
</html>