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
                                <th class="text-center">No Permintaan</th>
                                <th class="text-center">No Pengiriman</th>
                                <th class="text-center">Tanggal Order</th>
                                <th class="text-center">Penanggung Jawab</th>
                                <th class="text-center">Supplier</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Harga Per Unit</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($purchaseOrders as $po): ?>
                                <tr>
                                    <td class="text-center"><?= $po['no_permintaan'] ?></td>
                                    <td class="text-center"><?= sprintf('P-%03d', $po['id_po']) ?></td>
                                    <td class="text-center"><?= $po['tanggal'] ?></td>
                                    <td class="text-center"><?= $po['penanggung_jawab'] ?: '-' ?></td>
                                    <td class="text-center"><?= $po['supplier'] ?: '-' ?></td>
                                    <td class="text-center"><?= $po['nama_barang'] ?></td>
                                    <td class="text-center"><?= $po['jumlah'] ?></td>
                                    <td class="text-center"><?= $po['satuan'] ?></td>
                                    <!-- Harga Per Unit -->
                                    <td class="text-center">Rp<?= number_format($po['harga'], 0, ", ", ",") ?></td>

                                    <!-- Harga Total (Jumlah x Harga Per Unit) -->
                                    <td class="text-center">Rp<?= number_format($po['jumlah'] * $po['harga'], 0, ", ", ",") ?></td>
                                    <td class="text-center" style="width:18%">
                                        <a href="<?= site_url('purchaseorder/detail/' . $po['id_po']) ?>" class="btn btn-info"><i class="fas fa-bars btn-small"></i>Detail</a>
                                        <a href="<?= site_url('purchaseorder/edit/' . $po['id_po']) ?>" class="btn btn-warning"><i class="fas fa-pencil-alt btn-small"></i>Add</a>
                                        <a href="<?= site_url('purchaseorder/purchaseorderpdf/' . $po['id_po']) ?>" class="btn btn-success">Invoice</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <thead>*Harga Termasuk Pajak</thead>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>