<!-- FOOTER -->
<footer>

    <div class="footer-grid">

        <div class="footer-about">
            <div class="brand">ARKA<span>.</span></div>
            <p><?= t('footer_about') ?></p>
        </div>

        <div class="footer-col">
            <h4><?= t('f_platform') ?></h4>
            <a href="#courses"><?= t('nav_courses') ?></a>
            <a href="#why"><?= t('nav_why') ?></a>
            <a href="#instructors"><?= t('nav_instructors') ?></a>
            <a href="#reviews"><?= t('nav_reviews') ?></a>
        </div>

        <div class="footer-col">
            <h4><?= t('f_help') ?></h4>
            <a href="#"><?= t('f_faq') ?></a>
            <a href="#"><?= t('f_helpcenter') ?></a>
            <a href="#"><?= t('f_contact') ?></a>
            <a href="#"><?= t('f_privacy') ?></a>
        </div>

        <div class="footer-col">
            <h4><?= t('f_follow') ?></h4>
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
            <a href="#">YouTube</a>
            <a href="#">LinkedIn</a>
        </div>

    </div>

    <div class="footer-bottom">
        <span>© <?= date('Y') ?> ARKA Academy — <?= t('rights') ?></span>
        <span><?= t('tagline') ?></span>
    </div>

</footer>
