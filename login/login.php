<?php

require("../functions.php");
session_start();

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
            header("Location: ../dashboard/dashboard.php");
            exit;
        }
    }

    $error = true;
}

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "
            <script>
            alert('User berhasil ditambahkan!');
            </script>
        ";
    } else {
        echo mysqli_error($conn);
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
                <?php if (isset($error)) : ?>
                    <p style="color:red; font-style: italic;"> username / password salah </p>
                <?php endif; ?>

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

                    <div class="checkbox-text">
                        <a href="#" class="text">Forgot password?</a>
                    </div>

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

    <script>
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
    </script>

</body>

</html>