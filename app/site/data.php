<?php

/* =========================================================
   USER SUBSCRIPTIONS
========================================================= */

$my_subs = [];

if ($user_name) {

    $stmt = mysqli_prepare(
        $conn,
        "SELECT course_title FROM user_courses WHERE user_name = ?"
    );
    mysqli_stmt_bind_param($stmt, "s", $user_name);
    mysqli_stmt_execute($stmt);

    $r = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($r)) {

        $my_subs[] = $row['course_title'];
    }
}

$my_subs_count = count($my_subs);


/* =========================================================
   CATEGORIES
========================================================= */

$categories = [];

$catRes = mysqli_query(
    $conn,
    "SELECT DISTINCT category
     FROM courses
     ORDER BY category"
);

if ($catRes) {

    while ($c = mysqli_fetch_assoc($catRes)) {

        $categories[] = $c['category'];
    }
}


/* =========================================================
   COURSE COUNT
========================================================= */

$total_courses = mysqli_num_rows(
    mysqli_query($conn, "SELECT id FROM courses")
);
