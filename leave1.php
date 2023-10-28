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
<table border="2">
    <tr>
        <th>studentName</th>
        <th>parentName</th>
        <th>studentContact</th>
        <th>parentContact</th>
        <th>startDate</th>
        <th>endDate</th>
        <th>timing</th>
        <th>reason</th>
        
    </tr>

    <?php
    while ($res = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $res['studentName'] . '</td>';
        echo '<td>' . $res['parentName'] . '</td>';
        echo '<td>' . $res['studentContact'] . '</td>';
        echo '<td>' . $res['parentContact'] . '</td>';
        echo '<td>' . $res['startDate'] . '</td>';
        echo '<td>' . $res['endDate'] . '</td>';
        echo '<td>' . $res['timing'] . '</td>';
        echo '<td>' . $res['reason'] . '</td>';
       
        echo '</tr>';
    }
    $conn->close();
    ?>
</table>
