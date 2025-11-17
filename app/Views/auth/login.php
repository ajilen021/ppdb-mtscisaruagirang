<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container" style="max-width: 500px;">
    <div class="card mt-5">
        <div class="card-header text-center">
            <h3>Login Akun PPDB</h3>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('error_verify')): ?>
                <div class="alert alert-warning">
                    <?= session()->getFlashdata('error_verify') ?>
                    <a href="<?= site_url('resend-verification') ?>" class="alert-link">Kirim ulang email verifikasi?</a>
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= site_url('login') ?>" method="post"> <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <p>Belum punya akun? <a href="<?= site_url('register') ?>">Registrasi di sini</a></p> </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>