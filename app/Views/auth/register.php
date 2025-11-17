<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container" style="max-width: 500px;">
    <div class="card mt-5">
        <div class="card-header text-center">
            <h3>Registrasi Akun PPDB</h3>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form action="/register" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="form-text">Minimal 8 karakter.</div>
                </div>
                <div class="mb-3">
                    <label for="pass_confirm" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="pass_confirm" name="pass_confirm" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <p>Sudah punya akun? <a href="<?= site_url('login') ?>">Login di sini</a></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
