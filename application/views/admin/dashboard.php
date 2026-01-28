<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">CMS Sederhana</a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3">Halo, <?= $this->session->userdata('nama'); ?></span>
            <a href="<?= base_url('login/logout') ?>" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Artikel</h5>
            <a href="<?= base_url('admin/tambah') ?>" class="btn btn-primary btn-sm">Tambah Artikel Baru</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Judul Artikel</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($artikel as $a): ?>
                        <tr>
                            <td><?= $a['judul'] ?></td>
                            <td>
                                <a href="<?= base_url('admin/edit/'.$a['id']) ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                                <a href="<?= base_url('admin/hapus/'.$a['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if(empty($artikel)): ?>
                <div class="text-center py-5 text-muted">
                    Belum ada artikel yang ditulis.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>