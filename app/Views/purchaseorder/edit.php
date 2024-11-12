<!-- View: permintaanpembelian/edit.php -->
<?= $this->extend("layout/backend"); ?>

<?= $this->section("content"); ?>
<section class="section">
    <div class="section-header">
        <h1>Edit Permintaan Pembelian</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body p-4">
                <form action="<?= site_url('purchaseorder/update/' . $purchaseOrder['id_po']) ?>" method="post">
                    <div class="form-group">
                        <label for="penanggung_jawab">Penanggung Jawab</label>
                        <select name="penanggung_jawab" id="penanggung_jawab" class="form-control" required>
                            <option value="">Pilih Penanggung Jawab</option>
                            <?php foreach ($akun1List as $akun): ?>
                                <option value="<?= $akun['nama_akun1']; ?>" 
                                    <?= $akun['nama_akun1'] == $purchaseOrder['penanggung_jawab'] ? 'selected' : ''; ?>>
                                    <?= $akun['nama_akun1']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <input type="text" name="supplier" class="form-control" value="<?= $purchaseOrder['supplier'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control"><?= $purchaseOrder['keterangan'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
