<div class="col-sm-12 col-md-5 col-lg-5 mt-sm-4 mt-md-2">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000000">
        <label for="file_upload" class="form-label">UPLOAD AN IMAGE HERE</label>
        <input class="form-control" type="file" name="file_upload" id="file_upload" accept=".png,.jpg">
        <input class="btn buttonColor mt-2 shadow fw-bold" type="submit" name="submit" value="Upload">
    </form>

    <?php
    echo "<div class='row mt-2'>";
    echo "<div class='col-12'>";
    displayErrorMessage($message);
    echo "</div>";
    echo "</div>";
    ?>
</div>

<div class="row mt-5">
    <div class="col-12">
        <h2 class="display-6 accentColor"><?= isset($_SESSION['first_name']) ? $_SESSION['first_name'] . "'s" : 'Your' ?> Uploaded Images</h2>
    </div>
</div>

<div class="row mt-4">
    <?php displayImages('uploads') ?>
</div>