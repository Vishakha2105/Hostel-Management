<!DOCTYPE html>
<html>
<head>
    <title>Room Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Room Booking Information</h1>
        <?php
        // PHP code to handle form submission and database operations

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
        <table>
            <tr>
                <th>Room Number</th>
                <th>Start Date</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Father Name</th>
                <th>Mother Name</th>
                <th>Contact Number</th>
                <th>Home Address</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
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
    </div>
</body>
</html>