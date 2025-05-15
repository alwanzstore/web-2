<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary btn-sm mb-3 w-100" data-toggle="modal" data-target="#tambahJenisKegiatan">
                Tambah Jenis Kegiatan
            </button>

            <!-- Modal Tambah Jenis Kegiatan -->
            <div class="modal fade" id="tambahJenisKegiatan">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Jenis Kegiatan</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <!-- <span>&times;</span> -->
                            </button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" name="id" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Jenis Kegiatan</label>
                                    <input type="text" name="nama" class="form-control" required>
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

            <!-- Tabel Jenis Kegiatan -->
            <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama Jenis Kegiatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('Controllers/Jeniskegiatan.php');
                        $no = 1;
                        foreach ($jenis_kegiatan->index() as $ok): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $ok['id'] ?></td>
                                <td><?= $ok['nama'] ?></td>
                                <td class="d-flex">
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#edit<?= $ok['id'] ?>">Edit</button>

                                    <!-- Modal Edit Jenis Kegiatan -->
                                    <div class="modal fade" id="edit<?= $ok['id'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Jenis Kegiatan</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>ID</label>
                                                          <input type="text" name="nama" value="<?= $ok['nama'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Jenis Kegiatan</label>
                                                            <input type="text" name="nama" value="<?= $ok['nama'] ?>" class="form-control" required>
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
                                        <input type="hidden" name="id" value="<?= $ok['id'] ?>">
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
                            <th>Nama Jenis Kegiatan</th>
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
                    "nama" => $_POST['nama'] ?? ''
                ];

                switch ($_POST['tipe']) {
                    case "simpan":
                        $jenis_kegiatan->create($data);
                        echo '<script>alert("Jenis kegiatan berhasil ditambahkan"); location.href="?url=jenis_kegiatan";</script>';
                        break;
                    case "edit":
                        $jenis_kegiatan->update($_POST['id'], $data);
                        echo '<script>alert("Jenis kegiatan berhasil diedit"); location.href="?url=jenis_kegiatan";</script>';
                        break;
                    case "delete":
                        $jenis_kegiatan->delete($_POST['id']);
                        echo '<script>alert("Jenis kegiatan berhasil dihapus"); location.href="?url=jenis_kegiatan";</script>';
                        break;
                }
            }
            ?>
        </div>
    </div>
</div>
