@props([
    'url' => url()->current(),
    'title' => 'Ruang Kelas - Platform Belajar Modern',
    'description' => 'Temukan kursus terbaik untuk mengembangkan skill Anda',
    'hashtags' => 'edutech,learning,onlinecourse'
])

<div class="rk-social-share" {{ $attributes }}>
    <h6 class="text-muted mb-3">Bagikan:</h6>
    <div class="rk-social-share-buttons">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}&quote={{ urlencode($title) }}" 
           class="rk-social-share-btn rk-facebook" 
           target="_blank" 
           rel="noopener noreferrer"
           title="Share on Facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        
        <a href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ urlencode($title) }}&hashtags={{ $hashtags }}" 
           class="rk-social-share-btn rk-twitter" 
           target="_blank" 
           rel="noopener noreferrer"
           title="Share on Twitter">
            <i class="fab fa-twitter"></i>
        </a>
        
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($url) }}" 
           class="rk-social-share-btn rk-linkedin" 
           target="_blank" 
           rel="noopener noreferrer"
           title="Share on LinkedIn">
            <i class="fab fa-linkedin-in"></i>
        </a>
        
        <a href="https://wa.me/?text={{ urlencode($title . ' ' . $url) }}" 
           class="rk-social-share-btn rk-whatsapp" 
           target="_blank" 
           rel="noopener noreferrer"
           title="Share on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
        
        <button class="rk-social-share-btn rk-copy-link" 
                title="Copy link" 
                data-url="{{ $url }}">
            <i class="fas fa-link"></i>
        </button>
    </div>
    
    <div class="rk-copy-alert alert alert-success mt-3 d-none" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        Link berhasil disalin!
    </div>
</div>

<style>
    .rk-social-share {
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: var(--rk-radius);
        margin: 1rem 0;
    }
    
    .rk-social-share-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .rk-social-share-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        text-decoration: none;
        color: white;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .rk-social-share-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .rk-facebook {
        background: #3b5998;
    }
    
    .rk-facebook:hover {
        background: #2d4373;
    }
    
    .rk-twitter {
        background: #1da1f2;
    }
    
    .rk-twitter:hover {
        background: #0d8bd9;
    }
    
    .rk-linkedin {
        background: #0077b5;
    }
    
    .rk-linkedin:hover {
        background: #005582;
    }
    
    .rk-whatsapp {
        background: #25d366;
    }
    
    .rk-whatsapp:hover {
        background: #128c7e;
    }
    
    .rk-copy-link {
        background: #6c757d;
    }
    
    .rk-copy-link:hover {
        background: #495057;
    }
    
    .rk-copy-alert {
        border-radius: var(--rk-radius);
        border: none;
        padding: 0.75rem 1rem;
    }
    
    @media (max-width: 576px) {
        .rk-social-share-buttons {
            justify-content: center;
        }
        
        .rk-social-share-btn {
            width: 40px;
            height: 40px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyLinkBtn = document.querySelector('.rk-copy-link');
        const copyAlert = document.querySelector('.rk-copy-alert');
        
        copyLinkBtn.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            
            // Use the Clipboard API
            navigator.clipboard.writeText(url).then(function() {
                // Show success message
                copyAlert.classList.remove('d-none');
                
                // Hide after 3 seconds
                setTimeout(() => {
                    copyAlert.classList.add('d-none');
                }, 3000);
                
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = url;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                
                copyAlert.classList.remove('d-none');
                setTimeout(() => {
                    copyAlert.classList.add('d-none');
                }, 3000);
            });
        });
        
        // Open share links in popup window
        const shareLinks = document.querySelectorAll('.rk-social-share-btn:not(.rk-copy-link)');
        shareLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                window.open(url, 'share', 'width=600,height=400');
            });
        });
    });
</script>
