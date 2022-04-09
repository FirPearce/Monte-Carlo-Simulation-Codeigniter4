<?= $this->extend('login/templates/layout') ?>

<?= $this->section('content') ?>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">MedicPredict</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Register</h3>
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <h4>Periksa Isian Kembali</h4>
                            </hr />
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="<?= base_url('Home/daftar'); ?>" class="signin-form" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Sign Up</button>
                        </div>
                    </form>
                    <a href="<?= base_url('Home/login'); ?>">
                        <p class="w-100 text-center" style="color: #fff">&mdash; Have an account? Sign In Here &mdash;</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>