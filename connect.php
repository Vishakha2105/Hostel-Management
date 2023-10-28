<?php
$roomNumber = $_POST['roomNumber'];
$startDate = $_POST['startDate'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$phoneNumber = $_POST['phoneNumber'];
$fatherName = $_POST['fatherName'];
$motherName = $_POST['motherName'];
$contactNumber = $_POST['contactNumber'];
$homeAddress = $_POST['homeAddress'];
$city = $_POST['city'];
$state = $_POST['state'];
$postalCode = $_POST['postalCode'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'test');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $res = $conn->prepare("INSERT INTO nmims(roomNumber, startDate, firstName, lastName, email, gender, phoneNumber, fatherName, motherName, contactNumber, homeAddress, city, state, postalCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $res->bind_param("isssssississsi", $roomNumber, $startDate, $firstName, $lastName, $email, $gender, $phoneNumber, $fatherName, $motherName, $contactNumber, $homeAddress, $city, $state, $postalCode);
    $execval = $res->execute();
    $res->close();
}

// Check if the insert was successful
if ($execval) {
    echo "Booked successfully...";
} else {
    echo "Registration failed: " . $conn->error;
}

// Fetch and display data from the database
$result = mysqli_query($conn, "SELECT * FROM nmims ORDER BY roomNumber DESC");
?>

<table border="1"
 >
    <tr	>
        <th
>RoomNumber</th>
        <th>StartName</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Email</th>
        <th>Gender</th>
        <th>PhoneNumber</th>
        <th>FatherName</th>
        <th>MotherName</th>
        <th>ContactNumber</th>
        <th>Home Address</th>
        <th>City</th>
        <th>State</th>
        <th>PostalCode</th>
    </tr>

    <?php
    while ($res = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $res['roomNumber'] . '</td>';
        echo '<td>' . $res['startDate'] . '</td>';
        echo '<td>' . $res['firstName'] . '</td>';
        echo '<td>' . $res['lastName'] . '</td>';
        echo '<td>' . $res['email'] . '</td>';
        echo '<td>' . $res['gender'] . '</td>';
        echo '<td>' . $res['phoneNumber'] . '</td>';
        echo '<td>' . $res['fatherName'] . '</td>';
        echo '<td>' . $res['motherName'] . '</td>';
        echo '<td>' . $res['contactNumber'] . '</td>';
        echo '<td>' . $res['homeAddress'] . '</td>';
        echo '<td>' . $res['city'] . '</td>';
        echo '<td>' . $res['state'] . '</td>';
        echo '<td>' . $res['postalCode'] . '</td>';
        echo '</tr>';
    }
    $conn->close();
    ?>
</table>
