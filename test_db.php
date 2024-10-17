<?php
include 'db_connect.php';

try {
    $stmt = $conn->prepare("SELECT title, excerpt FROM articles ORDER BY created_at DESC");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($result);
    echo "</pre>";

    if (count($result) > 0) {
        foreach ($result as $row) {
            echo "<h2>" . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . "</h2>";
            echo "<p>" . htmlspecialchars($row['excerpt'], ENT_QUOTES, 'UTF-8') . "</p>";
        }
    } else {
        echo "<p>Няма статии.</p>";
    }
} catch (Exception $e) {
    echo "Грешка при извличане на данни: " . $e->getMessage();
}

$conn = null;
?>
