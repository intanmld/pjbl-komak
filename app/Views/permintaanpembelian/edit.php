<!-- View: permintaanpembelian/edit.php -->
<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <h1>Edit Purchase Request</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body p-4">
                <form action="<?= site_url('permintaanpembelian/update/' . $permintaan['id_permintaan']) ?>" method="post">
                    <div class="form-group">
                        <label>No Permintaan</label>
                        <input type="text" class="form-control" name="no_permintaan" value="<?= $permintaan['no_permintaan'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?= $permintaan['tanggal'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Pemohon</label>
                        <select class="form-control" name="pemohon" required>
                            <?php foreach ($pemohon_list as $pemohon): ?>
                                <option value="<?= $pemohon['id_akun1'] ?>" <?= ($pemohon['id_akun1'] == $permintaan['pemohon']) ? 'selected' : '' ?>><?= $pemohon['nama_akun1'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" value="<?= $permintaan['nama_barang'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" value="<?= $permintaan['jumlah'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" class="form-control" name="satuan" value="<?= $permintaan['satuan'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Per Unit</label>
                        <input type="number" class="form-control" name="harga" value="<?= $permintaan['harga'] ?>" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>