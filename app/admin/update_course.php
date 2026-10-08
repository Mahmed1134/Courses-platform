<?php

/* =========================================================
   UPDATE COURSE
========================================================= */

if ($is_admin && isset($_POST['update_course'])) {

    $id         = intval($_POST['course_id'] ?? 0);
    $title      = trim($_POST['title'] ?? '');
    $instructor = trim($_POST['instructor'] ?? '');
    $price      = $_POST['price'] ?? '';
    $category   = trim($_POST['category'] ?? '');
    $image      = trim($_POST['image'] ?? '');

    if ($id < 1 || $title === '' || $instructor === '' || $category === '' || !is_numeric($price) || $price < 0) {

        $message      = "تأكد من إدخال كل البيانات بشكل صحيح";
        $message_type = "error";

    } else {

        /* التأكد أن اسم الكورس غير مستخدم في كورس آخر */

        $stmt = mysqli_prepare($conn, "SELECT id FROM courses WHERE title = ? AND id != ?");
        mysqli_stmt_bind_param($stmt, "si", $title, $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_num_rows(mysqli_stmt_get_result($stmt)) > 0) {

            $message      = "اسم الكورس مستخدم بالفعل";
            $message_type = "error";

        } else {

            $price = (float)$price;

            $stmt = mysqli_prepare(
                $conn,
                "UPDATE courses
                 SET title = ?, instructor = ?, price = ?, category = ?, image = ?
                 WHERE id = ?"
            );
            mysqli_stmt_bind_param($stmt, "ssdssi", $title, $instructor, $price, $category, $image, $id);

            if (mysqli_stmt_execute($stmt)) {

                $message      = "تم تعديل الكورس بنجاح";
                $message_type = "success";

            } else {

                $message      = "حدث خطأ أثناء تعديل الكورس";
                $message_type = "error";
            }
        }
    }
}
