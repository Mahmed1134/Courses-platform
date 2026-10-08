<!DOCTYPE html>

<html lang="<?= $lang ?>" dir="<?= $dir ?>">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>ARKA | <?= e(t('tagline')) ?></title>

<link rel="preconnect"
      href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">


<link rel="stylesheet" href="assets/css/site/01-variables.css">
<link rel="stylesheet" href="assets/css/site/02-reset.css">
<link rel="stylesheet" href="assets/css/site/03-navbar.css">
<link rel="stylesheet" href="assets/css/site/04-hero.css">
<link rel="stylesheet" href="assets/css/site/05-stats.css">
<link rel="stylesheet" href="assets/css/site/06-section.css">
<link rel="stylesheet" href="assets/css/site/07-search.css">
<link rel="stylesheet" href="assets/css/site/08-categories.css">
<link rel="stylesheet" href="assets/css/site/09-courses.css">
<link rel="stylesheet" href="assets/css/site/10-why-arka.css">
<link rel="stylesheet" href="assets/css/site/11-video.css">
<link rel="stylesheet" href="assets/css/site/12-instructors.css">
<link rel="stylesheet" href="assets/css/site/13-reviews.css">
<link rel="stylesheet" href="assets/css/site/14-partners.css">
<link rel="stylesheet" href="assets/css/site/15-cta.css">
<link rel="stylesheet" href="assets/css/site/16-footer.css">
<link rel="stylesheet" href="assets/css/site/17-modals.css">
<link rel="stylesheet" href="assets/css/site/18-mobile.css">
<link rel="stylesheet" href="assets/css/site/19-payment.css">


</head>

<body>



<?php require __DIR__ . '/partials/navbar.php'; ?>

<?php require __DIR__ . '/partials/hero.php'; ?>

<?php require __DIR__ . '/partials/stats.php'; ?>

<?php require __DIR__ . '/partials/courses.php'; ?>

<?php require __DIR__ . '/partials/why-arka.php'; ?>

<?php require __DIR__ . '/partials/video.php'; ?>

<?php require __DIR__ . '/partials/instructors.php'; ?>

<?php require __DIR__ . '/partials/reviews.php'; ?>

<?php require __DIR__ . '/partials/partners.php'; ?>

<?php require __DIR__ . '/partials/cta.php'; ?>

<?php require __DIR__ . '/partials/footer.php'; ?>

<?php require __DIR__ . '/partials/login-modal.php'; ?>

<?php require __DIR__ . '/partials/register-modal.php'; ?>

<?php if ($user_name): ?>
<?php require __DIR__ . '/partials/payment-modal.php'; ?>
<?php endif; ?>


<script>window.I18N = <?= json_encode(lang_js(), JSON_UNESCAPED_UNICODE) ?>;</script>
<script src="assets/js/site/theme.js"></script>
<script src="assets/js/site/course-filter.js"></script>
<script src="assets/js/site/course-search.js"></script>
<script src="assets/js/site/navbar-scroll.js"></script>
<script src="assets/js/site/payment.js"></script>




</body>

</html>
