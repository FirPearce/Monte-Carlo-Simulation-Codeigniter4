<?= $this->extend('User/templates/sidebar') ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Home/</span> New</h4>
    <?php if ($harga[0]['penaksiran'] != null) : ?>
        <?php $totalbulan = "Tersimpan" . " " . $harga[0]['penaksiran'] . " " . "Bulan" ?>
        <?php $simpan = "Edit" ?>
    <?php else : ?>
        <?php $totalbulan = "Jumlah bulan" ?>
        <?php $simpan = "Tambah" ?>
    <?php endif; ?>
    <?php if ($harga[0]['harga'] != null) : ?>
        <?php $totalharga = "Tersimpan " . "Rp." . $harga[0]['harga'] ?>
    <?php else : ?>
        <?php $totalharga = "Harga(Satuan)" ?>
    <?php endif; ?>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Monte Carlo Simulation</h5>
                    <small class="text-muted float-end"><?= date('D-d-M-Y'); ?></small>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('Penjual/tambahbulanharga'); ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Jumlah Penaksiran (bulan)</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input type="number" class="form-control" name="bulan" id="bulan" placeholder="<?= $totalbulan; ?>" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                <span id="basic-icon-default-email2" class="input-group-text">Contoh: 12</span>
                            </div>
                            <div class="form-text">Isi dengan jumlah bulan</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-company">Harga (Satuan)</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-money"></i></span>
                                <input type="number" name="harga" id="harga" class="form-control" placeholder="<?= $totalharga; ?>" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
                                <span id="basic-icon-default-email2" class="input-group-text">Contoh: 20000</span>
                            </div>
                            <div class="form-text">Isi dengan harga</div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?= $simpan; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Striped Rows -->
    <div class="col-xl">
        <div class="card">
            <h5 class="card-header">Data Permintaan Obat Al Shifa 250 gram</h5>
            <div class="card-body">
                <form method="POST" action="<?= base_url('Penjual/tambahpermintaan'); ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-email"> Permintaan Bulan Ke- <?= (int)$bulan[0]['bulan'] + 1; ?></label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-cart"></i></span>
                            <input type="number" name="frekuensi" id="frekuensi" class="form-control" placeholder="Permintaan" aria-label="john.doe" aria-describedby="basic-icon-default-email2" />
                            <span id="basic-icon-default-email2" class="input-group-text">Contoh:5</span>
                        </div>
                        <div class="form-text">Isi dengan nomor</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Permintaan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $i = 1; ?>
                            <?php $j = 1; ?>
                            <?php $counter = count($permintaan); ?>
                            <?php foreach ($permintaan as $p) : ?>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $j++; ?></strong></td>
                                    <td>Bulan <?= $p['bulan']; ?> (<?= date('F', mktime(0, 0, 0, $p['bulan'], 10)); ?>) </td>
                                    <td><?= $p['frekuensi']; ?> obat</td>
                                    <td>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <?php if ($counter == $i) : ?>
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        <?php endif; ?>
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
    <!--/ Striped Rows -->
</div>


<?= $this->endSection() ?>