<?php
/*
 * ARKA Academy - الصفحة الرئيسية للموقع (كانت ARKA_sc.php)
 */

session_start();

require __DIR__ . '/config/database.php';   // الاتصال بقاعدة البيانات ($conn)
require __DIR__ . '/config/google.php';     // إعدادات تسجيل الدخول بجوجل

require __DIR__ . '/app/common.php';         // اللغة + دوال مشتركة
require __DIR__ . '/app/site/helpers.php';   // دوال مساعدة
require __DIR__ . '/app/site/schema.php';    // إنشاء الجداول
require __DIR__ . '/app/site/logout.php';    // تسجيل الخروج
require __DIR__ . '/app/site/register.php';  // إنشاء حساب
require __DIR__ . '/app/site/login.php';     // تسجيل الدخول
require __DIR__ . '/app/site/google.php';    // تسجيل الدخول بجوجل
require __DIR__ . '/app/site/user.php';      // المستخدم الحالي
require __DIR__ . '/app/site/subscribe.php'; // الاشتراك / إلغاء الاشتراك
require __DIR__ . '/app/site/data.php';      // بيانات الصفحة

require __DIR__ . '/views/site/index.php';   // عرض الصفحة
