        <!-- About Us Section -->
        <section id="about">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="section-title text-start mb-4">
                            <h2>Tentang Kami</h2>
                            <div class="title-line ms-0"></div>
                        </div>
                        <p class="mb-4" style="white-space: pre-line;">
                            <?= esc($settings['about_text'] ?? 'Lorem ipsum dolor sit amet...') ?>
                        </p>
                       
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="bento-item h-100"
                            style="background-image: url('<?= base_url('Assets/prakerjanusantara2.webp') ?>'); background-size: cover; background-position: center; min-height: 450px; border-radius: 40px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
