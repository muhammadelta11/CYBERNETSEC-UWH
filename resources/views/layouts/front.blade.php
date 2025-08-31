<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CYBERNETSEC.ID</title>
    <link rel="icon" href="{{ asset('frontemplate') }}/img/icon/logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontemplate') }}/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontemplate') }}/css/style.css">

    <link href="{{ asset('swal/dist/sweetalert2.min.css') }}" rel="stylesheet">
</head>

<body class="rk-body">
    @include('components.dark-mode-toggle')

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
                            <a class="nav-link rk-nav-link {{ request()->routeIs('kelas') ? 'active' : '' }}" href="{{ route('kelas') }}">Up Skill</a>
                        </li>
                        <li class="nav-item rk-nav-item">
                            <a class="nav-link rk-nav-link {{ request()->routeIs('podcast') ? 'active' : '' }}" href="{{ route('podcast') }}">Jadwal Event</a>
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
    <main style="min-height: calc(100vh - 400px);">
        @yield('content')
    </main>

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
                            <p><span>Address :</span> Jl. Raya Manyaran-Gunungpati, Nongkosawit, Kec. Gn. Pati, Kota Semarang, Jawa Tengah 50224</p>
                            <p><span>Phone :</span> +62 85647121046</p>
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
    <script src="{{ asset('frontemplate') }}/js/jquery-1.12.1.min.js"></script>
    <script src="{{ asset('frontemplate') }}/js/popper.min.js"></script>
    <script src="{{ asset('frontemplate') }}/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

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