    <!-- =====================================================
         EDIT COURSE
    ===================================================== -->

    <?php if ($edit_course): ?>


    <div
        class="panel edit-panel"
        id="edit">


        <span class="edit-label">
            وضع التعديل
        </span>


        <h2>
            تعديل الكورس
        </h2>


        <form method="POST">


            <input
                type="hidden"
                name="course_id"
                value="<?= $edit_course['id'] ?>">


            <div class="form-grid">


                <input
                    type="text"
                    name="title"
                    value="<?= htmlspecialchars($edit_course['title']) ?>"
                    placeholder="اسم الكورس"
                    required>


                <input
                    type="text"
                    name="instructor"
                    value="<?= htmlspecialchars($edit_course['instructor']) ?>"
                    placeholder="اسم المحاضر"
                    required>


                <input
                    type="number"
                    name="price"
                    step="0.01"
                    value="<?= htmlspecialchars($edit_course['price']) ?>"
                    placeholder="سعر الكورس"
                    required>


                <input
                    type="text"
                    name="category"
                    value="<?= htmlspecialchars($edit_course['category']) ?>"
                    placeholder="التصنيف"
                    required>


                <input
                    type="text"
                    name="image"
                    value="<?= htmlspecialchars($edit_course['image']) ?>"
                    placeholder="رابط صورة الكورس"
                    required>


            </div>


            <button
                type="submit"
                name="update_course"
                class="add-button">

                حفظ التعديلات

            </button>


            <a
                href="Admin.php"
                class="cancel-button">

                إلغاء

            </a>


        </form>


    </div>


    <?php endif; ?>
