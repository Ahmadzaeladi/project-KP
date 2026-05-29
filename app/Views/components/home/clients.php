        <!-- Clients Section -->
        <section id="clients" class="py-5">
            <div class="container overflow-hidden">
                <div class="section-title text-center mb-5" data-aos="fade-up">
                    <h2>Klien & Mitra Kami</h2>
                    <div class="title-line"></div>
                </div>
                
                <?php if (!empty($clients)): ?>
                <!-- Row 1 -->
                <div class="slider-container mb-4">
                    <div class="logo-slider">
                        <!-- 1st Set -->
                        <?php foreach ($clients as $c): ?>
                        <div class="logo-slide">
                            <img src="<?= esc($c['logo_path']) ?>" alt="<?= esc($c['name']) ?>" />
                        </div>
                        <?php endforeach; ?>
                        <!-- 2nd Set -->
                        <?php foreach ($clients as $c): ?>
                        <div class="logo-slide">
                            <img src="<?= esc($c['logo_path']) ?>" alt="<?= esc($c['name']) ?>" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Row 2 -->
                <div class="slider-container">
                    <div class="logo-slider slider-reverse">
                        <!-- 1st Set -->
                        <?php foreach ($clients as $c): ?>
                        <div class="logo-slide">
                            <img src="<?= esc($c['logo_path']) ?>" alt="<?= esc($c['name']) ?>" />
                        </div>
                        <?php endforeach; ?>
                        <!-- 2nd Set -->
                        <?php foreach ($clients as $c): ?>
                        <div class="logo-slide">
                            <img src="<?= esc($c['logo_path']) ?>" alt="<?= esc($c['name']) ?>" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
