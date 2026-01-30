<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>

        .hero-wrapper {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            border-radius: 0 0 30px 30px;
            margin-bottom: 2rem;
            position: relative;
        .hero-content { padding: 4rem 0; }
        .btn-close-hero {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 1.2rem;
            transition: all 0.3s;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-close-hero:hover { background: rgba(255,255,255,0.4); transform: rotate(90deg); }

        .card-music { transition: all 0.3s ease; border: none; border-radius: 15px; background: #fff; }
        .card-music:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
        .cover-area { height: 200px; overflow: hidden; position: relative; }
        .object-fit-cover { object-fit: cover; width: 100%; height: 100%; transition: transform 0.5s; }
        .card-music:hover .object-fit-cover { transform: scale(1.1); }
        .play-btn-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s; }
        .card-music:hover .play-btn-overlay { opacity: 1; }
        .user-avatar { width: 25px; height: 25px; background: #e9ecef; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; margin-right: 5px; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-soundwave me-2"></i>MyMusic</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3 d-none d-md-block"><small>Halo,</small> <strong><?= $this->session->userdata('nama'); ?></strong></span>
                <a href="<?= base_url('index.php/login/logout'); ?>" class="btn btn-outline-light btn-sm rounded-pill px-3"><i class="bi bi-box-arrow-right me-1"></i> Logout</a>
            </div>
        </div>
    </nav>

    <div class="hero-wrapper shadow" id="heroBanner">
        <button onclick="closeBanner()" class="btn-close-hero" title="Tutup Banner">
            <i class="bi bi-x-lg"></i>
        </button>

        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="fw-bold display-5 mb-2">Jelajahi Musik</h1>
                    <p class="lead opacity-75 mb-4">Dengarkan karya terbaik dari komunitas kami.</p>
                    <a href="<?= base_url('index.php/admin/tambah'); ?>" class="btn btn-light text-primary rounded-pill px-4 fw-bold shadow-sm">
                        <i class="bi bi-cloud-upload-fill me-2"></i> Upload Lagumu
                    </a>
                </div>
                <div class="col-md-4 d-none d-md-block text-center opacity-50">
                    <i class="bi bi-music-note-beamed" style="font-size: 8rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <?php if($this->session->flashdata('success')): ?>
            <div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php if(empty($musik)): ?>
                <div class="col-12 text-center py-5">
                    <div class="text-muted opacity-25 display-1 mb-3"><i class="bi bi-music-note-beamed"></i></div>
                    <h4 class="text-muted">Belum ada lagu</h4>
                    <p class="text-muted small">Jadilah yang pertama mengupload!</p>
                </div>
            <?php else: ?>
                <?php foreach($musik as $m): ?>
                <div class="col" data-aos="fade-up" data-aos-duration="800">
                    <div class="card card-music shadow-sm h-100">
                        <div class="cover-area">
                            <img src="<?= base_url('assets/uploads/' . $m['cover_image']); ?>" 
                                 class="object-fit-cover" 
                                 alt="Cover"
                                 onerror="this.src='https://placehold.co/400x400/e9ecef/6c757d?text=No+Cover';">
                            
                            <div class="play-btn-overlay">
                                <i class="bi bi-play-circle-fill text-white display-4"></i>
                            </div>
                            
                            <span class="position-absolute top-0 end-0 badge bg-white text-dark m-2 rounded-pill px-3 shadow-sm">
                                <?= $m['genre']; ?>
                            </span>
                        </div>

                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold text-truncate mb-1"><?= $m['judul']; ?></h5>
                            <p class="text-secondary small mb-3 text-truncate"><?= $m['penyanyi']; ?></p>
                            
                            <audio controls class="w-100 mb-3" style="height: 30px;">
                                <source src="<?= base_url('assets/uploads/' . $m['file_name']); ?>" type="audio/mpeg">
                            </audio>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar"><i class="bi bi-person-fill"></i></div>
                                    <small class="text-muted fw-bold" style="font-size: 0.8rem;"><?= $m['uploader']; ?></small>
                                </div>
                                
                                <?php if($m['uploader'] == $this->session->userdata('nama') || $this->session->userdata('nama') == 'admin'): ?>
                                <a href="<?= base_url('index.php/admin/hapus/'.$m['id']); ?>" 
                                   class="btn btn-sm btn-light text-danger rounded-circle tombol-hapus"
                                   title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?= $this->pagination->create_links(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        AOS.init();

        function closeBanner() {
            const banner = document.getElementById('heroBanner');
            banner.style.transition = 'all 0.5s';
            banner.style.opacity = '0';
            banner.style.marginTop = '-300px';
            setTimeout(() => {
                banner.style.display = 'none';
            }, 500);
        }

        const flashSuccess = document.querySelector('.flash-data-success');
        if(flashSuccess){
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: flashSuccess.getAttribute('data-flashdata'), showConfirmButton: false, timer: 1500 });
        }
        document.querySelectorAll('.tombol-hapus').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                Swal.fire({ title: 'Hapus lagu?', text: "Tak bisa kembali!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Ya, Hapus!' }).then((result) => { if (result.isConfirmed) document.location.href = href; })
            });
        });
    </script>
</body>
</html>