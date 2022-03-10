<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>

<body>
    <?php
    require 'inc/db_connect.inc.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = hash('sha512', $_POST['password']);

        $sql = "INSERT INTO user (email,first_name,last_name,password) ";
        $sql .= "VALUES (:email,:first_name,:last_name,:password)";

        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(["email" => $email, "first_name" => $first_name, "last_name" => $last_name, "password" => $password]);
            echo "<div class='container mb-5'>";
            echo "<div class='row mt-5'>";
            echo "<div class='col-sm-12'>";
            echo "<p class='display-6 accentColor'>Thank you for registering! Please login to continue.</p>";
            echo "<a href='login.php' type='button' class='btn buttonColor'>Login</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } catch (Exception $e) {
            echo '<div class="container mt-5"';
            echo '<div class="row mt-5">';
            echo '<p class="text-danger display-6">An error occurred and we could not register your account. The most likely reason is the email address you entered already exists. Please try again.</p>';
            echo '</div>';
            echo '</div>';
            //echo 'Caught Exception: ', $e->getMessage(), "\n";
        }

        // This was the original code to make sure there wasn't an issue creating the user
        // It produced a fatal error message that it was not able to catch with the if statement, so it was changed to a try/catch. 
        // I am leaving this code for future reference to see if I can get it working.

        // $stmt = $db->prepare($sql);
        // $stmt->execute(["email" => $email, "first_name" => $first_name, "last_name" => $last_name, "password" => $password]);

        // if ($stmt->rowCount() == 0) {
        //     echo '<div>There was a problem registering your account</div>';
        // } else {
        //     echo "<div class='container mb-5'>";
        //     echo "<div class='row mt-5'>";
        //     echo "<div class='col-sm-12'>";
        //     echo "<p class='display-6 accentColor'>Thank you for registering! Please login to continue.</p>";
        //     echo "<a href='login.php' type='button' class='btn buttonColor'>Login</a>";
        //     echo "</div>";
        //     echo "</div>";
        //     echo "</div>";
        // }
    }
    ?>

    <div class="container mb-5">
        <div class="row mt-5">
            <div class="col-sm-12">
                <h1 class="display-2 mb-3">Image Gallery</h1>
                <hr class="buttonColor">
                <p class="display-6 accentColor">Please register to continue</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12 col-md-9 col-lg-6">
                <form action="register.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <button type="submit" class="btn buttonColor">Register</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <p>Or if you are already registered, please login by clicking the link below.</p>
                <a href='login.php' type='button' class='btn buttonColor'>Login</a>
            </div>
        </div>
    </div>
</body>

</html>