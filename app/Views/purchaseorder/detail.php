<!-- View: purchaseorder/detail.php -->
<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <h4>Detail Purchase Order</h4>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body p-4">
                <table style="border-spacing: 0 10px;">
                    <tr>
                        <th>No Req</th>
                        <td>: <?= $permintaanPembelian['no_permintaan']; // No Permintaan dari tabel persetujuan ?></td>
                    </tr>
                    <tr>
                        <th>No PO</th>
                        <td>: <?= $noPoFormatted; // Menampilkan No PO dengan format PR-001 ?></td>
                    </tr>
                    <tr>
                        <th>Penanggung Jawab</th>
                        <td>: <?= $purchaseOrder['penanggung_jawab']; ?></td>
                    </tr>
                    <tr>
                        <th>Pemohon</th>
                        <td>: <?= $pemohon['nama_akun1']; // Menampilkan nama pemohon dari tabel akun1s ?></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>: <?= $purchaseOrder['keterangan']; // Menampilkan nama pemohon dari tabel akun1s ?></td>
                    </tr>
                    <tr>
                </table>
                <table class="table table-striped table-md">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td><?= $tanggalFormatted; ?></td>
                        <td><?= $purchaseOrder['supplier']; ?></td>
                        <td><?= $permintaanPembelian['nama_barang']; ?></td>
                        <td><?= $permintaanPembelian['jumlah']; ?></td>
                        <td><?= $permintaanPembelian['satuan']; ?></td>
                        <td>Rp.<?= number_format($permintaanPembelian['harga'], 2, ',', '.'); ?></td>
                        <td>On-process</td>
                    </tbody>
                </table>
                <a href="<?= site_url('purchaseorder') ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
