        <!-- Lokasi Kantor Section -->
        <section id="locations" class="py-5" style="background: #ffffff;">
            <div class="container overflow-hidden">
                <div class="section-title text-center mb-5" data-aos="fade-up">
                    <h2>Lokasi Kantor Kami</h2>
                    <div class="title-line" style="margin: 0 auto;"></div>
                    <p class="text-muted mt-3">Temukan kantor cabang kami di berbagai daerah untuk layanan yang lebih dekat dengan Anda.</p>
                </div>
                
                <div class="row g-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-4">
                        <div class="locations-list" style="max-height: 500px; overflow-y: auto; padding-right: 10px;">
                            <?php if (!empty($locations)): ?>
                                <?php foreach ($locations as $index => $loc): ?>
                                    <?php
                                        $coords = explode(',', $loc['position']);
                                        $lat = isset($coords[0]) ? trim($coords[0]) : '-6.2088';
                                        $lng = isset($coords[1]) ? trim($coords[1]) : '106.8456';
                                    ?>
                                    <div class="location-item p-4 mb-3 rounded-4 shadow-sm" onclick="moveToLocation(<?= $lat ?>, <?= $lng ?>, '<?= esc(addslashes($loc['name'])) ?>')" style="cursor: pointer; transition: all 0.3s ease; border: 1px solid rgba(0,74,173,0.1); background: var(--bg-light);">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="location-icon" style="background: rgba(0, 180, 216, 0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <i class="fas fa-map-marker-alt" style="color: var(--primary-color); font-size: 1.2rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-1" style="color: var(--text-main); font-size: 1.1rem;"><?= esc($loc['name']) ?></h5>
                                                <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;"><?= nl2br(esc($loc['description'])) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted text-center">Belum ada data lokasi.</p>
                            <?php endif; ?>
                        </div>
                        <style>
                            .location-item:hover {
                                transform: translateX(10px);
                                background: #ffffff !important;
                                box-shadow: 0 10px 20px rgba(0, 74, 173, 0.1) !important;
                                border-color: rgba(0, 74, 173, 0.3) !important;
                            }
                            .location-item:hover .location-icon {
                                background: var(--primary-color) !important;
                            }
                            .location-item:hover .location-icon i {
                                color: #ffffff !important;
                            }
                            /* Custom Scrollbar for list */
                            .locations-list::-webkit-scrollbar {
                                width: 6px;
                            }
                            .locations-list::-webkit-scrollbar-track {
                                background: #f1f1f1; 
                                border-radius: 10px;
                            }
                            .locations-list::-webkit-scrollbar-thumb {
                                background: #c1c1c1; 
                                border-radius: 10px;
                            }
                            .locations-list::-webkit-scrollbar-thumb:hover {
                                background: #a8a8a8; 
                            }
                        </style>
                    </div>
                    <div class="col-lg-8">
                        <div id="main-map" class="rounded-4 shadow-sm" style="height: 500px; width: 100%; z-index: 1;"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script>
            let mainMap;
            let markers = [];
            
            document.addEventListener("DOMContentLoaded", function() {
                const locationsData = <?= json_encode($locations ?? []) ?>;
                
                // Initialize map
                let initialLat = -6.2088;
                let initialLng = 106.8456;
                
                if (locationsData.length > 0) {
                    const firstCoords = locationsData[0].position.split(',');
                    if(firstCoords.length === 2) {
                        initialLat = parseFloat(firstCoords[0]);
                        initialLng = parseFloat(firstCoords[1]);
                    }
                }
                
                mainMap = L.map('main-map').setView([initialLat, initialLng], 5);
                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(mainMap);
                
                // Add markers
                const bounds = [];
                locationsData.forEach(loc => {
                    const coords = loc.position ? loc.position.split(',') : [];
                    if(coords.length === 2) {
                        const lat = parseFloat(coords[0]);
                        const lng = parseFloat(coords[1]);
                        const marker = L.marker([lat, lng]).addTo(mainMap);
                        marker.bindPopup(`<b>${loc.name}</b><br>${loc.description}`);
                        bounds.push([lat, lng]);
                        markers.push(marker);
                    }
                });
                
                if(bounds.length > 1) {
                    mainMap.fitBounds(bounds, {padding: [50, 50]});
                } else if(bounds.length === 1) {
                    mainMap.setView(bounds[0], 13);
                }
            });
            
            function moveToLocation(lat, lng, name) {
                if(mainMap) {
                    mainMap.flyTo([lat, lng], 15, {
                        animate: true,
                        duration: 1.5
                    });
                    
                    // Find marker and open popup
                    const targetMarker = markers.find(m => {
                        const pos = m.getLatLng();
                        return Math.abs(pos.lat - lat) < 0.0001 && Math.abs(pos.lng - lng) < 0.0001;
                    });
                    if(targetMarker) {
                        setTimeout(() => {
                            targetMarker.openPopup();
                        }, 1500);
                    }
                }
            }
        </script>
