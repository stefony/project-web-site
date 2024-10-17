<?php
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => isset($_SERVER['HTTPS']), // Използвай това, ако сайтът ти е достъпен чрез HTTPS
    'use_strict_mode' => true,
]);

// Проверка дали потребителят е логнат
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;

// Генериране на нов CSRF токен, ако такъв няма
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Настройки за грешки (може да ги деактивирате в продукция)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$errors = [];

// Функция за хеширане на пароли при регистрация
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Функция за проверка на парола при вход
function verifyPassword($inputPassword, $storedHash) {
    return password_verify($inputPassword, $storedHash);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка на CSRF токена
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errors[] = "Невалиден CSRF токен.";
    }

    // Валидация и обработка на формата за контакт
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

        // Проверки на името и имейла
        if (empty($name) || !preg_match("/^[a-zA-Zа-яА-Я ]*$/u", $name)) {
            $errors[] = "Невалидно име.";
        }

        if (!$email) {
            $errors[] = "Невалиден имейл адрес.";
        }

        if (empty($message) || strlen($message) > 1000) {
            $errors[] = "Съобщението трябва да бъде между 1 и 1000 символа.";
        }

        // Ако няма грешки, изпращане на имейл
        if (empty($errors)) {
            $to = "stefony@gmail.com";
            $subject = "Нов контакт от формата за запитвания";
            $body = "Име: $name\nИмейл: $email\nСъобщение:\n$message";
            $headers = "From: no-reply@yourdomain.com\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8";

            if (mail($to, $subject, $body, $headers)) {
                echo "<p style='color:green;'>Вашето съобщение беше изпратено успешно!</p>";
            } else {
                echo "<p style='color:red;'>Грешка при изпращането на съобщението. Моля, опитайте отново.</p>";
            }
        }
    }

    // Обработка на формата за среща
    if (isset($_POST['appointment_date']) && isset($_POST['selected_time'])) {
        $appointmentDate = htmlspecialchars(trim($_POST['appointment_date']), ENT_QUOTES, 'UTF-8');
        $selectedTime = htmlspecialchars(trim($_POST['selected_time']), ENT_QUOTES, 'UTF-8');

        // Валидация на датата и часа
        if (!empty($appointmentDate) && !empty($selectedTime)) {
            $to = "stefony@gmail.com";
            $subject = "Нова среща насрочена";
            $body = "Дата: $appointmentDate\nЧас: $selectedTime";
            $headers = "From: no-reply@yourdomain.com\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8";

            if (mail($to, $subject, $body, $headers)) {
                echo "<p style='color:green;'>Срещата беше запазена успешно!</p>";
            } else {
                echo "<p style='color:red;'>Грешка при запазването на срещата. Моля, опитайте отново.</p>";
            }
        } else {
            $errors[] = "Моля, изберете дата и час за срещата.";
        }
    }

    // Валидация и обработка на полетата от калкулатора
    if (isset($_POST['loanAmount']) && isset($_POST['interestRate']) && isset($_POST['feeRate']) && isset($_POST['loanTerm'])) {
        $loanAmount = filter_var($_POST['loanAmount'], FILTER_VALIDATE_FLOAT);
        $interestRate = filter_var($_POST['interestRate'], FILTER_VALIDATE_FLOAT);
        $feeRate = filter_var($_POST['feeRate'], FILTER_VALIDATE_FLOAT);
        $loanTerm = filter_var($_POST['loanTerm'], FILTER_VALIDATE_INT);

        if ($loanAmount === false || $interestRate === false || $feeRate === false || $loanTerm === false) {
            $errors[] = "Моля, въведете валидни числа.";
        } elseif ($loanAmount <= 0 || $interestRate < 0 || $feeRate < 0 || $loanTerm <= 0) {
            $errors[] = "Всички стойности трябва да са положителни числа.";
        } elseif ($interestRate > 100 || $feeRate > 100) {
            $errors[] = "Лихвата и таксите не могат да надвишават 100%.";
        }

        // Санитизация и валидация на текстови данни
        $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
        $password = trim($_POST['password']); // Паролата също трябва да се валидира
        $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

        // Проверка за header injection в имейл адреса
        if (preg_match("/[\r\n]/", $email)) {
            $errors[] = "Невалиден имейл адрес.";
        }

        // Валидация на паролата
        if (strlen($password) < 8) {
            $errors[] = "Паролата трябва да е поне 8 символа.";
        }

        // Хеширане на паролата преди съхранение (ако се изисква)
        $hashedPassword = hashPassword($password);

        // Логика за запазване на данните в базата (пример)
        // saveToDatabase($name, $email, $hashedPassword, $message);
    }

    // Показване на грешки
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }

    // Генериране на нов CSRF токен след заявка
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
} else {
    echo "<p style='color:red;'>Невалиден метод на заявка.</p>";
}
?>
