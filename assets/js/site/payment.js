/* =========================================================
   PAYMENT (محاكاة الدفع - لا يتم إرسال بيانات البطاقة للسيرفر)
========================================================= */

(function () {

    const modal = document.getElementById("paymentModal");

    if (!modal) return;

    const stepForm = document.getElementById("payStepForm");
    const stepLoading = document.getElementById("payStepLoading");
    const stepSuccess = document.getElementById("payStepSuccess");

    const form = document.getElementById("payForm");
    const errorBox = document.getElementById("payError");

    const nameInput = document.getElementById("cardName");
    const numberInput = document.getElementById("cardNumber");
    const expiryInput = document.getElementById("cardExpiry");
    const cvvInput = document.getElementById("cardCvv");

    const previewNumber = document.getElementById("cardPreviewNumber");
    const previewName = document.getElementById("cardPreviewName");
    const previewExpiry = document.getElementById("cardPreviewExpiry");
    const previewCvv = document.getElementById("cardPreviewCvv");
    const brandBox = document.getElementById("cardBrand");
    const card = document.getElementById("payCard");
    const demoBtn = document.getElementById("payDemoFill");

    const EMPTY_NUMBER = "•••• •••• •••• ••••";
    const EMPTY_NAME = "YOUR NAME";

    let processing = false;


    /* فتح الفورم */

    window.openPayment = function (btn) {

        document.getElementById("payCourseName").textContent =
            btn.dataset.course;

        document.getElementById("payCoursePrice").textContent =
            btn.dataset.price;

        document.getElementById("payCourseInput").value =
            btn.dataset.course;

        resetModal();

        modal.showModal();

        nameInput.focus();
    };


    function resetModal() {

        processing = false;

        form.reset();

        errorBox.textContent = "";

        previewNumber.textContent = EMPTY_NUMBER;
        previewName.textContent = EMPTY_NAME;
        previewExpiry.textContent = "MM/YY";
        previewCvv.textContent = "•••";
        brandBox.textContent = "CARD";
        card.classList.remove("flipped");

        /* تعبئة الاسم تلقائياً من حساب المستخدم */
        const user = (modal.dataset.user || "").trim();

        if (user) {
            nameInput.value = user;
            previewName.textContent = user;
        }

        stepForm.hidden = false;
        stepLoading.hidden = true;
        stepSuccess.hidden = true;
    }


    /* منع الإغلاق أثناء المعالجة */

    modal.addEventListener("cancel", function (e) {

        if (processing) e.preventDefault();
    });

    modal.addEventListener("close", function () {

        if (!processing) form.reset();
    });


    /* تنسيق الحقول + تعبئة صورة البطاقة تلقائياً */

    function detectBrand(digits) {

        if (/^4/.test(digits)) return "VISA";

        if (/^(5[1-5]|2(2[2-9]|[3-6]|7[01]|720))/.test(digits)) {
            return "MASTERCARD";
        }

        return "CARD";
    }

    function renderNumber(digits) {

        /* الأرقام اللي اتكتبت + نقط للباقي */
        const padded = (digits + "••••••••••••••••").slice(0, 16);

        return padded.replace(/(.{4})/g, "$1 ").trim();
    }

    numberInput.addEventListener("input", function () {

        const digits = numberInput.value.replace(/\D/g, "").slice(0, 16);

        numberInput.value = digits.replace(/(.{4})/g, "$1 ").trim();

        previewNumber.textContent = renderNumber(digits);

        brandBox.textContent = detectBrand(digits);
    });

    expiryInput.addEventListener("input", function () {

        let digits = expiryInput.value.replace(/\D/g, "").slice(0, 4);

        if (digits.length === 1 && parseInt(digits, 10) > 1) {
            digits = "0" + digits;
        }

        if (digits.length > 2) {
            digits = digits.slice(0, 2) + "/" + digits.slice(2);
        }

        expiryInput.value = digits;

        previewExpiry.textContent = digits || "MM/YY";
    });

    cvvInput.addEventListener("input", function () {

        cvvInput.value = cvvInput.value.replace(/\D/g, "").slice(0, 4);

        previewCvv.textContent =
            cvvInput.value
                ? "•".repeat(cvvInput.value.length)
                : "•••";
    });

    nameInput.addEventListener("input", function () {

        previewName.textContent =
            nameInput.value.trim() || EMPTY_NAME;
    });

    /* قلب البطاقة عند الكتابة في CVV */

    cvvInput.addEventListener("focus", function () {
        card.classList.add("flipped");
    });

    cvvInput.addEventListener("blur", function () {
        card.classList.remove("flipped");
    });


    /* تعبئة بيانات تجريبية بضغطة واحدة */

    demoBtn.addEventListener("click", function () {

        const year = String((new Date().getFullYear() + 3) % 100).padStart(2, "0");

        if (!nameInput.value.trim()) {
            nameInput.value = "ARKA STUDENT";
        }

        numberInput.value = "4242 4242 4242 4242";
        expiryInput.value = "12/" + year;
        cvvInput.value = "123";

        [nameInput, numberInput, expiryInput, cvvInput].forEach(function (el) {
            el.dispatchEvent(new Event("input"));
        });

        errorBox.textContent = "";
    });


    /* التحقق */

    function luhn(number) {

        let sum = 0;
        let alt = false;

        for (let i = number.length - 1; i >= 0; i--) {

            let n = parseInt(number[i], 10);

            if (alt) {
                n *= 2;
                if (n > 9) n -= 9;
            }

            sum += n;
            alt = !alt;
        }

        return sum % 10 === 0;
    }

    function validate() {

        if (nameInput.value.trim().length < 3) {
            return I18N.err_name;
        }

        const number = numberInput.value.replace(/\s/g, "");

        if (number.length !== 16 || !luhn(number)) {
            return I18N.err_number;
        }

        const m = expiryInput.value.match(/^(\d{2})\/(\d{2})$/);

        if (!m) {
            return I18N.err_expiry_fmt;
        }

        const month = parseInt(m[1], 10);
        const year = 2000 + parseInt(m[2], 10);

        if (month < 1 || month > 12) {
            return I18N.err_month;
        }

        const now = new Date();

        const expiresAt = new Date(year, month, 1);

        if (expiresAt <= now) {
            return I18N.err_expired;
        }

        if (!/^\d{3,4}$/.test(cvvInput.value)) {
            return I18N.err_cvv;
        }

        return "";
    }


    /* إرسال */

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const error = validate();

        errorBox.textContent = error;

        if (error) return;

        processing = true;

        /* مسح بيانات البطاقة من الصفحة */

        form.reset();

        stepForm.hidden = true;
        stepLoading.hidden = false;

        setTimeout(function () {

            stepLoading.hidden = true;
            stepSuccess.hidden = false;

            setTimeout(function () {

                document
                    .getElementById("payConfirmForm")
                    .submit();

            }, 1600);

        }, 2300);
    });

})();
