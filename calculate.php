<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Slots</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 1200px;
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

        .filter-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .filter-btn:hover {
            background-color: #0056b3;
        }

        .filter-form {
            margin-bottom: 20px;
        }

        .filter-form select {
            padding: 10px;
            font-size: 16px;
        }

        .result {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }

        .redirect-link {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
        }

        .redirect-link:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="dashboard">
            <h1>View Slots</h1>
            <a href="teacher_management.php" class="redirect-link">Go to Teacher Management</a>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="filter-form">
                <label for="teacher_id">Select Teacher ID:</label>
                <select name="teacher_id" id="teacher_id">
                    <option value="">All</option>
                    <?php
                    // Include the database connection file
                    include 'db_connect.php';

                    // Query to fetch distinct teacher IDs
                    $query = "SELECT DISTINCT Teacher_ID FROM Slots";

                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Output options for each distinct teacher ID
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["Teacher_ID"] . "'>" . $row["Teacher_ID"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <button type="submit" class="filter-btn">Filter</button>
            </form>
            <?php
            // Check if a teacher ID filter is applied
            if (isset($_GET["teacher_id"]) && !empty($_GET["teacher_id"])) {
                $teacherId = $_GET["teacher_id"];

                // Query to fetch total duration hours for the teacher
                $query = "SELECT SUM(Duration_Hours) AS total_duration FROM Slots WHERE Teacher_ID = $teacherId";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $totalDuration = $row['total_duration'];

                    // Fetch pay per hour for the teacher
                    $query = "SELECT pay_per_hour FROM Teachers WHERE T_ID = $teacherId";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $payPerHour = $row['pay_per_hour'];

                        // Calculate total salary
                        $totalSalary = $payPerHour * $totalDuration;

                        // Display the result
                        echo "<div class='result'>Total Salary for Teacher ID $teacherId: $totalSalary</div>";
                    } else {
                        echo "<div class='result'>Error: Pay per hour not found for Teacher ID $teacherId</div>";
                    }
                } else {
                    echo "<div class='result'>No slots found for Teacher ID $teacherId</div>";
                }
            }
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Slot ID</th>
                        <th>Teacher ID</th>
                        <th>Slot Date</th>
                        <th>From Time</th>
                        <th>To Time</th>
                        <th>Duration Hours</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if a teacher ID filter is applied
                    $filter = "";
                    if (isset($_GET["teacher_id"]) && !empty($_GET["teacher_id"])) {
                        $filter = " WHERE Teacher_ID = " . $_GET["teacher_id"];
                    }

                    // Query to fetch slots data with optional filter
                    $query = "SELECT * FROM Slots" . $filter;

                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["Slot_ID"] . "</td>";
                            echo "<td>" . $row["Teacher_ID"] . "</td>";
                            echo "<td>" . $row["Slot_Date"] . "</td>";
                            echo "<td>" . $row["From_Time"] . "</td>";
                            echo "<td>" . $row["To_Time"] . "</td>";
                            echo "<td>" . $row["Duration_Hours"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No slots found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
