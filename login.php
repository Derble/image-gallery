<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
    <!-- Derry Lammerding
    Image Gallery with Login and Registration -->
</head>

<body>
    <?php
    require 'inc/db_connect.inc.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = hash('sha512', $_POST['password']);

        $sql = "SELECT * FROM user WHERE email=:email AND password=:password LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute(["email" => $email, "password" => $password]);

        if ($stmt->rowCount() == 1) {
            $_SESSION['loggedin'] = 1;
            $_SESSION['email'] = $email;
            $row = $stmt->fetch();
            $_SESSION['first_name'] = $row->first_name;
            $_SESSION['last_name'] = $row->last_name;
            header('location: image-gallery.php');
        } else {
            echo '<div class="container mt-5"';
            echo '<div class="row mt-5">';
            echo '<p class="text-danger display-6">An error occurred. Either the email address is not registered or the password does not match what we have on record. Please try again.</p>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
    <div class="container mb-5">
        <div class="row mt-5">
            <div class="col-sm-12">
                <h1 class="display-2 mb-3">Image Gallery</h1>
                <hr class="buttonColor">
                <p class="display-6 accentColor">Please login to continue</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label><br>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label><br>
                        <input type="password" class="form-control" name="password" id="password" required>
                        <span id="showPassword" onclick="showPassword()">Show Password</span>
                    </div>
                    <div class="mb-5">
                        <button type="submit" class="btn buttonColor">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <p>Or if you are not currently registered, please register by clicking the link below.</p>
                <a href='register.php' type='button' class='btn buttonColor'>Register</a>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>