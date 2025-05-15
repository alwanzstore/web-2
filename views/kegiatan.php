<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary btn-sm mb-3 w-100" data-toggle="modal" data-target="#tambahKegiatan">
                Tambah Kegiatan
            </button>

            <!-- Modal Tambah Kegiatan -->
            <div class="modal fade" id="tambahKegiatan">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Kegiatan</h4>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="id" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="tanggal_mulai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" name="tanggal_selesai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat</label>
                                    <input type="text" name="tempat" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kegiatan ID</label>
                                    <input type="text" name="jenis_kegiatan_id" class="form-control" required>
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

            <!-- Tabel Kegiatan -->
            <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Tempat</th>
                            <th>Deskripsi</th>
                            <th>Jenis Kegiatan ID</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('Controllers/Kegiatan.php');
                        $no = 1;
                        foreach ($kegiatan->index() as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['tanggal_mulai'] ?></td>
                                <td><?= $row['tanggal_selesai'] ?></td>
                                <td><?= $row['tempat'] ?></td>
                                <td><?= $row['deskripsi'] ?></td>
                                <td><?= $row['jenis_kegiatan_id'] ?></td>
                                <td class="d-flex">
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#edit<?= $row['id'] ?>">Edit</button>

                                    <!-- Modal Edit Kegiatan -->
                                    <div class="modal fade" id="edit<?= $row['id'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Kegiatan</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                        <div class="form-group">
                                                            <label>Tanggal Mulai</label>
                                                            <input type="date" name="tanggal_mulai" value="<?= $row['tanggal_mulai'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Selesai</label>
                                                            <input type="date" name="tanggal_selesai" value="<?= $row['tanggal_selesai'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tempat</label>
                                                            <input type="text" name="tempat" value="<?= $row['tempat'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskripsi</label>
                                                            <textarea name="deskripsi" class="form-control" required><?= $row['deskripsi'] ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jenis Kegiatan ID</label>
                                                            <input type="text" name="jenis_kegiatan_id" value="<?= $row['jenis_kegiatan_id'] ?>" class="form-control" required>
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
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="submit" name="tipe" value="delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Tempat</th>
                            <th>Deskripsi</th>
                            <th>Jenis Kegiatan ID</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Proses Tambah/Edit/Delete -->
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipe'])) {
                $data = [
                    "id" => $_POST['id'] ?? '',
                    "tanggal_mulai" => $_POST['tanggal_mulai'] ?? '',
                    "tanggal_selesai" => $_POST['tanggal_selesai'] ?? '',
                    "tempat" => $_POST['tempat'] ?? '',
                    "deskripsi" => $_POST['deskripsi'] ?? '',
                    "jenis_kegiatan_id" => $_POST['jenis_kegiatan_id'] ?? ''
                ];

                switch ($_POST['tipe']) {
                    case "simpan":
                        $kegiatan->create($data);
                        echo '<script>alert("Kegiatan berhasil ditambahkan"); location.href="?url=kegiatan";</script>';
                        break;
                    case "edit":
                        $kegiatan->update($_POST['id'], $data);
                        echo '<script>alert("Kegiatan berhasil diedit"); location.href="?url=kegiatan";</script>';
                        break;
                    case "delete":
                        $kegiatan->delete($_POST['id']);
                        echo '<script>alert("Kegiatan berhasil dihapus"); location.href="?url=kegiatan";</script>';
                        break;
                }
            }
            ?>
        </div>
    </div>
</div>
