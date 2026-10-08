<?php

/* =========================================================
   HELPERS
========================================================= */

function alert_redirect($message, $url = 'Go2.php')
{
    echo '<!DOCTYPE html><html lang="ar" dir="rtl"><meta charset="UTF-8"><body><script>'
        . 'alert(' . json_encode($message, JSON_UNESCAPED_UNICODE) . ');'
        . 'window.location.href=' . json_encode($url) . ';'
        . '</script></body></html>';

    exit();
}
