<?php
session_start();
require_once "../database/connection.php"; // تأكد من المسار الصحيح لملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // حفظ البريد في السيشن لملئه تلقائيًا عند الخطأ
    $_SESSION['email'] = $email;

    // تحقق من أن الحقول غير فارغة
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Gelieve alle velden in te vullen."; // Please fill in all fields
        header("Location: ../pages/login-form.php");
        exit;
    }

    // الاستعلام عن المستخدم
    $stmt = $conn->prepare("SELECT * FROM account WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // تسجيل الدخول ناجح
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // تنظيف الجلسة من أي رسائل قديمة
        unset($_SESSION['error']);

        header("Location: ../index.php"); // إعادة توجيه للموقع الرئيسي
        exit;
    } else {
        // فشل في تسجيل الدخول
        $_SESSION['error'] = "E-mailadres of wachtwoord is onjuist."; // البريد أو كلمة السر خاطئة
        header("Location: ../pages/login-form.php");
        exit;
    }
} else {
    // الوصول غير المسموح
    header("Location: ../pages/login-form.php");
    exit;
}
