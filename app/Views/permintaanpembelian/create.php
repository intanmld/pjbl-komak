<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <h1>Permintaan</h1>
    </div>

    <div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Permintaan</h4>
        </div>
        <div class="card-body p-4">
            <form action="<?= site_url('permintaanpembelian/store') ?>" method="post">
                <div class="form-group">
                    <label>No Permintaan</label>
                    <input type="text" class="form-control" name="no_permintaan" placeholder="Nomor">
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" placeholder="Tanggal">
                </div>
                <div class="form-group">
                    <label>Pemohon</label>
                    <select class="form-control" name="pemohon" required>
                        <?php foreach ($pemohon_list as $pemohon): ?>
                            <option  value="<?= $pemohon['id_akun1'] ?>"><?= $pemohon['nama_akun1'] ?></option>
                        <?php endforeach; ?>
                    </select><br>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" required><br>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" required><br>
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" class="form-control" name="satuan" required><br>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga" required><br>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-danger" href="<?= site_url('permintaanpembelian') ?>">Cancel</a>
            </form>
        </div>
    <div class="card-footer text-right">

    </div>
</div>
    </div>
</section>

<?= $this->endSection(); ?>
