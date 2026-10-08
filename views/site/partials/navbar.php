<!-- NAVBAR -->
<nav class="nav">

    <a href="#" class="brand">ARKA<span>.</span></a>

    <div class="nav-links">
        <a href="#courses"><?= t('nav_courses') ?></a>
        <a href="#why"><?= t('nav_why') ?></a>
        <a href="#instructors"><?= t('nav_instructors') ?></a>
        <a href="#reviews"><?= t('nav_reviews') ?></a>
        <a href="#partners"><?= t('nav_partners') ?></a>
    </div>

    <div class="nav-tools">

        <!-- LANGUAGE -->
        <a class="icon-btn"
           href="<?= e(lang_url($lang === 'ar' ? 'en' : 'ar')) ?>"
           title="<?= e(t('lang_title')) ?>">
            <?= $lang === 'ar' ? 'EN' : 'عربي' ?>
        </a>

        <!-- THEME -->
        <button class="icon-btn" onclick="toggleTheme()" id="themeButton" title="<?= e(t('theme_title')) ?>">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 3v18a9 9 0 0 0 0-18z" fill="currentColor"/></svg>
        </button>

        <?php if ($user_name): ?>

            <div class="user-box">
                <span class="user-name"><?= e($user_name) ?></span>
                <a href="<?= e(lang_url($lang) . '&logout=1') ?>" class="logout"><?= t('logout') ?></a>
            </div>

        <?php else: ?>

            <button class="login-button" onclick="loginModal.showModal()"><?= t('login') ?></button>

        <?php endif; ?>

    </div>

</nav>
