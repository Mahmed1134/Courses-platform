<!-- WHY ARKA -->
<section class="section" id="why">

    <div class="section-head">
        <span class="eyebrow">WHY ARKA</span>
        <h2><?= t('why_h2') ?></h2>
        <p><?= t('why_p') ?></p>
    </div>

    <div class="features">

        <?php for ($i = 1; $i <= 6; $i++): ?>

        <div class="feature">
            <div class="feature-icon">0<?= $i ?></div>
            <h3><?= t('f' . $i . '_t') ?></h3>
            <p><?= t('f' . $i . '_d') ?></p>
        </div>

        <?php endfor; ?>

    </div>

</section>
