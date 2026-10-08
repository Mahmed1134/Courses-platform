<?php if (GOOGLE_CLIENT_ID !== 'YOUR_CLIENT_ID'): ?>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<div id="g_id_onload"
     data-client_id="<?= e(GOOGLE_CLIENT_ID) ?>"
     data-login_uri="<?= e(GOOGLE_LOGIN_URI) ?>"
     data-ux_mode="redirect"
     data-auto_prompt="false"></div>
<?php endif; ?>

<!-- LOGIN MODAL -->
<dialog id="loginModal">

    <div class="modal">

        <h3><?= t('login_title') ?></h3>
        <p class="modal-sub"><?= t('login_sub') ?></p>

        <form method="POST">

            <div class="field">
                <input type="email" name="email" placeholder="<?= e(t('email_ph')) ?>" required>
            </div>

            <div class="field">
                <input type="password" name="password" placeholder="<?= e(t('password_ph')) ?>" required>
            </div>

            <div class="modal-actions">
                <button type="button" class="outline-btn" onclick="loginModal.close()"><?= t('cancel') ?></button>
                <button type="submit" name="login" class="main-btn"><?= t('login_btn') ?></button>
            </div>

        </form>

        <?php require __DIR__ . '/google-button.php'; ?>

        <div class="switch">
            <?= t('no_account') ?>
            <a onclick="loginModal.close(); registerModal.showModal();"><?= t('create_account') ?></a>
        </div>

    </div>

</dialog>
