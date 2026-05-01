<?php
require_once __DIR__ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $middlename = $_POST['middlename'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    try {
        $sql = "UPDATE students 
                SET name = :name,
                    surname = :surname,
                    middlename = :middlename,
                    address = :address,
                    contact_number = :contact
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':surname' => $surname,
            ':middlename' => $middlename,
            ':address' => $address,
            ':contact' => $contact
        ]);

        header("Location: ../public/index.php?status=updated");
        exit();

    } catch (PDOException $e) {
        echo "Update Error: " . $e->getMessage();
    }
}
?>