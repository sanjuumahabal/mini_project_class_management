<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Teacher Management</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
        .sidebar {
            width: 270px;
            background-color: #007bff;
            color: #fff;
            padding: 20px 10px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .dashboard {
            flex: 1; /* Allow the content area to grow */
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
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
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

        .action-buttons button {
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

        h2 {
            display: block;
            font-size: 1.5em;
            margin-block-start: -0.17em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
        }

        .edit_profile_button, 
        .calculate_salary_button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout {
            position: relative;
            top: -5px;
            right: -795px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s; /* Adding transition */
        }

        .logout:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container" >
        <div class="sidebar">
                <?php include 'sidebar.php'; ?>
        </div>
        <div class="dashboard">
            <div>
                <button class="logout" onclick="location.href='logout.php';"><i class="fa-solid fa-power-off"></i> Logout</button>
            </div>
            <h1>Teacher Management</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact Information</th>
                        <th>Qualifications</th>
                        <th>Teaching Hours</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john@example.com<br>+1 123-456-7890</td>
                        <td>Bachelor's in Education</td>
                        <td>25</td>
                        <td>
                            <button class="edit_profile_button" onclick="editTeacher(1)">Edit Profile</button>
                            <button class="calculate_salary_button" onclick="calculateSalary(1)">Calculate Salary</button>
                        </td>
                    </tr>
                    <!-- Add more rows for other teachers -->
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function editTeacher(teacherId) {
            alert("Editing teacher with ID: " + teacherId);
        }

        function calculateSalary(teacherId) {
            var salary = working_hours * pay_per_hour;
            alert("Calculating salary for teacher with ID: " + teacherId);
        }
    </script>
</body>

</html>