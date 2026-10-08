<?php

/* =========================================================
   GET COURSE FOR EDIT
========================================================= */

$edit_course = null;

if ($is_admin && isset($_GET['edit'])) {

    $edit_id = intval($_GET['edit']);

    $stmt = mysqli_prepare($conn, "SELECT * FROM courses WHERE id = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "i", $edit_id);
    mysqli_stmt_execute($stmt);

    $edit_course = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}
