<?php session_start();
if (!isset($_SESSION['loginkasir'])) {
    header("location: ../login.php");
    exit;
}

$page = "data_pelanggan";

include "../db.php";
include "../filelog.php";
$queryUser = "SELECT * FROM tb_pelanggan ORDER BY id DESC";
$execUser  = mysqli_query($conn, $queryUser);
$dataUser = mysqli_fetch_all($execUser, MYSQLI_ASSOC);

$jumlahDataPerhalaman = 5;
$jumlahData = mysqli_num_rows($execUser);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
// Cek sedang ada dihalaman berapa
$halamanAktif = (isset($_GET['p'])) ? $_GET['p'] : 1;
$dataAwal = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$queryUser = "SELECT * FROM tb_pelanggan ORDER BY id DESC LIMIT $dataAwal, $jumlahDataPerhalaman";
$execUser  = mysqli_query($conn, $queryUser);
$dataUser = mysqli_fetch_all($execUser, MYSQLI_ASSOC);





if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenkel = $_POST['jenkel'];
    $tlp = $_POST['telp'];
    $queryTambah = "INSERT INTO `tb_pelanggan` (`id`, `nama`, `alamat`, `jenis_kelamin`, `tlp`) VALUES (NULL, '$nama', '$alamat', '$jenkel', '$tlp');";
    $execTambah = mysqli_query($conn, $queryTambah);
    if ($execTambah) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menambah pelanggan dengan nama $nama pada daftar pelanggan";
        logger($log, "../../../");
        header("location: data_pelanggan.php");
    }
}
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['editnama'];
    $alamat = $_POST['editalamat'];
    $tlp = $_POST['edittlp'];
    $jenkel = $_POST['editjenkel'];
    $queryEdit = "UPDATE tb_pelanggan SET nama = '$nama', alamat = '$alamat', tlp = '$tlp', jenis_kelamin = '$jenkel' WHERE id = $id";
    $execEdit = mysqli_query($conn, $queryEdit);
    if ($execEdit) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah mengubah pelanggan dengan id ($id) pada daftar pelanggan";
        logger($log, "../../../");
        header("location: data_pelanggan.php");
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['idhapus'];
    $queryPilih = "SELECT * FROM tb_transaksi WHERE id_pelanggan = $id";
    $execPilih = mysqli_query($conn, $queryPilih);
    $dataPilih = mysqli_fetch_all($execPilih, MYSQLI_ASSOC);
    $idTransaksi = [];
    foreach ($dataPilih as $pilih) {
        $idTransaksi[] += $pilih['id'];
    }
    foreach ($idTransaksi as $hapus) {
        $idTrans = $hapus;
        $queryHapusDetail = "DELETE FROM tb_detail_transaksi WHERE id_transaksi = $idTrans";
        $execHapusDetail = mysqli_query($conn, $queryHapusDetail);
    }
    $queryHapusTransaksi = "DELETE FROM tb_transaksi WHERE id_pelanggan = $id";
    $execHapusTransaksi = mysqli_query($conn, $queryHapusTransaksi);
    if ($execHapusDetail && $execHapusTransaksi) {
        $querryDelete = "DELETE FROM tb_pelanggan WHERE id = $id";
        $execDelete = mysqli_query($conn, $querryDelete);
        if ($execDelete) {
            $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menghapus pelanggan dengan id ($id) pada daftar pelanggan";
            logger($log, "../../../");
            header("location: data_pelanggan.php");
        }
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
    <style>
        header {
            margin-left: 20px;
        }
    </style>
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
                <h3>Data Pelanggan</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Tambah Pelanggan -->
                        <div class="card-header pb-4">
                            <h4 class="mb-3">Tambah Pelanggan</h4>
                            <?php include "modal_tambah_pelanggan.php"; ?>
                            <hr>
                        </div>
                        <!-- Akhir Tambah Pelanggan -->
                        <!-- Daftar Pelanggan -->
                        <div class="card-body">
                            <h5>Daftar Pelanggan</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <th>No</th>
                                        <th>Id Pelanggan</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $i = 0; ?>
                                    <?php foreach ($dataUser as $user) : ?>
                                        <?php $i++; ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $user['id']; ?></td>
                                            <td><?= $user['nama']; ?></td>
                                            <td><?= $user['alamat']; ?></td>
                                            <td><?= $user['jenis_kelamin']; ?></td>
                                            <td><?= $user['tlp']; ?></td>
                                            <td>
                                                <?php include "modal_edit_pelanggan.php";
                                                ?>
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