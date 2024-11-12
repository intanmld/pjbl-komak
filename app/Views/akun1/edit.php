<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <h4>Edit Data Akun</h4>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="<?= site_url('akun1/update/' . $akun->id_akun1) ?>" method="post">
                    <div class="form-group">
                        <label for="kode_akun1">Kode Akun</label>
                        <input type="text" name="kode_akun1" id="kode_akun1" class="form-control" value="<?= $akun->kode_akun1 ?>" required>
                    <div class="form-group">
                        <label for="nama_akun1">Nama Akun</label>
                        <input type="text" name="nama_akun1" id="nama_akun1" class="form-control" value="<?= $akun->nama_akun1 ?>" required>
                    </div>
                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="<?= site_url('akun1') ?>" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
