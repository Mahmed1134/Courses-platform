<?php

/* =========================================================
   DELETE COURSE  (POST فقط - أأمن من الحذف عبر رابط)
========================================================= */

if ($is_admin && isset($_POST['delete_course'])) {

    $id = intval($_POST['delete_id'] ?? 0);

    $stmt = mysqli_prepare($conn, "DELETE FROM courses WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: Admin.php");

    exit();
}
