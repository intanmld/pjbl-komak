<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <a href="<?= site_url('permintaanpembelian/create') ?>" class="btn btn-primary">Tambah Permintaan Pembelian</a>
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
                                <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <a href="<?= site_url('permintaanpembelian/edit/' . $row['id_permintaan']) ?>" class="btn btn-warning">Edit</a>
                                    <a href="<?= site_url('permintaanpembelian/delete/' . $row['id_permintaan']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger">Delete</a>
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
