<?php
require 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    exit('Invalid student ID.');
}

$stmt = $pdo->prepare('SELECT * FROM students WHERE id = ?');
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    exit('Student not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | ITPC 109</title>

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

        h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 28px;
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

        <h1>Edit Student</h1>
        <p class="subtitle">Update the student's information below.</p>

        <form method="post" action="update.php">

            <input
                type="hidden"
                name="id"
                value="<?= htmlspecialchars($student['id']) ?>"
            >

            <div class="field">
                <label>Student Number</label>
                <input
                    type="text"
                    name="student_number"
                    value="<?= htmlspecialchars($student['student_number']) ?>"
                    required
                >
            </div>

            <div class="field">
                <label>First Name</label>
                <input
                    type="text"
                    name="first_name"
                    value="<?= htmlspecialchars($student['first_name']) ?>"
                    required
                >
            </div>

            <div class="field">
                <label>Last Name</label>
                <input
                    type="text"
                    name="last_name"
                    value="<?= htmlspecialchars($student['last_name']) ?>"
                    required
                >
            </div>

            <div class="field">
                <label>Course</label>
                <input
                    type="text"
                    name="course"
                    value="<?= htmlspecialchars($student['course']) ?>"
                    required
                >
            </div>

            <div class="buttons">
                <button type="submit">Update Student</button>
                <a href="index.php" class="back">Cancel</a>
            </div>

        </form>

    </div>

</main>

</body>
</html>