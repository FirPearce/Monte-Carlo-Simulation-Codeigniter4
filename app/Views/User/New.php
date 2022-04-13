<?= $this->extend('User/templates/sidebar') ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home/</span> New</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Monte Carlo Simulation</h5>
                    <small class="text-muted float-end"><?= date('D-d-M-Y'); ?></small>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('Penjual/tambahpermintaan'); ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Jumlah Penaksiran (bulan)</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input type="number" class="form-control" name="bulan" id="bulan" placeholder="Jumlah Penaksiran" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                <span id="basic-icon-default-email2" class="input-group-text">Contoh: 12</span>
                            </div>
                            <div class="form-text">Isi dengan jumlah bulan</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-company">Harga (Satuan)</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-money"></i></span>
                                <input type="number" name="harga" id="harga" class="form-control" placeholder="Harga (Satuan)" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
                                <span id="basic-icon-default-email2" class="input-group-text">Contoh: 20000</span>
                            </div>
                            <div class="form-text">Isi dengan harga 1 kali</div>
                        </div>
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
                </div>
            </div>
        </div>
    </div>
    <!-- Striped Rows -->
    <div class="card">
        <h5 class="card-header">Striped rows</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Frekuensi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular Project</strong></td>
                        <td>Albert Cook</td>
                        <td>
                            2
                        </td>
                        <td>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Striped Rows -->
</div>


<?= $this->endSection() ?>