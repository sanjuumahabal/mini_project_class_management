<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Teacher Management</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f7f7f7;
        }

        .container {
            display: flex;
            max-width: 1400px;
            margin: auto;
        }

        .dashboard {
            flex: 1;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            text-align: center;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f4f4f4;
        }

        .action-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-buttons button:hover {
            background-color: #0056b3;
        }

        .edit-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            max-width: 80%;
            overflow-y: auto;
        }

        .edit-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .edit-form label {
            display: block;
            margin-bottom: 10px;
        }

        .edit-form input,
        .edit-form select {
            width: calc(100% - 22px);
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .edit-form button {
            width: 100%;
            padding: 10px 0;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-form button:hover {
            background-color: #0056b3;
        }

        .edit-form .close-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 20px;
            cursor: pointer;
        }

        .show-by-form select {
            padding: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            margin-block: 10px;
        }
        .add-slot-button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-slot-button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="dashboard">
            <h1>Teacher Management</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Qualification</th>
                        <th>Pay Per Hour</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    include 'db_connect.php';

                    // Query to fetch teacher data
                    $query = "SELECT T_ID, CONCAT(first_name, ' ', last_name) AS Name, qualification, pay_per_hour FROM Teachers";

                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["T_ID"] . "</td>";
                            echo "<td>" . $row["Name"] . "</td>";
                            echo "<td>" . $row["qualification"] . "</td>";
                            echo "<td>" . $row["pay_per_hour"] . "</td>";
                            echo "<td>";
                            echo "<button onclick=\"editTeacher(" . $row["T_ID"] . ")\">Edit</button>";
                            echo '<button onclick="deleteTeacher(' . $row["T_ID"] . ')">Delete</button>';
                            echo '<button class="add-slot-button" onclick="addSlot(' . $row["T_ID"] . ')">Add Slot</button>';
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No teachers found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <div class="action-buttons">
                <a href="add_teacher.php"><button>Add New Teacher</button></a>
                <button onclick="calculateSalary()">Calculate Salary</button>
            </div>
        </div>
    </div>

    <!-- Modal for editing teacher -->
    <div id="editModal" class="edit-form">
        <span class="close-btn" onclick="closeEditModal()">&times;</span>
        <h2>Edit Teacher</h2>
        <!-- Form for editing teacher will go here -->
    </div>

    <script>
        function editTeacher(teacherId) {
            // Logic to edit teacher with the given ID
            window.location.href = "edit_teacher.php?id=" + teacherId;
        }

        function deleteTeacher(teacherId) {
            // Logic to delete teacher with the given ID
            window.location.href = "delete_teacher.php?id=" + teacherId;
        }

        function addSlot(teacherId) {
            // Logic to redirect to add_slot.php with the teacher ID
            window.location.href = "add_slot.php?teacher_id=" + teacherId;
        }

        function calculateSalary() {
            // Logic to calculate salary for teachers
            window.location.href = "calculate.php?";
        }
    </script>
</body>

</html>
