<?php
session_start();
require "../database/connection.php";

// استلام البيانات من النموذج
$full_name = trim($_POST["full_name"]);
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$phone = trim($_POST["phone"]);
$address = trim($_POST["address"]);
$password = $_POST["password"];
$confirm_password = $_POST["confirm-password"];

// حفظ الإيميل لجعله يظهر في الحقل عند فشل التسجيل
$_SESSION['email'] = $email;

if ($password === $confirm_password) {
    // تحقق من وجود الحساب مسبقًا
    $check_account = $conn->prepare("SELECT * FROM account WHERE email = :email");
    $check_account->bindParam(":email", $email);
    $check_account->execute();

    if ($check_account->rowCount() === 0) {
        // تشفير كلمة المرور
        $options = ['cost' => 14];
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT, $options);

        // إنشاء الحساب مع الحقول الإضافية
        $create_account = $conn->prepare("
            INSERT INTO account (full_name, email, phone, address, password) 
            VALUES (:full_name, :email, :phone, :address, :password)
        ");
        $create_account->bindParam(":full_name", $full_name);
        $create_account->bindParam(":email", $email);
        $create_account->bindParam(":phone", $phone);
        $create_account->bindParam(":address", $address);
        $create_account->bindParam(":password", $encrypted_password);
        $create_account->execute();

        // إعادة توجيه إلى صفحة تسجيل الدخول
        $_SESSION["success"] = "Registratie is gelukt, log nu in:";
        unset($_SESSION["email"]);
        header("Location: ../pages/login-form.php");
        exit();
    } else {
        $_SESSION["message"] = "Dit e-mailadres is al in gebruik.";
        header("Location: ../pages/register-form.php");
        exit();
    }
} else {
    $_SESSION["message"] = "Wachtwoorden komen niet overeen.";
    header("Location: ../pages/register-form.php");
    exit();
}
