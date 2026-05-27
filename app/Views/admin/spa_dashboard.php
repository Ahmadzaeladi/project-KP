<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
    <div class="app-container">
        <?= $this->include('admin/components/sidebar') ?>

        <!-- Modals -->
        <?= $this->include('admin/components/modal_gallery') ?>
        <?= $this->include('admin/components/modal_team') ?>
        <?= $this->include('admin/components/modal_mission') ?>
        <?= $this->include('admin/components/modal_client') ?>
        <?= $this->include('admin/components/modal_service') ?>
        <?= $this->include('admin/components/modal_certification') ?>

        <!-- Main Content Area -->
        <main class="main-view" id="app-view">
            <!-- Content will be injected here by JS -->
            <div class="view-content">
                <h2>Memuat Dashboard...</h2>
            </div>
        </main>
    </div>

    <!-- SPA Logic -->
    <script>
        let serverData = <?= json_encode([
            'hero' => $hero,
            'settings' => $settings,
            'gallery' => $gallery,
            'missions' => $missions,
            'team' => $team,
            'clients' => $clients ?? [],
            'services' => $services ?? [],
            'certifications' => $certifications ?? []
        ]) ?>;

        const baseUrl = '<?= base_url() ?>';

        function showToast(message, type = 'info') {
             const existingToast = document.querySelector('.toast-spa');
             if (existingToast) existingToast.remove();
             const toast = document.createElement('div');
             toast.className = `toast-spa ${type}`;
             let icon = 'info-circle';
             if (type === 'success') icon = 'check-circle';
             if (type === 'error') icon = 'exclamation-triangle';
             toast.innerHTML = `<i class="fas fa-${icon}"></i> ${message}`;
             document.body.appendChild(toast);
             setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(20px)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

    </script>

    <?= $this->include('admin/components/scripts_templates') ?>
    <?= $this->include('admin/components/scripts_core') ?>
<?= $this->endSection() ?>
