<?php

/* =========================================================
   ADD COURSE
========================================================= */

if ($is_admin && isset($_POST['add_course'])) {

    $title      = trim($_POST['title'] ?? '');
    $instructor = trim($_POST['instructor'] ?? '');
    $price      = $_POST['price'] ?? '';
    $category   = trim($_POST['category'] ?? '');
    $image      = trim($_POST['image'] ?? '');

    if ($title === '' || $instructor === '' || $category === '' || !is_numeric($price) || $price < 0) {

        $message      = "تأكد من إدخال كل البيانات بشكل صحيح";
        $message_type = "error";

    } else {

        $stmt = mysqli_prepare($conn, "SELECT id FROM courses WHERE title = ?");
        mysqli_stmt_bind_param($stmt, "s", $title);
        mysqli_stmt_execute($stmt);

        if (mysqli_num_rows(mysqli_stmt_get_result($stmt)) > 0) {

            $message      = "هذا الكورس موجود بالفعل";
            $message_type = "error";

        } else {

            $price = (float)$price;

            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO courses (title, instructor, price, category, image)
                 VALUES (?, ?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($stmt, "ssdss", $title, $instructor, $price, $category, $image);

            if (mysqli_stmt_execute($stmt)) {

                $message      = "تم إضافة الكورس بنجاح";
                $message_type = "success";

            } else {

                $message      = "حدث خطأ أثناء إضافة الكورس";
                $message_type = "error";
            }
        }
    }
}
