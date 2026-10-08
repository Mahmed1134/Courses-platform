<!-- REGISTER MODAL -->
<dialog id="registerModal">

    <div class="modal">

        <h3><?= t('register_title') ?></h3>
        <p class="modal-sub"><?= t('register_sub') ?></p>

        <form method="POST">

            <div class="field">
                <input type="text" name="name" placeholder="<?= e(t('name_ph')) ?>" required>
            </div>

            <div class="field">
                <input type="email" name="email" placeholder="<?= e(t('email_ph')) ?>" required>
            </div>

            <div class="field">
                <input type="password" name="password" placeholder="<?= e(t('password_ph')) ?>" required>
            </div>

            <div class="modal-actions">
                <button type="button" class="outline-btn" onclick="registerModal.close()"><?= t('cancel') ?></button>
                <button type="submit" name="register" class="main-btn"><?= t('create_btn') ?></button>
            </div>

        </form>

        <?php require __DIR__ . '/google-button.php'; ?>

        <div class="switch">
            <?= t('have_account') ?>
            <a onclick="registerModal.close(); loginModal.showModal();"><?= t('login_title') ?></a>
        </div>

    </div>

</dialog>
