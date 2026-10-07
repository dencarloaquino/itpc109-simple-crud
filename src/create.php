<?php
require 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
        $error = 'All fields are required.';
    } else {

        try {

            $stmt = $pdo->prepare(
                'INSERT INTO students
                (student_number, first_name, last_name, course)
                VALUES (?, ?, ?, ?)'
            );

            $stmt->execute([
                $student_number,
                $first_name,
                $last_name,
                $course
            ]);

            header('Location: index.php');
            exit;

        } catch (PDOException $e) {

            if ($e->getCode() === '23000') {
                $error = 'Student number already exists.';
            } else {
                $error = 'Unable to save the student record.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student | ITPC 109</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1e293b;
        }

        .navbar {
            background: #0f172a;
            color: white;
            padding: 18px 7%;
        }

        .brand {
            font-size: 21px;
            font-weight: 700;
        }

        .brand span {
            color: #60a5fa;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        }

        .heading {
            margin-bottom: 28px;
        }

        .heading h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .heading p {
            color: #64748b;
            font-size: 14px;
        }

        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 13px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #334155;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #dbeafe;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 28px;
        }

        button,
        .back {
            padding: 12px 18px;
            border-radius: 9px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        button {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #e2e8f0;
            color: #334155;
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="brand">ITPC <span>109</span></div>
</nav>

<main class="container">

    <div class="card">

        <div class="heading">
            <h1>Add Student</h1>
            <p>Enter the student's information below.</p>
        </div>

        <?php if ($error): ?>
            <div class="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post">

            <div class="field">
                <label>Student Number</label>
                <input
                    type="text"
                    name="student_number"
                    placeholder="e.g. 2026-0003"
                    value="<?= htmlspecialchars($_POST['student_number'] ?? '') ?>"
                    required
                >
            </div>

            <div class="field">
                <label>First Name</label>
                <input
                    type="text"
                    name="first_name"
                    placeholder="Enter first name"
                    value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>"
                    required
                >
            </div>

            <div class="field">
                <label>Last Name</label>
                <input
                    type="text"
                    name="last_name"
                    placeholder="Enter last name"
                    value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>"
                    required
                >
            </div>

            <div class="field">
                <label>Course</label>
                <input
                    type="text"
                    name="course"
                    placeholder="e.g. BS Information Technology"
                    value="<?= htmlspecialchars($_POST['course'] ?? '') ?>"
                    required
                >
            </div>

            <div class="buttons">
                <button type="submit">Save Student</button>
                <a href="index.php" class="back">Cancel</a>
            </div>

        </form>

    </div>

</main>

</body>
</html>