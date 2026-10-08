<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width,initial-scale=1">

<title>ARKA Admin Dashboard</title>


<link
href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap"
rel="stylesheet">

<link rel="stylesheet" href="assets/css/admin/admin.css?v=<?= @filemtime(__DIR__ . '/../../assets/css/admin/admin.css') ?: 1 ?>">

</head>


<body>



<?php require __DIR__ . '/partials/mobile-nav.php'; ?>


<div class="admin">


<?php require __DIR__ . '/partials/sidebar.php'; ?>


<!-- =========================================================
     MAIN
========================================================= -->

<main class="main">



<?php require __DIR__ . '/partials/header.php'; ?>


<?php require __DIR__ . '/partials/stats.php'; ?>


<?php require __DIR__ . '/partials/add-course.php'; ?>


<?php require __DIR__ . '/partials/edit-course.php'; ?>


<?php require __DIR__ . '/partials/courses-table.php'; ?>


<?php require __DIR__ . '/partials/lessons.php'; ?>


</main>


</div>



<?php if ($edit_course): ?>
<script src="assets/js/admin/edit-scroll.js"></script>
<?php endif; ?>

<?php if ($lesson_course): ?>
<script>
window.addEventListener("load", function () {
    var box = document.getElementById("lessons");
    if (box) box.scrollIntoView({ behavior: "smooth", block: "start" });
});
</script>
<?php endif; ?>




</body>

</html>
