<?php session_start();
if (!isset($_SESSION['loginadmin'])) {
    header("location: ../login.php");
    exit;
}


include "../db.php";
include "../filelog.php";

$page = "datakasir";

$queryUser = "SELECT * FROM tb_user";
$execUser  = mysqli_query($conn, $queryUser);


$jumlahDataPerHalaman = 5;
$jumlahData = mysqli_num_rows($execUser);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['p'])) ? $_GET['p'] : 1;
$dataAwal = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$queryUser = "SELECT * FROM tb_user LIMIT $dataAwal, $jumlahDataPerHalaman";
$execUser  = mysqli_query($conn, $queryUser);
$dataUser = mysqli_fetch_all($execUser, MYSQLI_ASSOC);

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $queryTambah = "INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `role`) VALUES (NULL, '$nama', '$username', '$password', '$role');";
    $execTambah = mysqli_query($conn, $queryTambah);
    if ($execTambah) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menambahkan user $nama pada daftar anggota";
        // var_dump($log);
        logger($log, "../../../");
        header("location: data_kasir.php");
    }
}
// Besok lanjut fungsi log edit data kasir!!!!!!!!!!
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['editnama'];
    $username = $_POST['editusername'];
    $password = $_POST['editpassword'];
    $role = $_POST['editrole'];
    $queryEdit = "UPDATE tb_user SET nama = '$nama', username = '$username', password = '$password', role = '$role' WHERE id = $id";
    $execEdit = mysqli_query($conn, $queryEdit);
    if ($execEdit) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah mengubah user dengan id ($id) pada daftar anggota";
        logger($log, "../../../");
        header("location: data_kasir.php");
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['idhapus'];
    $querryDelete = "DELETE FROM tb_user WHERE id = $id";
    $execDelete = mysqli_query($conn, $querryDelete);
    if ($execDelete) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menghapus user dengan id ($id) pada daftar anggota";
        logger($log, "../../../");
        header("location: data_kasir.php");
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
</head>

<body class="theme-dark" style="overflow-y: hidden;">
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Data Anggota</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Tambah Anggota -->
                        <div class="card-header pb-4">
                            <h4 class="mb-3">Tambah Anggota</h4>
                            <?php include "modal_tambah.php"; ?>
                            <hr>
                        </div>
                        <!-- Akhir Tambah Anggota -->
                        <!-- Daftar Anggota -->
                        <div class="card-body">
                            <h5>Daftar Anggota</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <th>No</th>
                                        <th>Id Anggota</th>
                                        <th>Nama</th>
                                        <th>Username </th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $i = 0; ?>
                                    <?php foreach ($dataUser as $user) : ?>
                                        <?php $i++; ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $user['id']; ?></td>
                                            <td><?= $user['nama']; ?></td>
                                            <td><?= $user['username']; ?></td>
                                            <td><?= $user['password']; ?></td>
                                            <td><?= $user['role']; ?></td>
                                            <td>
                                                <?php include "modal_edit.php"; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </table>
                                <div class="dataTable-bottom mt-3">
                                    <nav class="dataTable-pagination">
                                        <ul class="dataTable-pagination-list pagination pagination-primary">
                                            <?php if ($halamanAktif > 1) : ?>
                                                <li class="pager page-item">
                                                    <a href="?p=<?= $halamanAktif - 1 ?>" data-page="1" class="page-link">‹</a>
                                                </li>
                                            <?php endif ?>
                                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                <li class="active page-item">
                                                    <a href="?p=<?= $i; ?>" data-page="1" class="page-link"><?= $i ?></a>
                                                </li>
                                            <?php endfor ?>
                                            <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                                <li class="pager page-item">
                                                    <a href="?p=<?= $halamanAktif + 1 ?>" data-page="2" class="page-link">›</a>
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Daftar Anggotaa -->
                    </div>
                </div>
            </div>

        </div>
    </div>




    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>