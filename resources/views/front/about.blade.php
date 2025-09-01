@extends('layouts.front')
@section('content')
    <!-- Hero Section -->
    <section class="rk-page-hero bg-gradient">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="rk-hero-content">
                        {{-- <h1 class="display-4 fw-bold text-white mb-4 rk-heading">Tentang <span
                                class="text-warning">Ceybernetsec ID</span></h1> --}}
                        <h1 class="display-5 fw-bold text-white mb-3">
                            Tentang <span class="text-warning">Cybernetsec ID</span>
                        </h1>
                        <hr class="border-light opacity-25 w-25 mb-4">
                        <p class="text-light mb-4 text-justify">
                            Unwahas Cybernetsec Lab adalah pusat riset dan pengembangan di bidang Network Security,
                            Artificial Intelligence, dan Cloud Computing. Berbasis di Universitas Wahid Hasyim Semarang,
                            kami berkomitmen menghadirkan inovasi digital yang memberi dampak nyata bagi kampus, masyarakat,
                            dan dunia industri. <br>
                            <br>
                            Kami percaya bahwa teknologi bukan hanya sekadar alat, tetapi juga pondasi untuk membangun masa
                            depan yang lebih aman, kreatif, dan berdaya guna. Oleh karena itu, setiap kelas, workshop,
                            maupun program yang kami rancang selalu berorientasi pada praktik nyata yang dapat langsung
                            diterapkan baik di dunia kerja maupun dalam proyek pribadi.
                        </p>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('welcome') }}" class="text-light">Home</a>
                                </li>
                                <li class="breadcrumb-item active text-warning" aria-current="page">Tentang Kami</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="rk-hero-image text-center">
                        {{-- <img src="{{ asset('frontemplate') }}/img/gallery/wel.png" alt="About Us" class="img-fluid"> --}}
                        <img src="{{ asset('frontemplate') }}/img/gallery/wel.png" alt="About Us"
                            class="img-fluid rounded-3 shadow-lg" data-aos="zoom-in">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">

                <!-- Gambar -->
                <div class="col-lg-6 text-center" data-aos="fade-right">
                    <img src="{{ asset('frontemplate') }}/img/pak-ardian.png" alt="About Us"
                        class="img-fluid shadow-lg border border-1 border-white" style="border-radius: 10px">
                </div>

                <!-- Konten -->
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="ps-lg-4">
                        <h5 class="text-uppercase text-primary fw-bold mb-3">Visi & Misi</h5>
                        <h2 class="fw-bold mb-4 lh-base">Riset, Pengembangan dan Edukasi</h2>

                        @php
                            $setting = \App\Setting::first();
                        @endphp

                        {{-- <p class="text-justify text-lg">
                            Cybernetsec Lab berkomitmen menjadi pusat inovasi dalam bidang Cybersecurity, Network, serta Web
                            & Cloud Computing.
                            Kami percaya teknologi bukan hanya sarana, melainkan fondasi penting dalam membangun masa depan
                            digital yang aman, kreatif, dan berdaya guna.

                            Melalui program riset, workshop, dan pelatihan, kami mendorong mahasiswa, akademisi, dan
                            praktisi untuk terus berkembang, berkolaborasi, dan menciptakan solusi nyata yang bermanfaat
                            bagi kampus, masyarakat, maupun industri.
                            Setiap kegiatan kami selalu berorientasi pada praktik langsung, sehingga hasil pembelajaran bisa
                            diterapkan secara nyata baik dalam dunia kerja maupun proyek personal.
                        </p> --}}

                        <div class="text-muted mb-4">
                            {!! $setting->about ?? '<p>Selamat datang di platform e-learning kami. Platform ini.</p>' !!}
                        </div>

                        <!-- List Keunggulan -->
                        <div class="row gy-3">
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center p-3 bg-light rounded shadow-sm">
                                    <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center me-3"
                                        style="width:40px; height:40px;">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span class="fw-semibold">&nbsp;Materi Terupdate</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded shadow-sm">
                                    <div class="bg-success rounded-circle d-flex justify-content-center align-items-center me-3"
                                        style="width:40px; height:40px;">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span class="fw-semibold">&nbsp;Akses Fleksibel</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded shadow-sm">
                                    <div class="bg-warning rounded-circle d-flex justify-content-center align-items-center me-3"
                                        style="width:40px; height:40px;">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span class="fw-semibold">&nbsp;Konsultasi Mentor</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded shadow-sm">
                                    <div class="bg-danger rounded-circle d-flex justify-content-center align-items-center me-3"
                                        style="width:40px; height:40px;">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span class="fw-semibold">&nbsp;Sertifikat Resmi</span>
                                </div>
                            </div>
                        </div>
                        <!-- /List -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="rk-section py-5">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <h6 class="text-primary mb-2">Tim Kami</h6>
                    <h2 class="fw-bold mb-3 rk-heading">Bertemu Dengan Tim Expert Kami</h2>
                    <p class="text-muted">Dibimbing oleh profesional berpengalaman di bidangnya masing-masing</p>
                </div>
            </div>
            <div class="row">
                <!-- Team Member 1 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                        <div class="rk-team-img-wrapper position-relative">
                            <img src="{{ asset('frontemplate') }}/img/masud.png" class="card-img-top" alt="Team Member">
                            <div class="rk-team-social-overlay">
                                <div class="rk-social-icons2">
                                    <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-1 rk-heading">Muhammad Mas'ud</h5>
                            {{-- <p class="text-primary mb-3">Web Developer & AI</p> --}}
                            <span class="badge bg-primary px-3 py-2 mb-3 mt-1">Web Developer & AI</span>
                            <p class="card-text text-muted">Fokus pada pengembangan aplikasi web yang scalable
                                dan
                                user-friendly. Mulai dari frontend, backend, database, hingga integrasi Artificial
                                Intelligence untuk solusi inovatif di bidang edukasi dan teknologi.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                        <div class="rk-team-img-wrapper position-relative">
                            <img src="{{ asset('frontemplate') }}/img/haromain.png" class="card-img-top"
                                alt="Team Member">
                            <div class="rk-team-social-overlay">
                                <div class="rk-social-icons2">
                                    <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-1 rk-heading">M. Nur Haromain</h5>
                            {{-- <p class="text-primary mb-3">Cyber Scurity</p> --}}
                            <span class="badge bg-primary px-3 py-2 mb-3 mt-1">Cyber Scurity</span>
                            <p class="card-text text-muted">bertugas melindungi platform dari ancaman digital.
                                Mulai dari
                                penetration testing, analisis kerentanan, hingga menerapkan standar keamanan global (OWASP,
                                Zero Trust). Dengan kemampuan defensive dan offensive, tim ini memastikan setiap sistem
                                berjalan dengan aman.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                        <div class="rk-team-img-wrapper position-relative">
                            <img src="{{ asset('frontemplate') }}/img/arief.png" class="card-img-top" alt="Team Member">
                            <div class="rk-team-social-overlay">
                                <div class="rk-social-icons2">
                                    <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-1 rk-heading">Muhammad Arief Maulana</h5>
                            {{-- <p class="text-primary mb-3">Networking</p> --}}
                            <span class="badge bg-primary px-3 py-2 mb-3 mt-1">Networking</span>
                            <p class="card-text text-muted">Berperan dalam merancang, mengatur, dan memelihara
                                infrastruktur jaringan baik on-premise maupun berbasis cloud. Fokus pada kecepatan,
                                kestabilan, dan skalabilitas jaringan, tim ini memastikan layanan dapat diakses dengan
                                lancar oleh pengguna.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                        <div class="rk-team-img-wrapper position-relative">
                            <img src="{{ asset('frontemplate') }}/img/nanda.jpg" class="card-img-top" alt="Team Member">
                            <div class="rk-team-social-overlay">
                                <div class="rk-social-icons2">
                                    <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-1 rk-heading">Nanda Bagus Ramadhani</h5>
                            {{-- <p class="text-primary mb-3">Cyber Scurity</p> --}}
                            <span class="badge bg-primary px-3 py-2 mb-3 mt-1">Cyber Scurity</span>
                            <p class="card-text text-muted">Mengembangkan strategi pertahanan siber melalui monitoring,
                                analisis ancaman, serta pelatihan keamanan. Berusaha aktif membangun kesadaran keamanan
                                di
                                organisasi agar setiap lapisan mampu mendeteksi dan merespons insiden dengan cepat.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 5 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                        <div class="rk-team-img-wrapper position-relative">
                            <img src="{{ asset('frontemplate') }}/img/vian.jpg" class="card-img-top" alt="Team Member">
                            <div class="rk-team-social-overlay">
                                <div class="rk-social-icons2">
                                    <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-1 rk-heading">Arvian Raditya Pratama</h5>
                            {{-- <p class="text-primary mb-3">Networking</p> --}}
                            <span class="badge bg-primary px-3 py-2 mb-3 mt-1">Networking</span>
                            <p class="card-text text-muted">Berperan dalam merancang, mengatur, dan memelihara
                                infrastruktur jaringan baik on-premise maupun berbasis cloud. Fokus pada kecepatan,
                                kestabilan, dan skalabilitas jaringan, tim ini memastikan layanan dapat diakses dengan
                                lancar oleh pengguna.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 6 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                        <div class="rk-team-img-wrapper position-relative">
                            <img src="{{ asset('frontemplate') }}/img/mala.png" class="card-img-top" alt="Team Member">
                            <div class="rk-team-social-overlay">
                                <div class="rk-social-icons2">
                                    <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-1 rk-heading">Mala Fillatunnida</h5>
                            {{-- <p class="text-primary mb-3">Web Developer</p> --}}
                            <span class="badge bg-primary px-3 py-2 mb-3 mt-1">Web Developer</span>
                            <p class="card-text text-muted">Fokus pada pengembangan aplikasi web yang scalable dan
                                user-friendly. Mulai dari frontend, backend, database, hingga integrasi Artificial
                                Intelligence untuk solusi inovatif di bidang edukasi dan teknologi.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 7 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                        <div class="rk-team-img-wrapper position-relative">
                            <img src="{{ asset('frontemplate') }}/img/nadia.png" class="card-img-top" alt="Team Member">
                            <div class="rk-team-social-overlay">
                                <div class="rk-social-icons2">
                                    <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-1 rk-heading">Nadia Rizky Chairunnisa</h5>
                            {{-- <p class="text-primary mb-3">Cyber security</p> --}}
                            <span class="badge bg-primary px-3 py-2 mb-3 mt-1">Cyber Scurity</span>
                            <p class="card-text text-muted">Fokus untuk riset dalam merancang strategi uji ketahanan
                                sistem
                                melalui pendekatan Red Team. Mulai dari simulasi serangan, analisis kerentanan, hingga
                                pelatihan terstruktur untuk meningkatkan kesiapan organisasi menghadapi ancaman siber.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 8 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                        <div class="rk-team-img-wrapper position-relative">
                            <img src="{{ asset('frontemplate') }}/img/putri.png" class="card-img-top" alt="Team Member">
                            <div class="rk-team-social-overlay">
                                <div class="rk-social-icons2">
                                    <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-1 rk-heading">Dwi Putri</h5>
                            {{-- <p class="text-primary mb-3">Web Developer</p> --}}
                            <span class="badge bg-primary px-3 py-2 mb-3 mt-1">Web Developer</span>
                            <p class="card-text text-muted">Fokus pada pengembangan aplikasi web yang scalable dan
                                user-friendly. Mulai dari frontend, backend, database, hingga integrasi Artificial
                                Intelligence untuk solusi inovatif di bidang edukasi dan teknologi.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 9 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                        <div class="rk-team-img-wrapper position-relative">
                            <img src="{{ asset('frontemplate') }}/img/rizki.png" class="card-img-top" alt="Team Member">
                            <div class="rk-team-social-overlay">
                                <div class="rk-social-icons2">
                                    <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-1 rk-heading">Rizky Subekti, S.Kom</h5>
                            {{-- <p class="text-primary mb-3">multimedia Business Design</p> --}}
                            <span class="badge bg-primary px-3 py-2 mb-3 mt-1">Multimedia Business Design</span>
                            <p class="card-text text-muted">Bertugas merancang konten visual dan multimedia yang
                                mendukung
                                strategi bisnis. Mulai dari desain grafis, presentasi corporate, hingga materi promosi
                                digital, guna memperkuat branding dan profesionalitas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Section -->
    <section class="rk-section py-5">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <h2 class="fw-bold mb-3 rk-heading">Jenis Up Skill yang Kami Tawarkan</h2>
                    <p class="text-muted">Pilih metode belajar yang paling sesuai dengan kebutuhan dan preferensi Anda</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="rk-card rk-feature-card h-100 border-0 rk-shadow-hover">
                        <div class="card-body p-4 text-center">
                            <div class="icon-wrapper icon-blue">
                                <i class="fas fa-book-open fs-3 text-primary"></i>
                            </div>

                            <h4 class="fw-bold mb-3 rk-heading">Up Skill Gratis</h4>
                            <p class="text-muted">Akses materi pembelajaran dasar tanpa biaya untuk semua pengunjung
                                website</p>
                            <div class="mt-4">
                                <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3">Tanpa Registrasi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="rk-card rk-feature-card h-100 border-0 rk-shadow-hover">
                        <div class="card-body p-4 text-center">
                            <div class="icon-wrapper icon-green">
                                <i class="fas fa-users fs-3 text-success"></i>
                            </div>
                            <h4 class="fw-bold mb-3 rk-heading">Up Skill Regular</h4>
                            <p class="text-muted">Up Skill eksklusif untuk anggota terdaftar dengan materi lebih lengkap
                                dan terstruktur</p>
                            <div class="mt-4">
                                <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">Free Membership</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="rk-card rk-feature-card h-100 border-0 rk-shadow-hover">
                        <div class="card-body p-4 text-center">
                            <div class="icon-wrapper icon-yellow">
                                <i class="fas fa-gem fs-3 text-warning"></i>
                            </div>
                            <h4 class="fw-bold mb-3 rk-heading">Up Skill Premium</h4>
                            <p class="text-muted">Pengalaman belajar premium dengan mentor dedicated, sertifikat, dan
                                konsultasi privat</p>
                            <div class="mt-4">
                                <span class="badge bg-warning bg-opacity-10 text-warning py-2 px-3">Fitur Eksklusif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="rk-stats py-5 rk-stats py-5 rk-page-hero">
        <div class="container py-5">
            <div class="row text-center">
                <!-- Up Skill Online -->
                <div class="col-md-3 col-6 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                    <div class="rk-stat-item">
                        <div class="icon-wrapper bg-warning text-white mb-3">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h2 class="fw-bold display-6 text-white mb-1" data-count="5">0</h2>
                        <p class="text-white mb-0">Up Skill Online</p>
                    </div>
                </div>

                <!-- Gabung Bersama Kami -->
                <div class="col-md-3 col-6 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="rk-stat-item">
                        <div class="icon-wrapper bg-info text-white mb-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2 class="fw-bold display-6 text-white mb-1" data-count="109">0</h2>
                        <p class="text-white mb-0">Gabung Bersama Kami</p>
                    </div>
                </div>
                <!-- Kepuasan Pengguna -->
                <div class="col-md-3 col-6 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="rk-stat-item">
                        <div class="icon-wrapper bg-success text-white mb-3">
                            <i class="fas fa-star"></i>
                        </div>
                        <h2 class="fw-bold display-6 text-white mb-1" data-count="89">0</h2>
                        <p class="text-white mb-0">Kepuasan Pengguna</p>
                    </div>
                </div>
                <!-- Mentor Expert -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="rk-stat-item">
                        <div class="icon-wrapper bg-primary text-white mb-3">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h2 class="fw-bold display-6 text-white mb-1" data-count="9">0</h2>
                        <p class="text-white mb-0">Mentor Expert</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Page Hero Section */
        .rk-page-hero {
            padding: 120px 0;
            background: var(--rk-gradient);
            position: relative;
            overflow: hidden;
            margin-top: -1px;
        }

        .rk-page-hero::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1;
        }

        .rk-page-hero::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1;
        }

        .rk-hero-content {
            position: relative;
            z-index: 2;
        }

        .rk-page-hero .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .rk-page-hero .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .rk-page-hero .breadcrumb-item.active {
            color: var(--warning);
        }

        .rk-page-hero .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.8);
        }

        /* Perbaikan untuk Team Card */
        .rk-team-card .card-body {
            min-height: 150px;
            /* Menjaga tinggi card body agar konsisten */
        }

        .rk-team-card img {
            height: 300px;
            /* Mengatur tinggi gambar agar seragam */
            object-fit: cover;
            /* Memastikan gambar mengisi area tanpa distorsi */
            object-position: top;
            /* Mengatur fokus gambar di bagian atas */
        }

        /* Overlay untuk efek hover */
        .rk-team-social-overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.6);
            /* Warna overlay lebih solid */
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .rk-team-card:hover .rk-team-social-overlay {
            opacity: 1;
        }

        .rk-social-icons2 {
            display: flex;
            gap: 15px;
        }

        .rk-social-icon2 {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background: var(--rk-primary);
            color: white;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .rk-social-icon2:hover {
            background: white;
            color: var(--rk-primary);
            transform: translateY(-3px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .rk-team-card img {
                height: 250px;
                /* Mengurangi tinggi gambar di layar mobile */
            }
        }

        /* Feature Cards */
        .rk-feature-card {
            border-radius: var(--rk-radius);
            transition: all 0.3s ease;
        }

        .rk-feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--rk-shadow) !important;
        }

        .rk-icon-wrapper {
            width: 80px;
            height: 80px;
        }

        .icon-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-bottom: 1rem;
            /* biar sama kayak mb-4 */
        }

        /* Variasi warna */
        .icon-blue {
            background: rgba(13, 110, 253, 0.1);
            border: 2px solid rgba(13, 110, 253, 0.3);
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.15);
            color: #0d6efd;
        }

        .icon-green {
            background: rgba(25, 135, 84, 0.1);
            border: 2px solid rgba(25, 135, 84, 0.3);
            box-shadow: 0 4px 10px rgba(25, 135, 84, 0.15);
            color: #198754;
        }

        .icon-yellow {
            background: rgba(255, 193, 7, 0.1);
            border: 2px solid rgba(255, 193, 7, 0.3);
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.15);
            color: #ffc107;
        }

        /* Team Section */
        .rk-team-card {
            border-radius: var(--rk-radius);
            transition: all 0.3s ease;
            /* box-shadow: var(--rk-shadow) !important; */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);

        }

        .rk-team-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--rk-shadow) !important;
            /* box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); */
        }

        .rk-team-img-wrapper {
            overflow: hidden;
            border-top-left-radius: var(--rk-radius);
            border-top-right-radius: var(--rk-radius);
        }

        .rk-team-img-wrapper img {
            transition: transform 0.5s ease;
            height: 250px;
            object-fit: cover;
        }

        .rk-team-card:hover .rk-team-img-wrapper img {
            transform: scale(1.05);
        }

        .rk-team-social-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .rk-team-card:hover .rk-team-social-overlay {
            opacity: 1;
        }

        /* Stats Section */
        .rk-stat-item h2 {
            font-size: 3rem;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .rk-page-hero {
                padding: 100px 0;
            }

            .rk-hero-image {
                margin-top: 3rem;
            }
        }

        @media (max-width: 768px) {
            .rk-page-hero {
                padding: 80px 0;
                text-align: center;
            }

            .rk-stat-item h2 {
                font-size: 2.5rem;
            }

            .display-4 {
                font-size: 2.5rem;
            }

            .rk-team-card {
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 576px) {
            .rk-page-hero {
                padding: 70px 0;
            }

            .rk-section {
                padding: 2rem 0;
            }

            .rk-stat-item h2 {
                font-size: 2rem;
            }
        }

        /* Memastikan konten tidak tertutup oleh fixed navbar */
        .rk-page-hero {
            padding-top: calc(80px + 2rem);
        }
    </style>

    <script>
        // Counter animation for stats
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('[data-count]');
            const speed = 200;

            counters.forEach(counter => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target;
                }

                function updateCount() {
                    const current = +counter.innerText;
                    if (current < target) {
                        counter.innerText = Math.ceil(current + increment);
                        setTimeout(updateCount, 1);
                    } else {
                        counter.innerText = target;
                    }
                }
            });
        });
    </script>
@endsection
