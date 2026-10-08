<!-- REVIEWS -->
<section class="section" id="reviews">

    <div class="section-head">
        <span class="eyebrow">STUDENT REVIEWS</span>
        <h2><?= t('rev_h2') ?></h2>
        <p><?= t('rev_p') ?></p>
    </div>

    <?php $imgs = [1 => 12, 2 => 32, 3 => 15]; ?>

    <div class="reviews">

        <?php for ($i = 1; $i <= 3; $i++): ?>

        <div class="review">

            <div class="stars">★★★★★</div>

            <p class="review-text">"<?= t('rev' . $i . '_t') ?>"</p>

            <div class="student">
                <img src="https://i.pravatar.cc/100?img=<?= $imgs[$i] ?>" alt="">
                <div>
                    <strong><?= t('rev' . $i . '_n') ?></strong>
                    <small><?= t('rev' . $i . '_r') ?></small>
                </div>
            </div>

        </div>

        <?php endfor; ?>

    </div>

</section>
