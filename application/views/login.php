<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #eef2f5; }
        .login-container { margin-top: 100px; max-width: 400px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="card p-4">
        <div class="card-body">
            <h3 class="text-center mb-4 fw-bold text-primary">Admin CMS</h3>
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger text-center shadow-sm">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login/cek') ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="admin@email.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="******" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary py-2 fw-bold">Masuk Sistem</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>