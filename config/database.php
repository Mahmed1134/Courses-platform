<?php

$conn = mysqli_connect("sql106.infinityfree.com", "if0_42670775", "2050TM2050", "if0_42670775_if0_42670775_ooo");

if (!$conn) {
    die("Database connection failed");
}

mysqli_set_charset($conn, "utf8mb4");
