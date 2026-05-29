        <!-- Team Section -->
        <section id="team">
            <div class="container">
                <div class="section-title text-center mb-5" data-aos="fade-up">
                    <h2>Jajaran Manajemen</h2>
                    <div class="title-line"></div>
                </div>
                <div class="row g-4 justify-content-center">
                    <?php foreach ($team as $index => $t): ?>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?= 100 * ($index + 1) ?>">
                        <div class="team-card">
                            <div class="team-img-wrapper">
                                <img src="<?= $t['photo_path'] ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80' ?>" alt="<?= esc($t['name']) ?>" class="team-img">
                            </div>
                            <div class="team-info">
                                <h5><?= esc($t['name']) ?></h5>
                                <p><?= esc($t['position']) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
