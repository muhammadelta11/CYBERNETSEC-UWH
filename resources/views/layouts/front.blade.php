<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CYBERNETSEC.ID</title>
    <link rel="icon" href="{{ asset('frontemplate') }}/img/icon/logo.png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontemplate') }}/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontemplate') }}/css/style.css">
    
    <!-- SweetAlert2 -->
    <link href="{{ asset('swal/dist/sweetalert2.min.css') }}" rel="stylesheet">
    
    <style>
        :root {
            --rk-primary: #4361ee;
            --rk-secondary: #3a0ca3;
            --rk-accent: #f72585;
            --rk-light: #f8f9fa;
            --rk-dark: #212529;
            --rk-success: #4cc9f0;
            --rk-gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            --rk-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --rk-radius: 12px;
        }
        
        .rk-body {
            font-family: 'Inter', sans-serif;
            color: #4a5568;
            overflow-x: hidden;
        }
        
        .rk-heading h1, 
        .rk-heading h2, 
        .rk-heading h3, 
        .rk-heading h4, 
        .rk-heading h5, 
        .rk-heading h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: var(--rk-dark);
        }
        
        /* Modern Navbar - Menambah prefix untuk menghindari konflik */
        .rk-navbar {
            padding: 1.2rem 0;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
        }
        
        .rk-navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }
        
        .rk-navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: var(--rk-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }
        
        .rk-nav-item {
            margin: 0 0.5rem;
        }
        
        .rk-nav-link {
            font-weight: 500;
            color: var(--rk-dark) !important;
            position: relative;
            padding: 0.5rem 0.8rem !important;
            transition: all 0.3s ease;
        }
        
        .rk-nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--rk-gradient);
            transition: all 0.3s ease;
        }
        
        .rk-nav-link:hover:after,
        .rk-nav-link.active:after {
            width: 70%;
        }
        
        .rk-nav-link.active {
            font-weight: 600;
        }
        
        .rk-btn-primary {
            background: var(--rk-gradient);
            border: none;
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }
        
        .rk-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
            color: white;
            text-decoration: none;
        }
        
        /* Hero Section */
        .rk-hero-section {
            padding: 7rem 0 5rem;
            background: linear-gradient(135deg, rgba(255,255,255,1) 0%, rgba(245,247,255,1) 100%);
            position: relative;
            overflow: hidden;
        }
        
        .rk-hero-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(58, 12, 163, 0.05) 100%);
            z-index: 0;
        }
        
        .rk-hero-content {
            position: relative;
            z-index: 2;
        }
        
        /* Footer */
        .rk-footer-area {
            background: var(--rk-dark);
            color: rgba(255, 255, 255, 0.8);
            padding: 4rem 0 0;
            margin-top: 4rem !important;
        }
        
        .rk-footer-area h2, 
        .rk-footer-area h4 {
            color: white;
        }
        
        .rk-footer-brand a {
            font-size: 2.2rem;
            font-weight: 800;
            color: white;
            text-decoration: none;
        }
        
        .rk-social-icon a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            margin-right: 10px;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
        }
        
        .rk-social-icon a:hover {
            background: var(--rk-primary);
            transform: translateY(-3px);
            color: white;
        }
        
        .rk-contact-info p {
            margin-bottom: 0.5rem;
        }
        
        .rk-copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }
        
        /* Dropdown Menu */
        .rk-dropdown-menu {
            border: none;
            border-radius: var(--rk-radius);
            box-shadow: var(--rk-shadow);
            padding: 0.8rem 0;
            margin-top: 1rem;
        }
        
        .rk-dropdown-item {
            padding: 0.7rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .rk-dropdown-item:hover {
            background: rgba(67, 97, 238, 0.1);
            color: var(--rk-primary);
        }
        
        /* Utility Classes */
        .rk-shadow-hover {
            transition: all 0.3s ease;
        }
        
        .rk-shadow-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }
        
        .rk-card {
            border-radius: var(--rk-radius);
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
        }
        
        /* Animations */
        [data-aos] {
            transition: all 0.8s ease;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .rk-navbar-collapse {
                background: white;
                padding: 1.5rem;
                border-radius: var(--rk-radius);
                box-shadow: var(--rk-shadow);
                margin-top: 1rem;
            }
            
            .rk-nav-item {
                margin: 0.3rem 0;
            }
            
            .rk-hero-section {
                padding: 6rem 0 4rem;
            }
            
            .rk-nav-link:after {
                display: none;
            }
        }
        
        @media (max-width: 767.98px) {
            .rk-hero-section {
                padding: 5rem 0 3rem;
            }
            
            .rk-footer-area {
                padding: 3rem 0 0;
            }
            
            .rk-btn-primary {
                padding: 0.7rem 1.5rem;
                font-size: 0.9rem;
            }
        }
        
        /* Reset untuk menghindari konflik dengan template原有样式 */
        .main_menu.home_menu .navbar {
            background: transparent !important;
            box-shadow: none !important;
        }
        
        .section_padding {
            padding: 80px 0;
        }
        
        /* Memastikan konten tidak tertutup navbar */
        body {
            padding-top: 80px;
        }
        
        .rk-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }
    </style>
</head>

<body class="rk-body">
    <!-- Dark Mode Toggle -->
    @include('components.dark-mode-toggle')
    
    <!-- Header part start-->
    <header class="main_menu home_menu">
        <nav class="navbar navbar-expand-lg navbar-light rk-navbar">
            <div class="container">
                <a class="navbar-brand rk-navbar-brand" href="{{ route('welcome') }}">CYBERNETSEC.ID</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse main-menu-item justify-content-end rk-navbar-collapse"
                    id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item rk-nav-item">
                            <a class="nav-link rk-nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}" href="{{ route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item rk-nav-item">
                            <a class="nav-link rk-nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item rk-nav-item">
                            <a class="nav-link rk-nav-link {{ request()->routeIs('blog') ? 'active' : '' }}" href="{{ route('blog') }}">Artikel</a>
                        </li>
                        <li class="nav-item rk-nav-item">
                            <a class="nav-link rk-nav-link {{ request()->routeIs('kelas') ? 'active' : '' }}" href="{{ route('kelas') }}">Kursus</a>
                        </li>
                        <li class="nav-item rk-nav-item">
                            <a class="nav-link rk-nav-link {{ request()->routeIs('podcast') ? 'active' : '' }}" href="{{ route('podcast') }}">Workshop</a>
                        </li>
                        @guest
                        <li class="nav-item rk-nav-item">
                            <a class="nav-link rk-nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="d-none d-lg-block">
                            <a class="rk-btn-primary" href="{{ route('register') }}">Daftar</a>
                        </li>
                        @else
                        <li class="nav-item dropdown rk-nav-item">
                            <a class="nav-link dropdown-toggle rk-nav-link" href="#" id="navbarDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> Hi {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu rk-dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item rk-dropdown-item" href="{{ route('akun') }}"><i class="fas fa-user me-2"></i>Akun</a>
                                @if (Auth::user()->role == 'regular')
                                <a class="dropdown-item rk-dropdown-item" href="{{ route('upgradepremium') }}"><i class="fas fa-crown me-2"></i>Upgrade Premium</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item rk-dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Header part end-->

    <main style="min-height: calc(100vh - 400px);">
        @yield('content')
    </main>

    <!-- footer part start-->
    <footer class="footer-area rk-footer-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="single-footer-widget footer_1">
                        <div class="rk-footer-brand">
                            <a href="{{ route('welcome') }}"> 
                                <h2>CYBERNETSEC.ID</h2>
                            </a>
                        </div>
                        <p>UNWAHAS CYBERNETSEC LABORATORY</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-4">
                    <div class="single-footer-widget footer_2">
                        <h4>Sosial Media</h4>
                        <div class="social_icon rk-social-icon">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_2">
                        <h4>Kontak Kami</h4>
                        <div class="contact_info rk-contact-info">
                            <p><span>Address :</span> Indonesia</p>
                            <p><span>Phone :</span> +62 8123 1234 567</p>
                            <p><span>Email : </span>cybernetsec@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright_part_text text-center rk-copyright">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="footer-text m-0">
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved | This template is made with <i class="fas fa-heart text-danger"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> & Developed Apps By <a href="https:://github/fikrisuheri">CYBERNETSEC.ID</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->

    <!-- jquery plugins here-->
    <script src="{{ asset('frontemplate') }}/js/jquery-1.12.1.min.js"></script>
    <script src="{{ asset('frontemplate') }}/js/popper.min.js"></script>
    <script src="{{ asset('frontemplate') }}/js/bootstrap.min.js"></script>
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom js -->
    <script src="{{ asset('frontemplate') }}/js/custom.js"></script>
    <script src="{{ asset('swal/dist/sweetalert2.min.js') }}"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            disable: function() {
                return window.innerWidth < 768;
            }
        });
        
        // Navbar scroll effect
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.rk-navbar').addClass('scrolled');
            } else {
                $('.rk-navbar').removeClass('scrolled');
            }
        });
        
        // Pastikan navbar tidak menutupi konten
        $(document).ready(function() {
            const navbarHeight = $('.rk-navbar').outerHeight();
            $('body').css('padding-top', navbarHeight + 'px');
            
            // Handle responsive navbar toggle
            $('.navbar-toggler').click(function() {
                $('.rk-navbar').toggleClass('menu-open');
            });
        });
        
        // Handle window resize
        $(window).resize(function() {
            const navbarHeight = $('.rk-navbar').outerHeight();
            $('body').css('padding-top', navbarHeight + 'px');
        });
    </script>
    
    @if(session('status'))
    <script type="text/javascript">
        Swal.fire({
            title: 'Sukses ...',
            icon: 'success',
            text: '{{ session("status") }}',
            showClass: {
                popup: 'animated bounceInDown slow'
            },
            hideClass: {
                popup: 'animated bounceOutDown slow'
            }
        })
    </script>
    @endif
</body>

</html>