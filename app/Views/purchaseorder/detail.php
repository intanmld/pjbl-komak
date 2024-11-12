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
            <table>
    <tr>
        <th>No Req</th>
        <td><?= $persetujuan['id_permintaan']; // No Permintaan dari tabel persetujuan ?></td>
    </tr>
    <tr>
        <th>No PO</th>
        <td><?= $noPoFormatted; // Menampilkan No PO dengan format PR-001 ?></td>
    </tr>
    <tr>
        <th>Penanggung Jawab</th>
        <td><?= $purchaseOrder['penanggung_jawab']; ?></td>
    </tr>
    <tr>
        <th>Pemohon</th>
        <td><?= $pemohon['nama_akun1']; // Menampilkan nama pemohon dari tabel akun1s ?></td>
    </tr>
    <tr>
        <th>Tanggal Order</th>
        <td><?= $permintaanPembelian['tanggal']; ?></td>
    </tr>
    <tr>
        <th>Supplier</th>
        <td><?= $purchaseOrder['supplier']; ?></td>
    </tr>
    <tr>
        <th>Nama Barang</th>
        <td><?= $permintaanPembelian['nama_barang']; ?></td>
    </tr>
    <tr>
        <th>Jumlah</th>
        <td><?= $permintaanPembelian['jumlah']; ?></td>
    </tr>
    <tr>
        <th>Satuan</th>
        <td><?= $permintaanPembelian['satuan']; ?></td>
    </tr>
    <tr>
        <th>Harga</th>
        <td><?= number_format($permintaanPembelian['harga'], 2, ',', '.'); ?></td>
    </tr>
    <tr>
        <th>Status</th>
        <td><?= $persetujuan['status']; ?></td>
    </tr>
</table>

                <a href="<?= site_url('purchaseorder') ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
