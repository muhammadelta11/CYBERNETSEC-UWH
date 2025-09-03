<div class="rk-dark-mode-toggle" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
    <button class="rk-dark-mode-btn" id="darkModeToggle" aria-label="Toggle dark mode">
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
    }
    
    .rk-dark-mode-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--rk-primary);
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--rk-shadow);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .rk-dark-mode-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
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
            top: 15px;
            right: 15px;
        }
        
        .rk-dark-mode-btn {
            width: 45px;
            height: 45px;
        }
    }

    /* ================================
   Footer Styling
    ================================ */

    /* Default (Light Mode) */
    .rk-footer-area,
    .rk-footer-area p,
    .rk-footer-area a,
    .rk-footer-area h4 {
        color: #f9fafb;
        background: #000000;
        transition: all 0.3s ease; /* biar smooth */
    }

    /* Dark Mode */
    [data-theme="dark"] .rk-footer-area,
    [data-theme="dark"] .rk-footer-area p,
    [data-theme="dark"] .rk-footer-area a,
    [data-theme="dark"] .rk-footer-area h4 {
        color: #f9fafb !important;  /* teks jadi terang */
        background: #1f2937;        /* latar jadi gelap */
    }

    [data-theme="dark"] .rk-footer-area a:hover {
        color: #60a5fa; /* biru terang saat hover */
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
        if (currentTheme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
        
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
    });
</script>
