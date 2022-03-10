<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Image Gallery</title>
    <!-- Derry Lammerding
    Image Gallery with Login and Registration -->
</head>

<body>
    <div class="container mb-5">
        <div class="row mt-5">
            <div class="col-12 text-end">
                <?php
                if (isset($_SESSION['loggedin'])) {
                    echo "<a href='logout.php' type='button' class='btn buttonColor'>Logout</a>";
                } else {
                    echo "<a href='register.php' type='button' class='btn buttonColor me-3'>Register</a>";
                    echo "<a href='login.php' type='button' class='btn buttonColor'>Login</a>";
                }
                echo "<hr class='buttonColor'>";
                ?>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12 col-md-7 col-lg-7 mb-4">
                <h1 class="display-2">Image Gallery</h1>
            </div>

            <?php
            function displayImages($dir)
            {
                if (is_dir($dir)) {
                    $dir_array = scandir($dir);
                    foreach ($dir_array as $file) {
                        // don't display the . and .. directories. Using the strpos() for this.
                        if (strpos($file, '.') > 0) {
                            echo "<div class='col-sm-12 col-md-6 col-lg-4 mt-2'>";
                            echo "<div class='card text-center shadow rounded'>";
                            echo "<a href='uploads/$file'><img src='uploads/{$file}' class='card-img-top' alt='...'></a>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text'><a href='?file=$file' class='btn buttonColor shadow'>Delete</a></p>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                }
            }

            function processSubmittedFile()
            {
                $upload_errors = array(
                    UPLOAD_ERR_OK                 => "No errors.",
                    UPLOAD_ERR_INI_SIZE          => "Larger than upload_max_filesize.",
                    UPLOAD_ERR_FORM_SIZE         => "Larger than form MAX_FILE_SIZE.",
                    UPLOAD_ERR_PARTIAL             => "Partial upload.",
                    UPLOAD_ERR_NO_FILE             => "No file.",
                    UPLOAD_ERR_NO_TMP_DIR         => "No temporary directory.",
                    UPLOAD_ERR_CANT_WRITE         => "Can't write to disk.",
                    UPLOAD_ERR_EXTENSION         => "File upload stopped by extension."
                );

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $tmp_file = $_FILES['file_upload']['tmp_name'];

                    // set target file name
                    // basename gets just the file name
                    $target_file = basename($_FILES['file_upload']['name']);

                    // set upload folder name
                    $upload_dir = 'uploads';

                    // move_uploaded_file returns false if something went wrong
                    if (move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)) {
                        $message = "File uploaded successfully";
                    } else {
                        $error = $_FILES['file_upload']['error'];
                        $message = $upload_errors[$error];
                    }
                    return $message;
                }
            }

            function displayErrorMessage($message)
            {
                if (!empty($message)) {
                    echo "<p>Message about your upload:&nbsp;&nbsp;";
                    echo "{$message}</p>";
                }
            }

            function deleteImage()
            {
                if (isset($_GET["file"])) {
                    unlink("uploads/" . $_GET['file']);
                }
            }

            $message = processSubmittedFile();

            deleteImage();
            ?>

            <?php
            if (!isset($_SESSION['loggedin'])) {
                echo "<p class='display-6 accentColor'>Please Register or Login to continue</p>";
                die();
            } else {
                require 'inc/upload-form.inc.php';
            }
            ?>
        </div>
    </div>
</body>

</html>