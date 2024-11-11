<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <h4>Persetujuan Permintaan Pembelian</h4>
    </div>

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
                                    <td><?= number_format($row['harga'], 0, ',', '.') ?></td>
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
</style>
<?= $this->endSection(); ?>
