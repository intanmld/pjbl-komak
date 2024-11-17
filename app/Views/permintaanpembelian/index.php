<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <a href="<?= site_url('permintaanpembelian/create') ?>" class="btn btn-primary">Add Purchase Request</a>
    </div>
    <!-- Notifikasi di bagian atas layar -->
    <?php if (session()->getFlashdata('error')): ?>
        <div id="notification" class="notification alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div id="notification" class="notification alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="section-body">
        <div class="card">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                            <th class="text-center">No Permintaan</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Pemohon</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Harga Per Unit</th>
                            <th class="text-center">Total Harga</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($permintaan as $row): ?>
                                <tr>
                                    <td class="text-center"><?= $row['no_permintaan'] ?></td>
                                    <td class="text-center"><?= $row['tanggal'] ?></td>
                                    <td class="text-center"><?= $row['pemohon'] ?></td>
                                    <td class="text-center"><?= $row['nama_barang'] ?></td>
                                    <td class="text-center"><?= $row['jumlah'] ?></td>
                                    <td class="text-center"><?= $row['satuan'] ?></td>
                                    <!-- Harga Per Unit -->
                                    <td class="text-center">Rp<?= number_format($row['harga'], 0, ", ", ",") ?></td>

                                    <!-- Harga Total (Jumlah x Harga Per Unit) -->
                                    <td class="text-center">Rp<?= number_format($row['jumlah'] * $row['harga'], 0, ", ", ",") ?></td>

                                    <td class="text-center" style="width:18%">
                                        <a href="<?= site_url('permintaanpembelian/edit/' . $row['id_permintaan']) ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <a href="<?= site_url('permintaanpembelian/delete/' . $row['id_permintaan']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                        </class=>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <thead>*Harga Termasuk Pajak</thead>
                </div>
            </div>
            <div class="card-footer text-right">

            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const notification = document.getElementById("notification");
        if (notification) {
            setTimeout(() => {
                notification.style.opacity = "0";
            }, 2000);

            setTimeout(() => {
                notification.remove();
            }, 2500);
        }
    });
</script>
<style>
    .notification {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        width: 80%;
        max-width: 400px;
        text-align: center;
        opacity: 1;
        transition: opacity 0.5s ease;
    }
</style>
<?= $this->endSection(); ?>