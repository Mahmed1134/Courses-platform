    <!-- =====================================================
         COURSES
    ===================================================== -->

    <div
        class="panel"
        id="courses">


        <h2>
            الكورسات الحالية
        </h2>


        <div class="table-wrap">


            <table>


                <thead>


                    <tr>


                        <th>
                            الصورة
                        </th>


                        <th>
                            الكورس
                        </th>


                        <th>
                            المحاضر
                        </th>


                        <th>
                            التصنيف
                        </th>


                        <th>
                            السعر
                        </th>


                        <th>
                            الإجراء
                        </th>


                    </tr>


                </thead>


                <tbody>


                <?php while($course = mysqli_fetch_assoc($courses)): ?>


                    <tr>


                        <td>


                            <img
                                class="course-image"
                                src="<?= htmlspecialchars($course['image']) ?>"
                                onerror="
                                this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=300&q=70';
                                ">


                        </td>


                        <td>

                            <?= htmlspecialchars($course['title']) ?>

                        </td>


                        <td>

                            <?= htmlspecialchars($course['instructor']) ?>

                        </td>


                        <td>

                            <?= htmlspecialchars($course['category']) ?>

                        </td>


                        <td>

                            <?= htmlspecialchars($course['price']) ?>

                            جنيه

                        </td>


                        <td>


                            <div class="actions">


                                <!-- EDIT -->

                                <a
                                    href="?edit=<?= $course['id'] ?>#edit"
                                    class="edit">

                                    تعديل

                                </a>


                                <a
                                    href="?lessons=<?= (int)$course['id'] ?>#lessons"
                                    class="lessons-link">

                                    الدروس

                                </a>


                                <!-- DELETE -->

                                <form
                                    method="POST"
                                    onsubmit="return confirm('هل تريد حذف هذا الكورس نهائياً؟');">

                                    <input
                                        type="hidden"
                                        name="delete_id"
                                        value="<?= (int)$course['id'] ?>">

                                    <button
                                        type="submit"
                                        name="delete_course"
                                        class="delete">

                                        حذف

                                    </button>

                                </form>


                            </div>


                        </td>


                    </tr>


                <?php endwhile; ?>


                </tbody>


            </table>


        </div>


    </div>
