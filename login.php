<?php session_start();
if (isset($_SESSION['loginadmin'])) {
    header("location: admin/admin.php");
    exit;
}
if (isset($_SESSION['loginkasir'])) {
    header("location: kasir/kasir.php");
    exit;
}
include "db.php";
include "filelog.php";
$queryUser = "SELECT * FROM tb_user";
$execUser = mysqli_query($conn, $queryUser);
$dataUser = mysqli_fetch_all($execUser, MYSQLI_ASSOC);
// var_dump($dataUser);
if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);


    $queryCekUser = "SELECT * FROM tb_user WHERE username = '$username'";
    $execCekUser = mysqli_query($conn, $queryCekUser);
    // Cek apakah ada username yang sama
    if (mysqli_num_rows($execCekUser) === 1) {

        $resultUser = mysqli_fetch_assoc($execCekUser);
        if ($password == $resultUser['password'] && $resultUser['role'] == "Admin") {
            $log = $resultUser['nama'] . " (" . $resultUser['role'] . ") " . "Melakukan Login";
            logger($log, "../../");
            $_SESSION['id'] = $resultUser['id'];
            $_SESSION['role'] = $resultUser['role'];
            $_SESSION['nama'] = $resultUser['nama'];
            $_SESSION['loginadmin'] = true;
            header("location: admin/admin.php");
            exit;
        }
        if ($password == $resultUser['password'] && $resultUser['role'] == 'Kasir') {
            $log = $resultUser['nama'] . " (" . $resultUser['role'] . ") " . "Melakukan Login";
            logger($log, "../../");
            $_SESSION['id'] = $resultUser['id'];
            $_SESSION['role'] = $resultUser['role'];
            $_SESSION['nama'] = $resultUser['nama'];
            $_SESSION['loginkasir'] = true;
            header("location: kasir/kasir.php");
            exit;
        }
    }
    // if (mysqli_num_rows($execCekUser) === 1) {
    //     $resultUser = mysqli_fetch_assoc($execCekUser);
    // }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <img src="Skio_Logo.jpg" alt="Logo">
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger" role="alert">Login gagal! username atau password tidak sesuai!</div>
                    <?php endif ?>
                    <form action="" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="username" name="username" autocomplete="off" autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="password" name="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <!-- <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div> -->
                        <button type="sub" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="login">Log in</button>
                    </form>
                    <!-- <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="auth-register.html" class="font-bold">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>