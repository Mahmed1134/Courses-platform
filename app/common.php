<?php

/* =========================================================
   COMMON — اللغة + دوال مشتركة
========================================================= */

$LANGS = ['ar', 'en'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $LANGS, true)) {

    setcookie('arka_lang', $_GET['lang'], time() + 31536000, '/');

    $_COOKIE['arka_lang'] = $_GET['lang'];
}

$lang = $_COOKIE['arka_lang'] ?? 'ar';

if (!in_array($lang, $LANGS, true)) {
    $lang = 'ar';
}

$dir = ($lang === 'ar') ? 'rtl' : 'ltr';

$STR = require __DIR__ . '/lang/' . $lang . '.php';


function t($key)
{
    global $STR;

    return $STR[$key] ?? $key;
}

function e($s)
{
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

/* رابط تغيير اللغة مع الحفاظ على باقي الـ parameters */
function lang_url($to)
{
    $q = $_GET;

    $q['lang'] = $to;

    return '?' . http_build_query($q);
}

/* نصوص بتتبعت للـ JavaScript */
function lang_js()
{
    global $STR;

    $out = [];

    foreach ($STR as $k => $v) {

        if (strpos($k, 'js_') === 0) {
            $out[substr($k, 3)] = $v;
        }
    }

    return $out;
}

/* استخراج ID الفيديو من أي رابط يوتيوب */
function youtube_id($url)
{
    $url = trim((string)$url);

    if (preg_match('~^[A-Za-z0-9_-]{11}$~', $url)) {
        return $url;
    }

    if (preg_match(
        '~(?:youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/|v/)|youtu\.be/)([A-Za-z0-9_-]{11})~i',
        $url,
        $m
    )) {
        return $m[1];
    }

    return null;
}
