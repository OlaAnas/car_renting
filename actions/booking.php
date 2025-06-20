<?php
session_start();
require_once "../database/connection.php";

// تحقق من تسجيل الدخول
if (!isset($_SESSION['id'])) {
    header("Location: ../pages/login-form.php");
    exit;
}

$account_id = $_SESSION['id'];
$car_id = isset($_POST['car_id']) ? (int)$_POST['car_id'] : 0;
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';

// تحقق من صحة البيانات
if (!$car_id || !$start_date || !$end_date) {
    $_SESSION['error'] = "Alle velden zijn verplicht.";
    header("Location: ../pages/book-car.php?id=$car_id");
    exit;
}

// تحقق من التواريخ
if (strtotime($end_date) < strtotime($start_date)) {
    $_SESSION['error'] = "Einddatum moet na de startdatum zijn.";
    header("Location: ../pages/book-car.php?id=$car_id");
    exit;
}

try {
    // تنفيذ الحجز
    $stmt = $pdo->prepare("INSERT INTO booking (account_id, car_id, start_date, end_date) VALUES (:account_id, :car_id, :start_date, :end_date)");
    $stmt->bindParam(':account_id', $account_id);
    $stmt->bindParam(':car_id', $car_id);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->execute();

    $_SESSION['success'] = "✅ Reservering succesvol geplaatst!";
    header("Location: ../pages/home.php");
    exit;
} catch (PDOException $e) {
    $_SESSION['error'] = "Er is een fout opgetreden bij het reserveren.";
    header("Location: ../pages/book-car.php?id=$car_id");
    exit;
}
