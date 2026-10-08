<!-- INSTRUCTORS -->
<section class="section" id="instructors">

    <div class="section-head">
        <span class="eyebrow">OUR INSTRUCTORS</span>
        <h2><?= t('ins_h2') ?></h2>
        <p><?= t('ins_p') ?></p>
    </div>

    <?php
    $instructors = [
        ['Max Wall',      'photo-1560250097-0b93528c311a', 'role1'],
        ['Sarah Adams',   'photo-1573496799515-eebbb63814f2', 'role2'],
        ['Ronaldo Alix',  'photo-1500648767791-00dcc994a43e', 'role3'],
        ['Rebika Luo',    'photo-1580489944761-15a19d654956', 'role4'],
    ];
    ?>

    <div class="people">

        <?php foreach ($instructors as $p): ?>

        <div class="person">
            <img src="https://images.unsplash.com/<?= $p[1] ?>?auto=format&fit=crop&w=700&q=85" alt="<?= e($p[0]) ?>">
            <h3><?= e($p[0]) ?></h3>
            <p><?= t($p[2]) ?></p>
        </div>

        <?php endforeach; ?>

    </div>

</section>
