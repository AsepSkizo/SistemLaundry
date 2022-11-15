<?php session_start();
if (!isset($_SESSION['loginkasir'])) {
    header("location: ../login.php");
    exit;
}




include "../db.php";
include "../filelog.php";
$querryPaket = "SELECT * FROM tb_paket";
$execPaket = mysqli_query($conn, $querryPaket);
$dataPaket = mysqli_fetch_all($execPaket, MYSQLI_ASSOC);

$jumlahDataPerHalaman = 5;
$jumlahData = mysqli_num_rows($execPaket);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['p'])) ? $_GET['p'] : 1;
$dataAwal = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$queryUser = "SELECT * FROM tb_user LIMIT $dataAwal, $jumlahDataPerHalaman";
$execPaket  = mysqli_query($conn, $queryUser);
$dataUser = mysqli_fetch_all($execPaket, MYSQLI_ASSOC);


if (isset($_POST['tambah'])) {

    $jenis = htmlspecialchars($_POST['jenis']);
    $nama = htmlspecialchars($_POST['nama']);
    $harga = htmlspecialchars($_POST['harga']);
    $querryTambah = "INSERT INTO `tb_paket` (`id`, `jenis`, `nama_paket`, `harga`) VALUES (NULL, '$jenis', '$nama', $harga);";
    $execTambah = mysqli_query($conn, $querryTambah);
    if ($execTambah) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menambah paket dengan nama paket $nama dan dengan jenis $jenis pada daftar paket";
        logger($log, "../../../");
        header("location: paket_laundry.php");
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $jenis = htmlspecialchars($_POST['jenis']);
    $nama = htmlspecialchars($_POST['nama']);
    $harga = htmlspecialchars($_POST['harga']);
    $querryEdit = "UPDATE `tb_paket` SET `jenis` = '$jenis', `nama_paket` = '$nama', `harga` = '$harga' WHERE `tb_paket`.`id` = $id";
    $execEdit = mysqli_query($conn, $querryEdit);
    if ($execEdit) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah mengubah paket dengan id paket ($id) pada daftar paket";
        logger($log, "../../../");
        header("location: paket_laundry.php");
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $querryDelete = "DELETE FROM tb_paket WHERE id = $id";
    $execDelete = mysqli_query($conn, $querryDelete);
    if ($execDelete) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menghapus paket dengan id paket ($id) pada daftar paket";
        logger($log, "../../../");
        header("location: paket_laundry.php");
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Laundry</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
</head>

<body>

    <div class="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Paket Laundry</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Tambah Pelanggan -->
                        <div class="card-header pb-4">
                            <h4 class="mb-3">Tambah Paket</h4>
                            <?php include "modal_tambah_paket.php"; ?>
                            <hr>

                        </div>
                        <!-- Akhir Tambah Pelanggan -->
                        <!-- Daftar Pelanggan -->
                        <div class="card-body">
                            <h5>Daftar Paket</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <th>No</th>
                                        <th>Id Paket</th>
                                        <th>Jenis Paket</th>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $i = 0; ?>
                                    <?php foreach ($dataPaket as $paket) : ?>
                                        <?php $i++; ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $paket['id']; ?></td>
                                            <td><?= $paket['jenis']; ?></td>
                                            <td><?= $paket['nama_paket']; ?></td>
                                            <td><?= $paket['harga']; ?></td>
                                            <td>
                                                <?php include "modal_edit_paket.php";
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