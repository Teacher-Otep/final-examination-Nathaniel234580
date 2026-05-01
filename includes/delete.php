<?php

require_once __DIR__ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'] ?? '';

    if (!empty($id)) {
        try {
            $sql = "DELETE FROM students WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);

            header("Location: ../public/index.php?status=deleted");
            exit();

        } catch (PDOException $e) {
            echo "Delete Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid ID";
    }
}
?>