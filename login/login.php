<?php
session_start();
require("../functions.php");

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result =  mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION['user'] = [
                'id' => $row['id'],
                'username' => $row['username'],
                'email' => $row['email']
            ];
            header("Location: ../homepage.php");
            exit;
        }
    }

    $error = true;
}


if (isset($_POST["register"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!preg_match('/@gmail\.com$/', $email)) {
        $_SESSION['register_error'] = "Email harus menggunakan domain @gmail.com";
        header("Location: login.php");
        exit;
    }

    if (strlen($password) < 8) {
        $_SESSION['register_error'] = "Password harus terdiri dari minimal 8 karakter";
        header("Location: login.php");
        exit;
    }

    if (registrasi($_POST) > 0) {
        $_SESSION['register_success'] = true;
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['register_error'] = "Username sudah terdaftar!";
        header("Location: login.php");
        exit;
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="../images/logo1.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk & Daftar</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">WELCOME BACK</span>

                <form action="" method="post">
                    <div class="input-field">
                        <input type="text" name="username" id="username" placeholder="Username" required>
                        <i class='bx bxs-user icon'></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" id="password" class="password" placeholder="Password" required>
                        <i class='bx bxs-lock icon'></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <!-- <div class="checkbox-text">
                        <a href="#" class="text">Forgot password?</a>
                    </div> -->

                    <div class="input-field button">
                        <input type="submit" name="login" value="Masuk">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Belum Memiliki Akun?
                        <a href="#" class="text signup-link">Daftar Sekarang</a>
                    </span>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form signup">
                <span class="title">GET STARTED</span>

                <form action="" method="post">
                    <div class="input-field">
                        <input type="text" name="username" id="username" placeholder="Username" required>
                        <i class='bx bxs-user icon'></i>
                    </div>
                    <div class="input-field">
                        <input type="text" name="email" id="email" placeholder="Email" required>
                        <i class='bx bxs-envelope icon'></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" id="password" class="password" placeholder="Password" required>
                        <i class='bx bxs-lock icon'></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>


                    <div class="input-field button">
                        <input type="submit" name="register" value="Daftar">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Sudah Memiliki Akun?
                        <a href="#" class="text login-link">Masuk</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('.form.signup form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

            if (!emailPattern.test(email)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Email Tidak Valid!',
                    text: 'Email harus menggunakan domain @gmail.com',
                    customClass: {
                    popup: 'my-swal-popup',
                    confirmButton: 'my-swal-button'
                },
                buttonStyling: false
                });
                return;
            }

            if (password.length < 8) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Password Terlalu Pendek!',
                    text: 'Password harus terdiri dari minimal 8 karakter',
                    customClass: {
                    popup: 'my-swal-popup',
                    confirmButton: 'my-swal-button'
                },
                buttonStyling: false
                })
            }
        })
        const container = document.querySelector(".container"),
            pwShowHide = document.querySelectorAll(".showHidePw"),
            pwFields = document.querySelectorAll(".password"),
            signUp = document.querySelector(".signup-link"),
            login = document.querySelector(".login-link");

        //   js code to show/hide password and change icon
        pwShowHide.forEach(eyeIcon => {
            eyeIcon.addEventListener("click", () => {
                pwFields.forEach(pwField => {
                    if (pwField.type === "password") {
                        pwField.type = "text";

                        pwShowHide.forEach(icon => {
                            icon.classList.replace("uil-eye-slash", "uil-eye");
                        })
                    } else {
                        pwField.type = "password";

                        pwShowHide.forEach(icon => {
                            icon.classList.replace("uil-eye", "uil-eye-slash");
                        })
                    }
                })
            })
        })

        // js code to appear signup and login form
        signUp.addEventListener("click", () => {
            container.classList.add("active");
        });
        login.addEventListener("click", () => {
            container.classList.remove("active");
        });

        <?php if (isset($_SESSION['register_success'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil!',
                text: 'Silakan login untuk melanjutkan.',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'my-swal-popup',
                    confirmButton: 'my-swal-button'
                },
                buttonStyling: false
            });
        <?php unset($_SESSION['register_success']);
        endif; ?>

        <?php if (isset($_SESSION['register_error'])): ?>
            Swal.fire({
                icon: 'error',
                title: 'Pendaftaran Gagal!',
                text: '<?= $_SESSION['register_error'] ?>',
                confirmButtonText: 'Coba Lagi',
                customClass: {
                    popup: 'my-swal-popup',
                    confirmButton: 'my-swal-button'
                },
                buttonStyling: false
            });
        <?php unset($_SESSION['register_error']);
        endif; ?>
        <?php if (isset($error)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: 'Username atau password salah.',
                confirmButtonText: 'Coba Lagi',
                customClass: {
                    popup: 'my-swal-popup',
                    confirmButton: 'my-swal-button'
                },
                buttonStyling: false
            });
        <?php endif; ?>
    </script>

</body>

</html>