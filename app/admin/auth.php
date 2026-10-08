<?php

/* =========================================================
   LOGOUT
========================================================= */

if (isset($_GET['logout'])) {

    unset($_SESSION['arka_admin']);

    header("Location: Admin.php");

    exit();
}


/* =========================================================
   LOGIN
========================================================= */

if (isset($_POST['admin_login'])) {

    $password = $_POST['password'] ?? "";

    if (hash_equals((string)$ADMIN_PASSWORD, (string)$password)) {

        session_regenerate_id(true);

        $_SESSION['arka_admin'] = true;

        header("Location: Admin.php");

        exit();

    } else {

        $login_error = "كلمة المرور غير صحيحة";

    }
}


/* =========================================================
   CHECK LOGIN
========================================================= */

$is_admin =
    isset($_SESSION['arka_admin']) &&
    $_SESSION['arka_admin'] === true;
