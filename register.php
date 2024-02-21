<?php
@ob_start();
session_start();

// Check if the user is an admin
if (isset($_SESSION['admin']) && $_SESSION['admin']['status'] == 1) {
    if (isset($_POST['register'])) {
        require 'config.php';

        $nm_member = strip_tags($_POST['nm_member']);
        $alamat_member = strip_tags($_POST['alamat_member']);
        $telepon = strip_tags($_POST['telepon']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : null;
        $NIK = strip_tags($_POST['NIK']);
        $status = in_array($_POST['status'], [1, 2]) ? $_POST['status'] : null;
        $user = strip_tags($_POST['user']);
        $pass = strip_tags($_POST['pass']);

        if (!$nm_member || !$alamat_member || !$telepon || !$email || !$NIK || !$status || !$user || !$pass) {
            echo '<script>alert("Invalid input. Please fill in all fields.");window.location="index.php"</script>';
            exit();
        }

        // Use MD5 for password hashing (not recommended for security)
        $hashedPassword = md5($pass);

        // Insert user data into the login table
        $insertLoginSql = 'INSERT INTO member (nm_member, alamat_member, telepon, email, NIK, status, user, pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $insertLoginStmt = $config->prepare($insertLoginSql);
        $insertLoginStmt->execute([$nm_member, $alamat_member, $telepon, $email, $NIK, $status, $user, $hashedPassword]);

        echo '<script>alert("Registration successful. You can now login.");window.location="index.php"</script>';
    }
} else {
    // If not an admin, show an alert and redirect
    echo '<script>alert("Only Admins can access this!");history.go(-1);</script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login - POS Codekop</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: url(assets/img/bg.jpg);
            /* Corrected direct image URL */
            animation: gradientMotion 10s infinite alternate-reverse;
        }


        @keyframes gradientMotion {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        .container {
            max-width: 700px;
            width: 100%;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(100px);
            animation: fadeIn 1.5s ease;
            background: transparent;
            border: solid 1px #fff;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .container .title {
            font-size: 25px;
            font-weight: 500;
            position: relative;
        }

        .container .title::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 30px;
            border-radius: 5px;
            background: white;
        }

        .content form .user-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px 0 12px 0;
        }

        form .user-details .input-box {
            margin-bottom: 15px;
            width: calc(100% / 2 - 20px);
        }

        form .input-box span.details {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .user-details .input-box input,
        .user-details .input-box select {
            height: 45px;
            width: 100%;
            outline: none;
            font-size: 16px;
            border-radius: 5px;
            padding-left: 15px;
            border: 1px solid #ccc;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
        }

        .user-details .input-box input:focus,
        .user-details .input-box input:valid,
        .user-details .input-box select:focus {
            border-color: #fff;
        }

        form .gender-details .gender-title {
            font-size: 20px;
            font-weight: 500;
        }

        form .category {
            display: flex;
            width: 80%;
            margin: 14px 0;
            justify-content: space-between;
        }

        form .category label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        form .category label .dot {
            height: 18px;
            width: 18px;
            border-radius: 50%;
            margin-right: 10px;
            background: #d9d9d9;
            border: 5px solid transparent;
            transition: all 0.3s ease;
        }

        form input[type="radio"] {
            display: none;
        }

        button {
            padding-left: 20px;
            padding-right: 20px;
            height: 45px;
            margin: 35px 0;
            animation: buttonMotion 2s infinite alternate;
            border: none;
            border-radius: 50px;
        }

        button:hover {
            background: linear-gradient(151deg, rgba(2, 0, 36, 1) 0%, rgba(40, 216, 233, 1) 0%, rgba(9, 105, 121, 1) 100%);
            color: white;
            animation: .5s;
        }

        form .button input {
            height: 100%;
            width: 100%;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: inherit;
        }

        form .button input:hover {
            /* transform: scale(0.99); */
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
        }

        @media(max-width: 584px) {
            .container {
                max-width: 100%;
            }

            form .user-details .input-box {
                margin-bottom: 15px;
                width: 100%;
            }

            form .category {
                width: 100%;
            }

            .content form .user-details {
                max-height: 300px;
                overflow-y: scroll;
            }

            .user-details::-webkit-scrollbar {
                width: 5px;
            }
        }

        .user-details .input-box select:focus {
            border-color: #9b59b6;
        }

        @media(max-width: 459px) {
            .container .content .category {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="color: white;" class="title">Registration</div>
        <div class="content">
            <form class="form-register" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details" style="color: white;">Nama Lengkap</span>
                        <input type="text" name="nm_member" placeholder="Masukan Nama" required>
                    </div>
                    <div class="input-box">
                        <span style="color: white;" class="details">Alamat</span>
                        <input type="text" name="alamat_member" placeholder="Masukan Alamat" required>
                    </div>
                    <div class="input-box">
                        <span style="color: white;" class="details">Telepon</span>
                        <input type="text" name="telepon" placeholder="Nomer Telepon" required>
                    </div>
                    <div class="input-box">
                        <span style="color: white;" class="details">Email</span>
                        <input type="email" name="email" placeholder="Masukan Email" required>
                    </div>

                    <div class="input-box">
                        <span style="color: white;" class="details">Nik</span>
                        <input type="text" name="NIK" placeholder="Masukan NIK" required>
                    </div>

                    <div class="input-box">
                        <span style="color: white;" class="details">Level:</span>
                        <div class="select-container">
                            <select name="status" required>
                                <option value="1">Admin</option>
                                <option value="2">Petugas</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-box">
                        <span style="color: white;" class="details">Username</span>
                        <input type="text" name="user" placeholder="Masukan Username" required>
                    </div>

                    <div class="input-box">
                        <span style="color: white;" class="details">Password</span>
                        <input type="password" name="pass" placeholder="Masukan Password" required>
                    </div>

                </div>
                <div class="button">
                    <button name="register" type="submit"><i class="fa fa-user-plus"></i>
                        REGISTER</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>