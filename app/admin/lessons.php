<?php

/* =========================================================
   LESSONS — إضافة / تعديل / حذف / ترتيب دروس الكورس
========================================================= */

$lesson_course = null;
$lessons       = [];
$edit_lesson   = null;
$lesson_message      = null;
$lesson_message_type = null;

if ($is_admin) {

    /* رسالة محفوظة من عملية قبل الـ redirect */
    if (isset($_SESSION['lesson_flash'])) {

        [$lesson_message, $lesson_message_type] = $_SESSION['lesson_flash'];

        unset($_SESSION['lesson_flash']);
    }

    function lesson_flash_redirect($course_id, $msg, $type)
    {
        $_SESSION['lesson_flash'] = [$msg, $type];

        header("Location: Admin.php?lessons=" . (int)$course_id . "#lessons");

        exit();
    }

    /* ---------- إضافة درس ---------- */

    if (isset($_POST['add_lesson'])) {

        $cid   = intval($_POST['course_id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $url   = trim($_POST['video_url'] ?? '');

        if ($cid < 1 || $title === '') {

            lesson_flash_redirect($cid, "اكتب عنوان الدرس", "error");
        }

        if (!youtube_id($url)) {

            lesson_flash_redirect($cid, "رابط يوتيوب غير صحيح", "error");
        }

        $stmt = mysqli_prepare($conn, "SELECT COALESCE(MAX(position), 0) + 1 FROM lessons WHERE course_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $cid);
        mysqli_stmt_execute($stmt);
        $pos = (int)mysqli_fetch_row(mysqli_stmt_get_result($stmt))[0];

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO lessons (course_id, title, video_url, position) VALUES (?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "issi", $cid, $title, $url, $pos);

        $ok = mysqli_stmt_execute($stmt);

        lesson_flash_redirect(
            $cid,
            $ok ? "تم إضافة الدرس بنجاح" : "حدث خطأ أثناء إضافة الدرس",
            $ok ? "success" : "error"
        );
    }

    /* ---------- تعديل درس ---------- */

    if (isset($_POST['update_lesson'])) {

        $cid   = intval($_POST['course_id'] ?? 0);
        $lid   = intval($_POST['lesson_id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $url   = trim($_POST['video_url'] ?? '');

        if ($lid < 1 || $title === '') {

            lesson_flash_redirect($cid, "اكتب عنوان الدرس", "error");
        }

        if (!youtube_id($url)) {

            lesson_flash_redirect($cid, "رابط يوتيوب غير صحيح", "error");
        }

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE lessons SET title = ?, video_url = ? WHERE id = ? AND course_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "ssii", $title, $url, $lid, $cid);

        $ok = mysqli_stmt_execute($stmt);

        lesson_flash_redirect(
            $cid,
            $ok ? "تم تعديل الدرس بنجاح" : "حدث خطأ أثناء تعديل الدرس",
            $ok ? "success" : "error"
        );
    }

    /* ---------- حذف درس ---------- */

    if (isset($_POST['delete_lesson'])) {

        $cid = intval($_POST['course_id'] ?? 0);
        $lid = intval($_POST['lesson_id'] ?? 0);

        $stmt = mysqli_prepare($conn, "DELETE FROM lessons WHERE id = ? AND course_id = ?");
        mysqli_stmt_bind_param($stmt, "ii", $lid, $cid);
        mysqli_stmt_execute($stmt);

        lesson_flash_redirect($cid, "تم حذف الدرس", "success");
    }

    /* ---------- تحريك درس لأعلى / لأسفل ---------- */

    if (isset($_POST['move_lesson'])) {

        $cid = intval($_POST['course_id'] ?? 0);
        $lid = intval($_POST['lesson_id'] ?? 0);
        $up  = (($_POST['direction'] ?? '') === 'up');

        $stmt = mysqli_prepare($conn, "SELECT position FROM lessons WHERE id = ? AND course_id = ?");
        mysqli_stmt_bind_param($stmt, "ii", $lid, $cid);
        mysqli_stmt_execute($stmt);
        $cur = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if ($cur) {

            $sql = $up
                ? "SELECT id, position FROM lessons WHERE course_id = ? AND (position < ? OR (position = ? AND id < ?)) ORDER BY position DESC, id DESC LIMIT 1"
                : "SELECT id, position FROM lessons WHERE course_id = ? AND (position > ? OR (position = ? AND id > ?)) ORDER BY position ASC, id ASC LIMIT 1";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iiii", $cid, $cur['position'], $cur['position'], $lid);
            mysqli_stmt_execute($stmt);
            $nb = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

            if ($nb) {

                $a = (int)$cur['position'];
                $b = (int)$nb['position'];

                /* لو المركزين متساويين، نفرّقهم */
                if ($a === $b) {
                    $b = $up ? $a - 1 : $a + 1;
                }

                $u = mysqli_prepare($conn, "UPDATE lessons SET position = ? WHERE id = ?");

                mysqli_stmt_bind_param($u, "ii", $b, $lid);
                mysqli_stmt_execute($u);

                mysqli_stmt_bind_param($u, "ii", $a, $nb['id']);
                mysqli_stmt_execute($u);
            }
        }

        header("Location: Admin.php?lessons=" . $cid . "#lessons");

        exit();
    }

    /* ---------- تحميل بيانات القسم ---------- */

    $all_courses = [];

    $r = mysqli_query($conn, "SELECT id, title FROM courses ORDER BY title");

    while ($row = mysqli_fetch_assoc($r)) {
        $all_courses[] = $row;
    }

    $sel = intval($_GET['lessons'] ?? 0);

    if ($sel > 0) {

        $stmt = mysqli_prepare($conn, "SELECT id, title FROM courses WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $sel);
        mysqli_stmt_execute($stmt);
        $lesson_course = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }

    if ($lesson_course) {

        $stmt = mysqli_prepare(
            $conn,
            "SELECT * FROM lessons WHERE course_id = ? ORDER BY position ASC, id ASC"
        );
        mysqli_stmt_bind_param($stmt, "i", $lesson_course['id']);
        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($res)) {
            $lessons[] = $row;
        }

        $eid = intval($_GET['edit_lesson'] ?? 0);

        if ($eid > 0) {

            foreach ($lessons as $l) {

                if ((int)$l['id'] === $eid) {
                    $edit_lesson = $l;
                }
            }
        }
    }
}
