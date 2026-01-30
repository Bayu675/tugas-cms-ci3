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
        :root {
            --card-radius: 16px;
        }
        .hero-wrapper {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            border-radius: 0 0 30px 30px;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }
        .btn-close-hero {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
            z-index: 10;
        }
        .btn-close-hero:hover { background: rgba(255,255,255,0.5); transform: rotate(90deg); }

        .card-music {
            border: none;
            border-radius: var(--card-radius);
            background: #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            height: 100%;
        }
        .card-music:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .cover-area {
            height: 250px;
            width: 100%;
            position: relative;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .object-fit-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.5s ease;
        }
        .card-music:hover .object-fit-cover { transform: scale(1.1); }

        .play-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
            cursor: pointer;
            backdrop-filter: blur(2px);
        }
        .card-music:hover .play-overlay { opacity: 1; }
        .play-overlay i { transition: transform 0.2s; }
        .play-overlay:hover i { transform: scale(1.2); }

        audio {
            height: 32px;
            border-radius: 20px;
            width: 100%;
        }
        audio::-webkit-media-controls-panel {
            background-color: #f8f9fa;
        }
        audio::-webkit-media-controls-enclosure {
            border-radius: 20px;
        }
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

    <div class="hero-wrapper" id="heroBanner">
        <div class="container position-relative">
            <button onclick="closeBanner()" class="btn-close-hero" title="Tutup Banner">
                <i class="bi bi-x-lg"></i>
            </button>

            <div class="py-5 row align-items-center">
                <div class="col-md-8">
                    <h1 class="fw-bold display-6 mb-2">Jelajahi Musik</h1>
                    <p class="text-white-50 mb-4">Dengarkan karya terbaik dari komunitas kami.</p>
                    <a href="<?= base_url('index.php/admin/tambah'); ?>" class="btn btn-light text-primary rounded-pill px-4 fw-bold shadow-sm">
                        <i class="bi bi-cloud-upload-fill me-2"></i> Upload Baru
                    </a>
                </div>
                <div class="col-md-4 d-none d-md-block text-center text-white-50">
                    <i class="bi bi-music-note-list" style="font-size: 6rem; opacity: 0.5;"></i>
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
                    <div class="text-muted opacity-25 display-1 mb-3"><i class="bi bi-disc"></i></div>
                    <h5 class="text-muted">Belum ada lagu</h5>
                    <p class="text-muted small">Upload lagu pertamamu sekarang!</p>
                </div>
            <?php else: ?>
                <?php foreach($musik as $m): ?>
                <div class="col" data-aos="fade-up" data-aos-duration="800">
                    <div class="card card-music">
                        
                        <div class="cover-area">
                            <img src="<?= base_url('assets/uploads/' . $m['cover_image']); ?>" 
                                 class="object-fit-cover" 
                                 alt="Cover"
                                 onerror="this.onerror=null; this.src='https://placehold.co/500x500/e9ecef/6c757d?text=No+Cover';">
                            
                            <span class="position-absolute top-0 end-0 badge bg-dark bg-opacity-75 m-3 rounded-pill px-3 shadow-sm">
                                <?= $m['genre']; ?>
                            </span>

                            <div class="play-overlay btn-trigger-play">
                                <i class="bi bi-play-circle-fill text-white display-3 drop-shadow icon-play"></i>
                                <i class="bi bi-pause-circle-fill text-white display-3 drop-shadow icon-pause d-none"></i>
                            </div>
                        </div>

                        <div class="card-body p-4 d-flex flex-column">
                            <div class="mb-3">
                                <h5 class="card-title fw-bold text-dark text-truncate mb-1"><?= $m['judul']; ?></h5>
                                <p class="text-secondary small mb-0 text-truncate">
                                    <i class="bi bi-mic-fill me-1"></i> <?= $m['penyanyi']; ?>
                                </p>
                            </div>
                            
                            <div class="mt-auto">
                                <audio controls class="mb-3 card-audio">
                                    <source src="<?= base_url('assets/uploads/' . $m['file_name']); ?>" type="audio/mpeg">
                                </audio>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light">
                                    <small class="text-muted fw-bold" style="font-size: 0.75rem;">
                                        <i class="bi bi-person-circle me-1"></i> <?= $m['uploader']; ?>
                                    </small>
                                    
                                    <?php if($m['uploader'] == $this->session->userdata('nama') || $this->session->userdata('nama') == 'admin'): ?>
                                    <a href="<?= base_url('index.php/admin/hapus/'.$m['id']); ?>" 
                                       class="btn btn-sm btn-light text-danger rounded-circle shadow-sm tombol-hapus"
                                       title="Hapus Lagu">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="mt-5">
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        AOS.init({ once: true });

        function closeBanner() {
            const banner = document.getElementById('heroBanner');
            banner.style.transition = 'all 0.6s ease';
            banner.style.maxHeight = '0';
            banner.style.opacity = '0';
            banner.style.marginBottom = '0';
            banner.style.overflow = 'hidden';
        }

        const flashSuccess = document.querySelector('.flash-data-success');
        if(flashSuccess){
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: flashSuccess.getAttribute('data-flashdata'), showConfirmButton: false, timer: 1500 });
        }
        
        document.querySelectorAll('.tombol-hapus').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                Swal.fire({ title: 'Hapus lagu?', text: "Gak bisa dibalikin lagi loh!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d', confirmButtonText: 'Ya, Hapus!' }).then((result) => { if (result.isConfirmed) document.location.href = href; })
            });
        });

        document.querySelectorAll('.btn-trigger-play').forEach(trigger => {
            trigger.addEventListener('click', function() {
                const card = this.closest('.card-music');
                const audio = card.querySelector('.card-audio');
                const iconPlay = this.querySelector('.icon-play');
                const iconPause = this.querySelector('.icon-pause');

                document.querySelectorAll('audio').forEach(a => {
                    if(a !== audio) {
                        a.pause();
                        const otherCard = a.closest('.card-music');
                        otherCard.querySelector('.icon-play').classList.remove('d-none');
                        otherCard.querySelector('.icon-pause').classList.add('d-none');
                    }
                });

                if (audio.paused) {
                    audio.play();
                    iconPlay.classList.add('d-none');
                    iconPause.classList.remove('d-none');
                } else {
                    audio.pause();
                    iconPlay.classList.remove('d-none');
                    iconPause.classList.add('d-none');
                }

                audio.onended = function() {
                    iconPlay.classList.remove('d-none');
                    iconPause.classList.add('d-none');
                };
            });
        });
    </script>
</body>
</html>