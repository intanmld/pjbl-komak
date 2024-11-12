<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <h4>Purchase Order</h4>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th>No Req</th>
                                <th>No PO</th>
                                <th>Tanggal Order</th>
                                <th>Penanggung Jawab</th>
                                <th>Supplier</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($purchaseOrders as $po): ?>
                                <tr>
                                    <td><?= $po['no_permintaan'] ?></td>
                                    <td><?= sprintf('P-%03d', $po['id_po']) ?></td>
                                    <td><?= $po['tanggal'] ?></td>
                                    <td><?= $po['penanggung_jawab'] ?: '-' ?></td>
                                    <td><?= $po['supplier'] ?: '-' ?></td>
                                    <td><?= $po['nama_barang'] ?></td>
                                    <td><?= $po['jumlah'] ?></td>
                                    <td><?= $po['satuan'] ?></td>
                                    <td>Rp.<?= number_format($po['harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="<?= site_url('purchaseorder/detail/' . $po['id_po']) ?>" class="btn btn-info">Detail</a>
                                        <a href="<?= site_url('purchaseorder/edit/' . $po['id_po']) ?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= site_url('purchaseorder/delete/' . $po['id_po']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
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
<?= $this->endSection(); ?>
