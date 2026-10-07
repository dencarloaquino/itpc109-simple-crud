<?php
require 'db.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    exit('Invalid student ID.');
}

$student_number = trim($_POST['student_number'] ?? '');
$first_name = trim($_POST['first_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$course = trim($_POST['course'] ?? '');

if (
    $student_number === '' ||
    $first_name === '' ||
    $last_name === '' ||
    $course === ''
) {
    exit('All fields are required.');
}

try {

    $stmt = $pdo->prepare(
        'UPDATE students
         SET student_number = ?,
             first_name = ?,
             last_name = ?,
             course = ?
         WHERE id = ?'
    );

    $stmt->execute([
        $student_number,
        $first_name,
        $last_name,
        $course,
        $id
    ]);

    header('Location: index.php');
    exit;

} catch (PDOException $e) {

    if ($e->getCode() === '23000') {
        exit('Student number already exists.');
    }

    exit('Unable to update the student record.');
}