<?php
require 'db.php';

$stmt = $pdo->query('SELECT * FROM students ORDER BY id DESC');
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records | ITPC 109</title>

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
            min-height: 100vh;
        }

        .navbar {
            background: #0f172a;
            color: white;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 21px;
            font-weight: 700;
        }

        .brand span {
            color: #60a5fa;
        }

        .nav-label {
            font-size: 13px;
            color: #cbd5e1;
        }

        .hero {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            padding: 55px 7%;
        }

        .hero h1 {
            font-size: 38px;
            margin-bottom: 10px;
        }

        .hero p {
            color: #dbeafe;
            font-size: 16px;
            max-width: 650px;
        }

        .container {
            width: 86%;
            max-width: 1200px;
            margin: -25px auto 50px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 24px;
        }

        .toolbar h2 {
            font-size: 22px;
        }

        .toolbar p {
            color: #64748b;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th {
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 16px 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        tr:hover {
            background: #f8fafc;
        }

        .student-id {
            color: #64748b;
            font-weight: 600;
        }

        .student-number {
            font-weight: 700;
            color: #2563eb;
        }

        .course {
            color: #475569;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .action {
            padding: 7px 11px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
        }

        .edit {
            background: #eff6ff;
            color: #2563eb;
        }

        .delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #64748b;
        }

        footer {
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            padding: 25px;
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 16px 5%;
            }

            .hero {
                padding: 40px 5%;
            }

            .hero h1 {
                font-size: 30px;
            }

            .container {
                width: 94%;
            }

            .toolbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="brand">ITPC <span>109</span></div>
    <div class="nav-label">Web Systems and Technologies</div>
</nav>

<section class="hero">
    <h1>Student Records Management</h1>
    <p>Manage student information through a simple PHP and MySQL CRUD application powered by Docker.</p>
</section>

<main class="container">
    <div class="card">

        <div class="toolbar">
            <div>
                <h2>Student Records</h2>
                <p>View and manage registered student information.</p>
            </div>

            <a href="create.php" class="btn btn-primary">
                + Add Student
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (count($students) > 0): ?>

                        <?php foreach ($students as $student): ?>

                            <tr>
                                <td class="student-id">
                                    #<?= htmlspecialchars($student['id']) ?>
                                </td>

                                <td class="student-number">
                                    <?= htmlspecialchars($student['student_number']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($student['first_name']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($student['last_name']) ?>
                                </td>

                                <td class="course">
                                    <?= htmlspecialchars($student['course']) ?>
                                </td>

                                <td>
                                    <div class="actions">

                                        <a
                                            href="edit.php?id=<?= $student['id'] ?>"
                                            class="action edit">
                                            Edit
                                        </a>

                                        <a
                                            href="delete.php?id=<?= $student['id'] ?>"
                                            class="action delete"
                                            onclick="return confirm('Are you sure you want to delete this student?');">
                                            Delete
                                        </a>

                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="6" class="empty">
                                No student records found.
                            </td>
                        </tr>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>

<footer>
    ITPC 109 • Simple PHP + MySQL CRUD Application
</footer>

</body>
</html>