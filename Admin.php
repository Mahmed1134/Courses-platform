<?php
/*
 * ARKA Admin - لوحة التحكم (Admin.php)
 */

session_start();

require __DIR__ . '/config/database.php';     // الاتصال بقاعدة البيانات ($conn)
require __DIR__ . '/config/admin.php';        // كلمة مرور الأدمن
require __DIR__ . '/app/common.php';          // دوال مشتركة (youtube_id)
require __DIR__ . '/app/site/schema.php';     // التأكد من وجود الجداول

require __DIR__ . '/app/admin/auth.php';      // تسجيل الخروج + الدخول + فحص الصلاحية

/* صفحة تسجيل الدخول (لو مش أدمن) */
if (!$is_admin) {

    require __DIR__ . '/views/admin/login.php';

    exit();
}

require __DIR__ . '/app/admin/add_course.php';      // إضافة كورس
require __DIR__ . '/app/admin/update_course.php';   // تعديل كورس
require __DIR__ . '/app/admin/delete_course.php';   // حذف كورس
require __DIR__ . '/app/admin/lessons.php';         // دروس الكورسات
require __DIR__ . '/app/admin/edit_course.php';     // جلب كورس للتعديل
require __DIR__ . '/app/admin/dashboard_data.php';  // إحصائيات + قائمة الكورسات

require __DIR__ . '/views/admin/dashboard.php';     // عرض لوحة التحكم
