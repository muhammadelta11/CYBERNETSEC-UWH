<div class="rk-dark-mode-toggle" style="position: fixed; bottom: 20px; right: 20px; z-index: 1050; background: rgba(99, 102, 241, 0.3); border-radius: 50%; padding: 5px; transition: all 0.3s ease;">

    <button class="rk-dark-mode-btn" id="darkModeToggle" aria-label="Toggle dark mode" style="background: transparent; width: 50px; height: 50px; border-radius: 50%; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: none; transition: all 0.3s ease;">
        <span class="rk-dark-icon">
            <i class="fas fa-moon"></i>
        </span>
        <span class="rk-light-icon">
            <i class="fas fa-sun"></i>
        </span>
    </button>
</div>

<style>
    .rk-dark-mode-toggle {
        transition: all 0.3s ease;
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1050;
        background: rgba(99, 102, 241, 0.3);
        border-radius: 50%;
        padding: 5px;
    }
    
    .rk-dark-mode-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: transparent;
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .rk-dark-mode-btn:hover {
        transform: scale(1.3);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.5);
        background: rgba(99, 102, 241, 0.6);
    }
    
    .rk-dark-icon,
    .rk-light-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.3s ease;
        opacity: 1;
    }
    
    .rk-light-icon {
        opacity: 0;
        transform: translate(-50%, -50%) rotate(180deg);
    }
    
    /* Dark mode styles */
    [data-theme="dark"] {
        --rk-primary: #6366f1;
        --rk-secondary: #4f46e5;
        --rk-accent: #ec4899;
        --rk-light: #1f2937;
        --rk-dark: #f9fafb;
        --rk-success: #22d3ee;
        --rk-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        --rk-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    [data-theme="dark"] body {
        background: #111827;
        color: #e5e7eb;
    }


    [data-theme="dark"] .navbar-nav.align-items-center {
        background: transparent;
        color: #111827 !important;
    }
    /* Dark mode di navbar */
    [data-theme="dark"] .breadcrumb{
        color: transparent !important;
        background: transparent;
    }



    /* Dark mode di register */
    [data-theme="dark"] .rk-features-list {
        background: #f8f9fa;
        color: #111827;
    }

     [data-theme="dark"] .rk-register-footer {
        /* background: white; */
        color: white;
    }

    /* breadcrumb register */
    [data-theme="dark"] .breadcrumb {
        background-color: transparent;
        color: #adb5bd !important;
    }

    [data-theme="dark"] .breadcrumb-item a {
        color: #adb5bd !important;
    }
    [data-theme="dark"] .breadcrumb-item.active {
        color: #ffc107 !important;
    }
    [data-theme="dark"] .breadcrumb-item a:hover {
        color: #f8f9fa !important;
    }
    [data-theme="dark"] .breadcrumb-item + .breadcrumb-item::before {
        color: #6c757d !important;
    }

    /* Dark mode di Masuk */
    [data-theme="dark"] .form-label{ /* kalimat nim atau kata sandi */
        background: var(--rk-light) !important;
        color: var(--rk-dark) !important;
    }

    [data-theme="dark"] .form-label{ /* kalimat kata sandi */
        background: var(--rk-light) !important;
        color: var(--rk-dark) !important;
    }

    [data-theme="dark"] .form-check{ /* kalimat ingat saya */
        background: var(--rk-light) !important;
        color: var(--rk-dark) !important;
    }

    [data-theme="dark"] .rk-login-footer{ /* kalimat belum punya akun?*/
        background: var(--rk-light) !important;
        color: var(--rk-dark) !important;
    }

    /* Additional dark mode fixes for login form elements */
    [data-theme="dark"] .rk-login-card,
    [data-theme="dark"] .rk-login-body,
    [data-theme="dark"] .rk-login-footer {
        background-color: var(--rk-light) !important;
        color: var(--rk-dark) !important;
        box-shadow: none !important;
        border: none !important;
    }

    [data-theme="dark"] .rk-form-control,
    [data-theme="dark"] .rk-input-group-text,
    [data-theme="dark"] .rk-password-toggle {
        background-color: var(--rk-light) !important;
        color: var(--rk-dark) !important;
        border: 1px solid var(--rk-secondary) !important;
        box-shadow: none !important;
    }

    [data-theme="dark"] .rk-login-footer a {
        color: var(--rk-primary) !important;
        box-shadow: none !important;
    }

    /* Dark mode di Pending-Approval */

    [data-theme="dark"] .card-header-text-center { /* kalimat Akun Anda telah berhasil dibuat*/
        text-align: center;
        background: white;
        color: #111827;
    }
    
    [data-theme="dark"] .card-text { /* kalimat Akun Anda telah berhasil dibuat*/
        color: #9ca3af !important;
    }

    [data-theme="dark"] .card-title { /* kalimat Terima kasih telah mendaftar!*/
        color: #f9fafb !important;
    }
    
    /* Dark mode di deskripsi kelas */
    [data-theme="dark"] .rk-curriculum-list .rk-empty-curriculum.text-center.py-4{
        background: #1f2937;
        color: #e5e7eb;
    }


    /* Dark mode di deskripsi event */
    [data-theme="dark"] .event-details.mt-4{
        background: #1f2937;
        color: #e5e7eb;
    }
    [data-theme="dark"] .sidebar_top.mt-3 {
        background: #1f2937;
        color: #e5e7eb;
    }
    [data-theme="dark"] .event-registration.mt-4  {
        background: #1f2937;
        color: #e5e7eb;
    }

    /* Dark mode di navbar dan hero section */
    [data-theme="dark"] .rk-navbar {
        background: rgba(17, 24, 39, 0.95) !important;
        backdrop-filter: blur(10px);
    }

    [data-theme="dark"] .rk-hero-section {
        background: rgba(17, 24, 39, 0.95) !important;
        backdrop-filter: blur(10px);
    }
    
    [data-theme="dark"] .rk-nav-link {
        color: #e5e7eb !important;
    }
    
    [data-theme="dark"] .rk-card {
        background: #1f2937;
        color: #e5e7eb;
    }
    
    [data-theme="dark"] .rk-heading h1
    {
        color: #000000;
    },
    [data-theme="dark"] .rk-heading h2,
    [data-theme="dark"] .rk-heading h3,
    [data-theme="dark"] .rk-heading h4,
    [data-theme="dark"] .rk-heading h5,
    [data-theme="dark"] .rk-heading h6 {
        color: #f9fafb;
    }
    
    [data-theme="dark"] .text-muted {
        color: #9ca3af !important;
    }
    
    [data-theme="dark"] .bg-light {
        background: #374151 !important;
    }
    
    [data-theme="dark"] .rk-dark-icon {
        opacity: 0;
        transform: translate(-50%, -50%) rotate(-180deg);
    }
    
    [data-theme="dark"] .rk-light-icon {
        opacity: 1;
        transform: translate(-50%, -50%) rotate(0deg);
    }

    /* Card components specific styling */
[data-theme="dark"] .card-body {
    background: #1f2937 !important;
    color: #e5e7eb !important;
}

[data-theme="dark"] .card-footer {
    background: #1f2937 !important;
    border-color: #374151 !important;
}

[data-theme="dark"] .card {
    background: #1f2937 !important;
    border-color: #374151 !important;
}

/* Specific untuk course card */
[data-theme="dark"] .course-card .card-body {
    background: #1f2937 !important;
}

[data-theme="dark"] .course-card .card-footer.bg-transparent {
    background: #1f2937 !important;
}

/* Button styling di dalam card */
[data-theme="dark"] .btn-outline-primary {
    border-color: #6366f1 !important;
    color: #6366f1 !important;
}

[data-theme="dark"] .btn-outline-primary:hover {
    background-color: #6366f1 !important;
    border-color: #6366f1 !important;
    color: white !important;
}

/* Badge styling */
[data-theme="dark"] .badge.bg-success {
    background-color: #22c55e !important;
    color: white !important;
}

[data-theme="dark"] .badge.bg-primary {
    background-color: #6366f1 !important;
    color: white !important;
}

[data-theme="dark"] .badge.bg-warning {
    background-color: #f59e0b !important;
    color: black !important;
}

/* Specific for semi-transparent badges in about page */
[data-theme="dark"] .badge.bg-success.bg-opacity-10 {
    color: #1f2937 !important; /* Dark text for contrast on light background */
}

[data-theme="dark"] .badge.bg-warning.bg-opacity-10 {
    color: #1f2937 !important; /* Dark text for contrast on light background */
}

[data-theme="dark"] .badge.bg-primary.bg-opacity-10 {
    color: #1f2937 !important; /* Dark text for contrast on light background */
}
[data-theme="light"] .badge.bg-success {
    background-color: #22c55e !important;
}

[data-theme="light"] .badge.bg-primary {
    background-color: #6366f1 !important;
}

[data-theme="light"] .badge.bg-warning {
    color: #000000 !important;
}

/* Specific for semi-transparent badges in about page in light mode */
[data-theme="light"] .badge.bg-success.bg-opacity-10 {
    color: #1f2937 !important; /* Dark text for contrast on light background */
}

[data-theme="light"] .badge.bg-warning.bg-opacity-10 {
    background-color: #f59e0b !important; /* Same as dark mode */
    color: black !important; /* Same as dark mode */
}

[data-theme="light"] .badge.bg-primary.bg-opacity-10 {
    color: #1f2937 !important; /* Dark text for harmony with other badges */
}

[data-theme="light"] .badge.bg-primary {
    color: white !important; /* White text for contrast on blue background */
}

[data-theme="dark"] .rk-card {
    border: none !important; /* Remove black border in dark mode to match light mode */
    box-shadow: none !important; /* Remove black shadow in dark mode to match light mode */
}

    /* Smooth transition for theme change */
    body {
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    
    .rk-card,
    .rk-navbar,
    .rk-btn-primary {
        transition: all 0.3s ease;
    }
    
    @media (max-width: 768px) {
        .rk-dark-mode-toggle {
            bottom: 15px;
            right: 15px;
        }
        
        .rk-dark-mode-btn {
            width: 45px;
            height: 45px;
        }
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const darkModeToggle = document.getElementById('darkModeToggle');
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
        
    // Check for saved theme preference or use system preference
    const currentTheme = localStorage.getItem('theme') ||
                        (prefersDarkScheme.matches ? 'dark' : 'light');

    // Apply the theme
    document.documentElement.setAttribute('data-theme', currentTheme);
        
    // Toggle theme
    darkModeToggle.addEventListener('click', function() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        let newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        // Dispatch custom event for other components
        document.dispatchEvent(new CustomEvent('themeChange', { 
            detail: { theme: newTheme } 
        }));
    });
    
    // Listen for system theme changes
    prefersDarkScheme.addEventListener('change', function(e) {
        if (!localStorage.getItem('theme')) {
            const newTheme = e.matches ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
        }
    });
    
    // Fix for initial theme flash issue on page load
    window.addEventListener('load', function() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
        } else {
            document.documentElement.setAttribute('data-theme', prefersDarkScheme.matches ? 'dark' : 'light');
        }
    });
    });
</script>
