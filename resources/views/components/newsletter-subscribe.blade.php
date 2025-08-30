 <section class="rk-section py-5 bg-primary">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="fw-bold text-white mb-3 rk-heading">Tetap Terupdate!</h2>
                <p class="text-light mb-4">Dapatkan informasi terbaru tentang kursus, workshop, dan artikel terbaru langsung ke email Anda</p>
                
                <form id="newsletterForm" class="rk-newsletter-form" data-aos="fade-up" data-aos-delay="100">
                    @csrf
                    <div class="input-group rk-input-group">
                        <input type="email" 
                               name="email" 
                               class="form-control rk-newsletter-input" 
                               placeholder="Masukkan alamat email Anda" 
                               required
                               aria-label="Email newsletter">
                        <button type="submit" class="btn btn-warning rk-newsletter-btn">
                            <span class="d-none d-md-inline">Berlangganan</span>
                            <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </div>
                    <div class="form-text text-light mt-2">
                        Kami menghargai privasi Anda. Email tidak akan dibagikan ke pihak ketiga.
                    </div>
                </form>
                
                <div id="newsletterMessage" class="alert alert-success mt-3 d-none" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <span id="messageText"></span>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .rk-newsletter-form {
        max-width: 500px;
        margin: 0 auto;
    }
    
    .rk-input-group {
        border-radius: 50px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .rk-newsletter-input {
        border: none;
        padding: 1.2rem 1.5rem;
        font-size: 1rem;
        border-radius: 50px 0 0 50px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }
    
    .rk-newsletter-input:focus {
        border-color: var(--rk-primary);
        box-shadow: none;
    }
    
    .rk-newsletter-btn {
        border: none;
        padding: 1.2rem 2rem;
        font-weight: 600;
        border-radius: 0 50px 50px 0;
        transition: all 0.3s ease;
    }
    
    .rk-newsletter-btn:hover {
        background: var(--rk-dark);
        color: white;
        transform: translateX(2px);
    }
    
    .rk-newsletter-btn:active {
        transform: translateX(0);
    }
    
    #newsletterMessage {
        border-radius: var(--rk-radius);
        border: none;
        background: rgba(255,255,255,0.95);
        color: var(--rk-dark);
    }
    
    @media (max-width: 576px) {
        .rk-input-group {
            flex-direction: column;
            border-radius: var(--rk-radius);
        }
        
        .rk-newsletter-input {
            border-radius: var(--rk-radius) var(--rk-radius) 0 0;
            text-align: center;
        }
        
        .rk-newsletter-btn {
            border-radius: 0 0 var(--rk-radius) var(--rk-radius);
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const newsletterForm = document.getElementById('newsletterForm');
        const newsletterMessage = document.getElementById('newsletterMessage');
        const messageText = document.getElementById('messageText');
        
        newsletterForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const email = formData.get('email');
            
            // Simple email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showMessage('Please enter a valid email address', 'danger');
                return;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
            submitBtn.disabled = true;
            
            try {
                // Simulate API call (replace with actual endpoint)
                await new Promise(resolve => setTimeout(resolve, 1500));
                
                // Success message
                showMessage('Terima kasih! Anda telah berhasil berlangganan newsletter kami.', 'success');
                newsletterForm.reset();
                
                // Store in localStorage to prevent duplicate submissions
                localStorage.setItem('newsletterSubscribed', 'true');
                
            } catch (error) {
                showMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'danger');
            } finally {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
        
        function showMessage(text, type) {
            messageText.textContent = text;
            newsletterMessage.className = `alert alert-${type} mt-3`;
            newsletterMessage.classList.remove('d-none');
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                newsletterMessage.classList.add('d-none');
            }, 5000);
        }
        
        // Check if already subscribed
        if (localStorage.getItem('newsletterSubscribed')) {
            newsletterForm.classList.add('d-none');
            showMessage('Anda sudah berlangganan newsletter kami. Terima kasih!', 'info');
        }
    });
</script>
