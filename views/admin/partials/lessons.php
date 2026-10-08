    <!-- =====================================================
         LESSONS
    ===================================================== -->

    <div
        class="panel<?= $edit_lesson ? ' edit-panel' : '' ?>"
        id="lessons">


        <h2>
            دروس الكورس
        </h2>


        <!-- اختيار الكورس -->

        <form method="GET" class="select-row">

            <select
                name="lessons"
                onchange="this.form.submit()">

                <option value="">
                    — اختر الكورس —
                </option>

                <?php foreach ($all_courses as $c): ?>

                    <option
                        value="<?= (int)$c['id'] ?>"
                        <?= ($lesson_course && (int)$lesson_course['id'] === (int)$c['id']) ? 'selected' : '' ?>>

                        <?= htmlspecialchars($c['title']) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </form>


        <?php if ($lesson_message): ?>

            <div class="message <?= htmlspecialchars($lesson_message_type) ?>">

                <?= htmlspecialchars($lesson_message) ?>

            </div>

        <?php endif; ?>


        <?php if (!$lesson_course): ?>

            <p class="hint">
                اختر كورس من القائمة لإدارة دروسه.
            </p>

        <?php else: ?>


            <!-- إضافة / تعديل -->

            <form method="POST">

                <input
                    type="hidden"
                    name="course_id"
                    value="<?= (int)$lesson_course['id'] ?>">

                <?php if ($edit_lesson): ?>

                    <input
                        type="hidden"
                        name="lesson_id"
                        value="<?= (int)$edit_lesson['id'] ?>">

                    <span class="edit-label">
                        وضع تعديل الدرس
                    </span>

                <?php endif; ?>


                <div class="form-grid">

                    <input
                        type="text"
                        name="title"
                        placeholder="عنوان الدرس"
                        value="<?= $edit_lesson ? htmlspecialchars($edit_lesson['title']) : '' ?>"
                        required>

                    <input
                        type="text"
                        name="video_url"
                        placeholder="رابط فيديو يوتيوب"
                        dir="ltr"
                        value="<?= $edit_lesson ? htmlspecialchars($edit_lesson['video_url']) : '' ?>"
                        required>

                </div>


                <?php if ($edit_lesson): ?>

                    <button
                        type="submit"
                        name="update_lesson"
                        class="add-button">

                        حفظ التعديلات

                    </button>

                    <a
                        href="?lessons=<?= (int)$lesson_course['id'] ?>#lessons"
                        class="cancel-button">

                        إلغاء

                    </a>

                <?php else: ?>

                    <button
                        type="submit"
                        name="add_lesson"
                        class="add-button">

                        إضافة الدرس

                    </button>

                <?php endif; ?>

            </form>


            <!-- قائمة الدروس -->

            <div class="table-wrap" style="margin-top:24px">

                <table>

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الفيديو</th>
                            <th>العنوان</th>
                            <th>الترتيب</th>
                            <th>الإجراء</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if (!$lessons): ?>

                        <tr>
                            <td colspan="5">
                                لا توجد دروس لهذا الكورس بعد.
                            </td>
                        </tr>

                    <?php endif; ?>

                    <?php foreach ($lessons as $i => $l): ?>

                        <?php $vid = youtube_id($l['video_url']); ?>

                        <tr>

                            <td><?= $i + 1 ?></td>

                            <td>
                                <?php if ($vid): ?>
                                    <img
                                        class="lesson-thumb"
                                        src="https://img.youtube.com/vi/<?= htmlspecialchars($vid) ?>/mqdefault.jpg"
                                        alt="">
                                <?php endif; ?>
                            </td>

                            <td><?= htmlspecialchars($l['title']) ?></td>

                            <td>

                                <div class="order-btns">

                                    <?php foreach (['up' => '↑', 'down' => '↓'] as $dirName => $arrow): ?>

                                        <?php
                                        $disabled =
                                            ($dirName === 'up' && $i === 0) ||
                                            ($dirName === 'down' && $i === count($lessons) - 1);
                                        ?>

                                        <form method="POST">
                                            <input type="hidden" name="course_id" value="<?= (int)$lesson_course['id'] ?>">
                                            <input type="hidden" name="lesson_id" value="<?= (int)$l['id'] ?>">
                                            <input type="hidden" name="direction" value="<?= $dirName ?>">
                                            <button
                                                type="submit"
                                                name="move_lesson"
                                                <?= $disabled ? 'disabled' : '' ?>>
                                                <?= $arrow ?>
                                            </button>
                                        </form>

                                    <?php endforeach; ?>

                                </div>

                            </td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="?lessons=<?= (int)$lesson_course['id'] ?>&edit_lesson=<?= (int)$l['id'] ?>#lessons"
                                        class="edit">

                                        تعديل

                                    </a>

                                    <form
                                        method="POST"
                                        onsubmit="return confirm('هل تريد حذف هذا الدرس؟');">

                                        <input type="hidden" name="course_id" value="<?= (int)$lesson_course['id'] ?>">
                                        <input type="hidden" name="lesson_id" value="<?= (int)$l['id'] ?>">

                                        <button
                                            type="submit"
                                            name="delete_lesson"
                                            class="delete">

                                            حذف

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>


    </div>
