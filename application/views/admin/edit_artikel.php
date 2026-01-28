<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('admin') ?>">CMS Sederhana</a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3">Halo, <?= $this->session->userdata('nama'); ?></span>
            <a href="<?= base_url('login/logout') ?>" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container" style="max-width: 800px;">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-warning">Edit Artikel</h5>
        </div>
        <div class="card-body p-4">
            <?= validation_errors('<div class="alert alert-danger mb-3">', '</div>'); ?>

            <form action="<?= base_url('admin/edit/'.$artikel['id']) ?>" method="post">
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Artikel</label>
                    <input type="text" name="judul" class="form-control form-control-lg" value="<?= $artikel['judul'] ?>" required>
                </div>
                
                <div class="mb-4">
                    <label class="form-label fw-bold">Konten Artikel</label>
                    <textarea name="konten" class="form-control" rows="10" required><?= $artikel['konten'] ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('admin') ?>" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Update Artikel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>