<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <h1>Buat akun</h1>
    </div>

    <div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Akun1</h4>
        </div>
        <div class="card-body p-4">
            <form action="post" action="<?= site_url('akun1') ?>">
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
            </form>
        </div>
    <div class="card-footer text-right">

    </div>
</div>
    </div>
</section>

<?= $this->endSection(); ?>
