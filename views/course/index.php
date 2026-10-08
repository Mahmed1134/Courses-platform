<!DOCTYPE html>

<html lang="<?= $lang ?>" dir="<?= $dir ?>">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= e($course['title']) ?> | ARKA</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/site/01-variables.css">
<link rel="stylesheet" href="assets/css/site/02-reset.css">
<link rel="stylesheet" href="assets/css/course/course.css">

</head>

<body>

<script src="assets/js/course/theme.js"></script>


<header class="course-nav">

    <a href="Go2.php" class="course-logo">ARKA<span>.</span></a>

    <div class="course-nav-links">

        <span class="course-user"><?= e($user_name) ?></span>

        <a href="<?= e(lang_url($lang === 'ar' ? 'en' : 'ar')) ?>" class="course-link">
            <?= $lang === 'ar' ? 'EN' : 'عربي' ?>
        </a>

        <a href="Go2.php" class="course-link"><?= t('all_courses') ?></a>

        <a href="Go2.php?logout=1" class="course-link"><?= t('logout') ?></a>

    </div>

</header>


<main class="course-page">

    <section class="course-hero">

        <div class="course-cover">

            <?php if (!empty($course['image'])): ?>

                <img src="<?= e($course['image']) ?>" alt="<?= e($course['title']) ?>">

            <?php else: ?>

                <div class="course-cover-empty">ARKA</div>

            <?php endif; ?>

        </div>

        <div class="course-info">

            <span class="course-badge"><?= e($course['category']) ?></span>

            <h1><?= e($course['title']) ?></h1>

            <p class="course-instructor"><?= t('instructor') ?>: <?= e($course['instructor']) ?></p>

            <div class="course-status">
                <span class="ok">✓</span> <?= t('subscribed_status') ?>
            </div>

        </div>

    </section>


    <section class="course-content">

        <h2>
            <?= t('course_content') ?>
            <?php if ($lessons): ?>
                <small>(<?= count($lessons) ?> <?= t('lessons') ?>)</small>
            <?php endif; ?>
        </h2>

        <?php if ($lessons): ?>

        <div class="player-layout">

            <div class="player-main">

                <div class="player-frame">
                    <iframe
                        id="lessonFrame"
                        data-course="<?= (int)$course['id'] ?>"
                        src="https://www.youtube-nocookie.com/embed/<?= e($lessons[0]['vid']) ?>?rel=0"
                        title="<?= e($lessons[0]['title']) ?>"
                        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen"
                        allowfullscreen></iframe>
                </div>

                <h3 id="lessonTitle"><?= e($lessons[0]['title']) ?></h3>

            </div>

            <aside class="lesson-side">

                <div class="lesson-side-head"><?= t('lessons_list') ?></div>

                <ol class="lesson-list">

                    <?php foreach ($lessons as $i => $l): ?>

                    <li>
                        <button
                            type="button"
                            class="lesson-item<?= $i === 0 ? ' active' : '' ?>"
                            data-id="<?= (int)$l['id'] ?>"
                            data-vid="<?= e($l['vid']) ?>"
                            data-title="<?= e($l['title']) ?>">

                            <span class="lesson-num"><?= $i + 1 ?></span>

                            <span class="lesson-name"><?= e($l['title']) ?></span>

                            <span class="lesson-done ok">✓</span>

                        </button>
                    </li>

                    <?php endforeach; ?>

                </ol>

            </aside>

        </div>

        <?php else: ?>

        <div class="course-empty">

            <div class="course-empty-icon">—</div>

            <p>
                <?= t('no_lessons') ?>
                <br>
                <?= t('no_lessons_sub') ?>
            </p>

        </div>

        <?php endif; ?>

    </section>


    <form method="POST" action="Go2.php" class="course-unsub" id="unsubForm">

        <input type="hidden" name="course_title" value="<?= e($course['title']) ?>">

        <button type="submit" name="sub" class="unsub-btn"><?= t('unsub') ?></button>

    </form>

</main>


<script>window.I18N = <?= json_encode(lang_js(), JSON_UNESCAPED_UNICODE) ?>;</script>
<script src="assets/js/course/course.js"></script>

</body>

</html>
