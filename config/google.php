<?php

/* =========================================================
   GOOGLE LOGIN
   1) خد الـ Client ID من Google Cloud Console
   2) حطه هنا بدل YOUR_CLIENT_ID
   3) أضف نفس GOOGLE_LOGIN_URI في Authorized redirect URIs
========================================================= */

define('GOOGLE_CLIENT_ID', 'YOUR_CLIENT_ID');

$__scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

define('GOOGLE_LOGIN_URI', $__scheme . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')
    . rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\') . '/Go2.php');
