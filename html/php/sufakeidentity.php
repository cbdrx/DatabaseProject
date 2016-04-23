<?php
    $user = $_GET["user"];
    session_start();
    $_SESSION["loggedInUser"] = $user;
    header("Location: ../index.php");
?>