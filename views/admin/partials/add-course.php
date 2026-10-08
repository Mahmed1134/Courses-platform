    <!-- =====================================================
         ADD COURSE
    ===================================================== -->

    <div
        class="panel"
        id="add">


        <h2>
            إضافة كورس جديد
        </h2>


        <?php if(isset($message)): ?>

            <div
                class="message <?= $message_type ?>">

                <?= htmlspecialchars($message) ?>

            </div>

        <?php endif; ?>


        <form method="POST">


            <div class="form-grid">


                <input
                    type="text"
                    name="title"
                    placeholder="اسم الكورس"
                    required>


                <input
                    type="text"
                    name="instructor"
                    placeholder="اسم المحاضر"
                    required>


                <input
                    type="number"
                    name="price"
                    step="0.01"
                    placeholder="سعر الكورس"
                    required>


                <input
                    type="text"
                    name="category"
                    placeholder="التصنيف"
                    required>


                <input
                    type="text"
                    name="image"
                    placeholder="رابط صورة الكورس"
                    required>


            </div>


            <button
                type="submit"
                name="add_course"
                class="add-button">

                إضافة الكورس

            </button>


        </form>


    </div>
