<!-- =========================================================
     PAYMENT MODAL  (وضع تجريبي - لا يتم خصم أي مبلغ)
========================================================= -->

<dialog id="paymentModal" data-user="<?= htmlspecialchars($user_name ?? '') ?>">

    <div class="modal pay-modal">


        <!-- الخطوة 1: بيانات البطاقة -->
        <div id="payStepForm">

            <h3><?= t('pay_title') ?></h3>

            <p class="modal-sub">
                <?= t('pay_sub') ?>
            </p>

            <div class="pay-summary">
                <span id="payCourseName"></span>
                <strong>
                    <span id="payCoursePrice"></span> <?= t('currency') ?>
                </strong>
            </div>


            <!-- صورة البطاقة (بتتملى تلقائي) -->
            <div class="pay-scene">

                <div class="pay-card" id="payCard">

                    <div class="pay-face pay-front">

                        <div class="pay-top">
                            <div class="pay-chip"></div>
                            <div class="pay-brand" id="cardBrand">CARD</div>
                        </div>

                        <div class="pay-card-number" id="cardPreviewNumber">
                            •••• •••• •••• ••••
                        </div>

                        <div class="pay-card-row">
                            <div>
                                <small>CARD HOLDER</small>
                                <span id="cardPreviewName" dir="auto">YOUR NAME</span>
                            </div>
                            <div>
                                <small>EXPIRES</small>
                                <span id="cardPreviewExpiry">MM/YY</span>
                            </div>
                        </div>

                    </div>

                    <div class="pay-face pay-back">

                        <div class="pay-strip"></div>

                        <div class="pay-cvv-wrap">
                            <div class="pay-cvv-lines"></div>
                            <div class="pay-cvv-box" id="cardPreviewCvv">•••</div>
                        </div>

                        <div class="pay-back-note">ARKA ACADEMY — DEMO CARD</div>

                    </div>

                </div>

            </div>


            <button type="button" class="pay-demo" id="payDemoFill">
                <?= t('pay_demo') ?>
            </button>


            <form id="payForm" autocomplete="off" novalidate>

                <div class="field">
                    <input
                        type="text"
                        id="cardName"
                        placeholder="<?= e(t('card_name_ph')) ?>"
                        autocomplete="off">
                </div>

                <div class="field">
                    <input
                        type="text"
                        id="cardNumber"
                        inputmode="numeric"
                        placeholder="<?= e(t('card_number_ph')) ?>"
                        maxlength="19"
                        dir="ltr"
                        autocomplete="off">
                </div>

                <div class="pay-row">
                    <div class="field">
                        <input
                            type="text"
                            id="cardExpiry"
                            inputmode="numeric"
                            placeholder="MM/YY"
                            maxlength="5"
                            dir="ltr"
                            autocomplete="off">
                    </div>

                    <div class="field">
                        <input
                            type="password"
                            id="cardCvv"
                            inputmode="numeric"
                            placeholder="CVV"
                            maxlength="4"
                            dir="ltr"
                            autocomplete="off">
                    </div>
                </div>

                <div class="pay-error" id="payError"></div>

                <div class="modal-actions">
                    <button
                        type="button"
                        class="outline-btn"
                        onclick="paymentModal.close()">
                        <?= t('cancel') ?>
                    </button>

                    <button
                        type="submit"
                        class="main-btn">
                        <?= t('pay_now') ?>
                    </button>
                </div>

            </form>

            <p class="pay-note">
                <?= t('pay_note1') ?>
                <br>
                <?= t('pay_note2') ?>
            </p>

        </div>


        <!-- الخطوة 2: التحميل -->
        <div id="payStepLoading" class="pay-state" hidden>
            <div class="pay-spinner"></div>
            <h3><?= t('processing') ?></h3>
            <p class="modal-sub"><?= t('dont_close') ?></p>
        </div>


        <!-- الخطوة 3: النجاح -->
        <div id="payStepSuccess" class="pay-state" hidden>
            <div class="pay-check">✓</div>
            <h3><?= t('pay_success') ?></h3>
            <p class="modal-sub"><?= t('redirecting') ?></p>
        </div>


        <!-- تأكيد الاشتراك في السيرفر -->
        <form
            id="payConfirmForm"
            method="POST"
            action="Go2.php">

            <input type="hidden" name="course_title" id="payCourseInput">
            <input type="hidden" name="pay_confirm" value="1">
            <input type="hidden" name="go_course" value="1">
            <input type="hidden" name="sub" value="1">

        </form>

    </div>

</dialog>
