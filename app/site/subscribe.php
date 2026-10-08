<?php

/* =========================================================
   SUBSCRIBE
   - الاشتراك بيتم فقط بعد فورم الدفع (pay_confirm)
   - إلغاء الاشتراك من صفحة الكورس (نفس زر sub بدون pay_confirm)
========================================================= */

if (isset($_POST['sub'])) {

    $redirect = "Go2.php";

    if ($user_name && $course_title) {

        $u = mysqli_real_escape_string($conn, $user_name);
        $t = mysqli_real_escape_string($conn, $course_title);

        $exists = mysqli_num_rows(
            mysqli_query(
                $conn,
                "SELECT id
                 FROM user_courses
                 WHERE user_name='$u'
                 AND course_title='$t'"
            )
        );

        if (isset($_POST['pay_confirm'])) {

            if (!$exists) {

                mysqli_query(
                    $conn,
                    "INSERT INTO user_courses
                    (user_name,course_title)
                    VALUES
                    ('$u','$t')"
                );
            }

            if (isset($_POST['go_course'])) {

                $redirect = "Course.php?title=" . urlencode($course_title);
            }

        } elseif ($exists) {

            mysqli_query(
                $conn,
                "DELETE FROM user_courses
                 WHERE user_name='$u'
                 AND course_title='$t'"
            );
        }
    }

    header("Location: " . $redirect);

    exit();
}
