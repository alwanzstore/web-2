<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary btn-sm mb-3 w-100" data-toggle="modal" data-target="#tambahDosen">
                Tambah Dosen
            </button>

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="tambahDosen">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Dosen</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <?php
                                $fields = [
                                    "nidn" => "NIDN",
                                    "nama" => "Nama",
                                    "gelar_depan" => "Gelar Depan",
                                    "gelar_belakang" => "Gelar Belakang",
                                    "jenis_kelamin" => "Jenis Kelamin",
                                    "tempat_lahir" => "Tempat Lahir",
                                    "tanggal_lahir" => "Tanggal Lahir",
                                    "alamat" => "Alamat",
                                    "email" => "Email",
                                    "tahun_masuk" => "Tahun Masuk",
                                    "prodi_id" => "Prodi ID"
                                ];

                                foreach ($fields as $key => $label): ?>
                                    <div class="form-group">
                                        <label for="<?= $key ?>"><?= $label ?></label>
                                        <?php if ($key == 'jenis_kelamin'): ?>
                                            <select name="<?= $key ?>" class="form-control" required>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        <?php elseif ($key == 'tanggal_lahir'): ?>
                                            <input type="date" name="<?= $key ?>" class="form-control" required>
                                        <?php else: ?>
                                            <input type="text" name="<?= $key ?>" class="form-control" required>
                                        <?php endif; ?>
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

            <!-- Tabel Dosen -->
            <div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIDN</th>
                <th>Nama</th>
                <th>Gelar Depan</th>
                <th>Gelar Belakang</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Tahun Masuk</th>
                <th>Prodi ID</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once('Controllers/dosen.php');
            $no = 1;
            foreach ($dosen->index() as $d): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nidn'] ?></td>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['gelar_depan'] ?></td>
                    <td><?= $d['gelar_belakang'] ?></td>
                    <td><?= $d['jenis_kelamin'] ?></td>
                    <td><?= $d['tempat_lahir'] ?></td>
                    <td><?= date('d-m-Y', strtotime($d['tanggal_lahir'])) ?></td>
                    <td><?= $d['alamat'] ?></td>
                    <td><?= $d['email'] ?></td>
                    <td><?= $d['tahun_masuk'] ?></td>
                    <td><?= $d['prodi_id'] ?></td>
                    <td class="d-flex">
                        <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#edit<?= $d['id'] ?>">
                            Edit
                        </button>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="edit<?= $d['id'] ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form method="post">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Dosen</h4>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php foreach ($fields as $key => $label): ?>
                                                <div class="form-group">
                                                    <label><?= $label ?></label>
                                                    <?php if ($key == 'jenis_kelamin'): ?>
                                                        <select name="<?= $key ?>" class="form-control" required>
                                                            <option value="Laki-laki" <?= $d[$key] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                                            <option value="Perempuan" <?= $d[$key] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                                        </select>
                                                    <?php elseif ($key == 'tanggal_lahir'): ?>
                                                        <input type="date" name="<?= $key ?>" value="<?= $d[$key] ?>" class="form-control" required>
                                                    <?php else: ?>
                                                        <input type="text" name="<?= $key ?>" value="<?= $d[$key] ?>" class="form-control" required>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <input type="hidden" name="id" value="<?= $d['id'] ?>">
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
                            <input type="hidden" name="id" value="<?= $d['id'] ?>">
                            <input type="submit" name="tipe" value="delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>NIDN</th>
                <th>Nama</th>
                <th>Gelar Depan</th>
                <th>Gelar Belakang</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Tahun Masuk</th>
                <th>Prodi ID</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
</div>


<!-- Proses Tambah/Edit/Delete -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipe'])) {
    $data = [
        "nidn" => $_POST['nidn'] ?? '',
        "nama" => $_POST['nama'] ?? '',
        "gelar_depan" => $_POST['gelar_depan'] ?? '',
        "gelar_belakang" => $_POST['gelar_belakang'] ?? '',
        "jenis_kelamin" => $_POST['jenis_kelamin'] ?? '',
        "tempat_lahir" => $_POST['tempat_lahir'] ?? '',
        "tanggal_lahir" => $_POST['tanggal_lahir'] ?? '',
        "alamat" => $_POST['alamat'] ?? '',
        "email" => $_POST['email'] ?? '',
        "tahun_masuk" => $_POST['tahun_masuk'] ?? '',
        "prodi_id" => $_POST['prodi_id'] ?? '',
    ];

    switch ($_POST['tipe']) {
        case "simpan":
            $dosen->create($data);
            echo '<script>alert("Data dosen berhasil ditambahkan"); location.href="?url=dosen";</script>';
            break;
        case "edit":
            $dosen->update($_POST['id'], $data);
            echo '<script>alert("Data dosen berhasil diedit"); location.href="?url=dosen";</script>';
            break;
        case "delete":
            $dosen->delete($_POST['id']);
            echo '<script>alert("Data dosen berhasil dihapus"); location.href="?url=dosen";</script>';
            break;
    }
}
?>
