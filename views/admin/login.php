<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width,initial-scale=1">

<title>ARKA Admin Login</title>

<link
href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap"
rel="stylesheet">


<link rel="stylesheet" href="assets/css/admin/login.css?v=<?= @filemtime(__DIR__ . '/../../assets/css/admin/login.css') ?: 1 ?>">


</head>


<body>


<div class="login-card">

    <h1>
        ARKA Admin
    </h1>


    <p class="subtitle">
        لوحة إدارة منصة ARKA
    </p>


    <?php if(isset($login_error)): ?>

        <div class="error">

            <?= htmlspecialchars($login_error) ?>

        </div>

    <?php endif; ?>


    <form method="POST">


        <input
            type="password"
            name="password"
            placeholder="كلمة مرور الأدمن"
            required
            autofocus>


        <button
            type="submit"
            name="admin_login">

            دخول إلى لوحة التحكم

        </button>


    </form>


    <a
        href="Go2.php"
        class="back">

        ← العودة إلى ARKA

    </a>


</div>


</body>

</html>
