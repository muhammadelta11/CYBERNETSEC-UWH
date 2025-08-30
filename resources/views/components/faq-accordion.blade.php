<section class="rk-section py-5 bg-light">
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h6 class="text-primary mb-2">FAQ</h6>
                <h2 class="fw-bold mb-3 rk-heading">Pertanyaan yang Sering Diajukan</h2>
                <p class="text-muted">Temukan jawaban untuk pertanyaan umum tentang platform kami</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="faqAccordion">
                    @php
                    $faqs = [
                        [
                            'question' => 'Apa itu Ruang Kelas?',
                            'answer' => 'Ruang Kelas adalah platform belajar online yang menghubungkan mentor berkualitas dengan pelajar di seluruh Indonesia.'
                        ],
                        [
                            'question' => 'Bagaimana cara mendaftar?',
                            'answer' => 'Anda dapat mendaftar melalui halaman pendaftaran di website kami dengan mengisi formulir yang disediakan.'
                        ],
                        [
                            'question' => 'Apakah ada biaya untuk mengikuti kelas?',
                            'answer' => 'Kami menawarkan berbagai jenis kelas, termasuk kelas gratis dan premium. Silakan cek halaman kursus untuk informasi lebih lanjut.'
                        ],
                        [
                            'question' => 'Bagaimana cara menghubungi mentor?',
                            'answer' => 'Setelah mendaftar, Anda akan mendapatkan akses untuk menghubungi mentor melalui platform kami.'
                        ],
                        [
                            'question' => 'Apakah ada sertifikat setelah menyelesaikan kursus?',
                            'answer' => 'Ya, setelah menyelesaikan kursus, Anda akan mendapatkan sertifikat yang dapat diunduh.'
                        ]
                    ];
                    @endphp

                    @foreach ($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .accordion-button {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: var(--rk-radius);
        transition: background 0.3s ease;
    }
    
    .accordion-button:hover {
        background: #e2e6ea;
    }
    
    .accordion-button:not(.collapsed) {
        background: var(--rk-primary);
        color: white;
    }
    
    .accordion-item {
        margin-bottom: 1rem;
    }
    
    .accordion-body {
        background: white;
        border-radius: var(--rk-radius);
        padding: 1.5rem;
        box-shadow: var(--rk-shadow);
    }
</style>
