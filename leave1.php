<?php
$studentName = $_POST['studentName'];
$parentName = $_POST['parentName'];
$studentContact = $_POST['studentContact'];
$parentContact = $_POST['parentContact'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$timing = $_POST['timing'];
$reason = $_POST['reason'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'leave');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $res = $conn->prepare("INSERT INTO hostel(studentName, parentName, studentContact, parentContact, startDate, endDate, timing, reason) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $res->bind_param("ssiissss", $studentName, $parentName, $studentContact, $parentContact, $startDate, $endDate, $timing, $reason);
    $execval = $res->execute();
    $res->close();
}

// Check if the insert was successful
if ($execval) {
    echo "Form Submitted...";
} else {
    echo "Registration failed: " . $conn->error;
}

// Fetch and display data from the database
$result = mysqli_query($conn, "SELECT * FROM hostel ORDER BY studentName DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th>Student Name</th>
        <th>Parent Name</th>
        <th>Student Contact</th>
        <th>Parent Contact</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Timing</th>
        <th>Reason</th>
    </tr>

    <?php
    while ($res = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($res['studentName']) . '</td>';
        echo '<td>' . htmlspecialchars($res['parentName']) . '</td>';
        echo '<td>' . htmlspecialchars($res['studentContact']) . '</td>';
        echo '<td>' . htmlspecialchars($res['parentContact']) . '</td>';
        echo '<td>' . htmlspecialchars($res['startDate']) . '</td>';
        echo '<td>' . htmlspecialchars($res['endDate']) . '</td>';
        echo '<td>' . htmlspecialchars($res['timing']) . '</td>';
        echo '<td>' . htmlspecialchars($res['reason']) . '</td>';
        echo '</tr>';
    }
    $conn->close();
    ?>

</table>

</body>
</html>
