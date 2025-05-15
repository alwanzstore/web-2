<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary btn-sm mb-3 w-100" data-toggle="modal" data-target="#tambahData">
                Tambah Data Prodi
            </button>

            <!-- Modal Tambah Data Prodi -->
            <div class="modal fade" id="tambahData">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Data Prodi</h4>
                            <button type="button" class="close" data-dismiss="modal"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <?php
                                $fields = ['id' => 'ID', 'kode' => 'Kode', 'nama' => 'Nama', 'alamat' => 'Alamat', 'telpon' => 'Telpon', 'ketua' => 'Ketua'];
                                foreach ($fields as $key => $label): ?>
                                    <div class="form-group">
                                        <label><?= $label ?></label>
                                        <input type="text" name="<?= $key ?>" class="form-control" required>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <input type="submit" name="tipe" value="simpan" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Prodi -->
            <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                            <th>Ketua</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('Controllers/Prodi.php');
                        $no = 1;
                        foreach ($prodi->index() as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['kode'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['alamat'] ?></td>
                                <td><?= $row['telpon'] ?></td>
                                <td><?= $row['ketua'] ?></td>
                                <td class="d-flex">
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#edit<?= $row['id'] ?>">Edit</button>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit<?= $row['id'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Data Prodi</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Hidden id_lama -->
                                                        <input type="hidden" name="id_lama" value="<?= $row['id'] ?>">
                                                        <?php foreach ($fields as $key => $label): ?>
                                                            <div class="form-group">
                                                                <label><?= $label ?></label>
                                                                <input type="text" name="<?= $key ?>" value="<?= $row[$key] ?>" class="form-control" required>
                                                            </div>
                                                        <?php endforeach; ?>
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
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                            <th>Ketua</th>
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
                    "kode" => $_POST['kode'] ?? '',
                    "nama" => $_POST['nama'] ?? '',
                    "alamat" => $_POST['alamat'] ?? '',
                    "telpon" => $_POST['telpon'] ?? '',
                    "ketua" => $_POST['ketua'] ?? ''
                ];

                switch ($_POST['tipe']) {
                    case "simpan":
                        $prodi->create($data);
                        echo '<script>alert("Data prodi berhasil ditambahkan"); location.href="?url=prodi";</script>';
                        break;
                    case "edit":
                        $prodi->update($_POST['id_lama'], $data); // gunakan ID lama untuk update
                        echo '<script>alert("Data prodi berhasil diedit"); location.href="?url=prodi";</script>';
                        break;
                    case "delete":
                        $prodi->delete($_POST['id']);
                        echo '<script>alert("Data prodi berhasil dihapus"); location.href="?url=prodi";</script>';
                        break;
                }
            }
            ?>
        </div>
    </div>
</div>
