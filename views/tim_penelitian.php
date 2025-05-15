<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary btn-sm mb-3 w-100" data-toggle="modal" data-target="#tambahPenelitianDosen">
                Tambah Penelitian Dosen
            </button>

            <!-- Modal Tambah -->
            <div class="modal fade" id="tambahPenelitianDosen">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Penelitian Dosen</h4>
                            <button type="button" class="close" data-dismiss="modal"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="penelitian_id">Penelitian ID</label>
                                    <input type="text" name="penelitian_id" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="dosen_id">Dosen ID</label>
                                    <input type="text" name="dosen_id" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="peran">Peran</label>
                                    <input type="text" name="peran" class="form-control" required>
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

            <!-- Tabel -->
            <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Penelitian ID</th>
                            <th>Dosen ID</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('Controllers/Timpenelitian.php');
                        $no = 1;
                        foreach ($timpenelitian->index() as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $item['penelitian_id'] ?></td>
                                <td><?= $item['dosen_id'] ?></td>
                                <td><?= $item['peran'] ?></td>
                                <td class="d-flex">
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#edit<?= $item['penelitian_id'] . $item['dosen_id'] ?>">Edit</button>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit<?= $item['penelitian_id'] . $item['dosen_id'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Penelitian Dosen</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="penelitian_id" value="<?= $item['penelitian_id'] ?>">
                                                        <input type="hidden" name="dosen_id" value="<?= $item['dosen_id'] ?>">
                                                        <div class="form-group">
                                                            <label>Peran</label>
                                                            <input type="text" name="peran" value="<?= $item['peran'] ?>" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <input type="submit" name="tipe" value="edit" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Hapus -->
                                    <form method="post">
                                        <input type="hidden" name="penelitian_id" value="<?= $item['penelitian_id'] ?>">
                                        <input type="hidden" name="dosen_id" value="<?= $item['dosen_id'] ?>">
                                        <input type="submit" name="tipe" value="delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Penelitian ID</th>
                            <th>Dosen ID</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Proses Tambah/Edit/Delete -->
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipe'])) {
                $data = [
                    "penelitian_id" => $_POST['penelitian_id'] ?? '',
                    "dosen_id" => $_POST['dosen_id'] ?? '',
                    "peran" => $_POST['peran'] ?? ''
                ];

                switch ($_POST['tipe']) {
                    case "simpan":
                        $timpenelitian->create($data);
                        echo '<script>alert("Data berhasil ditambahkan"); location.href="?url=tim_penelitian";</script>';
                        break;
                    case "edit":
                        $timpenelitian->update($_POST['penelitian_id'], $_POST['dosen_id'], $data);
                        echo '<script>alert("Data berhasil diedit"); location.href="?url=tim_penelitian";</script>';
                        break;
                    case "delete":
                        $timpenelitian->delete($_POST['penelitian_id'], $_POST['dosen_id']);
                        echo '<script>alert("Data berhasil dihapus"); location.href="?url=tim_penelitian";</script>';
                        break;
                }
            }
            ?>
        </div>
    </div>
</div>
