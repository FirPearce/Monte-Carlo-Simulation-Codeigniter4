<?= $this->extend('User/templates/sidebar') ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Home/</span> Penaksiran</h4>
    <div class="col-xl">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Hasil Penaksiran</h5>
                <small class="text-muted float-end"><?= date('D-d-M-Y'); ?></small>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Jumlah Permintaan</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-line-chart"></i></span>
                        <input type="text" class="form-control" name="bulan" id="bulan" placeholder=" <?= $permintaan['total_hasil_permintaan']; ?>" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" disabled />
                        <span id="basic-icon-default-company2" class="input-group-text">Jumlah Permintaan</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-company">Rata - Rata Permintaan/Bulan</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-bar-chart-square"></i></span>
                        <input type="text" name="harga" id="harga" class="form-control" placeholder=" <?= round($permintaan['rata_rata_hasil_permintaan'], 2); ?>" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" disabled />
                        <span id="basic-icon-default-company2" class="input-group-text">Permintaan/Bulan</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-company">Rata - Rata Pemasukan/Bulan</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-money"></i></span>
                        <input type="text" name="harga" id="harga" class="form-control" placeholder="Rp. <?= $permintaan['rata_rata_pemasukan']; ?>" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" disabled />
                        <span id="basic-icon-default-company2" class="input-group-text">Ribu</span>
                    </div>
                </div>
                <form method="POST" action="<?= base_url('Penjual/inputhasil'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="totalhasil" value="<?= $permintaan['total_hasil_permintaan']; ?>">
                    <input type="hidden" name="ratahasil" value="<?= round($permintaan['rata_rata_hasil_permintaan'], 2); ?>">
                    <input type="hidden" name="ratapemasukan" value="<?= $permintaan['rata_rata_pemasukan']; ?>">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Striped Rows -->
    <div class="col-xl">
        <div class="card">
            <h5 class="card-header">Tabel Penaksiran</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Angka Acak</th>
                                <th>Permintaan</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $i = 1; ?>
                            <?php $j = 1; ?>
                            <?php foreach ($permintaan['hasilnya'] as $p) : ?>
                                <tr align="left">
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $j++; ?></strong></td>
                                    <td>Bulan <?= $p['penaksiran']; ?> (<?= date('F', mktime(0, 0, 0, $p['penaksiran'], 10)); ?>) </td>
                                    <td><?= $p['angka_acak']; ?></td>
                                    <td>
                                        <?= $p['hasil_permintaan']; ?> Obat
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="demo-inline-spacing">
                    <!-- Basic Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item first">
                                <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                            </li>
                            <li class="page-item prev">
                                <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-left"></i></a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="javascript:void(0);">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">5</a>
                            </li>
                            <li class="page-item next">
                                <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-right"></i></a>
                            </li>
                            <li class="page-item last">
                                <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <!--/ Basic Pagination -->
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>