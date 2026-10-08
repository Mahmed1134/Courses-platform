<?php
/*
 * ARKA - صفحة الكورس (للمشتركين فقط)
 */

session_start();

require __DIR__ . '/config/database.php';   // $conn
require __DIR__ . '/app/common.php';        // اللغة + دوال مشتركة
require __DIR__ . '/app/site/schema.php';   // الجداول (بما فيها الدروس)

$user_name = $_SESSION['user_name'] ?? null;

/* لازم يكون مسجل دخول */
if (!$user_name) {
    header("Location: Go2.php");
    exit();
}

$title = $_GET['title'] ?? '';

/* جلب الكورس */
$stmt = mysqli_prepare($conn, "SELECT * FROM courses WHERE title = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $title);
mysqli_stmt_execute($stmt);
$course = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$course) {
    header("Location: Go2.php");
    exit();
}

/* لازم يكون مشترك في الكورس */
$stmt = mysqli_prepare(
    $conn,
    "SELECT id FROM user_courses WHERE user_name = ? AND course_title = ? LIMIT 1"
);
mysqli_stmt_bind_param($stmt, "ss", $user_name, $course['title']);
mysqli_stmt_execute($stmt);

if (mysqli_num_rows(mysqli_stmt_get_result($stmt)) === 0) {
    header("Location: Go2.php");
    exit();
}

/* دروس الكورس بالترتيب */
$lessons = [];

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, title, video_url FROM lessons WHERE course_id = ? ORDER BY position ASC, id ASC"
);
mysqli_stmt_bind_param($stmt, "i", $course['id']);
mysqli_stmt_execute($stmt);

$res = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($res)) {

    $vid = youtube_id($row['video_url']);

    if ($vid) {
        $row['vid'] = $vid;
        $lessons[] = $row;
    }
}

require __DIR__ . '/views/course/index.php';
