<?php

/* =========================================================
   LOGIN
========================================================= */

if (isset($_POST['login'])) {

    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = mysqli_prepare(
        $conn,
        "SELECT id, name, password FROM users2 WHERE email = ? LIMIT 1"
    );
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    $ok = false;

    if ($user) {

        if (password_verify($password, $user['password'])) {

            $ok = true;

        } elseif (hash_equals($user['password'], $password)) {

            /* حساب قديم كلمة سره مش مشفرة: نشفرها دلوقتي */

            $ok = true;

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $up = mysqli_prepare(
                $conn,
                "UPDATE users2 SET password = ? WHERE id = ?"
            );
            mysqli_stmt_bind_param($up, "si", $hash, $user['id']);
            mysqli_stmt_execute($up);
        }
    }

    if (!$ok) {

        alert_redirect(t('alert_login_bad'));
    }

    session_regenerate_id(true);

    $_SESSION['user_name'] = $user['name'];

    header("Location: Go2.php");

    exit();
}
