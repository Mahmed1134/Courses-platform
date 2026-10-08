<!-- =========================================================
     COURSES
========================================================= -->

<section
    class="section"
    id="courses">


    <div class="section-head">

        <span class="eyebrow">
            LEARN SOMETHING NEW
        </span>

        <h2>
            <?= t('courses_h2') ?>
        </h2>

        <p>
            <?= t('courses_p') ?>
        </p>

    </div>


    <!-- SEARCH -->

    <div class="course-toolbar">


        <div class="search">

            <span class="search-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            </span>

            <input
                type="text"
                id="courseSearch"
                placeholder="<?= e(t('search_ph')) ?>"
                onkeyup="searchCourses()">

        </div>


        <?php if (count($categories)): ?>

        <div
            class="filters"
            id="filters">

            <button
                class="chip active"
                data-cat="all"
                onclick="filterCourses('all',this)">

                <?= t('all') ?>

            </button>


            <?php foreach ($categories as $cat): ?>

                <button
                    class="chip"
                    data-cat="<?= htmlspecialchars($cat) ?>"
                    onclick="filterCourses('<?= htmlspecialchars($cat, ENT_QUOTES) ?>',this)">

                    <?= htmlspecialchars($cat) ?>

                </button>

            <?php endforeach; ?>

        </div>

        <?php endif; ?>

    </div>


    <!-- COURSE GRID -->

    <div
        class="grid"
        id="coursesGrid">


        <?php

        $courses = mysqli_query(
            $conn,
            "SELECT * FROM courses ORDER BY id DESC"
        );

        $count = 0;


        while ($course = mysqli_fetch_assoc($courses)):

            $count++;

            $subscribed = in_array(
                $course['title'],
                $my_subs,
                true
            );

        ?>


        <article
            class="card"
            data-cat="<?= htmlspecialchars($course['category']) ?>"
            data-title="<?= htmlspecialchars($course['title']) ?>">


            <div class="image-wrapper">

                <img
                    class="card-img"
                    src="<?= htmlspecialchars($course['image'] ?? '') ?>"
                    alt="<?= htmlspecialchars($course['title']) ?>"
                    onerror="this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80';">


                <span class="card-category">

                    <?= htmlspecialchars($course['category']) ?>

                </span>

            </div>


            <div class="card-body">

                <h3 class="card-title">

                    <?= htmlspecialchars($course['title']) ?>

                </h3>


                <div class="card-instructor">

                    <?= htmlspecialchars($course['instructor']) ?>

                </div>


                <div class="card-footer">

                    <div class="price">

                        <?= htmlspecialchars($course['price']) ?>

                        <small>
                            <?= t('currency') ?>
                        </small>

                    </div>


                    <?php if ($user_name): ?>

                        <?php if ($subscribed): ?>

                            <a
                                href="Course.php?title=<?= urlencode($course['title']) ?>"
                                class="sub-btn active">

                                <span class="ok">✓</span> <?= t('enter_course') ?>

                            </a>

                        <?php else: ?>

                            <button
                                type="button"
                                class="sub-btn"
                                data-course="<?= htmlspecialchars($course['title']) ?>"
                                data-price="<?= htmlspecialchars($course['price']) ?>"
                                onclick="openPayment(this)">

                                <?= t('sub_now') ?>

                            </button>

                        <?php endif; ?>

                    <?php else: ?>

                        <span
                            class="locked"
                            onclick="loginModal.showModal()">

                            <?= t('login_to_sub') ?>

                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </article>


        <?php endwhile; ?>


        <?php if ($count === 0): ?>

            <div class="empty">

                <?= t('no_courses') ?>

            </div>

        <?php endif; ?>


    </div>

</section>
