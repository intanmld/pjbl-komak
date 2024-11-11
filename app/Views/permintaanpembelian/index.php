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

<?= $this->endSection(); ?>
