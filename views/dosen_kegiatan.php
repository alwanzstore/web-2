<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary btn-sm mb-3 w-100" data-toggle="modal" data-target="#tambahDosenKegiatan">
                Tambah Dosen - Kegiatan
            </button>

            <!-- Modal Tambah Dosen Kegiatan -->
            <div class="modal fade" id="tambahDosenKegiatan">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Dosen - Kegiatan</h4>
                            <button type="button" class="close" data-dismiss="modal"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="dosen_id">Dosen ID</label>
                                    <input type="text" name="dosen_id" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="kegiatan_id">Kegiatan ID</label>
                                    <input type="text" name="kegiatan_id" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <input type="submit" name="tipe" value="simpan" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel Dosen Kegiatan -->
            <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Dosen ID</th>
                            <th>Kegiatan ID</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('Controllers/DosenKegiatan.php');
                        $no = 1;
                        foreach ($dosen_kegiatan->index() as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['dosen_id'] ?></td>
                                <td><?= $row['kegiatan_id'] ?></td>
                                <td class="d-flex">
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#edit<?= $row['dosen_id'] ?>_<?= $row['kegiatan_id'] ?>">Edit</button>

                                    <!-- Modal Edit Dosen Kegiatan -->
                                    <div class="modal fade" id="edit<?= $row['dosen_id'] ?>_<?= $row['kegiatan_id'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Dosen - Kegiatan</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Dosen ID</label>
                                                            <input type="text" name="dosen_id" value="<?= $row['dosen_id'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kegiatan ID</label>
                                                            <input type="text" name="kegiatan_id" value="<?= $row['kegiatan_id'] ?>" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <input type="hidden" name="old_dosen_id" value="<?= $row['dosen_id'] ?>">
                                                        <input type="hidden" name="old_kegiatan_id" value="<?= $row['kegiatan_id'] ?>">
                                                        <input type="submit" name="tipe" value="edit" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Hapus -->
                                    <form method="post">
                                        <input type="hidden" name="dosen_id" value="<?= $row['dosen_id'] ?>">
                                        <input type="hidden" name="kegiatan_id" value="<?= $row['kegiatan_id'] ?>">
                                        <input type="submit" name="tipe" value="delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Dosen ID</th>
                            <th>Kegiatan ID</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Proses Tambah/Edit/Delete -->
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipe'])) {
                $data = [
                    "dosen_id" => $_POST['dosen_id'] ?? '',
                    "kegiatan_id" => $_POST['kegiatan_id'] ?? ''
                ];

                switch ($_POST['tipe']) {
                    case "simpan":
                        $dosen_kegiatan->create($data);
                        echo '<script>alert("Relasi Dosen-Kegiatan berhasil ditambahkan"); location.href="?url=dosen_kegiatan";</script>';
                        break;
                    case "edit":
                        $dosen_kegiatan->update($_POST['old_dosen_id'], $_POST['old_kegiatan_id'], $data);
                        echo '<script>alert("Relasi Dosen-Kegiatan berhasil diedit"); location.href="?url=dosen_kegiatan";</script>';
                        break;
                    case "delete":
                        $dosen_kegiatan->delete($_POST['dosen_id'], $_POST['kegiatan_id']);
                        echo '<script>alert("Relasi Dosen-Kegiatan berhasil dihapus"); location.href="?url=dosen_kegiatan";</script>';
                        break;
                }
            }
            ?>
        </div>
    </div>
</div>
