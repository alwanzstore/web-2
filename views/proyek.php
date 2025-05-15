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
                                <?php 
                                $fields = [
                                    "name" => "Nama",
                                    "description" => "Description",
                                    "start_date" => "Start Date",
                                    "end_date" => "End Date"
                                ];
                                foreach ($fields as $key => $label): ?>
                                    <div class="form-group">
                                        <label for="<?= $key ?>"><?= $label ?></label>
                                        <input type="<?= ($key === 'start_date' || $key === 'end_date') ? 'date' : 'text' ?>" name="<?= $key ?>" class="form-control" required>
                                    </div>
                                <?php endforeach; ?>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="ongoing">ongoing</option>
                                        <option value="completed">completed</option>
                                        <option value="pending">pending</option>
                                    </select>
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

             
            <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('Controllers/project.php');
                        $no = 1;
                        foreach ($project->index() as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= date('d F Y', strtotime($item['start_date'])) ?></td>
                                <td><?= date('d F Y', strtotime($item['end_date'])) ?></td>
                                <td><?= $item['status'] ?></td>
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
                                                        <?php foreach ($fields as $key => $label): ?>
                                                            <div class="form-group">
                                                                <label for="<?= $key ?>"><?= $label ?></label>
                                                                <input type="<?= ($key === 'start_date' || $key === 'end_date') ? 'date' : 'text' ?>" name="<?= $key ?>" value="<?= $item[$key] ?>" class="form-control" required>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select name="status" class="form-control" required>
                                                                <option value="ongoing" <?= $item['status'] == "ongoing" ? "selected" : "" ?>>ongoing</option>
                                                                <option value="completed" <?= $item['status'] == "completed" ? "selected" : "" ?>>completed</option>
                                                                <option value="pending" <?= $item['status'] == "pending" ? "selected" : "" ?>>pending</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
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
                                        <input type="submit" name="tipe" value="delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>




 <?php
                        // Proses Tambah / Edit / Delete
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipe'])) {
                            $data = [
                                "name" => $_POST['name'] ?? '',
                                "description" => $_POST['description'] ?? '',
                                "start_date" => $_POST['start_date'] ?? '',
                                "end_date" => $_POST['end_date'] ?? '',
                                "status" => $_POST['status'] ?? '',
                                "created_at" => date("Y-m-d H:i:s")
                            ];

                            switch ($_POST['tipe']) {
                                case "delete":
                                    $project->delete($_POST['id']);
                                    echo '<script>alert("Data berhasil dihapus"); window.location.href="?url=proyek";</script>';
                                    break;
                                case "edit":
                                    $project->update($_POST['id'], $data);
                                    echo '<script>alert("Data berhasil diedit"); window.location.href="?url=proyek";</script>';
                                    break;
                                case "simpan":
                                    $project->create($data);
                                    echo '<script>alert("Data berhasil ditambahkan"); window.location.href="?url=proyek";</script>';
                                    break;
                            }
                        }
                        ?>


