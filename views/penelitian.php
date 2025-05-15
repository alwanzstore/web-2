<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary btn-sm mb-3 w-100" data-toggle="modal" data-target="#tambahJenisKegiatan">
                Tambah Kegiatan
            </button>

            <!-- Modal Tambah Kegiatan -->
            <div class="modal fade" id="tambahJenisKegiatan">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Kegiatan</h4>
                            <button type="button" class="close" data-dismiss="modal"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="id" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" name="judul" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Mulai</label>
                                    <input type="date" name="mulai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Akhir</label>
                                    <input type="date" name="akhir" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Bidang Ilmu ID</label>
                                    <input type="text" name="bidang_ilmu_id" class="form-control" required>
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
                            <th>Judul</th>
                            <th>Mulai</th>
                            <th>Akhir</th>
                            <th>Tahun Ajaran</th>
                            <th>Bidang Ilmu ID</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('Controllers/Penelitian.php');
                        $no = 1;
                        foreach ($penelitian->index() as $kegiatan): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $kegiatan['id'] ?></td>
                                <td><?= $kegiatan['judul'] ?></td>
                                <td><?= $kegiatan['mulai'] ?></td>
                                <td><?= $kegiatan['akhir'] ?></td>
                                <td><?= $kegiatan['tahun_ajaran'] ?></td>
                                <td><?= $kegiatan['bidang_ilmu_id'] ?></td>
                                <td class="d-flex">
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#edit<?= $kegiatan['id'] ?>">Edit</button>

                                    <!-- Modal Edit Kegiatan -->
                                    <div class="modal fade" id="edit<?= $kegiatan['id'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Kegiatan</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $kegiatan['id'] ?>">
                                                        <div class="form-group">
                                                            <label>Judul</label>
                                                            <input type="text" name="judul" value="<?= $kegiatan['judul'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Mulai</label>
                                                            <input type="date" name="mulai" value="<?= $kegiatan['mulai'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Akhir</label>
                                                            <input type="date" name="akhir" value="<?= $kegiatan['akhir'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tahun Ajaran</label>
                                                            <input type="text" name="tahun_ajaran" value="<?= $kegiatan['tahun_ajaran'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Bidang Ilmu ID</label>
                                                            <input type="text" name="bidang_ilmu_id" value="<?= $kegiatan['bidang_ilmu_id'] ?>" class="form-control" required>
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
                                        <input type="hidden" name="id" value="<?= $kegiatan['id'] ?>">
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
                            <th>Judul</th>
                            <th>Mulai</th>
                            <th>Akhir</th>
                            <th>Tahun Ajaran</th>
                            <th>Bidang Ilmu ID</th>
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
                    "judul" => $_POST['judul'] ?? '',
                    "mulai" => $_POST['mulai'] ?? '',
                    "akhir" => $_POST['akhir'] ?? '',
                    "tahun_ajaran" => $_POST['tahun_ajaran'] ?? '',
                    "bidang_ilmu_id" => $_POST['bidang_ilmu_id'] ?? '',
                ];

                switch ($_POST['tipe']) {
                    case "simpan":
                        $penelitian->create($data);
                        echo '<script>alert("Kegiatan berhasil ditambahkan"); location.href="?url=penelitian";</script>';
                        break;
                    case "edit":
                        $penelitian->update($_POST['id'], $data);
                        echo '<script>alert("Kegiatan berhasil diedit"); location.href="?url=penelitian";</script>';
                        break;
                    case "delete":
                        $penelitian->delete($_POST['id']);
                        echo '<script>alert("Kegiatan berhasil dihapus"); location.href="?url=penelitian";</script>';
                        break;
                }
            }
            ?>
        </div>
    </div>
</div>
