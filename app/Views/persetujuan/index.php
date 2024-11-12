<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <h4>Persetujuan Permintaan Pembelian</h4>
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
                            <tr>
                                <th>No Permintaan</th>
                                <th>Tanggal</th>
                                <th>Pemohon</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($persetujuan as $row): ?>
                                <tr>
                                    <td><?= $row['no_permintaan'] ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td><?= $row['pemohon'] ?></td>
                                    <td><?= $row['nama_barang'] ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><?= $row['satuan'] ?></td>
                                    <td>Rp.<?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <form action="<?= site_url('persetujuan/update_status/' . $row['id_persetujuan']) ?>" method="post">
                                            <!-- Mengubah warna dropdown berdasarkan status -->
                                            <select name="status" class="form-select <?= ($row['status'] == 'Disapprove') ? 'bg-danger' : 'bg-info' ?>">
                                                <option value="Disapprove" <?= ($row['status'] == 'Disapprove') ? 'selected' : '' ?>>Disapprove</option>
                                                <option value="Approved" <?= ($row['status'] == 'Approved') ? 'selected' : '' ?>>Approved</option>
                                            </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                        <a href="<?= site_url('persetujuan/delete/' . $row['id_persetujuan']) ?>" 
                                           class="btn btn-danger" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    <?php if (session()->getFlashdata('success')): ?>
        console.log("<?= session()->getFlashdata('success') ?>");
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        console.error("<?= session()->getFlashdata('error') ?>");
    <?php endif; ?>
</script>

<style>
    .bg-danger {
        background-color: #B10202 !important; /* Merah untuk Disapprove */
        color: #FFFFFF !important;
    }
    .bg-info {
        background-color: #0A53A8 !important; /* Biru untuk Approved */
        color: #FFFFFF !important;
    }
    select {
        padding-left: 5px;
        padding-left: 5px;
        border-radius: 15px;
    }
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
<script>
    // Tunggu hingga halaman selesai dimuat
    document.addEventListener("DOMContentLoaded", function() {
        const notification = document.getElementById("notification");
        if (notification) {
            // Menghilangkan notifikasi setelah 2 detik (2000ms)
            setTimeout(() => {
                notification.style.opacity = "0";
            }, 2000);

            // Menghapus elemen notifikasi dari DOM setelah animasi selesai
            setTimeout(() => {
                notification.remove();
            }, 2500); // Tambahkan sedikit waktu untuk memastikan efek fade out selesai
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function approvePersetujuan(id_persetujuan) {
        $.ajax({
            url: '/persetujuan/updateStatusAjax/' + id_persetujuan,  // Pastikan URL sesuai
            method: 'POST',
            data: { status: 'approved' },  // Kirim status 'approved'
            success: function(response) {
                // Tampilkan pesan yang diterima dari server di konsol
                console.log(response.message);  // Pesan detail dari server
                if (response.status === 'success') {
                    console.log('Purchase Order berhasil dibuat');
                } else {
                    console.log('Gagal membuat Purchase Order');
                }
            },
            error: function() {
                console.log('Error melakukan request');
            }
        });
    }
</script>

<?= $this->endSection(); ?>
