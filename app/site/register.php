<?php

/* =========================================================
   REGISTER
========================================================= */

if (isset($_POST['register'])) {

    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {

        alert_redirect(t('alert_reg_invalid'));
    }

    /* البريد أو الاسم مستخدم قبل كده */

    $stmt = mysqli_prepare(
        $conn,
        "SELECT id FROM users2 WHERE email = ? OR name = ? LIMIT 1"
    );
    mysqli_stmt_bind_param($stmt, "ss", $email, $name);
    mysqli_stmt_execute($stmt);

    if (mysqli_num_rows(mysqli_stmt_get_result($stmt)) > 0) {

        alert_redirect(t('alert_reg_exists'));
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO users2 (name, email, password, subscribed_courses)
         VALUES (?, ?, ?, '')"
    );
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hash);

    if (!mysqli_stmt_execute($stmt)) {

        alert_redirect(t('alert_reg_error'));
    }

    session_regenerate_id(true);

    $_SESSION['user_name'] = $name;

    header("Location: Go2.php");

    exit();
}
