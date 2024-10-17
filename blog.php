<?php
// Връзка с базата данни чрез db_connect.php
include 'db_connect.php';

try {
    // Подготвяне на заявката с подготвени изрази
    $stmt = $conn->prepare("SELECT title, excerpt FROM articles ORDER BY created_at DESC");
    
    // Изпълнение на заявката
    $stmt->execute();
    
    // Извличане на резултатите
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Отладка: Показване на данните, извлечени от базата данни
    echo "<pre>";
    print_r($result); // Това ще покаже какви данни се извличат от базата
    echo "</pre>";

    // Проверка дали има резултати
    if (count($result) > 0) {
        // Показване на статиите
        foreach ($result as $row) {
            echo "<div class='blog-post'>";
            echo "<h2>" . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . "</h2>";
            echo "<p>" . htmlspecialchars($row['excerpt'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<a href='#'>Прочети повече</a>";
            echo "</div>";
        }
    } else {
        echo "<p>Няма статии.</p>";
    }
} catch (Exception $e) {
    // Показване на грешката в случай на проблем
    error_log("Error fetching data: " . $e->getMessage());
    echo "Грешка при извличане на данни.";
}

// Затваряне на връзката с базата данни
$conn = null;
?>
