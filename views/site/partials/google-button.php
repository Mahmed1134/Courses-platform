<?php if (GOOGLE_CLIENT_ID !== 'YOUR_CLIENT_ID'): ?>
<div class="google-sep"><span><?= t('or') ?></span></div>
<div class="google-wrap">
    <div class="g_id_signin"
         data-type="standard"
         data-size="large"
         data-text="continue_with"
         data-shape="rectangular"
         data-width="300"
         data-locale="<?= e($lang) ?>"></div>
</div>
<?php endif; ?>
