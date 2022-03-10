<?php
    //get info from session
    session_start();
    //destroy session
    session_destroy();
    //redirect user
    header('Location: image-gallery.php');
