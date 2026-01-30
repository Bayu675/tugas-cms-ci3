<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Musik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white p-4 text-center border-0">
                        <i class="bi bi-cloud-arrow-up-fill display-4 mb-2"></i>
                        <h4 class="fw-bold mb-0">Upload Lagu</h4>
                        <p class="text-white-50 mb-0 small">Tambahkan koleksi musik baru</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger rounded-3 text-center small">
                                <?= $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>

                        <?= validation_errors('<div class="alert alert-danger rounded-3 small text-center">', '</div>'); ?>

                        <form action="<?= base_url('index.php/admin/tambah'); ?>" method="post" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="judul" class="form-control rounded-3" id="judul" placeholder="Judul Lagu" required>
                                        <label for="judul">Judul Lagu</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" name="penyanyi" class="form-control rounded-3" id="penyanyi" placeholder="Nama Artis" required>
                                        <label for="penyanyi">Nama Penyanyi / Artis</label>
                                    </div>

                                    <div class="form-floating mb-4">
                                        <select name="genre" class="form-select rounded-3" id="genre">
                                            <option value="Pop">Pop</option>
                                            <option value="Rock">Rock</option>
                                            <option value="Jazz">Jazz</option>
                                            <option value="Dangdut">Dangdut</option>
                                            <option value="EDM">EDM</option>
                                            <option value="Indie">Indie</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        <label for="genre">Pilih Genre</label>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                                    <div class="mb-3 text-center">
                                        <img id="img-preview" src="https://via.placeholder.com/150?text=No+Cover" class="img-thumbnail rounded-3 shadow-sm object-fit-cover" style="width: 150px; height: 150px;">
                                    </div>
                                    <div class="w-100">
                                        <label class="form-label text-muted small fw-bold ms-1">COVER ALBUM (JPG/PNG)</label>
                                        <input type="file" id="cover-input" name="cover_image" class="form-control form-control-sm bg-light" accept="image/png,image/jpeg,image/jpg,.png,.jpg,.jpeg">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold ms-1">FILE AUDIO (MP3)</label>
                                <input type="file" name="file_mp3" class="form-control form-control-lg bg-light" accept="audio/mpeg,audio/mp3,audio/x-mp3,.mp3,.wav,.m4a" required>
                                <div class="form-text">Wajib (Max 10MB)</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                    <i class="bi bi-check-lg me-1"></i> Simpan Lagu
                                </button>
                                <a href="<?= base_url('index.php/admin'); ?>" class="btn btn-light btn-lg rounded-pill text-muted">
                                    Batal
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const coverInput = document.getElementById('cover-input');
        const imgPreview = document.getElementById('img-preview');

        coverInput.onchange = evt => {
            const [file] = coverInput.files
            if (file) {
                imgPreview.src = URL.createObjectURL(file)
            }
        }
    </script>

</body>
</html>