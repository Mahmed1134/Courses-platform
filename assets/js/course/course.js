/* =========================================================
   COURSE PAGE: تأكيد إلغاء الاشتراك + مشغل الدروس
========================================================= */

(function () {

    var I = window.I18N || {};

    var unsub = document.getElementById("unsubForm");

    if (unsub) {

        unsub.addEventListener("submit", function (e) {

            if (!confirm(I.unsub_confirm || "Unsubscribe?")) {

                e.preventDefault();
            }
        });
    }


    /* ---------- المشغل ---------- */

    var frame = document.getElementById("lessonFrame");

    if (!frame) return;

    var titleBox = document.getElementById("lessonTitle");
    var items = document.querySelectorAll(".lesson-item");
    var courseKey = "arka-watched:" + (frame.dataset.course || "");

    var watched = [];

    try {
        watched = JSON.parse(localStorage.getItem(courseKey) || "[]");
    } catch (err) {
        watched = [];
    }

    function markWatched(id) {

        if (watched.indexOf(id) === -1) {

            watched.push(id);

            try {
                localStorage.setItem(courseKey, JSON.stringify(watched));
            } catch (err) {}
        }

        items.forEach(function (it) {

            if (it.dataset.id === id) {
                it.classList.add("done");
            }
        });
    }

    items.forEach(function (it) {

        if (watched.indexOf(it.dataset.id) !== -1) {
            it.classList.add("done");
        }

        it.addEventListener("click", function () {

            items.forEach(function (x) { x.classList.remove("active"); });

            it.classList.add("active");

            frame.src =
                "https://www.youtube-nocookie.com/embed/" +
                it.dataset.vid + "?rel=0&autoplay=1";

            titleBox.textContent = it.dataset.title;

            markWatched(it.dataset.id);
        });
    });

    /* أول درس بيتعلّم تلقائياً لما يتفتح */

    var first = document.querySelector(".lesson-item.active");

    if (first) markWatched(first.dataset.id);

})();
