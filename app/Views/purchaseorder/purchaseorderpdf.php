<html>

<div class="container">
    <h1>Invoice Purchase Order</h1>
    <table class="table table-striped table-md" style="margin-bottom: 50px;">
        <thead>
            <tr>
                <th><strong>No Permintaan</strong></th>
                <th><strong>No Pengiriman</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?= ($purchaseOrder['no_permintaan']) ? $purchaseOrder['no_permintaan'] : 'N/A'; ?></td>
                <td> <?= ($purchaseOrder['id_po']) ? $purchaseOrder['id_po'] : 'N/A'; ?></td>
            </tr>
        </tbody>
    </table>

    <table class="table table-striped table-md" style="margin-bottom: 50px;">
        <thead>
            <tr>
                <th><strong>Pemohon</strong></th>
                <th><strong>Penanggung Jawab</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?= ($purchaseOrder['nama_akun1']) ? $purchaseOrder['nama_akun1'] : 'N/A'; ?></td>
                <td> <?= ($purchaseOrder['penanggung_jawab']) ? $purchaseOrder['penanggung_jawab'] : 'N/A'; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<table border="1px" class="table tab-bordered">
    <thead>
        <tr>
            <th style="text-align: center;">Tanggal</th>
            <th style="text-align: center;">Supplier</th>
            <th style="text-align: center;">Nama Barang</th>
            <th style="text-align: center;">Jumlah</th>
            <th style="text-align: center;">Satuan</th>
            <th style="text-align: center;">Harga per unit</th>
            <th style="text-align: center;">Total Harga</th>
            <th style="text-align: center;">Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center;"><?= ($purchaseOrder['tanggal']) ? $purchaseOrder['tanggal'] : 'N/A'; ?></td>
            <td style="text-align: center;"><?= ($purchaseOrder['supplier']) ? $purchaseOrder['supplier'] : 'N/A'; ?></td>
            <td style="text-align: center;"><?= ($purchaseOrder['nama_barang']) ? $purchaseOrder['nama_barang'] : 'N/A'; ?></td>
            <td style="text-align: center;"><?= ($purchaseOrder['jumlah']) ? $purchaseOrder['jumlah'] : 'N/A'; ?></td>
            <td style="text-align: center;"><?= ($purchaseOrder['satuan']) ? $purchaseOrder['satuan'] : 'N/A'; ?></td>
            <td style="text-align: center;">Rp<?= ($purchaseOrder['harga']) ? number_format($purchaseOrder['harga'], 0, ", ", ",") : ''; ?></td>
            <td style="text-align: center;">Rp<?= ($purchaseOrder['harga']) ? number_format($purchaseOrder['jumlah'] * $purchaseOrder['harga'], 0, ", ", ",") : ''; ?></td>
            <td style="text-align: center;">On-process</td>
        </tr>
    </tbody>
</table>
<table>
    <thead>*Harga Termasuk Pajak</thead>
</table>

</html>