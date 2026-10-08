<?php

/* =========================================================
   GOOGLE LOGIN — جوجل بيبعت credential لنفس الصفحة
========================================================= */

if (isset($_POST['credential'])) {

    /* حماية CSRF: الـ token في الكوكي لازم يساوي اللي في الـ POST */
    $csrf_cookie = $_COOKIE['g_csrf_token'] ?? '';
    $csrf_body   = $_POST['g_csrf_token'] ?? '';

    if ($csrf_cookie === '' || !hash_equals($csrf_cookie, $csrf_body)) {

        alert_redirect(t('alert_google_bad'));
    }

    $info = google_verify_token($_POST['credential']);

    if (!$info) {

        alert_redirect(t('alert_google_bad'));
    }

    $email = $info['email'];
    $name  = trim($info['name'] ?? '') !== '' ? trim($info['name']) : strstr($email, '@', true);

    $stmt = mysqli_prepare($conn, "SELECT name FROM users2 WHERE email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if ($row) {

        $login_name = $row['name'];

    } else {

        /* حساب جديد: الاسم لازم يكون فريد */
        $login_name = $name;

        $chk = mysqli_prepare($conn, "SELECT id FROM users2 WHERE name = ? LIMIT 1");
        mysqli_stmt_bind_param($chk, "s", $login_name);
        mysqli_stmt_execute($chk);

        if (mysqli_num_rows(mysqli_stmt_get_result($chk)) > 0) {
            $login_name = $name . ' ' . random_int(100, 999);
        }

        /* باسورد عشوائي: الحساب بيدخل بجوجل بس */
        $hash = password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT);

        $ins = mysqli_prepare(
            $conn,
            "INSERT INTO users2 (name, email, password, subscribed_courses) VALUES (?, ?, ?, '')"
        );
        mysqli_stmt_bind_param($ins, "sss", $login_name, $email, $hash);

        if (!mysqli_stmt_execute($ins)) {

            alert_redirect(t('alert_reg_error'));
        }
    }

    session_regenerate_id(true);

    $_SESSION['user_name'] = $login_name;

    header("Location: Go2.php");

    exit();
}

/* التحقق من الـ token عن طريق جوجل (cURL — شغال على الاستضافات المجانية) */
function google_verify_token($token)
{
    if (GOOGLE_CLIENT_ID === 'YOUR_CLIENT_ID' || $token === '') {
        return null;
    }

    $url = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . urlencode($token);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_SSL_VERIFYPEER => true,
    ]);
    $json = curl_exec($ch);
    curl_close($ch);

    $info = json_decode((string)$json, true);

    if (!is_array($info)) {
        return null;
    }

    $issuer_ok = in_array($info['iss'] ?? '', ['accounts.google.com', 'https://accounts.google.com'], true);
    $aud_ok    = ($info['aud'] ?? '') === GOOGLE_CLIENT_ID;
    $exp_ok    = (int)($info['exp'] ?? 0) > time();
    $mail_ok   = ($info['email_verified'] ?? '') === 'true' || ($info['email_verified'] ?? false) === true;

    if (!$issuer_ok || !$aud_ok || !$exp_ok || !$mail_ok || empty($info['email'])) {
        return null;
    }

    return $info;
}
