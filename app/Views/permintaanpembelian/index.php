<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <a href="<?= site_url('permintaanpembelian/create') ?>" class="btn btn-primary">Tambah Permintaan Pembelian</a>
    </div>

    <div class="section-body">
    <div class="card">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <thead>
                        <th>No Permintaan</th>
                        <th>Tanggal</th>
                        <th>Pemohon</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php foreach ($permintaan as $row): ?>
                            <tr>
                                <td><?= $row['no_permintaan'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td><?= $row['pemohon'] ?></td>
                                <td><?= $row['nama_barang'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                                <td><?= $row['satuan'] ?></td>
                                <td>Rp.<?= number_format($row['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <a href="<?= site_url('permintaanpembelian/edit/' . $row['id_permintaan']) ?>" class="btn btn-warning">Edit</a> | <a href="<?= site_url('permintaanpembelian/delete/' . $row['id_permintaan']) ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- <form action="post" action="<?= site_url('akun1') ?>">
                <div class="form-group">
                    <label>Kode Akun 1</label>
                    <input type="text" class="form-control" name="kode_akun1" placeholder="Kode akun">
                </div>
                <div class="form-group">
                    <label>Nama Akun 1</label>
                    <input type="text" class="form-control" name="nama_akun1" placeholder="Nama akun">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form> -->
        </div>
    <div class="card-footer text-right">

    </div>
</div>
    </div>
</section>

<?= $this->endSection(); ?>
