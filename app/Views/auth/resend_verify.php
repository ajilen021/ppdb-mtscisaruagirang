<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container" style="max-width: 500px;">
    <div class="card mt-5">
        <div class="card-header text-center">
            <h3>Kirim Ulang Email Verifikasi</h3>
        </div>
        <div class="card-body">
            
            <p class="text-muted">Masukkan email yang Anda gunakan saat mendaftar. Kami akan mengirimkan link verifikasi baru.</p>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= site_url('resend-verification') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Kirim Ulang</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <p>Ingat password? <a href="<?= site_url('login') ?>">Login di sini</a></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>