<?php

/* =========================================================
   DASHBOARD DATA
========================================================= */

$total_courses =
    mysqli_num_rows(
        mysqli_query(
            $conn,
            "SELECT id FROM courses"
        )
    );


$total_students =
    mysqli_num_rows(
        mysqli_query(
            $conn,
            "SELECT id FROM users2"
        )
    );


$total_categories =
    mysqli_num_rows(
        mysqli_query(
            $conn,
            "SELECT DISTINCT category FROM courses"
        )
    );


$courses =
    mysqli_query(
        $conn,
        "SELECT *
         FROM courses
         ORDER BY id DESC"
    );
