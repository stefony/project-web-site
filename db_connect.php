<?php
$servername = "localhost";
$username = "root";
$password = "19375Swat+1"; // Твоят MySQL root парола
$dbname = "blog_db_1";

try {
    // Свързване с базата данни
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    
    // Отладка: Уведомява, че връзката е успешна
    echo "Успешно свързване с базата данни!";
    
    // Настройка на PDO режима за грешки
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Показване на грешката при неуспешна връзка
    die("Connection failed: " . $e->getMessage());
}
?>
