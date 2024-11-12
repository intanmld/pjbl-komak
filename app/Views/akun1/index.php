<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <a href="<?= site_url('akun1/new') ?>" class="btn btn-primary">Buat akun</a>
    </div>

    <div class="section-body">
    <div class="card">
    <div class="card-header">
    <h4>Data Akun</h4>
    </div>
    <div class="card-body p-4">
    <div class="table-responsive">
        <table class="table table-striped table-md">
            <thead>
                <tr>
                    <th class="text-center">Kode Akun</th>
                    <th class="text-center">Nama Akun</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dtakun1 as $key => $value) : ?>
                    <tr>
                        <td class="text-center" style="width: 30%;"><?= $value->kode_akun1 ?></td>
                        <td class="text-center" style="width: 30%;"><?= $value->nama_akun1 ?></td>
                        <td class="text-center" style="width: 60%;">
                            <a href="<?= site_url('akun1/edit/' . $value->id_akun1) ?>" class="btn btn-warning"> <i class="fas fa-pencil-alt"></i> edit</a>
                            <a href="<?= site_url('akun1/delete/' . $value->id_akun1) ?>"onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');" class="btn btn-danger"><i class="fas fa-trash"></i>Del</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
    <div class="card-footer text-right">

    </div>
</div>
    </div>
</section>

<?= $this->endSection(); ?>
