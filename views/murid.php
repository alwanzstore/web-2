<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary btn-sm mb-3 w-100" data-toggle="modal" data-target="#tambahData">
                Tambah
            </button>

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="tambahData">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('Controllers/Student.php');
                        $no = 1;
                        foreach ($murid->index() as $item):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td><?= date('d F Y', strtotime($item['created_at'])); ?></td>
                            <td class="d-flex">
                                <!-- Tombol Edit -->
                                <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#edit<?= $item['id'] ?>">
                                    Edit
                                </button>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="edit<?= $item['id'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Nama</label>
                                                        <input type="text" name="name" value="<?= $item['name'] ?>" class="form-control" required>
                                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" value="<?= $item['email'] ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <input type="submit" name="tipe" value="edit" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Delete -->
                                <form method="post">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="submit" value="delete" name="tipe" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <?php
                        // Proses Tambah / Edit / Delete
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipe'])) {
                            if ($_POST['tipe'] === "delete") {
                                $murid->delete($_POST['id']);
                                echo '<script>alert("Data berhasil dihapus"); window.location.href="?url=murid";</script>';
                            } elseif ($_POST['tipe'] === "edit") {
                                $data = [
                                    "name" => $_POST['name'],
                                    "email" => $_POST['email'],
                                ];
                                $murid->update($_POST['id'], $data);
                                echo '<script>alert("Data berhasil diedit"); window.location.href="?url=murid";</script>';
                            } elseif ($_POST['tipe'] === "simpan") {
                                $email = $_POST['email'];

                                if ($murid->emailExists($email)) {
                                    echo '<script>alert("Email sudah digunakan! Silakan gunakan email lain."); window.location.href="?url=murid";</script>';
                                } else {
                                    $data = [
                                        "name" => $_POST['name'],
                                        "email" => $email,
                                        "created_at" => date("Y-m-d H:i:s")
                                    ];
                                    $murid->create($data);
                                    echo '<script>alert("Data berhasil ditambahkan"); window.location.href="?url=murid";</script>';
                                }
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
